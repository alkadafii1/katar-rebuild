<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merk;
use RealRashid\SweetAlert\Facades\Alert;

class adminMerkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merk = Merk::getAllBrands();
        $title = 'Manajemen Merk';
        $content = 'admin.merk.index';
        return view('admin.layouts.wrapper', compact('content', 'title', 'merk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Merk';
        $content = 'admin.merk.create';
        return view('admin.layouts.wrapper', compact('content', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(Merk::getValidationRules());
        Merk::storeBrand($validatedData);

        Alert::success('Sukses', 'Merk berhasil ditambahkan!');
        return redirect('/admin/merk')->with('success', 'Data telah ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $merk = Merk::findOrFail($id);
        $title = 'Edit Merk';
        $content = 'admin.merk.create';
        return view('admin.layouts.wrapper', compact('content', 'title', 'merk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(Merk::getValidationRules($id));
        Merk::updateBrand($id, $validatedData);

        Alert::success('Sukses', 'Data berhasil diperbarui!');
        return redirect('/admin/merk')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Merk::deleteBrand($id);

        Alert::success('Sukses', 'Merk berhasil dihapus!');
        return redirect()->back()->with('success', 'Merk berhasil dihapus!');
    }
}
