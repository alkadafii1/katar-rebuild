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
     * Display a listing of the products.
     */
    public function index()
    {
        $produk = Produk::getAllProducts();
        $title = 'Manajemen Produk';
        $content = 'admin.produk.index';

        return view('admin.layouts.wrapper', compact('content', 'title', 'produk'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $merks = Merk::all();
        $title = 'Tambah Produk';
        $content = 'admin.produk.create';

        return view('admin.layouts.wrapper', compact('content', 'title', 'kategoris', 'merks'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(Produk::getValidationRules());
        Produk::storeProduct($validatedData);

        Alert::success('Sukses', 'Produk berhasil ditambahkan');
        return redirect('/admin/produk')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();
        $merks = Merk::all();
        $title = 'Edit Produk';
        $content = 'admin.produk.create';

        return view('admin.layouts.wrapper', compact('content', 'title', 'produk', 'kategoris', 'merks'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(Produk::getValidationRules());
        Produk::updateProduct($id, $validatedData);

        Alert::success('Sukses', 'Produk berhasil diperbarui');
        return redirect('/admin/produk')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        Produk::deleteProduct($id);

        Alert::success('Sukses', 'Data telah dihapus!');
        return redirect()->back()->with('success', 'Data telah dihapus!');
    }
}
