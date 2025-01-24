<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class adminTransaksiDetailController extends Controller
{
    function create(Request $request) {
        // Pastikan transaksi sudah dibuat
        $transaksi = Transaksi::find($request->transaksi_id);
    
        if (!$transaksi) {
            return redirect()->back()->withErrors('Transaksi tidak ditemukan.');
        }
    
        $data = [
            'produk_id' => $request->produk_id,
            'produk_name' => $request->produk_name,
            'transaksi_id' => $transaksi->id,
            'qty' => $request->qty,
            'subtotal' => $request->subtotal,
        ];
    
        TransaksiDetail::create($data);
        return redirect()->back();
    }
    
}