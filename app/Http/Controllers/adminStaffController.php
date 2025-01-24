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
        $staff = Staff::getAllStaff();
        return view('admin.layouts.wrapper', [
            'content' => 'admin.staff.index',
            'title'   => 'Manajemen Staff',
            'staff'   => $staff
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layouts.wrapper', [
            'content'  => 'admin.staff.create',
            'title'    => 'Tambah Staff',
            'jabatans' => Jabatan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(Staff::getValidationRules());
        Staff::storeStaff($data);

        Alert::success('Sukses', 'Staff berhasil ditambahkan');
        return redirect('/admin/staff')->with('success', 'Staff berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.layouts.wrapper', [
            'content'  => 'admin.staff.create',
            'title'    => 'Edit Staff',
            'staff'    => Staff::findOrFail($id),
            'jabatans' => Jabatan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(Staff::getValidationRules($id));
        Staff::updateStaff($id, $data);

        Alert::success('Sukses', 'Data berhasil diperbarui');
        return redirect('/admin/staff')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Staff::deleteStaff($id);

        Alert::success('Sukses', 'Data berhasil dihapus');
        return redirect('/admin/staff')->with('success', 'Data berhasil dihapus');
    }
}
