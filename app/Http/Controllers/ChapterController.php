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

    public function create(Manga $manga)
    {
        return view('chapters.create', compact('manga'));
    }

    public function store(Request $request, Manga $manga)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'number' => 'required|integer',
            'content' => 'required|string',
        ]);

        $manga->chapters()->create($request->all());

        return redirect()->route('mangas.show', $manga->id)->with('success', 'Capítulo publicado com sucesso.');
    }

    // Outros métodos do CRUD...
}