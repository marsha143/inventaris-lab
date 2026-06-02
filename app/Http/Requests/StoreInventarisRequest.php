<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventarisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_barang' => ['required', 'string', 'max:30', 'unique:inventaris,kode_barang'],
            'nama_barang' => ['required', 'string', 'min:3', 'max:100'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'kondisi' => ['required', 'in:Baik,Rusak Ringan,Rusak Berat'],
            'jumlah' => ['required', 'integer', 'min:1', 'max:999'],
            'tanggal_pengadaan' => ['required', 'date', 'before_or_equal:today'],
            'deskripsi' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'kode_barang.required' => 'Kode barang wajib diisi.',
            'kode_barang.unique' => 'Kode barang sudah digunakan.',
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.min' => 'Nama barang minimal 3 karakter.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori tidak valid.',
            'jumlah.min' => 'Jumlah minimal 1.',
            'tanggal_pengadaan.before_or_equal' => 'Tanggal pengadaan tidak boleh melebihi hari ini.',
        ];
    }
}