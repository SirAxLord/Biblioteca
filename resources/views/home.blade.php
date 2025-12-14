<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Inteligente - Inicio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-indigo-500 selection:text-white">

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
                    <li>
                        <a href="{{ route('usuarios.vista') }}" class="block py-2 pl-3 pr-4 text-slate-600 rounded hover:text-indigo-600 hover:bg-slate-100 md:hover:bg-transparent md:p-0 transition">Usuarios</a>
                    </li>
                    <li>
                        <a href="{{ route('libros.vista') }}" class="block py-2 pl-3 pr-4 text-slate-600 rounded hover:text-indigo-600 hover:bg-slate-100 md:hover:bg-transparent md:p-0 transition">Libros</a>
                    </li>
                    <li>
                        <a href="{{ route('prestamos.vista') }}" class="block py-2 pl-3 pr-4 text-slate-600 rounded hover:text-indigo-600 hover:bg-slate-100 md:hover:bg-transparent md:p-0 transition">Préstamos</a>
                    </li>
                    <li>
                        <a href="{{ route('devoluciones.vista') }}" class="block py-2 pl-3 pr-4 text-slate-600 rounded hover:text-indigo-600 hover:bg-slate-100 md:hover:bg-transparent md:p-0 transition">Devoluciones</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="relative flex flex-col items-center justify-center min-h-screen px-4 overflow-hidden">
        
        <div class="absolute top-0 -left-4 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-4000"></div>

        <div class="relative w-full max-w-2xl text-center z-10">
            <h1 class="text-5xl font-extrabold tracking-tight text-slate-900 mb-2">
                Explora el conocimiento
            </h1>
            <p class="text-lg text-slate-600 mb-8">
                Gestiona, busca y descubre libros en nuestro sistema inteligente.
            </p>

            <div class="bg-white p-2 rounded-2xl shadow-xl border border-slate-100">
                <form method="GET" action="{{ route('libros.buscar') }}" class="relative flex items-center w-full h-14 rounded-xl focus-within:shadow-lg bg-white overflow-hidden transition-shadow">
                    <div class="grid place-items-center h-full w-12 text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <input
                        class="peer h-full w-full outline-none text-sm text-gray-700 pr-2"
                        type="text"
                        name="titulo"
                        id="search"
                        placeholder="Escribe el título del libro..." 
                        required
                        autocomplete="off"
                    />

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-xl mr-2 transition-colors duration-300">
                        Buscar
                    </button>
                </form>
            </div>

            <div class="mt-8 transition-all duration-500 ease-in-out">
                @if(session('libro'))
                    <div class="bg-white rounded-xl shadow-lg border-l-4 border-indigo-500 overflow-hidden hover:shadow-2xl transition-shadow text-left">
                        <div class="p-6 flex items-start gap-4">
                            <div class="w-16 h-24 bg-slate-200 rounded flex items-center justify-center shrink-0">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 19.477 5.754 20 7.5 20s3.332-.477 4.5-1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 19.477 18.247 20 16.5 20a8.96 8.96 0 00-4.5-1.253"></path></svg>
                            </div>
                            
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-xl font-bold text-slate-800">{{ session('libro')->nombre }}</h3>
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded border border-green-400">Disponible</span>
                                </div>
                                <p class="text-slate-500 text-sm mt-1">Autor: <span class="font-medium text-slate-700">{{ session('libro')->autor }}</span></p>
                                <div class="mt-4 flex items-center gap-4 text-sm text-slate-500">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        <span>ISBN: {{ session('libro')->ISBN }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif(session('no_encontrado'))
                    <div class="bg-red-50 border border-red-100 text-red-700 px-6 py-4 rounded-xl shadow-sm flex items-center gap-3" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <span class="font-bold block">Lo sentimos</span>
                            <span class="text-sm">{{ session('no_encontrado') }}</span>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

</body>
</html>