<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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
            case 'latest':
            default:
                $mangas = Manga::with('chapters')->orderBy('updated_at', 'desc')->paginate(20);
                break;
        }

        // Buscar os 8 lançamentos mais recentes
        $latestMangas = Manga::with('latestChapter')->orderBy('created_at', 'desc')->limit(8)->get();

        // Buscar os 5 mangás mais visualizados
        $mostViewedMangas = Manga::with('latestChapter')->orderBy('views', 'desc')->limit(5)->get();

        return view('welcome', compact('mangas', 'latestMangas', 'mostViewedMangas'));
    }

    public function show(Manga $manga)
    {
        $manga->load('chapters');
        return view('mangas.show', compact('manga'));
    }
}
