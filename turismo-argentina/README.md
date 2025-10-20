TPE Web 2 - Turismo Argentino

Integrantes
- Martiniano Echeverria - martiecheverria2005@gmail.com
- Camila Fioravanti - camilafioravanti2003@gmail.com


 Tema
_TURISMO EN ARGENTINA_

 Descripción
Desarrollamos un sitio web dinámico que funciona como una guía de los destinos turísticos más destacados de Argentina. El modelo de datos se basa en una relación 1 a N, donde los destinos pertenecen a diferentes regiones geográficas del país.

El sitio permite a cualquier visitante explorar los destinos y filtrarlos por región. Además, cuenta con un panel de administración protegido por contraseña, desde el cual un usuario administrador puede gestionar (agregar, editar y eliminar) tanto los destinos como las regiones.

 Modelo de Datos

 Regiones (Entidad del lado 1)
* `id_region`: Identificador único (Clave Primaria).
* `nombre`: Nombre de la región (ej. "Patagonia").
* `descripcion`: Breve texto descriptivo de la región.
* `imagen_url`: URL de una imagen representativa.

 Destinos (Entidad del lado N)
* `id_destino`: Identificador único (Clave Primaria).
* `id_region_fk`: Clave foránea que lo vincula a una región.
* `nombre`: Nombre del destino turístico (ej. "Glaciar Perito Moreno").
* `descripcion`: Párrafo descriptivo del lugar.
* `imagen_url`: URL de una imagen del destino.

 Usuarios
* `id_usuario`: Identificador único (Clave Primaria).
* `email`: Email del usuario, usado para el login.
* `password`: Contraseña encriptada.
* `rol`: Rol del usuario ('admin' o 'user').


 Usuario Administrador
* **Usuario**: `admin@turismo.com`

* **Contraseña**: `admin`

 Despliegue y Uso

### Requisitos
* Un servidor web local (como XAMPP).
* PHP 8 o superior.
* MySQL / MariaDB.

### Instalación
1.  Clonar o descargar el repositorio en la carpeta `htdocs` de XAMPP.
2.  Asegurarse de que los servicios de Apache y MySQL estén iniciados.
3.  Crear un archivo `config.php` en la raíz del proyecto con las credenciales de su base de datos:
    ```php
    <?php
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'db_turismo');
    define('DB_USER', 'root');
    define('DB_PASS', ''); // Tu contraseña de MySQL
    ?>
    ```
4.  Navegar a `http://localhost/turismo-argentina/` en su navegador. La aplicación detectará que la base de datos no existe y lo redirigirá al instalador.
5.  El script de instalación (`install.php`) creará la base de datos `db_turismo`, las tablas, y cargará los datos iniciales automáticamente.

### Usuario Administrador
* **Usuario**: `webadmin
