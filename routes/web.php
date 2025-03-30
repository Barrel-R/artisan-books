<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookImageController;
use App\Http\Controllers\BookVideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia('Home');
});

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.show_login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('livros', BookController::class);
    Route::resource('videos', BookVideoController::class);
    Route::resource('imagens', BookImageController::class, ['parameters' => ['imagens' => 'imagem']]);
    Route::resource('categorias', CategoryController::class);
});
