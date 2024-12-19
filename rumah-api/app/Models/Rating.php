<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'rumah_id', // ID layanan yang dirating
        'user_id', // ID pengguna yang memberikan rating
        'rating', // Nilai rating (1-5)
    ];

    public function rumah()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
