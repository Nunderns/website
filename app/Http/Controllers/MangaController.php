<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Buscar os 8 lançamentos mais recentes
        $latestMangas = Manga::with('latestChapter')->orderBy('created_at', 'desc')->limit(8)->get();

        // Buscar os 5 mangás mais visualizados
        $mostViewedMangas = Manga::with('latestChapter')->orderBy('views', 'desc')->limit(5)->get();

        return view('welcome', compact('latestMangas', 'mostViewedMangas'));
    }
}
