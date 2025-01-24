<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['user_id', 'subtotal', 'kasir_name', 'status'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
