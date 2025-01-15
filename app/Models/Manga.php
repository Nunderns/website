<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image_url', 'approval_rating', 'trend_score', 'views'];

    // Relacionamento de um manga com vários capítulos
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    // Relacionamento para obter o capítulo mais recente
    public function latestChapter()
    {
        return $this->hasOne(Chapter::class)->latest();
    }

    // Escopo para pegar os mangas mais recentes
    public function scopeLatestMangas($query)
    {
        return $query->orderBy('created_at', 'desc')->limit(8);
    }
}
