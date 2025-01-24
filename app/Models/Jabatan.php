<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    
    protected $table = 'jabatans';

    protected $fillable = ['name'];

    public function staff()
    {
        return $this->hasMany(Staff::class, 'jabatan_id');
    }

    /**
     * Get all jabatans with pagination.
     */
    public static function getAllJabatan()
    {
        return self::paginate(7);
    }

    /**
     * Get validation rules.
     */
    public static function getValidationRules($id = null)
    {
        return [
            'name' => 'required|unique:jabatans,name,' . $id,
        ];
    }

    /**
     * Store a new jabatan.
     */
    public static function storeJabatan($data)
    {
        self::create($data);
    }

    /**
     * Update an existing jabatan.
     */
    public static function updateJabatan($id, $data)
    {
        $jabatan = self::findOrFail($id);
        $jabatan->update($data);
    }

    /**
     * Delete a jabatan.
     */
    public static function deleteJabatan($id)
    {
        $jabatan = self::findOrFail($id);
        $jabatan->delete();
    }
}
