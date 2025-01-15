<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relacionamento com mangas
    public function mangas()
    {
        return $this->belongsToMany(Manga::class);
    }
}