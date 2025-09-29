<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libros;

class libroController extends Controller
{
    public function mostrarVista()
    {
        $libros = Libros::all();
        return view("indexlibros", compact('libros'));
    }
    public function crearLibro(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'isbn' => 'required|string|max:255|unique:libros,isbn',
            'autor' => 'required|string|max:255',
        ]);

        // Crear un nuevo libro en la base de datos
        $libro = new Libros();
        $libro->nombre = $validatedData['nombre'];
        $libro->isbn = $validatedData['isbn'];
        $libro->autor = $validatedData['autor'];
        $libro->save();

        return redirect()->route('libros.vista')->with('success', 'Libro creado exitosamente');
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
            'isbn' => 'sometimes|required|string|max:255|unique:libros,isbn,' . $id,
            'autor' => 'sometimes|required|string|max:255',
        ]);

        // Actualizar los datos del libro
        if (isset($validatedData['nombre'])) {
            $libro->nombre = $validatedData['nombre'];
        }
        if (isset($validatedData['isbn'])) {
            $libro->isbn = $validatedData['isbn'];
        }
        if (isset($validatedData['autor'])) {
            $libro->autor = $validatedData['autor'];
        }
        $libro->save();
        return redirect()->route('libros.vista')->with('success', 'Libro actualizado exitosamente');
    }

    public function eliminarLibro($id)
    {
        $libro = Libros::find($id);
        if (!$libro) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }
        $libro->delete();
        return redirect()->route('libros.vista')->with('success', 'Libro eliminado exitosamente'); 
    }

    public function buscarLibro(Request $request)
    {
        $titulo = $request->input('titulo');

        $libro = Libros::where('nombre', 'like', "%$titulo%")->first();

        if ($libro) {
            return redirect()->route('home')->with('libro', $libro);
        } else {
            return redirect()->route('home')->with('no_encontrado', 'El libro no existe en la base de datos.');
        }
    }
}


