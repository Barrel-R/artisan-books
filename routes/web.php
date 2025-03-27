<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\LivroImagemController;
use App\Http\Controllers\LivroVideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia('Home');
});

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.show_login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::resource('livros', LivroController::class);
Route::resource('videos', LivroVideoController::class);
Route::resource('imagens', LivroImagemController::class, ['parameters' => ['imagens' => 'imagem']]);
Route::resource('categorias', CategoriaController::class);
