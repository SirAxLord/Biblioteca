<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Librería - Usuarios</title>
</head>
<body>
    <h2>Crear Nuevo Usuario</h2>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('usuarios.crear') }}">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Teléfono:</label>
        <input type="number" name="telefono" required>

        <label>Dirección:</label>
        <input type="text" name="direccion" required>

        <button type="submit">Crear Usuario</button>
    </form>

    <h2>Lista de Usuarios</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->telefono }}</td>
                    <td>{{ $usuario->direccion }}</td>
                    <td>
                        {{-- <a href="{{ route('usuarios.editar', $usuario->id) }}">Editar</a> --}}
                        <form method="POST" action="{{ route('usuarios.eliminar', $usuario->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
