<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;

class adminKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori    = Kategori::paginate(7);
        $title       = 'Manajemen Kategori';
        $content     = 'admin.kategori.index';
        return view('admin.layouts.wrapper', compact('content','title','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        {
        $kategori    = Kategori::all();
        $title = 'Tambah Kategori';
        $content = 'admin.kategori.create';
        return view('admin.layouts.wrapper', compact('content','title'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:kategoris'
        ]);

        Kategori::create($data);
        Alert::success('Sukses', 'Data telah ditambahkan!');
        return redirect('/admin/kategori')->with('success', 'Data telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        {
            $kategori    = Kategori::findOrFail($id);
            $title       = 'Tambah Kategori';
            $content     = 'admin.kategori.create';
        return view('admin.layouts.wrapper', compact('content','title','kategori'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        {
            $kategori = Kategori::find($id);
            $data = $request->validate([
                'name' => 'required|unique:kategoris,name,'. $kategori->$id
            ]);
    
            $kategori->update($data);
            Alert::success('Sukses', 'Data telah diedit!');
            return redirect('/admin/kategori');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);

        $kategori->delete();
        Alert::success('Sukses', 'Data telah dihapus!');
        return redirect()->back();
    }
}
