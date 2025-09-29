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
                <a href="{{ route('prestamos.vista')}}" class="mr-4 hover:underline">Prestamos</a>
                <a href="#" class="mr-4 hover:underline">Devolucion</a>
            </div>
        </div>
    </nav>

    <div class="flex flex-col items-center justify-center min-h-screen bg-blue-100">
        <h1 class="text-4xl font-bold mb-6 text-black">Bienvenido a la Librería</h1>
            <div class="mt-6 text-center">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">¿Qué libro desea buscar?</h2>
                <form method="GET" action="{{ route('libros.buscar') }}" class="flex justify-center">
                    <input type="text" name="titulo" placeholder="Ingrese el título del libro" class="px-4 py-2 border rounded-l-md w-1/3" required>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700">Buscar</button>
                </form>

                @if(session('libro'))
                    <div class="mt-4 bg-white p-4 rounded shadow-md w-1/2 mx-auto">
                        <h3 class="text-lg font-bold">Resultado:</h3>
                        <p><strong>Nombre:</strong> {{ session('libro')->nombre }}</p>
                        <p><strong>ISBN:</strong> {{ session('libro')->ISBN }}</p>
                        <p><strong>Autor:</strong> {{ session('libro')->autor }}</p>
                    </div>
                @elseif(session('no_encontrado'))
                    <div class="mt-4 text-red-600 font-semibold">
                        {{ session('no_encontrado') }}
                    </div>
                @endif
            </div>
    </div>
</body>
</html>