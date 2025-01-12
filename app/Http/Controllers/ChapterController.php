<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Manga;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function show(Manga $manga, Chapter $chapter)
    {
        return view('chapters.show', compact('manga', 'chapter'));
    }

    // Outros métodos do CRUD...
}