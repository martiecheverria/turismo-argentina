<?php

require_once 'config.php';

try {
    // 1. Conexión inicial al servidor MySQL (sin seleccionar la base de datos)
    $pdo = new PDO('mysql:host=' . DB_HOST, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Crear la base de datos si no existe
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "`");
    echo "<p>Base de datos '" . DB_NAME . "' creada o ya existente.</p>";

    // 3. Seleccionar la base de datos recién creada
    $pdo->exec("USE `" . DB_NAME . "`");
    echo "<p>Base de datos '" . DB_NAME . "' seleccionada.</p>";

    // 4. Leer el contenido del archivo .sql
    $sql = file_get_contents('db_turismo.sql');
    if ($sql === false) {
        die("<p>Error: No se pudo leer el archivo 'db_turismo.sql'.</p>");
    }

    // 5. Ejecutar el script SQL completo
    $pdo->exec($sql);

    echo "<h1>¡Instalación completada con éxito!</h1>";
    echo "<p>La base de datos y las tablas se han creado y llenado con datos iniciales.</p>";
    echo '<a href="home">Ir a la página principal</a>';

} catch (PDOException $e) {
    die("<h1>Error de instalación</h1><p>No se pudo completar la instalación. Por favor, revisá tu archivo 'config.php' y asegurate de que el servidor MySQL esté funcionando.</p><pre>" . $e->getMessage() . "</pre>");
}