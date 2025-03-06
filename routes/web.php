<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/usuarios', [UsuarioController::class, 'index'])->middleware(['auth'])->name('userIndex');
Route::get('/usuarios/create', [UsuarioController::class, 'create'])->middleware(['auth'])->name('userCreate');
Route::post('/usuarios', [UsuarioController::class, 'store'])->middleware(['auth'])->name('userStore');
Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->middleware(['auth'])->name('userShow');
Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->middleware(['auth'])->name('userEdit');
Route::post('/usuarios/{id}/status', [UsuarioController::class, 'userStatus'])->middleware(['auth'])->name('userStatus');
Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('userUpdate');


require __DIR__.'/auth.php';
