@extends('layouts.app')

@section('title', 'Tambah Inventaris')

@section('content')

    <div class="mb-4">
        <h1 class="fw-bold mb-1">
            <i class="bi bi-box-seam text-primary"></i>
            Tambah Inventaris Laboratorium
        </h1>

        <p class="text-muted">
            Lengkapi informasi inventaris baru laboratorium
        </p>
    </div>

<form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card border-0 shadow-lg">

            <div class="card-body p-4">

                <div class="row g-4">

                    {{-- KATEGORI --}}
                    <div class="col-md-6">
                        <label class="form-label">Kategori</label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-tags"></i>
                            </span>

                            <select name="kategori_id" class="form-select">
                                <option value="">
                                    Pilih Kategori
                                </option>

                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" @selected(old('kategori_id') == $kategori->id)>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach

                            </select>

                            <a href="{{ route('kategori.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-lg"></i>
                            </a>

                        </div>

                        @error('kategori_id')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- KODE --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Kode Barang
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-upc"></i>
                            </span>

                            <input type="text" name="kode_barang" class="form-control" placeholder="LAB-LPT-001"
                                value="{{ old('kode_barang') }}">

                        </div>

                    </div>

                    {{-- NAMA --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Nama Barang
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-box"></i>
                            </span>

                            <input type="text" name="nama_barang" class="form-control" placeholder="Laptop ASUS"
                                value="{{ old('nama_barang') }}">

                        </div>

                    </div>

                    {{-- MEREK --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Merek
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-award"></i>
                            </span>

                            <input type="text" name="merek" class="form-control" placeholder="ASUS"
                                value="{{ old('merek') }}">

                        </div>

                    </div>

                    {{-- LOKASI --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Lokasi
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-geo-alt"></i>
                            </span>

                            <input type="text" name="lokasi" class="form-control" placeholder="Lab Komputer 1"
                                value="{{ old('lokasi') }}">

                        </div>

                    </div>

                    {{-- KONDISI --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Kondisi
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-clipboard-check"></i>
                            </span>

                            <select name="kondisi_id" class="form-select">
                                <option value="">
                                    Pilih Kondisi
                                </option>

                                @foreach ($kondisis as $kondisi)
                                    <option value="{{ $kondisi->id }}" @selected(old('kondisi_id') == $kondisi->id)>
                                        {{ $kondisi->nama }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    {{-- JUMLAH --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Jumlah
                        </label>

                        <input type="number" name="jumlah" min="1" class="form-control"
                            value="{{ old('jumlah', 1) }}">

                    </div>

                    {{-- TANGGAL --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Tanggal Pengadaan
                        </label>

                        <input type="date" name="tanggal_pengadaan" class="form-control"
                            value="{{ old('tanggal_pengadaan') }}">

                    </div>

                    {{-- KETERANGAN --}}
                    <div class="col-12">

                        <label class="form-label">
                            Keterangan
                        </label>

                        <textarea name="keterangan" rows="4" class="form-control" placeholder="Masukkan keterangan tambahan...">{{ old('keterangan') }}</textarea>

                    </div>
                    {{-- FOTO BARANG --}}
<div class="col-md-6">
    <label class="form-label">Foto Barang</label>
    <input type="file" name="foto_barang" class="form-control"
        accept="image/jpg,image/jpeg,image/png,image/webp">
    @error('foto_barang')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

{{-- DOKUMEN PENDUKUNG --}}
<div class="col-md-6">
    <label class="form-label">Dokumen Pendukung</label>
    <input type="file" name="dokumen_pendukung" class="form-control"
        accept=".pdf,.doc,.docx">
    @error('dokumen_pendukung')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

                </div>

            </div>

            <div class="card-footer bg-white border-0 p-4">

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('inventaris.index') }}" class="btn btn-light border">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save"></i>
                        Simpan Inventaris
                    </button>

                </div>

            </div>

        </div>

    </form>

@endsection
