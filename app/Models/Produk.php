<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $fillable = ['name', 'harga', 'stok', 'gambar', 'kategori_id', 'merk_id'];

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Relasi ke merk
    public function merk()
    {
        return $this->belongsTo(Merk::class, 'merk_id');
    }

    /**
     * Get all products with pagination.
     */
    public static function getAllProducts()
    {
        return self::with('kategori', 'merk')->paginate(7);
    }

    /**
     * Get validation rules.
     */
    public static function getValidationRules()
    {
        return [
            'name'         => 'required|string|max:255',
            'harga'        => 'required|numeric|min:0',
            'stok'         => 'required|integer|min:0',
            'kategori_id'  => 'required|exists:kategoris,id',
            'merk_id'      => 'required|exists:merks,id',
            'gambar'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Store a new product.
     */
    public static function storeProduct($data)
    {
        if (isset($data['gambar']) && $data['gambar'] instanceof \Illuminate\Http\UploadedFile) {
            $data['gambar'] = $data['gambar']->store('uploads', 'public');
        }

        self::create($data);
    }

    /**
     * Update an existing product.
     */
    public static function updateProduct($id, $data)
    {
        $produk = self::findOrFail($id);

        if (isset($data['gambar']) && $data['gambar'] instanceof \Illuminate\Http\UploadedFile) {
            $data['gambar'] = $data['gambar']->store('uploads', 'public');
        }

        $produk->update($data);
    }

    /**
     * Delete a product.
     */
    public static function deleteProduct($id)
    {
        $produk = self::findOrFail($id);
        $produk->delete();
    }
}
