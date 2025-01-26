<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'manga_id',
        'created_at',
        'path',
        'chapter_id',
    
    ];

    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }

    public function images()
    {
        return $this->hasMany(ChapterImage::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}