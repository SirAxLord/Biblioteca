<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Libros;
use App\Models\Renta;
use Illuminate\Http\Request;

class RentaController extends Controller
{
    public function mostrarVista()
    {
        $usuarios = Usuario::all();
        $libros = Libros::all();
        return view('indexPrestamos', compact('usuarios', 'libros'));
    }

    public function registrarPrestamo(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'libro_id' => 'required|exists:libros,id',
        ]);

        Renta::create([
            'usuario_id' => $request->usuario_id,
            'libro_id' => $request->libro_id,
            'fecha_renta' => now(),
            'fecha_devolucion' => null,
        ]);

        return redirect()->route('prestamos.vista')->with('success', 'Préstamo registrado exitosamente.');
    }

    public function mostrarDevoluciones()
    {
        $rentas = Renta::with(['usuario', 'libro'])->get();
        return view('indexDevolucion', compact('rentas'));
    }

    public function marcarDevuelto($id)
    {
        $renta = Renta::find($id);
        if (!$renta) {
            return redirect()->route('devoluciones.vista')->with('error', 'Préstamo no encontrado.');
        }

        $renta->estado = 'devuelto';
        $renta->fecha_devolucion = now();
        $renta->save();

        return redirect()->route('devoluciones.vista')->with('success', 'Préstamo marcado como devuelto.');
    }
}

