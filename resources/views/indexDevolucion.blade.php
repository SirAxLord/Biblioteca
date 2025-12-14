<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería Pro - Gestión de Devoluciones</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    <nav class="fixed w-full z-20 top-0 left-0 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between p-4">
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="p-2 bg-indigo-600 rounded-lg text-white group-hover:bg-indigo-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                <span class="self-center text-xl font-bold whitespace-nowrap text-slate-800 tracking-tight">Librería<span class="text-indigo-600">Pro</span></span>
            </a>
            
            <div class="items-center justify-between hidden w-full md:flex md:w-auto">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">
                    <li><a href="{{ route('usuarios.vista') }}" class="block py-2 pl-3 pr-4 text-slate-600 rounded hover:text-indigo-600 hover:bg-slate-100 md:hover:bg-transparent md:p-0 transition">Usuarios</a></li>
                    <li><a href="{{ route('libros.vista') }}" class="block py-2 pl-3 pr-4 text-slate-600 rounded hover:text-indigo-600 hover:bg-slate-100 md:hover:bg-transparent md:p-0 transition">Libros</a></li>
                    <li><a href="{{ route('prestamos.vista') }}" class="block py-2 pl-3 pr-4 text-slate-600 rounded hover:text-indigo-600 hover:bg-slate-100 md:hover:bg-transparent md:p-0 transition">Préstamos</a></li>
                    <li><a href="{{ route('devoluciones.vista') }}" class="block py-2 pl-3 pr-4 text-indigo-600 font-bold rounded hover:text-indigo-600 md:bg-transparent md:p-0 transition">Devoluciones</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="relative min-h-screen pt-24 px-4 pb-12">
        
        <div class="fixed top-20 left-10 w-72 h-72 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10"></div>
        <div class="fixed bottom-10 right-10 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10"></div>

        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">Control de Préstamos</h1>
                    <p class="text-slate-500 mt-1">Administra las devoluciones y el estado de los libros prestados.</p>
                </div>
                
                </div>

            @if(session('success'))
                <div class="mb-6 flex items-center p-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200 shadow-sm animate-fade-in-down" role="alert">
                    <svg class="shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="font-medium">¡Operación exitosa!</span> &nbsp; {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-slate-600">
                        <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-semibold tracking-wider border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4">Usuario</th>
                                <th class="px-6 py-4">Libro Prestado</th>
                                <th class="px-6 py-4 text-center">Fechas</th>
                                <th class="px-6 py-4 text-center">Estado</th>
                                <th class="px-6 py-4 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($rentas as $renta)
                                <tr class="hover:bg-slate-50/80 transition duration-150 ease-in-out">
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">
                                                {{ substr($renta->usuario->nombre, 0, 2) }} </div>
                                            <div>
                                                <div class="font-bold text-slate-900">{{ $renta->usuario->nombre }}</div>
                                                <div class="text-xs text-slate-400">ID: #{{ $renta->usuario->id }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-800">{{ $renta->libro->nombre }}</div>
                                        <div class="text-xs text-slate-500">ISBN: {{ $renta->libro->ISBN }}</div>
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div class="text-sm">
                                            <span class="block text-xs text-slate-400 uppercase">Salida</span>
                                            <span class="font-mono text-slate-700">{{ $renta->fecha_renta }}</span>
                                        </div>
                                        @if($renta->fecha_devolucion)
                                            <div class="mt-2 text-sm">
                                                <span class="block text-xs text-slate-400 uppercase">Entrada</span>
                                                <span class="font-mono text-green-600">{{ $renta->fecha_devolucion }}</span>
                                            </div>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @if($renta->estado === 'prestado')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                                <span class="w-1.5 h-1.5 mr-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                                Prestado
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                Devuelto
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        @if($renta->estado === 'prestado')
                                            <form method="POST" action="{{ route('devoluciones.marcar', $renta->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="group relative inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white transition-all duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-md hover:shadow-lg">
                                                    <span>Registrar Devolución</span>
                                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                                </button>
                                            </form>
                                        @else
                                            <div class="flex items-center justify-end text-slate-400 gap-1 select-none">
                                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                <span class="text-sm font-medium">Completado</span>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            
                            @if($rentas->isEmpty())
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                                        No hay registros de préstamos actualmente.
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
                </div>
        </div>
    </div>

</body>
</html>