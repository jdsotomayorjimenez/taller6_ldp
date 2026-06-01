# Taller 6 - Laravel 1 - Introducción

Este taller presenta una introducción práctica a Laravel como framework de desarrollo web en PHP. El objetivo principal fue crear un primer proyecto Laravel, reconocer su estructura de carpetas, ejecutar el servidor local y construir una página básica usando rutas y vistas.

## Tecnologías utilizadas

| Tecnología | Descripción |
|---|---|
| PHP | Lenguaje base sobre el cual funciona Laravel. |
| Composer | Gestor de dependencias usado para instalar Laravel y sus paquetes. |
| Laravel | Framework PHP utilizado para construir la aplicación web. |
| Blade | Motor de plantillas incluido en Laravel para crear vistas. |
| Artisan | Herramienta de línea de comandos incluida en Laravel. |
| Navegador web | Usado para visualizar la aplicación en ejecución. |
| Visual Studio Code | Editor usado para revisar y modificar los archivos del proyecto. |

## Requisitos previos

Antes de crear el proyecto se necesita tener instalado:

- PHP.
- Composer.
- Laravel Installer o la posibilidad de crear el proyecto mediante Composer.
- Node.js y NPM si se van a compilar recursos frontend.

Para verificar algunas instalaciones se pueden usar los siguientes comandos:

```bash
php -v
```

```bash
composer -V
```

```bash
laravel --version
```

## Creación del proyecto

El proyecto puede crearse con el instalador de Laravel:

```bash
laravel new taller6_laravel
```

Después se ingresa a la carpeta del proyecto:

```bash
cd taller6_laravel
```

También se puede crear el proyecto usando Composer:

```bash
composer create-project laravel/laravel taller6_laravel
```

## Ejecución del proyecto

Para ejecutar el servidor de desarrollo se puede usar:

```bash
php artisan serve
```

Luego se abre el navegador en:

```text
http://127.0.0.1:8000
```

En versiones recientes de Laravel también puede usarse el script de desarrollo del proyecto:

```bash
composer run dev
```

Este comando puede iniciar varios servicios necesarios para el entorno de desarrollo, como el servidor de Laravel y herramientas frontend.

## Estructura principal del proyecto

Laravel genera automáticamente una estructura de carpetas organizada. Las carpetas más importantes para este taller son:

| Carpeta o archivo | Descripción |
|---|---|
| `app/` | Contiene el código principal de la aplicación. Aquí se ubican controladores, modelos y otros componentes. |
| `app/Http/Controllers/` | Carpeta donde se guardan los controladores. |
| `routes/` | Contiene los archivos donde se definen las rutas del sistema. |
| `routes/web.php` | Archivo principal para definir rutas web. |
| `resources/views/` | Carpeta donde se guardan las vistas Blade. |
| `public/` | Carpeta pública del proyecto. Contiene el punto de entrada `index.php` y recursos públicos. |
| `database/` | Contiene migraciones, seeders y archivos relacionados con base de datos. |
| `.env` | Archivo de configuración del entorno local. |
| `composer.json` | Archivo donde se registran las dependencias PHP del proyecto. |
| `artisan` | Archivo ejecutable usado para correr comandos de Laravel. |

## Conceptos implementados

### Creación de una ruta básica

Laravel permite definir rutas en el archivo `routes/web.php`. Una ruta indica qué debe responder la aplicación cuando el usuario visita una URL específica.

Ejemplo:

```php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
```

En este caso, cuando el usuario entra a la ruta principal `/`, Laravel devuelve la vista `welcome`.

### Creación de una ruta personalizada

Se puede crear una ruta nueva para mostrar una página propia del taller.

```php
Route::get('/inicio', function () {
    return view('inicio');
});
```

Esta ruta permite acceder a:

```text
http://127.0.0.1:8000/inicio
```

### Creación de una vista Blade

Las vistas se guardan en la carpeta `resources/views/`. Para este taller se puede crear el archivo:

```text
resources/views/inicio.blade.php
```

Contenido de ejemplo:

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller 6 - Laravel 1</title>
</head>
<body>
    <h1>Introducción a Laravel</h1>
    <p>Esta es la primera página creada en el Taller 6.</p>
</body>
</html>
```

### Envío de datos desde la ruta hacia la vista

Laravel permite enviar datos desde una ruta hacia una vista. Esto sirve para separar la lógica del contenido visual.

```php
Route::get('/presentacion', function () {
    $nombre = 'Taller 6';
    $tema = 'Laravel 1 - Introducción';

    return view('presentacion', compact('nombre', 'tema'));
});
```

Vista `resources/views/presentacion.blade.php`:

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $nombre }}</title>
</head>
<body>
    <h1>{{ $nombre }}</h1>
    <p>Tema: {{ $tema }}</p>
</body>
</html>
```

### Uso inicial de Blade

Blade permite insertar variables de PHP dentro del HTML usando doble llave:

```blade
{{ $variable }}
```

También permite estructuras condicionales y repetitivas. Por ejemplo:

```blade
@if($tema)
    <p>El tema del taller es: {{ $tema }}</p>
@endif
```

### Creación de un controlador básico

Aunque las primeras rutas pueden escribirse directamente en `web.php`, Laravel permite organizar mejor la lógica usando controladores.

Para crear un controlador se puede usar Artisan:

```bash
php artisan make:controller PageController
```

Esto genera el archivo:

```text
app/Http/Controllers/PageController.php
```

Ejemplo de controlador:

```php
<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function inicio()
    {
        return view('inicio');
    }
}
```

Luego, en `routes/web.php`, se puede conectar la ruta con el controlador:

```php
use App\Http\Controllers\PageController;

Route::get('/inicio', [PageController::class, 'inicio']);
```

## Flujo básico de una petición en Laravel

El flujo general trabajado en este taller es:

1. El usuario entra a una URL desde el navegador.
2. Laravel revisa las rutas definidas en `routes/web.php`.
3. La ruta ejecuta una función o llama a un controlador.
4. El controlador o la ruta devuelve una vista.
5. La vista Blade genera el HTML que se muestra en el navegador.

Ejemplo aplicado:

```text
Navegador -> /inicio -> routes/web.php -> PageController -> inicio.blade.php -> HTML final
```

## Comandos usados durante el taller

| Comando | Descripción |
|---|---|
| `php -v` | Verifica la versión instalada de PHP. |
| `composer -V` | Verifica la versión instalada de Composer. |
| `laravel new taller6_laravel` | Crea un nuevo proyecto Laravel usando el instalador. |
| `composer create-project laravel/laravel taller6_laravel` | Crea un proyecto Laravel usando Composer. |
| `cd taller6_laravel` | Ingresa a la carpeta del proyecto. |
| `php artisan serve` | Ejecuta el servidor local de Laravel. |
| `php artisan route:list` | Muestra las rutas registradas en el proyecto. |
| `php artisan make:controller PageController` | Crea un controlador. |
| `composer install` | Instala las dependencias PHP del proyecto. |
| `npm install` | Instala dependencias frontend, si el proyecto las necesita. |
| `npm run build` | Compila recursos frontend para producción. |

## Consultas o pruebas usadas para evidencia

En este taller no se usan consultas de Prolog. En su lugar, se usan comandos de terminal y pruebas en el navegador.

```bash
php -v
```

```bash
composer -V
```

```bash
laravel new taller6_laravel
```

```bash
cd taller6_laravel
```

```bash
php artisan serve
```

```bash
php artisan route:list
```

Rutas revisadas en el navegador:

```text
http://127.0.0.1:8000
```

```text
http://127.0.0.1:8000/inicio
```

```text
http://127.0.0.1:8000/presentacion
```

## Capturas de ejecución

### Captura 1 — Verificación de PHP y Composer

![Captura 1](capturas/1.png)

Esta captura muestra la verificación de las herramientas necesarias para trabajar con Laravel. Se ejecutan comandos como `php -v` y `composer -V`.

### Captura 2 — Creación del proyecto Laravel

![Captura 2](capturas/2.png)

Esta captura evidencia la creación del proyecto mediante `laravel new taller6_laravel` o `composer create-project laravel/laravel taller6_laravel`.

### Captura 3 — Estructura de carpetas del proyecto

![Captura 3](capturas/3.png)

Esta captura muestra las carpetas principales generadas por Laravel, como `app/`, `routes/`, `resources/`, `public/`, `database/` y el archivo `artisan`.

### Captura 4 — Ejecución del servidor local

![Captura 4](capturas/4.png)

Esta captura muestra el servidor ejecutándose con `php artisan serve`. Aquí se evidencia que el proyecto queda disponible en una dirección local.

### Captura 5 — Página inicial de Laravel

![Captura 5](capturas/5.png)

Esta captura muestra la página inicial del proyecto Laravel en el navegador.

### Captura 6 — Ruta personalizada `/inicio`

![Captura 6](capturas/6.png)

Esta captura muestra la página creada para el taller usando una ruta personalizada en `routes/web.php`.

### Captura 7 — Vista Blade con datos dinámicos

![Captura 7](capturas/7.png)

Esta captura evidencia el uso de una vista Blade que recibe datos desde la ruta o desde el controlador.

### Captura 8 — Lista de rutas del proyecto

![Captura 8](capturas/8.png)

Esta captura muestra el resultado de `php artisan route:list`, donde se verifican las rutas creadas durante el taller.

## Tabla de archivos creados o modificados

| Archivo | Descripción |
|---|---|
| `routes/web.php` | Archivo donde se definieron las rutas `/`, `/inicio` y `/presentacion`. |
| `resources/views/inicio.blade.php` | Vista creada para mostrar la página principal del taller. |
| `resources/views/presentacion.blade.php` | Vista creada para mostrar datos enviados desde Laravel. |
| `app/Http/Controllers/PageController.php` | Controlador usado para organizar la lógica de la ruta `/inicio`. |
| `.env` | Archivo de configuración local del proyecto. |
| `README.md` | Documentación del Taller 6. |
| `capturas/` | Carpeta con las evidencias gráficas del funcionamiento del proyecto. |

## Tabla de conceptos principales

| Concepto | Explicación |
|---|---|
| Laravel | Framework PHP para construir aplicaciones web. |
| Ruta | Define qué responde la aplicación cuando se visita una URL. |
| Vista | Archivo que contiene el HTML mostrado al usuario. |
| Blade | Motor de plantillas de Laravel. |
| Controlador | Clase que organiza la lógica de una o varias rutas. |
| Artisan | Herramienta de comandos de Laravel. |
| `.env` | Archivo donde se configuran variables del entorno local. |
| `public/index.php` | Punto de entrada de las peticiones web. |
| `composer.json` | Archivo que registra las dependencias del proyecto. |

## Cómo ejecutar el proyecto después de clonar el repositorio

Si otra persona descarga este proyecto desde GitHub, puede ejecutarlo con los siguientes pasos:

```bash
git clone URL_DEL_REPOSITORIO
```

```bash
cd taller6_laravel
```

```bash
composer install
```

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

```bash
php artisan serve
```

Luego debe abrir en el navegador:

```text
http://127.0.0.1:8000
```

Si el proyecto utiliza recursos frontend, también se pueden ejecutar:

```bash
npm install
```

```bash
npm run build
```

## Fuentes de referencia

- Documentación oficial de Laravel - Installation: https://laravel.com/docs/13.x/installation
- Documentación oficial de Laravel - Directory Structure: https://laravel.com/docs/13.x/structure
- Documentación oficial de Laravel - Routing: https://laravel.com/docs/13.x/routing
- Documentación oficial de Laravel - Views: https://laravel.com/docs/13.x/views
- Documentación oficial de Laravel - Controllers: https://laravel.com/docs/13.x/controllers
