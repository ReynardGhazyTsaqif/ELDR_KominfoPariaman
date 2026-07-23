<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJenisDokumenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->hasRole('super_admin');
    }

    public function rules(): array
    {
        $jenisKey = $this->route('id');

        return [
            'kode_jenis_dokumen' => 'required|string|max:10|unique:d_jenis_dokumen,kode_jenis_dokumen,' . $jenisKey . ',jenis_dokumen_key',
            'jenis_dokumen' => 'required|string|max:150',
        ];
    }

    public function messages(): array
    {
        return [
            'kode_jenis_dokumen.required' => 'Kode jenis dokumen wajib diisi.',
            'kode_jenis_dokumen.unique' => 'Kode jenis dokumen sudah digunakan kategori lain.',
            'jenis_dokumen.required' => 'Nama jenis dokumen wajib diisi.',
        ];
    }
}
