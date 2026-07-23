<?php

namespace App\Services;

use App\Models\Subjek;
use App\Models\Pegawai;
use App\Models\Masyarakat;
use App\Models\User;

class SubjekService
{
    /**
     * Cari atau buat record d_subjek untuk User berdasarkan NIP / NIK.
     */
    public function findOrCreateForUser(User $user): Subjek
    {
        if ($user->subjek_key) {
            $subjek = Subjek::find($user->subjek_key);
            if ($subjek) {
                return $subjek;
            }
        }

        $identifier = $user->username ?? $user->email;
        $namaSubjek = $user->name;
        $tipeSubjek = $user->tipe_login === 'masyarakat' ? 'Masyarakat' : 'Pegawai';
        $unitKerja = null;

        if ($user->tipe_login === 'masyarakat') {
            $masyarakat = Masyarakat::where('nik', $identifier)->first();
            if ($masyarakat) {
                $namaSubjek = $masyarakat->nama_masyarakat;
                $desa = $masyarakat->desa()->first();
                if ($desa) {
                    $unitKerja = $desa->desa_nama;
                }
            }
        } else {
            $pegawai = Pegawai::where('nip', $identifier)->first();
            if ($pegawai) {
                $namaSubjek = $pegawai->nama_pegawai;
                $uk = $pegawai->unitKerja()->first();
                if ($uk) {
                    $unitKerja = $uk->unit_kerja_nama;
                }
            }
        }

        $subjek = Subjek::updateOrCreate(
            ['nomor_identitas' => $identifier],
            [
                'nama_subjek' => $namaSubjek,
                'tipe_subjek' => $tipeSubjek,
                'unit_kerja' => $unitKerja,
            ]
        );

        $user->subjek_key = $subjek->subjek_key;
        $user->save();

        return $subjek;
    }
}
