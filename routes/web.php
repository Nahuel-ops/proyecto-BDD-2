<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\TurnosController;
use Illuminate\Support\Facades\Route;

// Redirección inicial compartida
Route::get('/', fn () => redirect()->route('curso.index'))->name('home');

// --- RUTAS PARA INVITADOS (GUEST) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])
        ->name('login.store')
        ->middleware('throttle:5,1');
        
    Route::get('/register', [RegistroController::class, 'create'])->name('register');
    Route::post('/register', [RegistroController::class, 'store'])->name('register.store');
});

// --- CERRAR SESIÓN (Requiere estar autenticado) ---
Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


// --- ENTORNO PROTEGIDO GLOBAL (Para usuarios logueados y auditados) ---
Route::middleware(['auth', 'actividad'])->group(function () {

    // [CRÍTICO] 1. Rutas específicas primero para evitar conflictos con el Resource
    Route::middleware('rol:admin')->group(function () {
        Route::get('/curso/create', [CursoController::class, 'create'])->name('curso.create');
        Route::post('/curso', [CursoController::class, 'store'])->name('curso.store');
    });

    // 2. Rutas del Resource (Van DESPUÉS de las rutas específicas)
    Route::resource('curso', CursoController::class)->only(['index', 'show']);


    // 3. Resto de rutas exclusivas para el ADMINISTRADOR
    Route::middleware('rol:admin')->group(function () {
        
        // Gestión de Instructores
        Route::resource('instructores', InstructorController::class)
            ->parameters(['instructores' => 'instructor'])
            ->only(['index']);

        // Gestión de Categorías
        Route::resource('categorias', CategoriaController::class)
            ->only(['index', 'create', 'store']);

        // Gestión de Turnos
        Route::resource('turnos', TurnosController::class)
            ->only(['index', 'create', 'store']);
    });

});

