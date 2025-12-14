<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería Pro - Gestión de Libros</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Animación suave para la aparición del editor */
        #editarLibroContainer { transition: all 0.3s ease-in-out; }
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
                    <li><a href="{{ route('libros.vista') }}" class="block py-2 pl-3 pr-4 text-indigo-600 font-bold rounded hover:text-indigo-600 transition">Libros</a></li>
                    <li><a href="{{ route('prestamos.vista') }}" class="block py-2 pl-3 pr-4 text-slate-600 rounded hover:text-indigo-600 transition">Préstamos</a></li>
                    <li><a href="{{ route('devoluciones.vista') }}" class="block py-2 pl-3 pr-4 text-slate-600 rounded hover:text-indigo-600 transition">Devoluciones</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="pt-24 pb-12 px-4 max-w-7xl mx-auto">
        
        <div class="flex flex-col md:flex-row gap-8 items-start">
            
            <div class="w-full md:w-1/3 md:sticky md:top-28 space-y-6">
                
                <div class="bg-white p-6 rounded-xl shadow-lg border border-slate-100">
                    <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Registrar Nuevo Libro
                    </h2>
                    <form method="POST" action="{{ route('libros.crear') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-slate-700 mb-1">Título del Libro</label>
                            <input type="text" id="nombre" name="nombre" required placeholder="Ej. El Quijote" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                        </div>
                        <div>
                            <label for="autor" class="block text-sm font-medium text-slate-700 mb-1">Autor</label>
                            <input type="text" id="autor" name="autor" required placeholder="Ej. Miguel de Cervantes" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                        </div>
                        <div>
                            <label for="isbn" class="block text-sm font-medium text-slate-700 mb-1">ISBN</label>
                            <input type="text" id="isbn" name="isbn" required placeholder="978-3-16-148410-0" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition font-mono text-sm">
                        </div>
                        <button type="submit" class="w-full bg-indigo-600 text-white font-medium py-2.5 rounded-lg hover:bg-indigo-700 shadow-md hover:shadow-lg transition-all duration-200">
                            Guardar Libro
                        </button>
                    </form>
                </div>

                <div id="editarLibroContainer" class="hidden bg-amber-50 p-6 rounded-xl shadow-lg border border-amber-200 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10">
                        <svg class="w-24 h-24 text-amber-500" fill="currentColor" viewBox="0 0 24 24"><path d="M14.06,9.02l0.92-0.92c0.59-0.59,0.59-1.54,0-2.12l-1.88-1.88c-0.59-0.59-1.54-0.59-2.12,0l-0.92,0.92L14.06,9.02z M13.13,9.94l-8.79,8.79c-0.13,0.13-0.2,0.29-0.23,0.47l-0.5,2.5c-0.06,0.28,0.19,0.53,0.47,0.47l2.5-0.5c0.18-0.03,0.34-0.1,0.47-0.23l8.79-8.79L13.13,9.94z"></path></svg>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-bold text-amber-800">Editando Libro</h2>
                            <button onclick="cancelarEdicion()" class="text-amber-600 hover:text-amber-800 text-sm underline">Cancelar</button>
                        </div>

                        <form method="POST" action="" id="formEditarLibro" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="edit_libro_id">
                            
                            <div>
                                <label class="block text-xs font-bold text-amber-700 uppercase tracking-wide mb-1">Título</label>
                                <input type="text" name="nombre" id="edit_nombre" required class="w-full px-4 py-2 bg-white border border-amber-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-amber-700 uppercase tracking-wide mb-1">Autor</label>
                                <input type="text" name="autor" id="edit_autor" required class="w-full px-4 py-2 bg-white border border-amber-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-amber-700 uppercase tracking-wide mb-1">ISBN</label>
                                <input type="text" name="isbn" id="edit_isbn" required class="w-full px-4 py-2 bg-white border border-amber-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition font-mono text-sm">
                            </div>
                            
                            <button type="submit" class="w-full bg-amber-600 text-white font-medium py-2.5 rounded-lg hover:bg-amber-700 shadow-md transition-all duration-200">
                                Actualizar Información
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <div class="w-full md:w-2/3">
                <div class="flex justify-between items-end mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900">Catálogo</h1>
                        <p class="text-slate-500 mt-1">Administra la colección de libros disponibles.</p>
                    </div>
                    <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded border border-indigo-200">
                        Total: {{ count($libros) }} libros
                    </span>
                </div>

                <div class="bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-semibold tracking-wider">
                                <tr>
                                    <th class="px-6 py-4 border-b border-slate-200">Libro</th>
                                    <th class="px-6 py-4 border-b border-slate-200 text-center">ISBN</th>
                                    <th class="px-6 py-4 border-b border-slate-200 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-600">
                                @foreach($libros as $libro)
                                    <tr class="hover:bg-slate-50/80 transition duration-150 group">
                                        <td class="px-6 py-4 align-top">
                                            <div class="flex gap-4">
                                                <div class="w-12 h-16 bg-slate-200 rounded flex items-center justify-center shrink-0 shadow-sm group-hover:shadow-md transition">
                                                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 19.477 5.754 20 7.5 20s3.332-.477 4.5-1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 19.477 18.247 20 16.5 20a8.96 8.96 0 00-4.5-1.253"></path></svg>
                                                </div>
                                                <div>
                                                    <div class="font-bold text-slate-900 text-lg leading-tight">{{ $libro->nombre }}</div>
                                                    <div class="text-sm text-slate-500 mt-1">Autor: <span class="font-medium text-slate-700">{{ $libro->autor }}</span></div>
                                                    <div class="text-xs text-slate-400 mt-1">ID Ref: #{{ $libro->id }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 align-middle text-center">
                                            <span class="font-mono text-sm bg-slate-100 px-2 py-1 rounded text-slate-600 border border-slate-200">
                                                {{ $libro->ISBN }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 align-middle text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <button onclick="activarEdicionLibro({{ $libro->id }}, '{{ $libro->nombre }}', '{{ $libro->ISBN }}', '{{ $libro->autor }}')" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition" title="Editar">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </button>
                                                
                                                <form method="POST" action="{{ route('libros.eliminar', $libro->id) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar el libro: {{ $libro->nombre }}?')" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Eliminar">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                @if($libros->isEmpty())
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center text-slate-500">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 19.477 5.754 20 7.5 20s3.332-.477 4.5-1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 19.477 18.247 20 16.5 20a8.96 8.96 0 00-4.5-1.253"></path></svg>
                                                <p>No hay libros registrados aún.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function activarEdicionLibro(id, nombre, isbn, autor) {
            const container = document.getElementById('editarLibroContainer');
            
            // Mostrar contenedor
            container.classList.remove('hidden');
            
            // Llenar datos
            document.getElementById('edit_libro_id').value = id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_isbn').value = isbn;
            document.getElementById('edit_autor').value = autor;

            // Actualizar action del form
            document.getElementById('formEditarLibro').action = '/libros/actualizar/' + id;

            // Scroll suave hacia el formulario de edición para mejor UX en móviles
            container.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            // Focus en el primer campo
            setTimeout(() => document.getElementById('edit_nombre').focus(), 500);
        }

        function cancelarEdicion() {
            const container = document.getElementById('editarLibroContainer');
            container.classList.add('hidden');
        }
    </script>
</body>
</html>