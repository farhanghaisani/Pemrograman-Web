<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Namespace untuk HasFactory
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute; // Namespace untuk Attribute

class Rumah extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'image',          // URL gambar rumah
        'name',           // Nama atau judul rumah (misal: "Rumah Hijau Asri")
        'description',    // Deskripsi singkat tentang rumah
        'price_range',    // Rentang harga atau harga rumah
        'location',       // Lokasi rumah
    ];

    /**
     * Accessor for the image attribute.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/rumahs/' . $image),
        );
    }
}
