<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <nav>
        <a href="{{ route('libros.index') }}">Libros</a>
        <a href="{{ route('usuario.index') }}">Usuarios</a>
        <a href="{{ route('prestamo.index') }}">Prestamo</a>
        <a href="{{ route('devolucion.index') }}">Devolucion</a>
        <!-- Add more navigation links as needed -->
    </nav>
    <h1>Welcome to the Library System</h1>
</body>
</html>