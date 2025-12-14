<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería Pro - Registrar Préstamo</title>
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
                    <li><a href="{{ route('usuarios.vista') }}" class="block py-2 pl-3 pr-4 text-slate-600 rounded hover:text-indigo-600 transition">Usuarios</a></li>
                    <li><a href="{{ route('libros.vista') }}" class="block py-2 pl-3 pr-4 text-slate-600 rounded hover:text-indigo-600 transition">Libros</a></li>
                    <li><a href="{{ route('prestamos.vista') }}" class="block py-2 pl-3 pr-4 text-indigo-600 font-bold rounded hover:text-indigo-600 transition">Préstamos</a></li>
                    <li><a href="{{ route('devoluciones.vista') }}" class="block py-2 pl-3 pr-4 text-slate-600 rounded hover:text-indigo-600 transition">Devoluciones</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="relative min-h-screen flex items-center justify-center px-4 pt-16">
        
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse animation-delay-2000"></div>

        <div class="w-full max-w-lg relative z-10">
            
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-slate-900">Nuevo Préstamo</h1>
                <p class="text-slate-500 mt-2">Registra la salida de un libro a un usuario.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative shadow-sm flex items-center" role="alert">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white p-8 rounded-2xl shadow-xl border border-slate-100">
                <form method="POST" action="{{ route('prestamos.registrar') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="usuario_id" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            ¿Quién solicita el libro?
                        </label>
                        <div class="relative">
                            <select name="usuario_id" id="usuario_id" class="w-full appearance-none bg-slate-50 border border-slate-300 text-slate-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition cursor-pointer" required>
                                <option value="" disabled selected>-- Selecciona un usuario --</option>
                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }} (ID: {{ $usuario->id }})</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-500">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="libro_id" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 19.477 5.754 20 7.5 20s3.332-.477 4.5-1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 19.477 18.247 20 16.5 20a8.96 8.96 0 00-4.5-1.253"></path></svg>
                            ¿Qué libro se llevará?
                        </label>
                        <div class="relative">
                            <select name="libro_id" id="libro_id" class="w-full appearance-none bg-slate-50 border border-slate-300 text-slate-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition cursor-pointer" required>
                                <option value="" disabled selected>-- Selecciona un libro --</option>
                                @foreach($libros as $libro)
                                    <option value="{{ $libro->id }}">{{ $libro->nombre }} - {{ $libro->autor }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-500">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        <p class="text-xs text-slate-400 mt-1">Asegúrate de que el libro esté disponible físicamente.</p>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                        <span>Confirmar Préstamo</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>