@extends('layouts.app')

@section('title', 'Data Inventaris Laboratorium')

@section('content')


    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- STATISTIK --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="card border-0 rounded-5 shadow-sm h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <small class="text-muted">
                                Total Inventaris
                            </small>

                            <h1 class="fw-bold mt-2" style="color:#db2777;">
                                {{ $inventaris->total() }}
                            </h1>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 rounded-5 shadow-sm h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <small class="text-muted">
                                Kategori
                            </small>

                            <h1 class="fw-bold mt-2" style="color:#db2777;">
                                {{ $kategoris->count() }}
                            </h1>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 rounded-5 shadow-sm h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <small class="text-muted">
                                Kondisi
                            </small>

                            <h1 class="fw-bold mt-2" style="color:#db2777;">
                                {{ $kondisis->count() }}
                            </h1>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- FILTER --}}
    <div class="card border-0 rounded-5 shadow-sm mb-4">

        <div class="card-body p-4">

            <form method="GET" action="{{ route('inventaris.index') }}">

                <div class="row g-3 align-items-end">

                    <div class="col-md-5">
                        <label class="form-label fw-semibold">
                            Cari Data
                        </label>

                        <input type="text" name="q" value="{{ request('q') }}" class="form-control"
                            placeholder="🔍 Kode, nama barang, atau lokasi">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">
                            Kategori
                        </label>

                        <select name="kategori_id" class="form-select">

                            <option value="">
                                Semua Kategori
                            </option>

                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" @selected(request('kategori_id') == $kategori->id)>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">
                            Kondisi
                        </label>

                        <select name="kondisi_id" class="form-select">

                            <option value="">
                                Semua Kondisi
                            </option>

                            @foreach ($kondisis as $kondisi)
                                <option value="{{ $kondisi->id }}" @selected(request('kondisi_id') == $kondisi->id)>
                                    {{ $kondisi->nama }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-1">
                        <button class="btn w-100 text-white"
                            style="background:linear-gradient(135deg,#ec4899,#db2777);border:none;" type="submit">

                            Filter

                        </button>
                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- HEADER TABEL --}}
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="fw-bold mb-0">
            Daftar Inventaris
        </h4>

        <a href="{{ route('inventaris.create') }}" class="btn text-white shadow-sm"
            style="background:linear-gradient(135deg,#ec4899,#db2777);border:none;">

            <i class="bi bi-plus-circle"></i>
            Tambah Barang

        </a>

    </div>

    {{-- TABEL --}}
    <div class="card border-0 rounded-5 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead
                        style="
                    background:linear-gradient(135deg,#ec4899,#db2777);
                    color:white;
                    ">

                        <tr>
                            <th>Kode</th>
                            @if (auth()->user()->role === 'admin')
                                <th>Foto</th>
                            @endif
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Kondisi</th>
                            <th>Jumlah</th>
                            <th width="220">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($inventaris as $item)
                            <tr>

                                <td>
                                    <strong>{{ $item->kode_barang }}</strong>
                                </td>

                                @if (auth()->user()->role === 'admin')
                                    <td>
                                        @if ($item->foto_path)
                                            <img src="{{ asset('storage/' . $item->foto_path) }}" alt="Foto"
                                                width="60" class="rounded border">
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                @endif

                                <td>

                                    <div class="fw-semibold">
                                        {{ $item->nama_barang }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $item->merek ?? '-' }}
                                    </small>

                                </td>

                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $item->kategori?->nama ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    {{ $item->lokasi }}
                                </td>

                                <td>

                                    @php
                                        $badge = match ($item->kondisi?->nama) {
                                            'Baik' => 'success',
                                            'Rusak Ringan' => 'warning',
                                            'Rusak Berat' => 'danger',
                                            default => 'secondary',
                                        };
                                    @endphp

                                    <span class="badge bg-{{ $badge }}">
                                        {{ $item->kondisi?->nama ?? '-' }}
                                    </span>

                                </td>

                                <td>
                                    <span class="badge bg-dark">
                                        {{ $item->jumlah }}
                                    </span>
                                </td>

                                <td>

                                    <div class="d-flex gap-2 flex-wrap">

                                        <a class="btn btn-sm btn-secondary rounded-pill"
                                            href="{{ route('inventaris.show', $item) }}">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a class="btn btn-sm btn-warning rounded-pill"
                                            href="{{ route('inventaris.edit', $item) }}">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form method="POST" action="{{ route('inventaris.destroy', $item) }}"
                                            onsubmit="return confirm('Hapus data ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-danger rounded-pill" type="submit">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-inbox display-4 d-block mb-3"></i>

                                        Belum ada data inventaris

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <div class="mt-4">
        {{ $inventaris->links() }}
    </div>

@endsection
