<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Usuario;
use App\Models\Libros;
use App\Models\Renta;

class CrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_crud(): void
    {
        // Crear
        $response = $this->post('/usuarios/crear', [
            'nombre' => 'Juan Pérez',
            'telefono' => '5551234567',
            'direccion' => 'Calle Falsa 123',
        ]);
        $response->assertRedirect('/usuarios');
        $this->assertDatabaseHas('usuarios', ['nombre' => 'Juan Pérez']);

        $usuario = Usuario::first();

        // Actualizar
        $response = $this->put('/usuarios/actualizar/' . $usuario->id, [
            'nombre' => 'Juan Actualizado',
        ]);
        $response->assertRedirect('/usuarios');
        $this->assertDatabaseHas('usuarios', ['id' => $usuario->id, 'nombre' => 'Juan Actualizado']);

        // Eliminar
        $response = $this->delete('/usuarios/eliminar/' . $usuario->id);
        $response->assertRedirect('/usuarios');
        $this->assertDatabaseMissing('usuarios', ['id' => $usuario->id]);
    }

    public function test_libros_crud(): void
    {
        // Crear
        $response = $this->post('/libros/crear', [
            'nombre' => 'El Quijote',
            'ISBN' => 'ISBN-12345',
            'autor' => 'Cervantes',
        ]);
        $response->assertRedirect('/libros');
        $this->assertDatabaseHas('libros', ['nombre' => 'El Quijote', 'ISBN' => 'ISBN-12345']);

        $libro = Libros::first();

        // Actualizar
        $response = $this->put('/libros/actualizar/' . $libro->id, [
            'autor' => 'Miguel de Cervantes',
        ]);
        $response->assertRedirect('/libros');
        $this->assertDatabaseHas('libros', ['id' => $libro->id, 'autor' => 'Miguel de Cervantes']);

        // Eliminar
        $response = $this->delete('/libros/eliminar/' . $libro->id);
        $response->assertRedirect('/libros');
        $this->assertDatabaseMissing('libros', ['id' => $libro->id]);
    }

    public function test_prestamo_y_devolucion(): void
    {
        // Datos base
        $usuario = Usuario::create([
            'nombre' => 'Ana',
            'telefono' => '5550001111',
            'direccion' => 'Av. Siempreviva',
        ]);

        $libro = Libros::create([
            'nombre' => '1984',
            'ISBN' => 'ISBN-1984',
            'autor' => 'George Orwell',
        ]);

        // Registrar préstamo
        $response = $this->post('/prestamos/registrar', [
            'usuario_id' => $usuario->id,
            'libro_id' => $libro->id,
        ]);
        $response->assertRedirect('/prestamos');
        $this->assertDatabaseHas('rentas', [
            'usuario_id' => $usuario->id,
            'libro_id' => $libro->id,
            'estado' => 'prestado',
        ]);

        $renta = Renta::first();

        // Marcar como devuelto
        $response = $this->put('/devoluciones/' . $renta->id);
        $response->assertRedirect('/devoluciones');
        $this->assertDatabaseHas('rentas', [
            'id' => $renta->id,
            'estado' => 'devuelto',
        ]);
    }
}
