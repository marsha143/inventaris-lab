<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInventarisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        $id = $this->route('inventaris')?->id;

        return [
            'kode_barang'        => ['required', 'string', 'max:30', Rule::unique('inventaris', 'kode_barang')->ignore($id)],
            'nama_barang'        => ['required', 'string', 'min:3', 'max:100'],
            'kategori_id'        => ['required', 'exists:kategoris,id'],
            'kondisi'            => ['required', 'in:Baik,Rusak Ringan,Rusak Berat'],
            'jumlah'             => ['required', 'integer', 'min:1', 'max:999'],
            'tanggal_pengadaan'  => ['required', 'date', 'before_or_equal:today'],
            'deskripsi'          => ['nullable', 'string', 'max:500'],
            'foto_barang'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'dokumen_pendukung'  => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'kode_barang.required'              => 'Kode barang wajib diisi.',
            'kode_barang.unique'                => 'Kode barang sudah digunakan.',
            'nama_barang.required'              => 'Nama barang wajib diisi.',
            'nama_barang.min'                   => 'Nama barang minimal 3 karakter.',
            'kategori_id.required'              => 'Kategori wajib dipilih.',
            'kategori_id.exists'                => 'Kategori tidak valid.',
            'jumlah.min'                        => 'Jumlah minimal 1.',
            'tanggal_pengadaan.before_or_equal' => 'Tanggal pengadaan tidak boleh melebihi hari ini.',
            'foto_barang.image'                 => 'File harus berupa gambar.',
            'foto_barang.mimes'                 => 'Foto hanya boleh jpg, jpeg, png, atau webp.',
            'foto_barang.max'                   => 'Ukuran foto maksimal 2 MB.',
            'dokumen_pendukung.mimes'           => 'Dokumen hanya boleh pdf, doc, atau docx.',
            'dokumen_pendukung.max'             => 'Ukuran dokumen maksimal 5 MB.',
        ];
    }
}