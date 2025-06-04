<?php
// db.php: conexión a MySQL (ajusta usuario/contraseña/BD si es necesario)
$servername = "localhost";
$username   = "root";
$password   = "Root";
$dbname     = "lenguas_oaxaca";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión falló
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
// Si llegamos aquí, la conexión fue exitosa y $conn está listo para consultas.
?>