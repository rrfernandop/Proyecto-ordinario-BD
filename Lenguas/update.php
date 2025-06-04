<?php
include 'db.php'; // conexión

// 1) Validar que venga un id_lengua por GET; si no, volver al listado
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}
$id = intval($_GET['id']);

// 2) Traer familias y regiones para poblar los dropdowns (igual que en insert.php)
$sqlFamilias = "SELECT id_familia, nombre_familia FROM familias_linguisticas ORDER BY nombre_familia";
$resFamilias = $conn->query($sqlFamilias);

$sqlRegiones = "SELECT id_region, nombre_region FROM regiones ORDER BY nombre_region";
$resRegiones = $conn->query($sqlRegiones);

// 3) Si es GET, traer los datos actuales de la lengua para mostrar en el formulario
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $sql = "SELECT * FROM lenguas WHERE id_lengua = $id";
    $res = $conn->query($sql);
    if (!$res || $res->num_rows == 0) {
        echo "No se encontró la lengua con ID = $id";
        exit();
    }
    $row = $res->fetch_assoc();
}

// 4) Si el método es POST, actualizar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre           = trim($_POST['nombre_lengua']);
    $id_familia       = intval($_POST['id_familia']);
    $id_region        = intval($_POST['id_region']);
    $numero_hablantes = intval($_POST['numero_hablantes']);

    $sql = "
        UPDATE lenguas SET
          nombre_lengua    = '{$conn->real_escape_string($nombre)}',
          id_familia       = $id_familia,
          id_region        = $id_region,
          numero_hablantes = $numero_hablantes
        WHERE id_lengua = $id
    ";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar: " . $conn->error;
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Lengua</title>
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
            background-color: #ffc107; color: white; border: none; 
            cursor: pointer; border-radius: 4px;
        }
        button:hover { background-color: #e0a800; }
        a { display: inline-block; margin-top: 12px; text-decoration: none; color: #555; }
    </style>
</head>
<body>
    <h2>✏️ Editar Lengua Indígena (ID: <?php echo $id; ?>)</h2>
    <form action="update.php?id=<?php echo $id; ?>" method="POST">
        <label for="nombre_lengua">Nombre de la Lengua:</label>
        <input 
            type="text" 
            id="nombre_lengua" 
            name="nombre_lengua" 
            required 
            value="<?php echo htmlspecialchars($row['nombre_lengua'], ENT_QUOTES, 'UTF-8'); ?>"
        >

        <label for="id_familia">Familia Lingüística:</label>
        <select id="id_familia" name="id_familia" required>
            <?php while($f = $resFamilias->fetch_assoc()): ?>
                <option 
                    value="<?php echo $f['id_familia']; ?>" 
                    <?php echo ($f['id_familia'] == $row['id_familia']) ? 'selected' : ''; ?>
                >
                    <?php echo htmlspecialchars($f['nombre_familia'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="id_region">Región de Oaxaca:</label>
        <select id="id_region" name="id_region" required>
            <?php while($r = $resRegiones->fetch_assoc()): ?>
                <option 
                    value="<?php echo $r['id_region']; ?>" 
                    <?php echo ($r['id_region'] == $row['id_region']) ? 'selected' : ''; ?>
                >
                    <?php echo htmlspecialchars($r['nombre_region'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="numero_hablantes">Número de Hablantes (aprox.):</label>
        <input 
            type="number" 
            id="numero_hablantes" 
            name="numero_hablantes" 
            required 
            min="0" 
            value="<?php echo $row['numero_hablantes']; ?>"
        >

        <button type="submit">Actualizar Lengua</button>
    </form>

    <a href="index.php">« Volver a la lista</a>
</body>
</html>