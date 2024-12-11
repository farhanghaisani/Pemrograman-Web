<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rumah_id', // ID rumah yang direview
        'user_id',  // ID pengguna yang memberikan review
        'review',   // Teks review
    ];

    // Relasi ke model Rumah
    public function rumah()
    {
        return $this->belongsTo(Rumah::class); // Menghubungkan ke model Rumah
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class); // Menghubungkan ke model User
    }
}
