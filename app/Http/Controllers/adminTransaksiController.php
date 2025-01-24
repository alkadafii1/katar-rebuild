<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Produk;
use RealRashid\SweetAlert\Facades\Alert;

class adminTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::paginate(7); // Mengambil data transaksi dengan paginasi
        $title = 'Manajemen Transaksi';
        $content = 'admin.transaksi.index';

        return view('admin.layouts.wrapper', compact('content', 'title', 'transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $data = [
            'user_id' => $user->id,
            'kasir_name' => $user->name,
            'total' => 0,
        ];

        $transaksi = Transaksi::create($data); // Membuat transaksi baru
        Alert::success('Sukses', 'Transaksi baru telah dibuat!');
        return redirect()->route('transaksi.edit', $transaksi->id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:transaksis', // Validasi nama harus unik
        ]);

        Transaksi::create($data);
        Alert::success('Sukses', 'Data telah ditambahkan!');
        return redirect('/admin/transaksi')->with('success', 'Data telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::findOrFail($id); // Mengambil transaksi berdasarkan ID
        $title = 'Detail Transaksi';
        $content = 'admin.transaksi.show';

        return view('admin.layouts.wrapper', compact('content', 'title', 'transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Produk::get(); // Mendapatkan semua produk
        $produk_id = request('produk_id');
        $p_detail = Produk::find($produk_id);
    
        $act = request('act'); // Tindakan: "min" atau "plus"
        $qty = request('qty', 1); // Default qty = 1 jika tidak ada input
    
        // Mengatur qty berdasarkan tindakan
        if ($act == 'min') {
            $qty = max(1, $qty - 1); // Minimal qty adalah 1
        } elseif ($act == 'plus') {
            $qty += 1;
        }
    
        // Menghitung subtotal
        $subtotal = 0;
        if ($p_detail) {
            $subtotal = $qty * $p_detail->harga;
        }
    
        $title = 'Tambah Transaksi';
        $content = 'admin.transaksi.create';
    
        return view('admin.layouts.wrapper', compact('content', 'title', 'produk', 'p_detail', 'qty', 'subtotal'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::findOrFail($id); // Mencari transaksi berdasarkan ID
        $data = $request->validate([
            'name' => 'required|unique:transaksis,name,' . $id, // Validasi nama unik, kecuali data ini
        ]);

        $transaksi->update($data);
        Alert::success('Sukses', 'Data telah diedit!');
        return redirect('/admin/transaksi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id); // Mencari transaksi berdasarkan ID
        $transaksi->delete();

        Alert::success('Sukses', 'Data telah dihapus!');
        return redirect()->back();
    }
}
