<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    public function index()
    {
        $mangas = Manga::with('chapters')
            ->orderBy('title')
            ->paginate(20);
            
        return view('mangas.index', compact('mangas'));
    }

    public function show(Manga $manga)
    {
        $manga->load('chapters');
        return view('mangas.show', compact('manga'));
    }

    // Outros métodos do CRUD...
}