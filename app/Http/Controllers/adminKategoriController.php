<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;

class AdminKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori    = Kategori::getAllKategori();
        $title       = 'Manajemen Kategori';
        $content     = 'admin.kategori.index';
        return view('admin.layouts.wrapper', compact('content', 'title', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Kategori';
        $content = 'admin.kategori.create';
        return view('admin.layouts.wrapper', compact('content', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(Kategori::getValidationRules());
        Kategori::storeKategori($validatedData);

        Alert::success('Sukses', 'Data telah ditambahkan!');
        return redirect('/admin/kategori')->with('success', 'Data telah ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $title = 'Edit Kategori';
        $content = 'admin.kategori.create';
        return view('admin.layouts.wrapper', compact('content', 'title', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate(Kategori::getValidationRules($id));
        Kategori::updateKategori($id, $validatedData);

        Alert::success('Sukses', 'Data telah diedit!');
        return redirect('/admin/kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kategori::deleteKategori($id);

        Alert::success('Sukses', 'Data telah dihapus!');
        return redirect()->back();
    }
}
