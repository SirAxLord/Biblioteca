<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Librería</title>
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

    <div class="flex flex-col items-center justify-center min-h-screen bg-blue-100 px-4">
        <h1 class="text-4xl font-bold mb-6 text-black text-center">Bienvenido a la Librería</h1>

        <div class="bg-white p-6 rounded shadow-md w-full max-w-3xl text-center">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">¿Qué libro desea buscar?</h2>

            <form method="GET" action="{{ route('libros.buscar') }}" class="flex items-center justify-center gap-2">
                <input type="text" name="titulo" placeholder="Ingrese el título del libro" class="px-5 py-3 border rounded-md w-full text-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md text-lg hover:bg-blue-700 flex items-center gap-2"> Buscar </button>
            </form>

            @if(session('libro'))
                <div class="mt-6 bg-gray-50 p-4 rounded shadow text-left">
                    <h3 class="text-lg font-bold mb-2">Resultado encontrado:</h3>
                    <p><strong> Nombre:</strong> {{ session('libro')->nombre }}</p>
                    <p><strong> ISBN:</strong> {{ session('libro')->ISBN }}</p>
                    <p><strong> Autor:</strong> {{ session('libro')->autor }}</p>
                </div>
            @elseif(session('no_encontrado'))
                <div class="mt-6 text-red-600 font-semibold">
                    {{ session('no_encontrado') }}
                </div>
            @endif
        </div>
    </div>

</body>
</html>
