<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class adminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user    = User::all();
        $title   = 'Manajemen User';
        $content = 'admin.user.index';
    return view('admin.layouts.wrapper', compact('content','title','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = ['admin', 'user', 'kasir'];
        $content = 'admin.user.create';
        return view('admin.layouts.wrapper', compact('content','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'roles' => 'required|in:admin,user,kasir',
        ]);

        User::create($data);
        Alert::success('Sukses', 'Data telah ditambahkan!');
        return redirect('/admin/user')->with('success', 'Data telah ditambahkan!');
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
        $user    = User::findOrFail($id);
        $roles = ['admin', 'user', 'kasir'];
        $content = 'admin.user.create';
        return view('admin.layouts.wrapper', compact('content','user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // 'password' => 'required',
            'roles' => 'required|in:admin,user,kasir',
        ]);

        if($request->password !=''){
            $data['password'] = Hash::make($request->password);
        }else{
            $data['password'] = $user->password;
        }

        $user->update($data);
        Alert::success('Sukses', 'Data telah diedit!');
        return redirect('/admin/user')->with('success', 'Data telah diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Alert::success('Sukses', 'Data telah dihapus!');
        return redirect('/admin/user')->with('success', 'Data telah dihapus!');
    }
}
