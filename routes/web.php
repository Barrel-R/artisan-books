<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookImageController;
use App\Http\Controllers\BookVideoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/painel', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('livros', BookController::class);
    Route::resource('videos', BookVideoController::class);
    Route::resource('imagens', BookImageController::class, ['parameters' => ['imagens' => 'imagem']]);
    Route::resource('categorias', CategoryController::class);
});

require __DIR__ . '/auth.php';
