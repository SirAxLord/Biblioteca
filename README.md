# Biblioteca (Laravel)

Aplicación web sencilla para gestionar una biblioteca: usuarios, libros, préstamos y devoluciones. Construida con Laravel 12, TailwindCSS y Vite.

## Requisitos
- PHP `^8.2`
- Composer
- Node.js `>=18`
- Extensiones de PHP recomendadas por Laravel (pdo, mbstring, openssl, etc.)
- Base de datos (MySQL/PostgreSQL) o SQLite

## Configuración rápida
1. Instalar dependencias de PHP y JS:
   ```powershell
   composer install
   npm install
   ```
2. Copiar y configurar `.env`:
   ```powershell
   copy .env.example .env
   ```
   - Ajusta `APP_KEY`, `DB_CONNECTION`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
   - Para SQLite, crea `database\database.sqlite` y usa `DB_CONNECTION=sqlite`.
3. Generar clave y ejecutar migraciones:
   ```powershell
   php artisan key:generate
   php artisan migrate
   ```
4. Levantar el servidor de desarrollo:
   ```powershell
   php artisan serve
   npm run dev
   ```
   - Alternativa integrada (si tienes `npx`):
     ```powershell
     composer run dev
     ```

## Estructura principal
- `routes/web.php`: rutas HTTP para vistas y acciones CRUD.
- `app/Http/Controllers/`: lógica de controladores (`usuarioController`, `libroController`, `RentaController`).
- `app/Models/`: modelos Eloquent (`Usuario`, `Libros`, `Renta`).
- `database/migrations/`: tablas de usuarios, libros y rentas.
- `resources/views/`: vistas Blade con Tailwind (`home`, `indexUsuario`, `indexLibros`, `indexPrestamos`, `indexDevolucion`).

## Funcionalidades
- Usuarios
  - Crear, listar, editar, eliminar.
- Libros
  - Crear, listar, editar, eliminar.
  - Buscar por título desde `home`.
- Préstamos
  - Registrar préstamo seleccionando usuario y libro.
- Devoluciones
  - Listar rentas y marcar como devuelto.

## Rutas principales
- `GET /` → `home` (búsqueda de libros).
- Usuarios:
  - `GET /usuarios` → vista listado/crear.
  - `POST /usuarios/crear`
  - `PUT /usuarios/actualizar/{id}`
  - `DELETE /usuarios/eliminar/{id}`
- Libros:
  - `GET /libros` → vista listado/crear.
  - `POST /libros/crear`
  - `PUT /libros/actualizar/{id}`
  - `DELETE /libros/eliminar/{id}`
  - `GET /buscar-libro?titulo=...` → búsqueda y feedback en `home`.
- Préstamos:
  - `GET /prestamos` → formulario registrar.
  - `POST /prestamos/registrar`
- Devoluciones:
  - `GET /devoluciones` → listado de rentas.
  - `PUT /devoluciones/{id}` → marcar devuelto.

## Modelos y relaciones
- `Usuario`
  - Tabla: `usuarios`
  - Fillable: `nombre`, `telefono`, `direccion`
  - Relación: `hasMany(Renta)`
- `Libros`
  - Tabla: `libros`
  - Fillable: `nombre`, `ISBN`, `autor`
  - Relación: `hasMany(Renta, 'libro_id')`
- `Renta`
  - Tabla: `rentas`
  - Fillable: `usuario_id`, `libro_id`, `fecha_renta`, `fecha_devolucion`, `estado`
  - Relaciones: `belongsTo(Usuario)`, `belongsTo(Libros, 'libro_id')`

## Migraciones
- `usuarios`: `id`, timestamps, `nombre` (string), `telefono` (unsigned big integer), `direccion` (string).
- `libros`: `id`, timestamps, `nombre` (string), `ISBN` (string, nullable), `autor` (string).
- `rentas`: `id`, timestamps, `usuario_id` (FK `usuarios`), `libro_id` (FK `libros`), `fecha_renta` (date), `fecha_devolucion` (date, nullable), `estado` (string, default `prestado`).

## Vistas
- `home.blade.php`: navegación y formulario de búsqueda; muestra resultado del libro si existe.
- `indexUsuario.blade.php`: CRUD de usuarios con formularios y tabla.
- `indexLibros.blade.php`: CRUD de libros y edición inline.
- `indexPrestamos.blade.php`: formulario para registrar préstamo.
- `indexDevolucion.blade.php`: tabla de rentas y acción de devolución.

## Desarrollo Frontend
- Vite (`vite.config.js`) y TailwindCSS via CDN en vistas.
- `npm run dev` inicia Vite; `npm run build` compila assets.

## Pruebas
- Ejecutar tests:
  ```powershell
  php artisan test
  ```

## Notas y posibles mejoras
- Campo `ISBN`:
  - Migración y vistas usan `ISBN` (mayúsculas), pero en `libroController` se valida `isbn` y la regla `unique:libros,isbn`. Recomendada alineación:
    - Cambiar a `ISBN` en validación/reglas, o renombrar columna a `isbn` en migración/modelo.
- `Renta::belongsTo(Usuario)` usa clave foránea por convención (`usuario_id`); puede explicitar `belongsTo(Usuario::class, 'usuario_id')` para claridad.
- Manejo de errores/respuestas: actualmente se redirige con flash messages; puede añadirse API JSON.
- Validaciones adicionales: evitar préstamo de libro con `estado` prestado, etc.

## Licencia
MIT (según `composer.json`).
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
