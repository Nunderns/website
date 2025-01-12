<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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