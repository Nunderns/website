<?php
<<<<<<< HEAD

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
=======
use App\Http\Controllers\Auth\AuthenticatedSessionController;
>>>>>>> 1dc73cf686705614c32f4a264e1cd9c48df79781
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Rota principal
<<<<<<< HEAD
Route::get('/', [HomeController::class, 'index']);

// Rotas de autenticação
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

=======
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rotas de autenticação
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// Rotas para páginas estáticas
Route::view('/discord', 'pages.discord')->name('discord');
Route::view('/doacoes', 'pages.donations')->name('donations');
Route::view('/solucoes', 'pages.solutions')->name('solutions');
Route::view('/contato', 'pages.contact')->name('contact');

// Rotas para mangás
Route::get('/mangas', [MangaController::class, 'index'])->name('mangas.index');
Route::get('/mangas/{manga}', [MangaController::class, 'show'])->name('mangas.show');
Route::get('/mangas/{manga}/capitulo/{chapter}', [ChapterController::class, 'show'])
    ->name('chapters.show');

// Rotas de perfil
>>>>>>> 1dc73cf686705614c32f4a264e1cd9c48df79781
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Rota para o painel de controle do usuário (dashboard)
    Route::get('/dashboard', function () {
        return view('dashboard');  // Certifique-se de ter a view 'dashboard.blade.php'
    })->name('dashboard');

    // Rotas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rota para a página inicial autenticada
    Route::get('/home', [HomeController::class, 'index'])->name('home.authenticated');
});

<<<<<<< HEAD
// Rotas para páginas estáticas
Route::view('/discord', 'pages.discord')->name('discord');
Route::view('/doacoes', 'pages.donations')->name('donations');
Route::view('/solucoes', 'pages.solutions')->name('solutions');
Route::view('/contato', 'pages.contact')->name('contact');

// Rotas para mangás
Route::get('/mangas', [MangaController::class, 'index'])->name('mangas.index');
Route::get('/mangas/{manga}', [MangaController::class, 'show'])->name('mangas.show');
Route::get('/mangas/{manga}/capitulo/{chapter}', [ChapterController::class, 'show'])->name('chapters.show');
=======
Route::middleware('auth')->get('/home', [HomeController::class, 'index']);
>>>>>>> 1dc73cf686705614c32f4a264e1cd9c48df79781
