<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    use HasFactory;

    protected $table = 'merks';

    protected $fillable = ['name'];

    // Relasi ke produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'merk_id');
    }

    /**
     * Get all brands with pagination.
     */
    public static function getAllBrands($pagination = 7)
    {
        return self::paginate($pagination);
    }

    /**
     * Get validation rules.
     */
    public static function getValidationRules($id = null)
    {
        $uniqueRule = $id ? 'required|unique:merks,name,' . $id : 'required|unique:merks';

        return [
            'name' => $uniqueRule,
        ];
    }

    /**
     * Store a new brand.
     */
    public static function storeBrand($data)
    {
        return self::create($data);
    }

    /**
     * Update an existing brand.
     */
    public static function updateBrand($id, $data)
    {
        $merk = self::findOrFail($id);
        $merk->update($data);
        return $merk;
    }

    /**
     * Delete a brand.
     */
    public static function deleteBrand($id)
    {
        $merk = self::findOrFail($id);
        $merk->delete();
    }
}
