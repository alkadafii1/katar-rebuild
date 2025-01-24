<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    
    protected $table= 'jabatans';

    protected $fillable = ['name'];

    public function staff()
    {
        return $this->hasMany(Staff::class,'jabatan_id');
    }
}
