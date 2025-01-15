<?php
namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestMangas = Manga::orderBy('created_at', 'desc')->take(8)->get();
        $mostViewedMangas = Manga::orderBy('views', 'desc')->take(8)->get();

        return view('welcome', compact('latestMangas', 'mostViewedMangas'));
    }
}