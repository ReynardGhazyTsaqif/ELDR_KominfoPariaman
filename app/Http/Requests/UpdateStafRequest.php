<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStafRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->hasRole('super_admin');
    }

    public function rules(): array
    {
        $stafKey = $this->route('id');

        return [
            'nik' => 'required|string|max:30|unique:d_masyarakat,nik,' . $stafKey . ',masyarakat_key',
            'nama_masyarakat' => 'required|string|max:255',
            'desa_key' => 'required|integer|exists:d_desa,desa_key',
        ];
    }

    public function messages(): array
    {
        return [
            'nik.required' => 'NIK / Nomor Identitas wajib diisi.',
            'nik.unique' => 'NIK sudah terdaftar pada orang lain.',
            'nama_masyarakat.required' => 'Nama staf / masyarakat wajib diisi.',
            'desa_key.required' => 'Desa asal wajib dipilih.',
            'desa_key.exists' => 'Desa yang dipilih tidak valid.',
        ];
    }
}
