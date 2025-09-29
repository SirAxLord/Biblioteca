<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usuarioController;
use App\Http\Controllers\libroController;
use App\Http\Controllers\RentaController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/buscar-libro', [LibroController::class, 'buscarLibro'])->name('libros.buscar');

Route::get('/usuarios', [usuarioController::class, 'mostrarVista'])->name('usuarios.vista');
Route::post('/usuarios/crear', [usuarioController::class, 'crearUsuario'])->name('usuarios.crear');
Route::put('/usuarios/actualizar/{id}', [usuarioController::class, 'actualizarUsuario'])->name('usuarios.actualizar');
Route::delete('/usuarios/eliminar/{id}', [usuarioController::class, 'eliminarUsuario'])->name('usuarios.eliminar');

Route::get('/libros', [libroController::class, 'mostrarVista'])->name('libros.vista');
Route::post('/libros/crear', [libroController::class, 'crearLibro'])->name('libros.crear');
Route::put('/libros/actualizar/{id}', [libroController::class, 'actualizarLibro'])->name('libros.actualizar');
Route::delete('/libros/eliminar/{id}', [libroController::class, 'eliminarLibro'])->name('libros.eliminar');

Route::get('/prestamos', [RentaController::class, 'mostrarVista'])->name('prestamos.vista');
Route::post('/prestamos/registrar', [RentaController::class, 'registrarPrestamo'])->name('prestamos.registrar');

Route::get('/devoluciones', [RentaController::class, 'mostrarDevoluciones'])->name('devoluciones.vista');
Route::put('/devoluciones/{id}', [RentaController::class, 'marcarDevuelto'])->name('devoluciones.marcar');
