<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libreria - Libros</title>
</head>
<body>
    <form>
        <h2>Crear Nuevo Libro</h2>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" required>

        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" required>

        <button type="submit">Crear Libro</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>ISBN</th>
                <th>Autor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
</body>
</html>