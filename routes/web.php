<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Rota principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rotas de autenticação
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Rota para o painel de controle do usuário (dashboard)
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    })->name('dashboard');

    // Rotas de perfil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rota para atualizar a senha
    Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    // Rota para enviar verificação de email
    Route::middleware(['auth', 'throttle:6,1'])->post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    })->name('verification.send');

    // Rota para a página inicial autenticada
    Route::get('/home', [HomeController::class, 'index'])->name('home.authenticated');
});

// Rotas para páginas estáticas
Route::view('/discord', 'pages.discord')->name('discord');
Route::view('/doacoes', 'pages.donations')->name('donations');
Route::view('/solucoes', 'pages.solutions')->name('solutions');
Route::view('/contato', 'pages.contact')->name('contact');
Route::post('/solucoes/submit', [SolutionController::class, 'submit'])->name('solutions.submit');

// Rotas para mangás
Route::get('/search', [MangaController::class, 'search'])->name('manga.search');
Route::get('/search-results', [MangaController::class, 'searchResults'])->name('manga.search.results');
Route::resource('mangas', MangaController::class)->except(['destroy']);
Route::prefix('mangas/{manga}')->group(function () {
    Route::post('/rate', [MangaController::class, 'rate'])->name('mangas.rate');
    Route::post('/report', [MangaController::class, 'report'])->name('mangas.report');
});

// Rotas para capítulos
Route::prefix('mangas/{manga}/chapters')->name('chapters.')->group(function () {
    Route::get('/create', [ChapterController::class, 'create'])->name('create');
    Route::post('/', [ChapterController::class, 'store'])->name('store');
    Route::get('/{chapter}/read', [ChapterController::class, 'read'])->name('read');
    Route::get('/{chapter}/edit', [ChapterController::class, 'edit'])->name('edit');
    Route::put('/{chapter}', [ChapterController::class, 'update'])->name('update');
    Route::delete('/{chapter}', [ChapterController::class, 'destroy'])->name('destroy');
});

// Rotas para imagens
Route::post('/chapters/{chapter}/images/upload', [ImageController::class, 'upload'])->name('images.upload');
Route::delete('/images/{image}', [ImageController::class, 'destroy'])->name('images.destroy');
