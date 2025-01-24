<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table= 'kategoris';
    protected $fillable = ['name'];

    // Relasi ke produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }

    /**
     * Get all categories with pagination.
     */
    public static function getAllKategori()
    {
        return self::paginate(7);
    }

    /**
     * Get validation rules.
     */
    public static function getValidationRules($id = null)
    {
        return [
            'name' => 'required|unique:kategoris,name,' . $id
        ];
    }

    /**
     * Store a new category.
     */
    public static function storeKategori($data)
    {
        self::create($data);
    }

    /**
     * Update an existing category.
     */
    public static function updateKategori($id, $data)
    {
        $kategori = self::findOrFail($id);
        $kategori->update($data);
    }

    /**
     * Delete a category.
     */
    public static function deleteKategori($id)
    {
        $kategori = self::findOrFail($id);
        $kategori->delete();
    }
}
