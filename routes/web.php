<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Rota para a página inicial
Route::get('/', function () {
    return view('welcome');
});

// Rota para o dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rotas para o perfil do usuário
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rota para a página de mangás
Route::get('/manga', function () {
    return view('manga'); // Aponta para resources/views/manga.blade.php
})->name('manga');

// Rota para a página de contato
Route::get('/concat', function () {
    return view('concat'); // Aponta para resources/views/contato.blade.php
})->name('concat');

// Rota para a página sobre
Route::get('/about', function () {
    return view('about'); // Aponta para resources/views/sobre.blade.php
})->name('about');


// Inclui as rotas de autenticação
require __DIR__.'/auth.php';
