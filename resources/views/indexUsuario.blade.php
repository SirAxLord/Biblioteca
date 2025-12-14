<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería Pro - Gestión de Usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Transición suave para el formulario de edición */
        #editarUsuarioContainer { transition: all 0.3s ease-in-out; }
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
                    <li><a href="{{ route('usuarios.vista') }}" class="block py-2 pl-3 pr-4 text-indigo-600 font-bold rounded hover:text-indigo-600 transition">Usuarios</a></li>
                    <li><a href="{{ route('libros.vista') }}" class="block py-2 pl-3 pr-4 text-slate-600 rounded hover:text-indigo-600 transition">Libros</a></li>
                    <li><a href="{{ route('prestamos.vista') }}" class="block py-2 pl-3 pr-4 text-slate-600 rounded hover:text-indigo-600 transition">Préstamos</a></li>
                    <li><a href="{{ route('devoluciones.vista') }}" class="block py-2 pl-3 pr-4 text-slate-600 rounded hover:text-indigo-600 transition">Devoluciones</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="pt-24 pb-12 px-4 max-w-7xl mx-auto">
        
        @if(session('success'))
            <div class="mb-6 flex items-center p-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200 shadow-sm" role="alert">
                <svg class="shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="font-medium">Éxito:</span> &nbsp; {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8 items-start">
            
            <div class="w-full lg:w-1/3 lg:sticky lg:top-28 space-y-6">
                
                <div class="bg-white p-6 rounded-xl shadow-lg border border-slate-100">
                    <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        Nuevo Miembro
                    </h2>
                    <form method="POST" action="{{ route('usuarios.crear') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Nombre Completo</label>
                            <input type="text" name="nombre" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" placeholder="Ej. Juan Pérez">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Teléfono</label>
                            <input type="tel" name="telefono" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" placeholder="Ej. 444 123 4567">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Dirección</label>
                            <textarea name="direccion" rows="2" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition resize-none" placeholder="Calle, Número, Colonia"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-indigo-600 text-white font-medium py-2.5 rounded-lg hover:bg-indigo-700 shadow-md transition-all duration-200">
                            Registrar Usuario
                        </button>
                    </form>
                </div>

                <div id="editarUsuarioContainer" class="hidden bg-amber-50 p-6 rounded-xl shadow-lg border border-amber-200 relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 text-amber-500 opacity-10">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>

                    <div class="relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-bold text-amber-800">Editar Usuario</h2>
                            <button onclick="cancelarEdicion()" class="text-amber-600 hover:text-amber-800 text-sm underline font-medium">Cancelar</button>
                        </div>

                        <form method="POST" action="" id="formEditar" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="edit_id">
                            
                            <div>
                                <label class="block text-xs font-bold text-amber-700 uppercase tracking-wide mb-1">Nombre</label>
                                <input type="text" name="nombre" id="edit_nombre" required class="w-full px-4 py-2 bg-white border border-amber-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-amber-700 uppercase tracking-wide mb-1">Teléfono</label>
                                <input type="tel" name="telefono" id="edit_telefono" required class="w-full px-4 py-2 bg-white border border-amber-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-amber-700 uppercase tracking-wide mb-1">Dirección</label>
                                <textarea name="direccion" id="edit_direccion" rows="2" required class="w-full px-4 py-2 bg-white border border-amber-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition resize-none"></textarea>
                            </div>
                            
                            <button type="submit" class="w-full bg-amber-600 text-white font-medium py-2.5 rounded-lg hover:bg-amber-700 shadow-md transition-all duration-200">
                                Guardar Cambios
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-2/3">
                <div class="flex justify-between items-end mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900">Directorio de Usuarios</h1>
                        <p class="text-slate-500 mt-1">Administra los miembros registrados en la biblioteca.</p>
                    </div>
                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded border border-blue-200">
                        Total: {{ count($usuarios) }}
                    </span>
                </div>

                <div class="bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-semibold tracking-wider">
                                <tr>
                                    <th class="px-6 py-4 border-b border-slate-200">Usuario</th>
                                    <th class="px-6 py-4 border-b border-slate-200">Datos de Contacto</th>
                                    <th class="px-6 py-4 border-b border-slate-200 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-600">
                                @foreach($usuarios as $usuario)
                                    <tr class="hover:bg-slate-50/80 transition duration-150 group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-linear-to-br from-indigo-100 to-white border border-indigo-100 flex items-center justify-center text-indigo-600 font-bold shadow-sm">
                                                    {{ substr($usuario->nombre, 0, 2) }}
                                                </div>
                                                <div>
                                                    <div class="font-bold text-slate-900">{{ $usuario->nombre }}</div>
                                                    <div class="text-xs text-slate-400">ID Cliente: #{{ $usuario->id }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex flex-col gap-1">
                                                <div class="flex items-center gap-2 text-sm text-slate-700">
                                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                    {{ $usuario->telefono }}
                                                </div>
                                                <div class="flex items-start gap-2 text-sm text-slate-500">
                                                    <svg class="w-4 h-4 text-slate-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                    <span class="truncate max-w-50" title="{{ $usuario->direccion }}">{{Str::limit($usuario->direccion, 30) }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <button onclick="activarEdicion({{ $usuario->id }}, '{{ $usuario->nombre }}', '{{ $usuario->telefono }}', '{{ $usuario->direccion }}')" class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition" title="Editar">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                </button>
                                                
                                                <form method="POST" action="{{ route('usuarios.eliminar', $usuario->id) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('¿Eliminar al usuario {{ $usuario->nombre }}?')" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Eliminar">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                @if($usuarios->isEmpty())
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center text-slate-500">
                                            <div class="flex flex-col items-center">
                                                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mb-3 text-slate-400">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                                </div>
                                                <p>No hay usuarios registrados.</p>
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
        function activarEdicion(id, nombre, telefono, direccion) {
            const container = document.getElementById('editarUsuarioContainer');
            
            // Mostrar y scroll
            container.classList.remove('hidden');
            
            // Poblar campos
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_telefono').value = telefono;
            document.getElementById('edit_direccion').value = direccion;

            // Actualizar ruta del formulario
            document.getElementById('formEditar').action = '/usuarios/actualizar/' + id;

            // Scroll suave (Mejora UX en móviles)
            container.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            // Foco en el nombre
            setTimeout(() => document.getElementById('edit_nombre').focus(), 300);
        }

        function cancelarEdicion() {
            const container = document.getElementById('editarUsuarioContainer');
            container.classList.add('hidden');
            // Limpiar formulario si se desea, aunque no es estrictamente necesario
        }
    </script>
</body>
</html>