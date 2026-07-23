<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDesaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->hasRole('super_admin');
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'tanggal_mulai' => $this->tanggal_mulai ?: null,
            'tanggal_selesai' => $this->tanggal_selesai ?: null,
        ]);
    }

    public function rules(): array
    {
        $desaKey = $this->route('id');

        return [
            'desa_kode' => 'required|string|max:10|unique:d_desa,desa_kode,' . $desaKey . ',desa_key',
            'desa_nama' => 'required|string|max:150',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ];
    }

    public function messages(): array
    {
        return [
            'desa_kode.required' => 'Kode desa wajib diisi.',
            'desa_kode.unique' => 'Kode desa sudah digunakan desa lain.',
            'desa_nama.required' => 'Nama desa wajib diisi.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
        ];
    }
}
