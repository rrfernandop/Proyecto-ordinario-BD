<?php
include 'db.php'; // conexión

// 1) Traer todas las familias lingüísticas para el dropdown
$sqlFamilias = "SELECT id_familia, nombre_familia FROM familias_linguisticas ORDER BY nombre_familia";
$resFamilias = $conn->query($sqlFamilias);

// 2) Traer todas las regiones para el dropdown
$sqlRegiones = "SELECT id_region, nombre_region FROM regiones ORDER BY nombre_region";
$resRegiones = $conn->query($sqlRegiones);

// 3) Si el método es POST, procesar el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger datos del formulario
    $nombre           = trim($_POST['nombre_lengua']);
    $id_familia       = intval($_POST['id_familia']);
    $id_region        = intval($_POST['id_region']);
    $numero_hablantes = intval($_POST['numero_hablantes']);

    // Construir INSERT (escapando caracteres especiales)
    $sql = "
        INSERT INTO lenguas 
          (nombre_lengua, id_familia, id_region, numero_hablantes)
        VALUES (
          '{$conn->real_escape_string($nombre)}',
          $id_familia,
          $id_region,
          $numero_hablantes
        )
    ";
    if ($conn->query($sql) === TRUE) {
        // Redirigir al listado para ver la nueva lengua
        header("Location: index.php");
        exit();
    } else {
        echo "Error al agregar: " . $conn->error;
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nueva Lengua</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { margin-bottom: 10px; }
        form { max-width: 450px; }
        label { display: block; margin: 8px 0 4px; }
        input[type="text"], input[type="number"], select {
            width: 100%; padding: 6px; box-sizing: border-box;
        }
        button {
            margin-top: 12px; padding: 8px 16px; 
            background-color: #007bff; color: white; border: none; 
            cursor: pointer; border-radius: 4px;
        }
        button:hover { background-color: #0056b3; }
        a { display: inline-block; margin-top: 12px; text-decoration: none; color: #555; }
    </style>
</head>
<body>
    <h2>➕ Agregar Nueva Lengua Indígena</h2>
    <form action="insert.php" method="POST">
        <label for="nombre_lengua">Nombre de la Lengua:</label>
        <input type="text" id="nombre_lengua" name="nombre_lengua" 
               required placeholder="Ej. Zapoteco de la Sierra Norte">

        <label for="id_familia">Familia Lingüística:</label>
        <select id="id_familia" name="id_familia" required>
            <option value="" disabled selected>Selecciona una familia</option>
            <?php while($f = $resFamilias->fetch_assoc()): ?>
                <option value="<?php echo $f['id_familia']; ?>">
                    <?php echo htmlspecialchars($f['nombre_familia'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="id_region">Región de Oaxaca:</label>
        <select id="id_region" name="id_region" required>
            <option value="" disabled selected>Selecciona una región</option>
            <?php while($r = $resRegiones->fetch_assoc()): ?>
                <option value="<?php echo $r['id_region']; ?>">
                    <?php echo htmlspecialchars($r['nombre_region'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="numero_hablantes">Número de Hablantes (aprox.):</label>
        <input type="number" id="numero_hablantes" name="numero_hablantes" 
               required min="0" placeholder="Ej. 60000">

        <button type="submit">Guardar Lengua</button>
    </form>

    <a href="index.php">« Volver a la lista</a>
</body>
</html>