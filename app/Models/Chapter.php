<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = [
        'manga_id',
        'number',
        'title'
    ];

    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }
}