<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Jabatan;
use RealRashid\SweetAlert\Facades\Alert;

class AdminStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::with('jabatan')->paginate(7);
        $title = 'Manajemen Staff';
        $content = 'admin.staff.index';

        return view('admin.layouts.wrapper', compact('content', 'title', 'staff'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatans = Jabatan::all();
        $title = 'Tambah Staff';
        $content = 'admin.staff.create';

        return view('admin.layouts.wrapper', compact('content', 'title', 'jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staffs,email',
            'no_tlp' => 'required|string|max:15|unique:staffs,no_tlp',
            'jabatan_id' => 'required|exists:jabatans,id',
        ]);

        Staff::create($validatedData);

        Alert::success('Sukses', 'Staff berhasil ditambahkan');
        return redirect('/admin/staff')->with('success', 'Staff berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        $jabatans = Jabatan::all();
        $title = 'Edit Staff';
        $content = 'admin.staff.create';

        return view('admin.layouts.wrapper', compact('content', 'title', 'staff', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staffs,email,' . $id,
            'no_tlp' => 'required|string|max:15|unique:staffs,no_tlp,' . $id,
            'jabatan_id' => 'required|exists:jabatans,id',
        ]);

        $staff = Staff::findOrFail($id);
        $staff->update($validatedData);

        Alert::success('Sukses', 'Data berhasil diperbarui');
        return redirect('/admin/staff')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        Alert::success('Sukses', 'Data berhasil dihapus');
        return redirect('/admin/staff')->with('success', 'Data berhasil dihapus');
    }
}
