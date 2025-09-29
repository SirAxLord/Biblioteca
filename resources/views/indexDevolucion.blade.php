<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Librería - Devoluciones</title>
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
        <h1 class="text-3xl font-bold text-center mb-6">Listado de Préstamos</h1>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 rounded mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto max-w-5xl mx-auto mb-16">
            <table class="table-auto w-full bg-white shadow-md rounded">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2">Usuario</th>
                        <th class="px-4 py-2">Libro</th>
                        <th class="px-4 py-2">Fecha Renta</th>
                        <th class="px-4 py-2">Fecha Devolución</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rentas as $renta)
                        <tr class="text-center border-b">
                            <td class="px-4 py-2">{{ $renta->usuario->nombre }}</td>
                            <td class="px-4 py-2">{{ $renta->libro->nombre }}</td>
                            <td class="px-4 py-2">{{ $renta->fecha_renta }}</td>
                            <td class="px-4 py-2">{{ $renta->fecha_devolucion ?? '—' }}</td>
                            <td class="px-4 py-2">{{ ucfirst($renta->estado) }}</td>
                            <td class="px-4 py-2">
                                @if($renta->estado === 'prestado')
                                    <form method="POST" action="{{ route('devoluciones.marcar', $renta->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                            Devolver
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500">Devuelto</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
