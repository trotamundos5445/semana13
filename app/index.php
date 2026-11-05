<?php
// Define el nombre del servicio Compose que funciona como host de MariaDB.
$dbHost = 'db';
// Define el usuario creado por las variables de entorno del servicio db.
$dbUser = 'cloud_user';
// Define la contraseña del usuario de la aplicación.
$dbPassword = 'cloud_pass';
// Define la base de datos que la aplicación consultará.
$dbName = 'cloud';
// Abre una conexión con MariaDB usando el puerto interno estándar.
$connection = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
// Detiene la página con un error legible si la conexión falla.
if ($connection->connect_errno) {
    http_response_code(503);
    exit('La aplicación no pudo conectarse a MariaDB.');
}
// Solicita una consulta real para comprobar que la base de datos responde.
$result = $connection->query('SELECT NOW() AS momento');
// Detiene la página si MariaDB no pudo ejecutar la consulta.
if (!$result) {
    http_response_code(503);
    exit('MariaDB respondió, pero la consulta falló.');
}
// Lee el resultado devuelto por la consulta.
$row = $result->fetch_assoc();
// Cierra la conexión cuando la consulta ya terminó.
$connection->close();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Semana 13 Docker</title>
</head>
<body>
    <h1>Aplicación web conectada</h1>
    <p>La aplicación consultó correctamente a MariaDB.</p>
    <p>Hora entregada por MariaDB: <?= htmlspecialchars($row['momento'], ENT_QUOTES, 'UTF-8') ?></p>
</body>
</html>
