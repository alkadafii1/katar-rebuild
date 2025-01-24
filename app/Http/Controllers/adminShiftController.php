<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\Staff;
use RealRashid\SweetAlert\Facades\Alert;

class adminShiftController extends Controller
{
    /**
     * Display a listing of the shifts.
     */
    public function index()
    {
        $shifts = Shift::with('staff')->paginate(7);
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
        $validatedData = $request->validate([
            'staff_id' => 'required|exists:staffs,id',
            'jama_kerja' => 'required|date_format:H:i',
            'jam_pulang' => 'required|date_format:H:i',
        ]);

        Shift::create($validatedData);

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
        $validatedData = $request->validate([
            'staff_id' => 'required|exists:staffs,id',
            'jama_kerja' => 'required|date_format:H:i',
            'jam_pulang' => 'required|date_format:H:i',
        ]);

        $shift = Shift::findOrFail($id);
        $shift->update($validatedData);

        Alert::success('Sukses', 'Shift berhasil diperbarui');
        return redirect('/admin/shift')->with('success', 'Shift berhasil diperbarui');
    }

    /**
     * Remove the specified shift from storage.
     */
    public function destroy($id)
    {
        $shift = Shift::findOrFail($id);
        $shift->delete();

        Alert::success('Sukses', 'Shift berhasil dihapus');
        return redirect('/admin/shift')->with('success', 'Shift berhasil dihapus');
    }
}
