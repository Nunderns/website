<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Rota principal (Página inicial)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rotas de autenticação
Route::middleware('guest')->group(function () {
    // Registro de usuário
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    
    // Login de usuário
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    // Logout de usuário
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Painel do usuário (Dashboard)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Perfil do usuário
    Route::get('/profile', function () {
        return redirect()->route('profile.edit');
    })->name('profile');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    
    // Verificação de e-mail
    Route::middleware(['auth', 'throttle:6,1'])->post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    })->name('verification.send');

    // Página inicial autenticada
    Route::get('/home', [HomeController::class, 'index'])->name('home.authenticated');
});

// Rotas para páginas estáticas
Route::view('/discord', 'pages.discord')->name('discord');
Route::view('/doacoes', 'pages.donations')->name('donations');
Route::view('/solucoes', 'pages.solutions')->name('solutions');
Route::view('/contato', 'pages.contact')->name('contact');

// Rotas para mangás
Route::prefix('mangas')->group(function () {
    Route::get('/', [MangaController::class, 'index'])->name('mangas.index');
    Route::get('/{manga}', [MangaController::class, 'show'])->name('mangas.show');
    Route::get('/{manga}/capitulo/{chapter}', [ChapterController::class, 'show'])->name('chapters.show');
});
