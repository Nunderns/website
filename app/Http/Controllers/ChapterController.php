<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Manga;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    // Exibir o formulário de criação de capítulo
    public function create(Manga $manga)
    {
        return view('chapters.create', compact('manga'));
    }

    // Armazenar um novo capítulo
    public function store(Request $request, Manga $manga)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'number' => 'required|integer|min:1',
            'content' => 'required|string',
        ]);

        // Criar o capítulo associado ao mangá
        $manga->chapters()->create([
            'title' => $request->title,
            'number' => $request->number,
            'content' => $request->content,
        ]);

        return redirect()->route('mangas.show', $manga->id)->with('success', 'Capítulo publicado com sucesso!');
    }
}
