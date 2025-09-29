<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libreria - Préstamos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 py-4 text-white">
        <div class="container mx-auto flex justify-between items-center px-4">
            <a href="{{ route('home') }}" class="text-2xl font-bold">Librería</a>
            <div>
                <a href="{{ route('usuarios.vista') }}" class="mr-4 hover:underline">Usuarios</a>
                <a href="{{ route('libros.vista') }}" class="mr-4 hover:underline">Libros</a>
                <a href="{{ route('prestamos.vista')}}" class="mr-4 hover:underline">Prestamos</a>
                <a href="{{ route('devoluciones.vista')}}" class="mr-4 hover:underline">Devolucion</a>
            </div>
        </div>
    </nav>

    <h1 class="text-3xl font-bold text-center mb-6">Registrar Préstamo</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-4 rounded mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('prestamos.registrar') }}" class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="usuario_id" class="block font-semibold mb-1">Seleccionar Usuario:</label>
            <select name="usuario_id" id="usuario_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Selecciona un usuario --</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="libro_id" class="block font-semibold mb-1">Seleccionar Libro:</label>
            <select name="libro_id" id="libro_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Selecciona un libro --</option>
                @foreach($libros as $libro)
                    <option value="{{ $libro->id }}">{{ $libro->nombre }} - {{ $libro->autor }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Registrar Préstamo</button>
    </form>
</body>
</html>
