<?php

// app/Models/Work.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'year',
        'category',
        'project_url',
    ];

    // Jika kamu ingin relasi ke User (siapa yg menambah project ini), tambahkan:
    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }
    // Dan jangan lupa tambahkan user_id di migration & $fillable
}
