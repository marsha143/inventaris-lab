<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Kategori;
use App\Models\Kondisi;
use Illuminate\Http\Request;

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
        $kategoris = Kategori::orderBy('nama')->get();
        $kondisis = Kondisi::orderBy('nama')->get();

        return view('inventaris.index', compact(
            'inventaris',
            'kategoris',
            'kondisis'
        ));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama')->get();
        $kondisis = Kondisi::orderBy('nama')->get();

        return view('inventaris.create', compact(
            'kategoris',
            'kondisis'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id'       => 'required|exists:kategoris,id',
            'kondisi_id'        => 'required|exists:kondisis,id',
            'kode_barang'       => 'required|max:30|unique:inventaris,kode_barang',
            'nama_barang'       => 'required|min:3|max:150',
            'merek'             => 'nullable|max:100',
            'lokasi'            => 'required|max:100',
            'jumlah'            => 'required|integer|min:1',
            'tanggal_pengadaan' => 'nullable|date',
            'keterangan'        => 'nullable|max:1000',
        ]);

        Inventaris::create($validated);

        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil ditambahkan.');
    }

    public function show(Inventaris $inventari)
    {
        $inventari->load(['kategori', 'kondisi']);

        return view('inventaris.show', [
            'item' => $inventari
        ]);
    }

    public function edit(Inventaris $inventari)
    {
        $kategoris = Kategori::orderBy('nama')->get();
        $kondisis = Kondisi::orderBy('nama')->get();

        return view('inventaris.edit', [
            'item'      => $inventari,
            'kategoris' => $kategoris,
            'kondisis'  => $kondisis,
        ]);
    }

    public function update(Request $request, Inventaris $inventari)
    {
        $validated = $request->validate([
            'kategori_id'       => 'required|exists:kategoris,id',
            'kondisi_id'        => 'required|exists:kondisis,id',
            'kode_barang'       => 'required|max:30|unique:inventaris,kode_barang,' . $inventari->id,
            'nama_barang'       => 'required|min:3|max:150',
            'merek'             => 'nullable|max:100',
            'lokasi'            => 'required|max:100',
            'jumlah'            => 'required|integer|min:1',
            'tanggal_pengadaan' => 'nullable|date',
            'keterangan'        => 'nullable|max:1000',
        ]);

        $inventari->update($validated);

        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil diperbarui.');
    }

    public function destroy(Inventaris $inventari)
    {
        $inventari->delete();

        return redirect()
            ->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil dihapus.');
    }
}