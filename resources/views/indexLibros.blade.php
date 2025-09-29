<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libreria - Libros</title>
</head>
<body>
    <h2>Crear Nuevo Libro</h2>

    <form method="POST" action="{{ route('libros.crear') }}">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="isbn">isbn:</label>
        <input type="text" id="isbn" name="isbn" required>

        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" required>

        <button type="submit">Crear Libro</button>
    </form>

    <div id="editarLibroContainer" style="display:none;">
        <h2>Editar Libro</h2>
        <form method="POST" action="" id="formEditarLibro">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit_libro_id">

            <label>Nombre:</label>
            <input type="text" name="nombre" id="edit_nombre" required>

            <label>isbn:</label>
            <input type="text" name="isbn" id="edit_isbn" required>

            <label>Autor:</label>
            <input type="text" name="autor" id="edit_autor" required>

            <button type="submit">Actualizar Libro</button>
        </form>
    </div>


    <h2>Lista de Libros</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>isbn</th>
                <th>Autor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($libros as $libro)
                <tr>
                    <td>{{ $libro->id }}</td>
                    <td>{{ $libro->nombre }}</td>
                    <td>{{ $libro->ISBN }}</td>
                    <td>{{ $libro->autor }}</td>
                    <td>
                        <button onclick="activarEdicionLibro({{ $libro->id }}, '{{ $libro->nombre }}', '{{ $libro->ISBN }}', '{{ $libro->autor }}')">Editar</button>
                        <form method="POST" action="{{ route('libros.eliminar', $libro->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Eliminar este libro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
