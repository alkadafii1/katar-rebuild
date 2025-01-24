<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Merk;
use RealRashid\SweetAlert\Facades\Alert;

class AdminProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::with('kategori','merk')->paginate(7);
        $title = 'Manajemen Produk';
        $content = 'admin.produk.index';

        return view('admin.layouts.wrapper', compact('content', 'title', 'produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $merks = Merk::all();
        $title = 'Tambah Produk';
        $content = 'admin.produk.create';

        return view('admin.layouts.wrapper', compact('content', 'title', 'kategoris','merks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'merk_id' => 'required|exists:merks,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Jika ada file gambar yang diunggah
        if ($request->hasFile('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('uploads', 'public');
        }
    
        Produk::create($validatedData);
    
        return redirect('/admin/produk')->with('success', 'Produk berhasil ditambahkan');
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();
        $merks = Merk::all();
        $title = 'Edit Produk';
        $content = 'admin.produk.create';

        return view('admin.layouts.wrapper', compact('content', 'title', 'produk', 'kategoris','merks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'merk_id' => 'required|exists:merks,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        if ($request->hasFile('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('uploads', 'public');
        }
    
        $produk = Produk::findOrFail($id); 
        $produk->update($validatedData); 

        return redirect('/admin/produk')->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        Alert::success('Sukses', 'Data telah dihapus!');
        return redirect()->back()->with('success', 'Data telah dihapus!');
    }
}
