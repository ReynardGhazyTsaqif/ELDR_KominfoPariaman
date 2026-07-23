<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusLabelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->hasRole('super_admin');
    }

    public function rules(): array
    {
        return [
            'status' => 'required|string|max:150',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Label / Deskripsi status wajib diisi.',
        ];
    }
}
