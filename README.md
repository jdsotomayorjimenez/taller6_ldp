# Taller 6 - Laravel con MariaDB y Bootstrap

## Objetivo

Implementar una aplicación básica en Laravel conectada a una base de datos MariaDB administrada desde XAMPP/phpMyAdmin.  
El proyecto permite consultar registros de la tabla `proyectos` y mostrarlos en una vista Blade usando Bootstrap.

---

## Capturas de evidencia

### Captura 1 — Modelo `Proyectos`

![Captura 1](capturas/1.png)

Se muestra el modelo `Proyectos.php`, ubicado en `app/Models/`.  
Este modelo representa la tabla `proyectos` y define los campos permitidos para asignación masiva: `nombre` y `descripcion`.

---

### Captura 2 — Controlador `ProyectosController`

![Captura 2](capturas/2.png)

Se muestra el controlador `ProyectosController.php`, ubicado en `app/Http/Controllers/`.  
En el método `index()` se obtienen los datos de la tabla `proyectos` y se envían a la vista `projects.index`.

---

### Captura 3 — Base de datos `prueba`

![Captura 3](capturas/3.png)

Se muestra phpMyAdmin con la base de datos `prueba` creada.  
Esta base de datos es la que se conecta con Laravel mediante el archivo `.env`.

---

### Captura 4 — Tablas generadas por migraciones

![Captura 4](capturas/4.png)

Se muestran las tablas creadas dentro de la base `prueba`.  
Entre ellas aparece la tabla `proyectos`, generada mediante una migración de Laravel.

---

### Captura 5 — Inserción de datos desde phpMyAdmin

![Captura 5](capturas/5.png)

Se muestra la inserción de registros en la tabla `proyectos` usando una consulta SQL en phpMyAdmin.

---

### Captura 6 — Vista Blade con Bootstrap

![Captura 6](capturas/6.png)

Se muestra el archivo `resources/views/projects/index.blade.php`.  
En esta vista se usa Bootstrap y se recorre la variable `$proyectos` con `@foreach` para mostrar los datos en una tabla HTML.

---

### Captura 7 — Resultado final en el navegador

![Captura 7](capturas/7.png)

Se muestra la ruta `/projects` ejecutándose en el navegador.  
La tabla presenta los registros insertados en la base de datos `prueba`.

---

## Tecnologías utilizadas

| Tecnología | Uso |
|---|---|
| Laravel | Framework PHP usado para crear la aplicación web. |
| PHP | Lenguaje base del proyecto. |
| Composer | Gestor de dependencias de Laravel. |
| MariaDB | Base de datos utilizada por medio de XAMPP. |
| phpMyAdmin | Herramienta web para administrar la base de datos. |
| Blade | Motor de plantillas de Laravel. |
| Bootstrap 5.3 | Framework CSS usado para dar formato a la tabla. |
| Artisan | Herramienta de comandos de Laravel. |

---

## Archivos principales del proyecto

| Archivo | Función |
|---|---|
| `app/Models/Proyectos.php` | Modelo que representa los registros de la tabla `proyectos`. |
| `app/Http/Controllers/ProyectosController.php` | Controlador que obtiene los datos desde la base y los envía a la vista. |
| `database/migrations/2026_05_28_213751_create_proyectos_table.php` | Migración que crea la tabla `proyectos`. |
| `resources/views/projects/index.blade.php` | Vista Blade que muestra los proyectos en una tabla con Bootstrap. |
| `routes/web.php` | Archivo donde se define la ruta recurso `projects`. |
| `.env` | Archivo local donde se configura la conexión con MariaDB. |

---

## Configuración de la base de datos

En el archivo `.env`, la conexión debe apuntar a la base `prueba`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=prueba
DB_USERNAME=root
DB_PASSWORD=
```

La base `prueba` debe estar creada previamente en phpMyAdmin.

---

## Migración de la tabla `proyectos`

La tabla `proyectos` se crea con la migración:

```php
Schema::create('proyectos', function (Blueprint $table) {
    $table->id();
    $table->string('nombre', 100);
    $table->text('descripcion');
    $table->timestamps();
});
```

Para ejecutar la migración:

```bash
php artisan migrate
```

---

## Inserción de datos de prueba

Los datos se pueden insertar desde phpMyAdmin con una consulta SQL como esta:

```sql
INSERT INTO proyectos (nombre, descripcion, created_at, updated_at)
VALUES
('Proyecto de prueba', 'Este dato fue insertado desde phpMyAdmin para probar Laravel.', NOW(), NOW()),
('Proyecto de prueba 2', 'Este dato fue insertado desde phpMyAdmin para probar Laravel.', NOW(), NOW());
```

---

## Ruta principal usada

En `routes/web.php` se define la ruta recurso:

```php
Route::resource("projects", ProyectosController::class);
```

La ruta usada para visualizar los datos es:

```text
http://127.0.0.1:8000/projects
```

---

## Funcionamiento del controlador

En `ProyectosController.php`, el método `index()` obtiene los registros de la tabla `proyectos`:

```php
public function index()
{
    $proyectos = DB::table('proyectos')->get();

    return view("projects.index", ['proyectos' => $proyectos]);
}
```

Esto permite enviar los datos desde Laravel hacia la vista Blade.

---

## Vista con Bootstrap

En `resources/views/projects/index.blade.php` se carga Bootstrap mediante CDN:

```html
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
```

Luego se muestra la información en una tabla:

```blade
@foreach($proyectos as $proyecto)
    <tr>
        <th scope="row">{{ $proyecto->id }}</th>
        <td>{{ $proyecto->nombre }}</td>
        <td>{{ $proyecto->descripcion }}</td>
        <td>{{ $proyecto->created_at }}</td>
    </tr>
@endforeach
```

---

## Comandos usados

```bash
php artisan migrate
```

```bash
php artisan serve
```

Si se necesita limpiar la configuración cacheada:

```bash
php artisan config:clear
php artisan cache:clear
```

---

## Ejecución del proyecto

Para ejecutar el proyecto localmente:

```bash
php artisan serve
```

Luego se abre en el navegador:

```text
http://127.0.0.1:8000/projects
```

---

## Estructura recomendada para GitHub

```text
taller6-laravel/
├── README.md
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── ProyectosController.php
│   └── Models/
│       └── Proyectos.php
├── database/
│   └── migrations/
│       └── 2026_05_28_213751_create_proyectos_table.php
├── resources/
│   └── views/
│       └── projects/
│           └── index.blade.php
├── routes/
│   └── web.php
├── capturas/
│   ├── 1.png
│   ├── 2.png
│   ├── 3.png
│   ├── 4.png
│   ├── 5.png
│   ├── 6.png
│   └── 7.png
├── .env.example
├── .gitignore
├── artisan
├── composer.json
├── composer.lock
├── package.json
└── vite.config.js
```

No se deben subir a GitHub:

```text
.env
vendor/
node_modules/
storage/logs/*.log
bootstrap/cache/*.php
```

---

## Conclusión

En este taller se creó una aplicación básica en Laravel conectada a una base de datos MariaDB mediante XAMPP.  
Se creó la tabla `proyectos`, se insertaron registros desde phpMyAdmin y se mostraron en una vista Blade usando Bootstrap.
