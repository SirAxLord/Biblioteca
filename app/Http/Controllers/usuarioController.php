<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class usuarioController extends Controller
{
    public function mostrarVista()
    {
        $usuarios = Usuario::all();
        return view("indexUsuario", compact('usuarios'));
    }
    public function crearUsuario(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|numeric',
            'direccion' => 'required|string|max:255',
        ]);

        // Crear un nuevo usuario en la base de datos
        $usuario = new Usuario();
        $usuario->nombre = $validatedData['nombre'];
        $usuario->telefono = $validatedData['telefono'];
        $usuario->direccion = $validatedData['direccion'];
        $usuario->save();

        return redirect()->route('usuarios.vista')->with('success', 'Usuario creado exitosamente');
    }

    public function obtenerUsuarios()
    {
        $usuarios = Usuario::all();
    }

    public function obtenerUsuario($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }

    public function actualizarUsuario(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Validar los datos recibidos
        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'telefono' => 'sometimes|required|numeric',
            'direccion' => 'sometimes|required|string|max:255',
        ]);

        // Actualizar los datos del usuario
        if (isset($validatedData['nombre'])) {
            $usuario->nombre = $validatedData['nombre'];
        }
        if (isset($validatedData['telefono'])) {
            $usuario->telefono = $validatedData['telefono'];
        }
        if (isset($validatedData['direccion'])) {
            $usuario->direccion = $validatedData['direccion'];
        }
        $usuario->save();
    }

    public function eliminarUsuario($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        $usuario->delete();
                return redirect()->route('usuarios.vista')->with('success', 'Usuario eliminado exitosamente');
    }
}
