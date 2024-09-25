<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'user_id',         // Tambahkan ini
        'category_id',     // Tambahkan ini jika ingin kategori bisa diset
        'is_featured',     // Tambahkan ini jika ingin unggulan bisa diset
    ];

    // Tambahkan relasi atau method lain sesuai kebutuhan
}
