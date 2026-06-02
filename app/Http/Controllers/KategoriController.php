<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::withCount('inventaris')->latest();

        if ($request->filled('q')) {
            $q = $request->q;

            $query->where(function ($data) use ($q) {
                $data->where('kode', 'like', "%{$q}%")
                     ->orWhere('nama', 'like', "%{$q}%");
            });
        }

        $kategoris = $query->paginate(10)->withQueryString();

        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|max:10|unique:kategoris,kode',
            'nama' => 'required|min:2|max:100|unique:kategoris,nama',
        ]);

        Kategori::create($request->only('kode', 'nama'));

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'kode' => 'required|max:10|unique:kategoris,kode,' . $kategori->id,
            'nama' => 'required|min:2|max:100|unique:kategoris,nama,' . $kategori->id,
        ]);

        $kategori->update($request->only('kode', 'nama'));

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->inventaris()->count() > 0) {
            return redirect()->route('kategori.index')
                ->with('error', 'Kategori tidak bisa dihapus karena masih memiliki data inventaris.');
        }

        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}