<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMakananRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only admin can create makanan
        return Auth::check() && Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255|unique:makanan,nama',
            'daerah_id' => 'required|exists:daerahs,id',
            'deskripsi' => 'required|string|max:1000',
            'resep' => 'required|string',
            'panduan' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=100,min_height=100',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama makanan wajib diisi.',
            'nama.unique' => 'Nama makanan sudah ada dalam database.',
            'daerah_id.required' => 'Daerah wajib dipilih.',
            'daerah_id.exists' => 'Daerah yang dipilih tidak valid.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.max' => 'Deskripsi maksimal 1000 karakter.',
            'resep.required' => 'Resep wajib diisi.',
            'panduan.required' => 'Panduan wajib diisi.',
            'image.required' => 'Gambar wajib dipilih.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat: jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
            'image.dimensions' => 'Dimensi gambar minimal 100x100 pixels.',
        ];
    }
}
