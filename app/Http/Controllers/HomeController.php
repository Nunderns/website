<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Método index para exibir a página inicial
    public function index()
    {
        return view('welcome');
    }
}
