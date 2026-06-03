<div class="card shadow border-0">
    <div class="card-header bg-primary text-white py-3">
        <h4 class="mb-0">📦 Form Inventaris</h4>
    </div>

    <div class="card-body">

        <div class="row">

            {{-- Kategori --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Kategori</label>

                <div class="input-group">
                    <select name="kategori_id" class="form-select">
                        <option value="">-- Pilih Kategori --</option>

                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" @selected(old('kategori_id', $item->kategori_id ?? '') == $kategori->id)>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>

                    <a href="{{ route('kategori.create') }}" class="btn btn-success" title="Tambah Kategori">
                        +
                    </a>
                </div>

                @error('kategori_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Kode Barang --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Kode Barang</label>

                <input type="text" name="kode_barang" class="form-control" placeholder="LAB-LPT-001"
                    value="{{ old('kode_barang', $item->kode_barang ?? '') }}">

                @error('kode_barang')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Nama Barang --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Nama Barang</label>

                <input type="text" name="nama_barang" class="form-control" placeholder="Laptop ASUS A455"
                    value="{{ old('nama_barang', $item->nama_barang ?? '') }}">

                @error('nama_barang')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Merek --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Merek</label>

                <input type="text" name="merek" class="form-control" placeholder="ASUS"
                    value="{{ old('merek', $item->merek ?? '') }}">

                @error('merek')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Lokasi --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Lokasi</label>

                <input type="text" name="lokasi" class="form-control" placeholder="Lab Komputer 1"
                    value="{{ old('lokasi', $item->lokasi ?? '') }}">

                @error('lokasi')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Kondisi --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Kondisi</label>

                <div class="input-group">
                    <select name="kondisi_id" class="form-select">
                        <option value="">-- Pilih Kondisi --</option>

                        @foreach ($kondisis as $k)
                            <option value="{{ $k->id }}" @selected(old('kondisi_id', $item->kondisi_id ?? '') == $k->id)>
                                {{ $k->nama }}
                            </option>
                        @endforeach
                    </select>

                </div>

                @error('kondisi_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Jumlah --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Jumlah</label>

                <input type="number" name="jumlah" min="1" class="form-control"
                    value="{{ old('jumlah', $item->jumlah ?? 1) }}">

                @error('jumlah')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Tanggal Pengadaan --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Tanggal Pengadaan</label>

                <input type="date" name="tanggal_pengadaan" class="form-control"
                    value="{{ old('tanggal_pengadaan', $item->tanggal_pengadaan ?? '') }}">

                @error('tanggal_pengadaan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div class="col-12 mb-3">
                <label class="form-label fw-semibold">Keterangan</label>

                <textarea name="keterangan" rows="4" class="form-control" placeholder="Masukkan keterangan tambahan">{{ old('keterangan', $item->keterangan ?? '') }}</textarea>

                @error('keterangan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

<div class="col-12 mb-3">
    <label class="form-label fw-semibold">Foto Barang</label>

    <input type="file" name="foto_barang" class="form-control"
        accept="image/jpg,image/jpeg,image/png,image/webp">

    @error('foto_barang')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    @if (!empty($item?->foto_path))
        <div class="mt-2">
            <p class="text-muted small mb-1">Foto saat ini:</p>
            <img src="{{ asset('storage/' . $item->foto_path) }}"
                alt="Foto {{ $item->nama_barang }}"
                width="160" class="rounded border">
        </div>
    @endif
</div>

<div class="col-12 mb-3">
    <label class="form-label fw-semibold">Dokumen Pendukung</label>

    <input type="file" name="dokumen_pendukung" class="form-control"
        accept=".pdf,.doc,.docx">

    @error('dokumen_pendukung')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    @if (!empty($item?->dokumen_path))
        <div class="mt-2">
            <a href="{{ asset('storage/' . $item->dokumen_path) }}"
                target="_blank" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-file-earmark"></i> Lihat dokumen saat ini
            </a>
        </div>
    @endif
</div>

        <hr>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('inventaris.index') }}" class="btn btn-outline-secondary">
                ← Kembali
            </a>

            <button type="submit" class="btn btn-primary px-4">
                💾 Simpan Data
            </button>
        </div>

    </div>
</div>
