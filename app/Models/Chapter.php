<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'manga_id', 'created_at'];

    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }
}