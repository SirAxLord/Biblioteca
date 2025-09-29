<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Home - Libreria </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="bg-blue-600 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-2xl font-bold">Librería</a>
            <div>
                <a href="{{ route('usuarios.vista') }}" class="mr-4 hover:underline">Usuarios</a>
                <a href="{{ route('libros.vista') }}" class="mr-4 hover:underline">Libros</a>
                <a href="#" class="mr-4 hover:underline">Prestamos</a>
                <a href="#" class="mr-4 hover:underline">Devolucion</a>
            </div>
        </div>
    </nav>

    <div class="flex flex-col items-center justify-center min-h-screen bg-blue-100">
        <h1 class="text-4xl font-bold mb-6 text-black">Bienvenido a la Librería</h1>
    </div>
</body>
</html>