<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image_url', 'approval_rating', 'trend_score', 'views'];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function latestChapter()
    {
        return $this->hasOne(Chapter::class)->latestOfMany();
    }

    // Optionally define a scope for latest mangas
    public function scopeLatestMangas($query)
    {
        return $query->orderBy('created_at', 'desc')->limit(8);
    }

    public function getLatestChapterAttribute()
    {
        return $this->chapters()->latest()->first()->number ?? 'N/A';
    }
}
