<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\TurnosController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('curso.index'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])
        ->name('login.store')
        ->middleware('throttle:5,1');
});
Route::get('/register', [RegistroController::class, 'create'])->name('register');
Route::post('/register', [RegistroController::class, 'store'])->name('register.store');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/curso/create', [CursoController::class, 'create'])->name('curso.create');
    Route::post('/curso', [CursoController::class, 'store'])->name('curso.store');
});

Route::resource('curso', CursoController::class)
    ->only(['index', 'show']);

Route::resource('instructores', InstructorController::class)
    ->parameters(['instructores' => 'instructor'])
    ->only(['index'])
    ->middleware(['auth', 'rol:admin']);

Route::resource('categorias', CategoriaController::class)
    ->only(['index', 'create', 'store']);

Route::resource('turnos', TurnosController::class)
    ->only(['index', 'create', 'store']);
