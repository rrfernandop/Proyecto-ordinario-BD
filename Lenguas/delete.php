<?php
include 'db.php'; // conexión

// 1) Validar que venga id_lengua por GET; si no, redirigimos
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}
$id = intval($_GET['id']);

// 2) Comprobar (opcional) que ese ID exista
$checkSql = "SELECT id_lengua FROM lenguas WHERE id_lengua = $id";
$checkRes = $conn->query($checkSql);
if (!$checkRes || $checkRes->num_rows == 0) {
    echo "No se encontró la lengua con ID = $id.";
    exit();
}

// 3) Ejecutar el DELETE
$sql = "DELETE FROM lenguas WHERE id_lengua = $id";
if ($conn->query($sql) === TRUE) {
    // Redirigir al listado si se borró bien
    header("Location: index.php");
    exit();
} else {
    echo "Error al eliminar: " . $conn->error;
    exit();
}
?>