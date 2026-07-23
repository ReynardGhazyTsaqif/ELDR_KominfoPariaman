<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStafRequest;
use App\Http\Requests\UpdateStafRequest;
use App\Models\Desa;
use App\Models\Masyarakat;
use App\Models\Subjek;
use App\Models\PengajuanDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MasterStafController extends Controller
{
    private function authorizeSuperAdmin(): void
    {
        $user = Auth::user();
        if (!$user || !$user->hasRole('super_admin')) {
            abort(403, 'Anda tidak memiliki hak akses sebagai Super Administrator.');
        }
    }

    public function index(Request $request)
    {
        $this->authorizeSuperAdmin();

        $search = $request->input('search');
        $desaFilter = $request->input('desa');

        $query = Masyarakat::with('desa');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_masyarakat', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        if ($desaFilter) {
            $query->whereHas('desa', function ($q) use ($desaFilter) {
                $q->where('d_desa.desa_key', $desaFilter);
            });
        }

        $stafs = $query->orderBy('masyarakat_key', 'desc')->paginate(10)->withQueryString();

        $totalStaf = Masyarakat::count();
        $activeDesas = Desa::where('f_status', '1')->get();

        return view('master.staf', [
            'stafs' => $stafs,
            'totalStaf' => $totalStaf,
            'activeDesas' => $activeDesas,
            'search' => $search,
            'desaFilter' => $desaFilter,
        ]);
    }

    public function store(StoreStafRequest $request)
    {
        $this->authorizeSuperAdmin();

        return DB::transaction(function () use ($request) {
            try {
                $masyarakat = Masyarakat::create([
                    'nik' => $request->nik,
                    'nama_masyarakat' => $request->nama_masyarakat,
                ]);

                $desa = Desa::findOrFail($request->desa_key);
                $masyarakat->desa()->sync([$request->desa_key]);

                // Sync to d_subjek
                Subjek::updateOrCreate(
                    ['nomor_identitas' => $request->nik],
                    [
                        'nama_subjek' => $request->nama_masyarakat,
                        'tipe_subjek' => 'Masyarakat',
                        'unit_kerja' => $desa->desa_nama,
                    ]
                );

                return redirect()->route('master.staf')
                    ->with('success', "Staf desa / masyarakat '{$masyarakat->nama_masyarakat}' berhasil ditambahkan!");
            } catch (\Exception $e) {
                return redirect()->route('master.staf')
                    ->with('error', 'Gagal menambahkan staf desa: ' . $e->getMessage());
            }
        });
    }

    public function update(UpdateStafRequest $request, $id)
    {
        $this->authorizeSuperAdmin();

        return DB::transaction(function () use ($request, $id) {
            $masyarakat = Masyarakat::findOrFail($id);

            try {
                $oldNik = $masyarakat->nik;

                $masyarakat->update([
                    'nik' => $request->nik,
                    'nama_masyarakat' => $request->nama_masyarakat,
                ]);

                $desa = Desa::findOrFail($request->desa_key);
                $masyarakat->desa()->sync([$request->desa_key]);

                // Sync to d_subjek
                $subjek = Subjek::where('nomor_identitas', $oldNik)->first();
                if ($subjek) {
                    $subjek->update([
                        'nomor_identitas' => $request->nik,
                        'nama_subjek' => $request->nama_masyarakat,
                        'unit_kerja' => $desa->desa_nama,
                    ]);
                } else {
                    Subjek::create([
                        'nomor_identitas' => $request->nik,
                        'nama_subjek' => $request->nama_masyarakat,
                        'tipe_subjek' => 'Masyarakat',
                        'unit_kerja' => $desa->desa_nama,
                    ]);
                }

                return redirect()->route('master.staf')
                    ->with('success', "Data staf '{$masyarakat->nama_masyarakat}' berhasil diperbarui!");
            } catch (\Exception $e) {
                return redirect()->route('master.staf')
                    ->with('error', 'Gagal memperbarui staf desa: ' . $e->getMessage());
            }
        });
    }

    public function destroy($id)
    {
        $this->authorizeSuperAdmin();

        $masyarakat = Masyarakat::findOrFail($id);

        // Check FK Usage in ff_pengajuan_dokumen via d_subjek
        $subjek = Subjek::where('nomor_identitas', $masyarakat->nik)->first();
        if ($subjek) {
            $isUsed = PengajuanDokumen::where('subjek_key', $subjek->subjek_key)->exists();

            if ($isUsed) {
                return redirect()->route('master.staf')
                    ->with('error', "Staf/Masyarakat '{$masyarakat->nama_masyarakat}' tidak dapat dihapus karena terhubung dengan riwayat pengajuan dokumen.");
            }
        }

        return DB::transaction(function () use ($masyarakat, $subjek) {
            try {
                $nama = $masyarakat->nama_masyarakat;

                $masyarakat->desa()->detach();
                $masyarakat->delete();

                if ($subjek) {
                    $subjek->delete();
                }

                return redirect()->route('master.staf')
                    ->with('success', "Staf/Masyarakat '{$nama}' berhasil dihapus.");
            } catch (\Exception $e) {
                return redirect()->route('master.staf')
                    ->with('error', 'Gagal menghapus staf: ' . $e->getMessage());
            }
        });
    }
}
