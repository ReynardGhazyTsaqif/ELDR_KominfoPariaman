<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class PegawaiDirectoryController extends Controller
{
    /**
     * Listing Direktori Pegawai ASN (Read-Only)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $unitFilter = $request->input('unit_kerja');

        $query = Pegawai::with('unitKerja');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_pegawai', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        if ($unitFilter) {
            $query->whereHas('unitKerja', function ($q) use ($unitFilter) {
                $q->where('d_unit_kerja.unit_kerja_key', $unitFilter);
            });
        }

        $pegawais = $query->orderBy('pegawai_key', 'asc')->paginate(12)->withQueryString();

        $totalPegawai = Pegawai::count();
        $unitKerjaList = UnitKerja::all();

        return view('pegawai.index', [
            'pegawais' => $pegawais,
            'totalPegawai' => $totalPegawai,
            'unitKerjaList' => $unitKerjaList,
            'search' => $search,
            'unitFilter' => $unitFilter,
        ]);
    }

    /**
     * Show detail pegawai
     */
    public function show($id)
    {
        $pegawai = Pegawai::with('unitKerja')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $pegawai,
        ]);
    }
}
