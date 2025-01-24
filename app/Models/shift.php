<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table = 'shifts';
    protected $fillable = ['staff_id', 'jama_kerja', 'jam_pulang'];

    // Relasi ke model Staff
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
