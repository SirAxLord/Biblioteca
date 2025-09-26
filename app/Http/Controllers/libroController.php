<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libros;

class libroController extends Controller
{
    public function mostrarVista()
    {
        $libros = Libros::all();
        return view("libros", compact('libros'));
    }
    public function crearLibro(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'ISBN' => 'required|string|max:13|unique:libros,ISBN',
            'autor' => 'required|string|max:255',
        ]);

        // Crear un nuevo libro en la base de datos
        $libro = new Libros();
        $libro->nombre = $validatedData['nombre'];
        $libro->ISBN = $validatedData['ISBN'];
        $libro->autor = $validatedData['autor'];
        $libro->save();

        return response()->json(['message' => 'Libro creado exitosamente', 'libro' => $libro], 201);
    }

    public function obtenerLibros()
    {
        $libros = Libros::all();
        return response()->json($libros);
    }

    public function obtenerLibro($id)
    {
        $libro = Libros::find($id);
        if (!$libro) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }
        return response()->json($libro);
    }

    public function actualizarLibro(Request $request, $id)
    {
        $libro = Libros::find($id);
        if (!$libro) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }

        // Validar los datos recibidos
        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'ISBN' => 'sometimes|required|string|max:13|unique:libros,ISBN,' . $id,
            'autor' => 'sometimes|required|string|max:255',
        ]);

        // Actualizar los datos del libro
        if (isset($validatedData['nombre'])) {
            $libro->nombre = $validatedData['nombre'];
        }
        if (isset($validatedData['ISBN'])) {
            $libro->ISBN = $validatedData['ISBN'];
        }
        if (isset($validatedData['autor'])) {
            $libro->autor = $validatedData['autor'];
        }
        $libro->save();

        return response()->json(['message' => 'Libro actualizado exitosamente', 'libro' => $libro]);
    }

    public function eliminarLibro($id)
    {
        $libro = Libros::find($id);
        if (!$libro) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }
        $libro->delete();
        return response()->json(['message' => 'Libro eliminado exitosamente']);
    }
}
