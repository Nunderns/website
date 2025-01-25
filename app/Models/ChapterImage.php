<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterImage extends Model
{
    use HasFactory;

    /**
     * Atributos permitidos para atribuição em massa.
     *
     * @var array
     */
    protected $fillable = [
        'path',       // Caminho da imagem
        'chapter_id', // ID do capítulo associado
    ];

    /**
     * Relacionamento com o modelo Chapter.
     */
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
