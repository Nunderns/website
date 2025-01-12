<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
=======
use App\Models\Manga;
>>>>>>> 1dc73cf686705614c32f4a264e1cd9c48df79781
use Illuminate\Http\Request;

class HomeController extends Controller
{
<<<<<<< HEAD
    // Método index para exibir a página inicial
    public function index()
    {
        return view('welcome');
    }
}
=======
    public function index()
    {
        $latestReleases = Manga::with('chapters')
            ->latest()
            ->take(8)
            ->get();
            
        $mostRead = Manga::with('chapters')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();
            
        return view('welcome', compact('latestReleases', 'mostRead'));
    }
}
>>>>>>> 1dc73cf686705614c32f4a264e1cd9c48df79781
