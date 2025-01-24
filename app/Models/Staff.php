<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $fillable = ['name', 'email', 'no_tlp', 'jabatan_id'];

    // Relasi dengan model Jabatan
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    /**
     * Get all staff.
     */
    public static function getAllStaff()
    {
        return self::with('jabatan')->paginate(7);
    }

    /**
     * Get validation rules.
     */
    public static function getValidationRules($id = null)
    {
        return [
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:staffs,email,' . $id,
            'no_tlp'     => 'required|string|max:15|unique:staffs,no_tlp,' . $id,
            'jabatan_id' => 'required|exists:jabatans,id',
        ];
    }

    /**
     * Store a new staff.
     */
    public static function storeStaff($data)
    {
        self::create($data);
    }

    /**
     * Update an existing staff.
     */
    public static function updateStaff($id, $data)
    {
        $staff = self::findOrFail($id);
        $staff->update($data);
    }

    /**
     * Delete a staff.
     */
    public static function deleteStaff($id)
    {
        $staff = self::findOrFail($id);
        $staff->delete();
    }
}
