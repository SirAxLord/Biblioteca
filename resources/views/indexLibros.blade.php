<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Librería - Libros</title>
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

        <h2 class="text-xl font-semibold mb-4">Crear Nuevo Libro</h2>
        <form method="POST" action="{{ route('libros.crear') }}" class="bg-white p-4 rounded shadow flex flex-wrap items-end gap-4 max-w-full mb-8">
            @csrf
            <div class="flex flex-col">
                <label for="nombre" class="font-medium">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required class="border px-3 py-2 rounded w-64">
            </div>
            <div class="flex flex-col">
                <label for="isbn" class="font-medium">ISBN:</label>
                <input type="text" id="isbn" name="isbn" required class="border px-3 py-2 rounded w-64">
            </div>
            <div class="flex flex-col">
                <label for="autor" class="font-medium">Autor:</label>
                <input type="text" id="autor" name="autor" required class="border px-3 py-2 rounded w-64">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Crear Libro</button>
        </form>

        <div id="editarLibroContainer" class="mt-10 hidden">
            <h2 class="text-xl font-semibold mb-4">Editar Libro</h2>
            <form method="POST" action="" id="formEditarLibro" class="bg-white p-4 rounded shadow flex flex-wrap items-end gap-4 max-w-full mb-8">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_libro_id">
                <div class="flex flex-col">
                    <label class="font-medium">Nombre:</label>
                    <input type="text" name="nombre" id="edit_nombre" required class="border px-3 py-2 rounded w-64">
                </div>
                <div class="flex flex-col">
                    <label class="font-medium">ISBN:</label>
                    <input type="text" name="isbn" id="edit_isbn" required class="border px-3 py-2 rounded w-64">
                </div>
                <div class="flex flex-col">
                    <label class="font-medium">Autor:</label>
                    <input type="text" name="autor" id="edit_autor" required class="border px-3 py-2 rounded w-64">
                </div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Actualizar Libro</button>
            </form>
        </div>

        <h2 class="text-xl font-semibold mt-12 mb-4">Lista de Libros</h2>
        <table class="table-auto w-full bg-white shadow rounded overflow-hidden mb-16">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">ISBN</th>
                    <th class="px-4 py-2">Autor</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($libros as $libro)
                    <tr class="text-center border-b">
                        <td class="px-4 py-2">{{ $libro->id }}</td>
                        <td class="px-4 py-2">{{ $libro->nombre }}</td>
                        <td class="px-4 py-2">{{ $libro->ISBN }}</td>
                        <td class="px-4 py-2">{{ $libro->autor }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <button onclick="activarEdicionLibro({{ $libro->id }}, '{{ $libro->nombre }}', '{{ $libro->ISBN }}', '{{ $libro->autor }}')" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Editar</button>
                            <form method="POST" action="{{ route('libros.eliminar', $libro->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar este libro?')" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Eliminar</button>
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
        function activarEdicionLibro(id, nombre, isbn, autor) {
            const container = document.getElementById('editarLibroContainer');
            container.style.display = 'block';

            document.getElementById('edit_libro_id').value = id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_isbn').value = isbn;
            document.getElementById('edit_autor').value = autor;

            document.getElementById('formEditarLibro').action = '/libros/actualizar/' + id;
        }
    </script>