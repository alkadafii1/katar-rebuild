<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class adminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::getAllUsers();
        return view('admin.layouts.wrapper', [
            'content' => 'admin.user.index',
            'title'   => 'Manajemen User',
            'user'    => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layouts.wrapper', [
            'content' => 'admin.user.create',
            'roles'   => User::getAvailableRoles(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(User::getValidationRules());
        User::storeUser($data);

        Alert::success('Sukses', 'Data telah ditambahkan!');
        return redirect('/admin/user')->with('success', 'Data telah ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.layouts.wrapper', [
            'content' => 'admin.user.create',
            'user'    => User::findOrFail($id),
            'roles'   => User::getAvailableRoles(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(User::getValidationRules($id));
        User::updateUser($id, $data);

        Alert::success('Sukses', 'Data telah diedit!');
        return redirect('/admin/user')->with('success', 'Data telah diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::deleteUser($id);

        Alert::success('Sukses', 'Data telah dihapus!');
        return redirect('/admin/user')->with('success', 'Data telah dihapus!');
    }
}
