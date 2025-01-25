<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    /**
     * Exibir todos os mangás com filtros de ordenação.
     */
    public function index(Request $request)
    {
        // Determinar o tipo de ordenação a partir do parâmetro 'sort'
        $sort = $request->get('sort', 'latest');

        $mangas = match ($sort) {
            'az' => Manga::orderBy('title'),
            'approval' => Manga::orderBy('approval_rating', 'desc'),
            'trend' => Manga::orderBy('trend_score', 'desc'),
            'views' => Manga::orderBy('views', 'desc'),
            'new' => Manga::orderBy('created_at', 'desc'),
            default => Manga::orderBy('created_at', 'desc'),
        };

        $mangas = $mangas->paginate(20);

        return view('mangas.index', compact('mangas'));
    }

    /**
     * Exibir detalhes de um mangá específico.
     */
    public function show(Manga $manga)
    {
        $manga->load('chapters', 'categories');
        return view('mangas.show', compact('manga'));
    }

    /**
     * Exibir o formulário para criar um novo mangá.
     */
    public function create()
    {
        return view('mangas.create');
    }

    /**
     * Armazenar um novo mangá no banco de dados.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload da imagem (se fornecida)
        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('mangas', 'public') 
            : null;

        // Criar o mangá
        $manga = Manga::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'author' => $validated['author'],
            'artist' => $validated['artist'],
            'category' => $validated['category'],
            'image' => $imagePath,
        ]);

        return redirect()->route('mangas.index')->with('success', 'Mangá adicionado com sucesso!');
    }

    /**
     * Exibir o formulário de edição de um mangá.
     */
    public function edit(Manga $manga)
    {
        return view('mangas.edit', compact('manga'));
    }

    /**
     * Atualizar os dados de um mangá existente.
     */
    public function update(Request $request, Manga $manga)
    {
        // Validação dos dados
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'artist' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:completed,ongoing',
            'approval_rating' => 'nullable|numeric|min:0|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Atualizar a imagem se fornecida
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store("mangas/{$manga->id}", 'public');
            $validated['image'] = $imagePath;
        }

        // Atualizar o mangá
        $manga->update($validated);

        return redirect()->route('mangas.show', $manga->id)->with('success', 'Mangá atualizado com sucesso!');
    }

    /**
     * Excluir um mangá.
     */
    public function destroy(Manga $manga)
    {
        // Excluir o mangá do banco e seus arquivos relacionados
        if ($manga->image) {
            \Storage::disk('public')->delete($manga->image);
        }

        $manga->delete();

        return redirect()->route('mangas.index')->with('success', 'Mangá excluído com sucesso!');
    }

    /**
     * Avaliar um mangá.
     */
    public function rate(Request $request, $id)
    {
        $request->validate(['rating' => 'required|numeric|min:0|max:5']);
        $manga = Manga::findOrFail($id);

        // Atualizar a avaliação do mangá
        $manga->update(['approval_rating' => $request->rating]);

        return response()->json(['success' => true]);
    }
}
