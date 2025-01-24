<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\Staff;
use RealRashid\SweetAlert\Facades\Alert;

class AdminShiftController extends Controller
{
    /**
     * Display a listing of the shifts.
     */
    public function index()
    {
        $shifts = Shift::getAllShifts();
        $title = 'Manajemen Shift';
        $content = 'admin.shift.index';

        return view('admin.layouts.wrapper', compact('content', 'title', 'shifts'));
    }

    /**
     * Show the form for creating a new shift.
     */
    public function create()
    {
        $staffs = Staff::all();
        $title = 'Tambah Shift';
        $content = 'admin.shift.create';

        return view('admin.layouts.wrapper', compact('content', 'title', 'staffs'));
    }

    /**
     * Store a newly created shift in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(Shift::getValidationRules());
        Shift::storeShift($validatedData);

        Alert::success('Sukses', 'Shift berhasil ditambahkan');
        return redirect('/admin/shift')->with('success', 'Shift berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified shift.
     */
    public function edit($id)
    {
        $shift = Shift::findOrFail($id);
        $staffs = Staff::all();
        $title = 'Edit Shift';
        $content = 'admin.shift.create';

        return view('admin.layouts.wrapper', compact('content', 'title', 'shift', 'staffs'));
    }

    /**
     * Update the specified shift in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(Shift::getValidationRules());
        Shift::updateShift($id, $validatedData);

        Alert::success('Sukses', 'Shift berhasil diperbarui');
        return redirect('/admin/shift')->with('success', 'Shift berhasil diperbarui');
    }

    /**
     * Remove the specified shift from storage.
     */
    public function destroy($id)
    {
        Shift::deleteShift($id);

        Alert::success('Sukses', 'Shift berhasil dihapus');
        return redirect('/admin/shift')->with('success', 'Shift berhasil dihapus');
    }
}
