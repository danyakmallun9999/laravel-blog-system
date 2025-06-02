<?php

// app/Models/Post.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str; // Import Str

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
        'user_id',
        'image',
    ];

    // Relasi: Satu post dimiliki oleh satu kategori
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Satu post dimiliki oleh satu user (author)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Otomatis buat slug saat judul di set (jika belum ada slug)
    public static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title, '-');
                // Pastikan slug unik
                $originalSlug = $post->slug;
                $count = 1;
                while (static::where('slug', $post->slug)->exists()) {
                    $post->slug = "{$originalSlug}-" . $count++;
                }
            }
        });

        static::updating(function ($post) {
            // Jika title berubah, update slug
            if ($post->isDirty('title') || empty($post->slug)) {
                $post->slug = Str::slug($post->title, '-');
                $originalSlug = $post->slug;
                $count = 1;
                // Pastikan slug unik, kecuali untuk dirinya sendiri
                while (static::where('slug', $post->slug)->where('id', '!=', $post->id)->exists()) {
                    $post->slug = "{$originalSlug}-" . $count++;
                }
            }
        });
    }


    // Untuk route model binding menggunakan slug
    public function getRouteKeyName()
    {
        return 'slug';
    }
}