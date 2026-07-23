<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->hasRole('super_admin');
    }

    public function rules(): array
    {
        $userId = $this->route('id');

        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $userId,
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:super_admin,admin_opd,admin_desa,admin_hukum,kabag_hukum',
            'tipe_login' => 'nullable|string|in:pegawai,masyarakat',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama pengguna wajib diisi.',
            'username.required' => 'Username / NIP / NIK wajib diisi.',
            'username.unique' => 'Username / NIP / NIK sudah digunakan pengguna lain.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Alamat email sudah digunakan pengguna lain.',
            'password.min' => 'Password baru minimal terdiri dari 8 karakter.',
            'role.required' => 'Peran (role) pengguna wajib dipilih.',
            'role.in' => 'Peran yang dipilih tidak valid.',
        ];
    }
}
