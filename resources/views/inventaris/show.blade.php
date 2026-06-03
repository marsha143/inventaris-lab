@extends('layouts.app')
@section('title', 'Detail Inventaris')
@section('content')
    <h1>Detail Inventaris</h1>
    <table>
        <tr>
            <th>Kode Barang</th>
            <td>{{ $item->kode_barang }}</td>
        </tr>
        <tr>
            <th>Nama Barang</th>
            <td>{{ $item->nama_barang }}</td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td>{{ $item->kategori->nama }}</td>
        </tr>
        <tr>
            <th>Merek</th>
            <td>{{ $item->merek ?? '-' }}</td>
        </tr>
        <tr>
            <th>Lokasi</th>
            <td>{{ $item->lokasi }}</td>
        </tr>
        <tr>
            <th>Kondisi</th>
            <td>{{ $item->kondisi->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>{{ $item->jumlah }}</td>
        </tr>
        <tr>
            <th>Tanggal Pengadaan</th>
            <td>{{ $item->tanggal_pengadaan ?? '-' }}</td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>{{ $item->keterangan ?? '-' }}</td>
        </tr>
        <tr>
    <th>Foto Barang</th>
    <td>
        @if ($item->foto_path)
            <img src="{{ asset('storage/' . $item->foto_path) }}"
                alt="Foto {{ $item->nama_barang }}"
                width="260" class="rounded border">
        @else
            <span class="text-muted">Belum ada foto</span>
        @endif
    </td>
</tr>
<tr>
    <th>Dokumen Pendukung</th>
    <td>
        @if ($item->dokumen_path)
            <a href="{{ asset('storage/' . $item->dokumen_path) }}"
                target="_blank" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-file-earmark"></i> Buka Dokumen
            </a>
        @else
            <span class="text-muted">Belum ada dokumen</span>
        @endif
    </td>
</tr>
    </table>
    <p>
        <a class="btn btn-warning" href="{{ route('inventaris.edit', $item) }}">Edit</a>
        <a class="btn btn-secondary" href="{{ route('inventaris.index') }}">Kembali</a>
    </p>
@endsection
