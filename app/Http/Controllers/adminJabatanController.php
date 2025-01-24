<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class AdminJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatan = Jabatan::getAllJabatan();
        $title = 'Manajemen Jabatan';
        $content = 'admin.jabatan.index';
        return view('admin.layouts.wrapper', compact('content', 'title', 'jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Jabatan';
        $content = 'admin.jabatan.create';
        return view('admin.layouts.wrapper', compact('content', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(Jabatan::getValidationRules());
        Jabatan::storeJabatan($data);
        Alert::success('Sukses', 'Data berhasil ditambahkan!');
        return redirect('/admin/jabatan')->with('success', 'Data telah ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $title = 'Edit Jabatan';
        $content = 'admin.jabatan.create';
        return view('admin.layouts.wrapper', compact('content', 'title', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(Jabatan::getValidationRules($id));
        Jabatan::updateJabatan($id, $data);
        Alert::success('Sukses', 'Jabatan berhasil diperbarui!');
        return redirect('/admin/jabatan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Jabatan::deleteJabatan($id);
        Alert::success('Sukses', 'Data berhasil dihapus!');
        return redirect()->back();
    }
}
