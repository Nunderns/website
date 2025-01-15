<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestMangas = Manga::with('latestChapter')
            ->latest()
            ->take(8)
            ->get();
            
        $mostViewedMangas = Manga::with('latestChapter')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();
            
        return view('welcome', compact('latestMangas', 'mostViewedMangas'));
    }
}