<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'image_url',
        'buy_link',
        'rating',
        'author',
        'artist',
    ];

    // Relacionamento com capítulos
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    // Relacionamento para obter o capítulo mais recente
    public function latestChapter()
    {
        return $this->hasOne(Chapter::class)->latest();
    }

    // Relacionamento com categorias
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Relacionamento com avaliações
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}