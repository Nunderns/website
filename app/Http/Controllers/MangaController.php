<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    // Exibir todos os mangás com filtros de ordenação
    public function index(Request $request)
    {
        // Lógica de filtro
        $sort = $request->get('sort', 'latest');

        switch ($sort) {
            case 'az':
                $mangas = Manga::orderBy('title')->paginate(20);
                break;
            case 'approval':
                $mangas = Manga::orderBy('approval_rating', 'desc')->paginate(20);
                break;
            case 'trend':
                $mangas = Manga::orderBy('trend_score', 'desc')->paginate(20);
                break;
            case 'views':
                $mangas = Manga::orderBy('views', 'desc')->paginate(20);
                break;
            case 'new':
                $mangas = Manga::orderBy('created_at', 'desc')->paginate(20);
                break;
            default:
                $mangas = Manga::orderBy('created_at', 'desc')->paginate(20);
                break;
        }

        return view('mangas.index', compact('mangas'));
    }

    // Exibir detalhes de um mangá específico
    public function show(Manga $manga)
    {
        $manga->load('chapters', 'categories');
        return view('mangas.show', compact('manga'));
    }

    // Adicionar um novo mangá ao banco de dados
    public function store(Request $request)
    {
        // Validação dos dados enviados
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Manipulação do upload de imagem
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('mangas', 'public');
        }
    
        // Criar um novo mangá no banco de dados
        $manga = Manga::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'author' => $validated['author'],
            'artist' => $validated['artist'],
            'image' => $imagePath,
        ]);
    
        // Redirecionar com mensagem de sucesso
        return redirect()->route('mangas.index')->with('success', 'Mangá adicionado com sucesso!');
    }
    

    public function rate(Request $request, $id)
    {
        $manga = Manga::findOrFail($id);
        $user = auth()->user();

        // Atualiza a avaliação do mangá
        $manga->update(['rating' => $request->rating]);

        return response()->json(['success' => true]);
    }

    public function edit(Manga $manga)
    {
        return view('mangas.edit', compact('manga'));
    }

    // Atualizar os dados de um mangá
    public function update(Request $request, Manga $manga)
    {
        // Validação dos dados enviados
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'artist' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:completed,ongoing',
            'approval_rating' => 'nullable|numeric|min:0|max:5',
        ]);

        // Atualizar os dados do mangá
        $manga->update($request->all());

        // Redirecionar com uma mensagem de sucesso
        return redirect()->route('mangas.show', $manga->id)->with('success', 'Mangá atualizado com sucesso!');
    }

    // Excluir um mangá
    public function destroy(Manga $manga)
    {
        // Excluir o mangá do banco de dados
        $manga->delete();

        // Redirecionar para a lista de mangás com uma mensagem de sucesso
        return redirect()->route('mangas.index')->with('success', 'Mangá excluído com sucesso!');
    }

    public function create()
    {
        return view('mangas.create');
    }

}
