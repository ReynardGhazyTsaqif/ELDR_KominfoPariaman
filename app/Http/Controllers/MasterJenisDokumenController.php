<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJenisDokumenRequest;
use App\Http\Requests\UpdateJenisDokumenRequest;
use App\Models\JenisDokumen;
use App\Models\PengajuanDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterJenisDokumenController extends Controller
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

        $query = JenisDokumen::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('jenis_dokumen', 'like', "%{$search}%")
                  ->orWhere('kode_jenis_dokumen', 'like', "%{$search}%");
            });
        }

        $jenisDokumenList = $query->orderBy('jenis_dokumen_key', 'asc')->paginate(10)->withQueryString();

        $totalJenis = JenisDokumen::count();

        return view('master.jenis', [
            'jenisList' => $jenisDokumenList,
            'jenisDokumenList' => $jenisDokumenList,
            'totalJenis' => $totalJenis,
            'search' => $search,
        ]);
    }

    public function store(StoreJenisDokumenRequest $request)
    {
        $this->authorizeSuperAdmin();

        try {
            $jenis = JenisDokumen::create([
                'kode_jenis_dokumen' => $request->kode_jenis_dokumen,
                'jenis_dokumen' => $request->jenis_dokumen,
            ]);

            return redirect()->route('master.jenis')
                ->with('success', "Jenis dokumen '{$jenis->jenis_dokumen}' berhasil ditambahkan!");
        } catch (\Exception $e) {
            return redirect()->route('master.jenis')
                ->with('error', 'Gagal menambahkan jenis dokumen: ' . $e->getMessage());
        }
    }

    public function update(UpdateJenisDokumenRequest $request, $id)
    {
        $this->authorizeSuperAdmin();

        $jenis = JenisDokumen::findOrFail($id);

        try {
            $jenis->update([
                'kode_jenis_dokumen' => $request->kode_jenis_dokumen,
                'jenis_dokumen' => $request->jenis_dokumen,
            ]);

            return redirect()->route('master.jenis')
                ->with('success', "Data jenis dokumen '{$jenis->jenis_dokumen}' berhasil diperbarui!");
        } catch (\Exception $e) {
            return redirect()->route('master.jenis')
                ->with('error', 'Gagal memperbarui jenis dokumen: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $this->authorizeSuperAdmin();

        $jenis = JenisDokumen::findOrFail($id);

        // Check FK Constraint: Prevent delete if used in transaction table ff_pengajuan_dokumen
        $isUsed = PengajuanDokumen::where('jenis_dokumen_key', $id)->exists();
        if ($isUsed) {
            return redirect()->route('master.jenis')
                ->with('error', "Jenis dokumen '{$jenis->jenis_dokumen}' tidak dapat dihapus karena sudah digunakan dalam transaksi pengajuan dokumen.");
        }

        try {
            $nama = $jenis->jenis_dokumen;
            $jenis->delete();

            return redirect()->route('master.jenis')
                ->with('success', "Jenis dokumen '{$nama}' berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->route('master.jenis')
                ->with('error', 'Gagal menghapus jenis dokumen: ' . $e->getMessage());
        }
    }
}
