<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDesaRequest;
use App\Http\Requests\UpdateDesaRequest;
use App\Models\Desa;
use App\Models\Subjek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterDesaController extends Controller
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

        $query = Desa::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('desa_nama', 'like', "%{$search}%")
                  ->orWhere('desa_kode', 'like', "%{$search}%");
            });
        }

        $desas = $query->orderBy('desa_key', 'desc')->paginate(10)->withQueryString();

        $totalDesa = Desa::count();
        $activeDesa = Desa::where('f_status', '1')->count();
        $inactiveDesa = Desa::where('f_status', '0')->count();

        return view('master.desa', [
            'desas' => $desas,
            'totalDesa' => $totalDesa,
            'activeDesa' => $activeDesa,
            'inactiveDesa' => $inactiveDesa,
            'search' => $search,
        ]);
    }

    public function store(StoreDesaRequest $request)
    {
        $this->authorizeSuperAdmin();

        try {
            $desa = Desa::create([
                'desa_kode' => $request->desa_kode,
                'desa_nama' => $request->desa_nama,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'f_status' => '1',
            ]);

            return redirect()->route('master.desa')
                ->with('success', "Desa '{$desa->desa_nama}' berhasil ditambahkan!");
        } catch (\Exception $e) {
            return redirect()->route('master.desa')
                ->with('error', 'Gagal menambahkan desa: ' . $e->getMessage());
        }
    }

    public function update(UpdateDesaRequest $request, $id)
    {
        $this->authorizeSuperAdmin();

        $desa = Desa::findOrFail($id);

        try {
            $desa->update([
                'desa_kode' => $request->desa_kode,
                'desa_nama' => $request->desa_nama,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
            ]);

            return redirect()->route('master.desa')
                ->with('success', "Data desa '{$desa->desa_nama}' berhasil diperbarui!");
        } catch (\Exception $e) {
            return redirect()->route('master.desa')
                ->with('error', 'Gagal memperbarui desa: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        $this->authorizeSuperAdmin();

        $desa = Desa::findOrFail($id);

        try {
            $newStatus = $desa->f_status === '1' ? '0' : '1';

            // Check if deactivating a desa with active masyarakat
            if ($newStatus === '0') {
                $masyarakatCount = $desa->masyarakat()->count();
                if ($masyarakatCount > 0) {
                    $desa->f_status = '0';
                    $desa->save();

                    return redirect()->route('master.desa')
                        ->with('warning', "Desa '{$desa->desa_nama}' dinonaktifkan (Peringatan: Terdapat {$masyarakatCount} staf/masyarakat terdaftar).");
                }
            }

            $desa->f_status = $newStatus;
            $desa->save();

            $statusText = $newStatus === '1' ? 'diaktifkan' : 'dinonaktifkan';

            return redirect()->route('master.desa')
                ->with('success', "Status desa '{$desa->desa_nama}' berhasil {$statusText}.");
        } catch (\Exception $e) {
            return redirect()->route('master.desa')
                ->with('error', 'Gagal mengubah status desa: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $this->authorizeSuperAdmin();

        $desa = Desa::findOrFail($id);

        // Check FK usage in ft_masyarakat or d_subjek unit_kerja
        $masyarakatCount = $desa->masyarakat()->count();
        $subjekCount = Subjek::where('unit_kerja', $desa->desa_nama)->exists();

        if ($masyarakatCount > 0 || $subjekCount) {
            return redirect()->route('master.desa')
                ->with('error', "Desa '{$desa->desa_nama}' tidak dapat dihapus karena memiliki staf/masyarakat terdaftar atau riwayat pengajuan dokumen. Silakan nonaktifkan status desa.");
        }

        try {
            $nama = $desa->desa_nama;
            $desa->delete();

            return redirect()->route('master.desa')
                ->with('success', "Desa '{$nama}' berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->route('master.desa')
                ->with('error', 'Gagal menghapus desa: ' . $e->getMessage());
        }
    }
}
