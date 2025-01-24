<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table = 'shifts';
    protected $fillable = ['staff_id', 'jama_kerja', 'jam_pulang'];
    public $timestamps = false;

    // Relasi ke model Staff
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    /**
     * Get all shifts with pagination.
     */
    public static function getAllShifts()
    {
        return self::with('staff')->paginate(7);
    }

    /**
     * Get validation rules.
     */
    public static function getValidationRules()
    {
        return [
            'staff_id'   => 'required|exists:staffs,id',
            'jama_kerja' => 'required|date_format:H:i',
            'jam_pulang' => 'required|date_format:H:i',
        ];
    }

    /**
     * Store a new shift.
     */
    public static function storeShift($data)
    {
        self::create($data);
    }

    /**
     * Update an existing shift.
     */
    public static function updateShift($id, $data)
    {
        $shift = self::findOrFail($id);
        $shift->update($data);
    }

    /**
     * Delete a shift.
     */
    public static function deleteShift($id)
    {
        $shift = self::findOrFail($id);
        $shift->delete();
    }
}
