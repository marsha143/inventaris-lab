<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Kategori;
use App\Models\Kondisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventarisController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventaris::with(['kategori', 'kondisi'])->latest();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($data) use ($q) {
                $data->where('kode_barang', 'like', "%{$q}%")
                    ->orWhere('nama_barang', 'like', "%{$q}%")
                    ->orWhere('lokasi', 'like', "%{$q}%");
            });
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('kondisi_id')) {
            $query->where('kondisi_id', $request->kondisi_id);
        }

        $inventaris = $query->paginate(5)->withQueryString();
        $kategoris  = Kategori::orderBy('nama')->get();
        $kondisis   = Kondisi::orderBy('nama')->get();

        return view('inventaris.index', compact('inventaris', 'kategoris', 'kondisis'));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama')->get();
        $kondisis  = Kondisi::orderBy('nama')->get();

        return view('inventaris.create', compact('kategoris', 'kondisis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id'        => 'required|exists:kategoris,id',
            'kondisi_id'         => 'required|exists:kondisis,id',
            'kode_barang'        => 'required|max:30|unique:inventaris,kode_barang',
            'nama_barang'        => 'required|min:3|max:150',
            'merek'              => 'nullable|max:100',
            'lokasi'             => 'required|max:100',
            'jumlah'             => 'required|integer|min:1',
            'tanggal_pengadaan'  => 'nullable|date',
            'keterangan'         => 'nullable|max:1000',
            'foto_barang'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'dokumen_pendukung'  => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);
        unset($validated['foto_barang'], $validated['dokumen_pendukung']);

        if ($request->hasFile('foto_barang')) {
            $validated['foto_path'] = $request->file('foto_barang')
                ->store('inventaris/foto', 'public');
        }

        if ($request->hasFile('dokumen_pendukung')) {
            $validated['dokumen_path'] = $request->file('dokumen_pendukung')
                ->store('inventaris/dokumen', 'public');
        }

        Inventaris::create($validated);

        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil ditambahkan.');
    }

    public function show(Inventaris $inventari)
    {
        $inventari->load(['kategori', 'kondisi']);

        return view('inventaris.show', ['item' => $inventari]);
    }

    public function edit(Inventaris $inventari)
    {
        $kategoris = Kategori::orderBy('nama')->get();
        $kondisis  = Kondisi::orderBy('nama')->get();

        return view('inventaris.edit', [
            'item'      => $inventari,
            'kategoris' => $kategoris,
            'kondisis'  => $kondisis,
        ]);
    }

    public function update(Request $request, Inventaris $inventari)
    {
        $validated = $request->validate([
            'kategori_id'        => 'required|exists:kategoris,id',
            'kondisi_id'         => 'required|exists:kondisis,id',
            'kode_barang'        => 'required|max:30|unique:inventaris,kode_barang,' . $inventari->id,
            'nama_barang'        => 'required|min:3|max:150',
            'merek'              => 'nullable|max:100',
            'lokasi'             => 'required|max:100',
            'jumlah'             => 'required|integer|min:1',
            'tanggal_pengadaan'  => 'nullable|date',
            'keterangan'         => 'nullable|max:1000',
            'foto_barang'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'dokumen_pendukung'  => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        unset($validated['foto_barang'], $validated['dokumen_pendukung']);

        if ($request->hasFile('foto_barang')) {
            $this->deletePublicFile($inventari->foto_path);
            $validated['foto_path'] = $request->file('foto_barang')
                ->store('inventaris/foto', 'public');
        }

        if ($request->hasFile('dokumen_pendukung')) {
            $this->deletePublicFile($inventari->dokumen_path);
            $validated['dokumen_path'] = $request->file('dokumen_pendukung')
                ->store('inventaris/dokumen', 'public');
        }

        $inventari->update($validated);

        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil diperbarui.');
    }

    public function destroy(Inventaris $inventari)
    {
        $this->deletePublicFile($inventari->foto_path);
        $this->deletePublicFile($inventari->dokumen_path);
        $inventari->delete();

        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil dihapus.');
    }

    private function deletePublicFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}