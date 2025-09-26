<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('home');
});

Route::get('/usuarios', [UsuarioController::class, 'mostrarVista'])->name('usuarios.vista');
Route::post('/usuarios', [UsuarioController::class, 'crearUsuario'])->name('usuarios.crear');
Route::put('/usuarios/{id}', [UsuarioController::class, 'actualizarUsuario'])->name('usuarios.actualizar');
Route::delete('/usuarios/{id}', [UsuarioController::class, 'eliminarUsuario'])->name('usuarios.eliminar');
