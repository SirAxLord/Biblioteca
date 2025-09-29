<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Librería - Usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <nav class="bg-blue-600 py-4 text-white shadow">
        <div class="container mx-auto flex justify-between items-center px-4">
            <a href="{{ route('home') }}" class="text-2xl font-bold">Librería</a>
            <div class="space-x-4">
                <a href="{{ route('usuarios.vista') }}" class="hover:underline">Usuarios</a>
                <a href="{{ route('libros.vista') }}" class="hover:underline">Libros</a>
                <a href="{{ route('prestamos.vista') }}" class="hover:underline">Préstamos</a>
                <a href="{{ route('devoluciones.vista') }}" class="hover:underline">Devoluciones</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 px-4">
        <h2 class="text-xl font-semibold mb-4">Crear Nuevo Usuario</h2>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('usuarios.crear') }}" class="bg-white p-4 rounded shadow flex flex-wrap items-end gap-4 max-w-full mb-8">
            @csrf
            <div class="flex flex-col">
                <label class="font-medium">Nombre:</label>
                <input type="text" name="nombre" required class="border px-3 py-2 rounded w-64">
            </div>
            <div class="flex flex-col">
                <label class="font-medium">Teléfono:</label>
                <input type="number" name="telefono" required class="border px-3 py-2 rounded w-64">
            </div>
            <div class="flex flex-col">
                <label class="font-medium">Dirección:</label>
                <input type="text" name="direccion" required class="border px-3 py-2 rounded w-64">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Crear Usuario</button>
        </form>

        <div id="editarUsuarioContainer" class="hidden">
            <h2 class="text-xl font-semibold mb-4">Editar Usuario</h2>
            <form method="POST" action="" id="formEditar" class="bg-white p-4 rounded shadow flex flex-wrap items-end gap-4 max-w-full mb-8">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_id">
                <div class="flex flex-col">
                    <label class="font-medium">Nombre:</label>
                    <input type="text" name="nombre" id="edit_nombre" required class="border px-3 py-2 rounded w-64">
                </div>
                <div class="flex flex-col">
                    <label class="font-medium">Teléfono:</label>
                    <input type="number" name="telefono" id="edit_telefono" required class="border px-3 py-2 rounded w-64">
                </div>
                <div class="flex flex-col">
                    <label class="font-medium">Dirección:</label>
                    <input type="text" name="direccion" id="edit_direccion" required class="border px-3 py-2 rounded w-64">
                </div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Actualizar Usuario</button>
            </form>
        </div>

        <h2 class="text-xl font-semibold mt-12 mb-4">Lista de Usuarios</h2>
        <table class="table-auto w-full bg-white shadow rounded overflow-hidden mb-16">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Teléfono</th>
                    <th class="px-4 py-2">Dirección</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr class="text-center border-b">
                        <td class="px-4 py-2">{{ $usuario->id }}</td>
                        <td class="px-4 py-2">{{ $usuario->nombre }}</td>
                        <td class="px-4 py-2">{{ $usuario->telefono }}</td>
                        <td class="px-4 py-2">{{ $usuario->direccion }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <button onclick="activarEdicion({{ $usuario->id }}, '{{ $usuario->nombre }}', '{{ $usuario->telefono }}', '{{ $usuario->direccion }}')" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Editar</button>
                            <form method="POST" action="{{ route('usuarios.eliminar', $usuario->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar este usuario?')" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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

