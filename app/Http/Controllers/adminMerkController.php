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
        $merk = Merk::paginate(7);
        $title = 'Manajemen Merk';
        $content = 'admin.merk.index';
        return view('admin.layouts.wrapper', compact('content', 'title', 'merk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        {
        $merk = Merk::all();
        $title = 'Tambah Merk';
        $content = 'admin.merk.create';
        return view('admin.layouts.wrapper', compact('content', 'title'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:merks'
        ]);

        Merk::create($data);
        Alert::success('Sukses', 'Merk berhasil ditambahkan!');
        return redirect('/admin/merk')->with('success', 'Data telah ditambahkan!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        {
        $merk = Merk::findOrFail($id);
        $title = 'Tambah Merk';
        $content = 'admin.merk.create';
        return view('admin.layouts.wrapper', compact('content', 'title', 'merk'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $merk = Merk::find($id);
        $data = $request->validate([
            'name' => 'required|unique:merks,name,' . $merk->id
        ]);

        $merk->update($data);
        Alert::success('Sukses', 'Data berhasil diperbarui!');
        return redirect('/admin/merk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $merk = Merk::findOrFail($id);

        $merk->delete();
        Alert::success('Sukses', 'Merk berhasil dihapus!');
        return redirect()->back();
    }
}
