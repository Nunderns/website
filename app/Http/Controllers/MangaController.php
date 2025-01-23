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
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Criar um novo mangá no banco de dados
        Manga::create([
            'title' => $request->title,
            'latest_chapter' => '', // Inicialmente vazio, caso precise ser atualizado
        ]);

        // Redirecionar de volta para a lista com uma mensagem de sucesso
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
}
