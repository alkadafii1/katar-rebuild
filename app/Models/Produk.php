<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table= 'produks';

    protected $fillable = ['name', 'harga', 'stok', 'gambar', 'kategori_id','merk_id'];

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function merk()
    {
        return $this->belongsTo(Merk::class, 'merk_id');
    }
}
