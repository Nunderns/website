<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Armazena um novo capítulo e suas imagens associadas.
     */
    public function store(Request $request, Manga $manga)
    {
        // Validação dos dados
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'number' => 'required|integer|min:1|unique:chapters,number,NULL,id,manga_id,' . $manga->id,
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validação das imagens
        ]);
    
        // Criar o capítulo no banco de dados
        $chapter = $manga->chapters()->create([
            'title' => $validated['title'],
            'number' => $validated['number'],
        ]);
    
        // Armazenar as imagens relacionadas ao capítulo
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                // Salvar a imagem em uma pasta específica
                $path = $image->store("mangas/{$manga->id}/chapters/{$chapter->id}", 'public');
    
                // Criar um registro no banco de dados para a imagem
                $chapter->images()->create(['path' => $path]);
            }
        }
    
        return redirect()->route('mangas.show', $manga->id)->with('success', 'Capítulo e imagens salvos com sucesso!');
    }
    

    public function create(Manga $manga)
{
    return view('chapters.create', compact('manga'));
}


    public function read($mangaId, $chapterId)
{
    $chapter = Chapter::with('images')->findOrFail($chapterId);

    return view('chapters.read', compact('chapter'));
}
}
