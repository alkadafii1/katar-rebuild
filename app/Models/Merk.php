<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    use HasFactory;

    protected $table= 'merks';

    protected $fillable = ['name'];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'merk_id');
    }
}
