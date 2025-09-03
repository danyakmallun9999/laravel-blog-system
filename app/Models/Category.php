<?php

// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str; // Import Str

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    // Relasi: Satu kategori memiliki banyak post
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    // Otomatis buat slug saat nama di set (jika belum ada slug)
    public static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name, '-');
            }
        });
        static::updating(function ($category) {
            if (empty($category->slug) || $category->isDirty('name')) {
                $category->slug = Str::slug($category->name, '-');
            }
        });
    }

    // Untuk route model binding menggunakan slug
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
