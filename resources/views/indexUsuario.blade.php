<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <div id="editarUsuarioContainer" style="display:none;">
        <h2>Editar Usuario</h2>
        <form method="POST" action="" id="formEditar">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit_id">

            <label>Nombre:</label>
            <input type="text" name="nombre" id="edit_nombre" required>

            <label>Teléfono:</label>
            <input type="number" name="telefono" id="edit_telefono" required>

            <label>Dirección:</label>
            <input type="text" name="direccion" id="edit_direccion" required>

            <button type="submit">Actualizar Usuario</button>
        </form>
    </div>



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
                        <button onclick="activarEdicion({{ $usuario->id }}, '{{ $usuario->nombre }}', '{{ $usuario->telefono }}', '{{ $usuario->direccion }}')">Editar</button>
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

<script>
    function activarEdicion(id, nombre, telefono, direccion) {
        const container = document.getElementById('editarUsuarioContainer');
        container.style.display = 'block';

        document.getElementById('edit_id').value = id;
        document.getElementById('edit_nombre').value = nombre;
        document.getElementById('edit_telefono').value = telefono;
        document.getElementById('edit_direccion').value = direccion;

        document.getElementById('formEditar').action = '/usuarios/actualizar/' + id;
}
</script>

