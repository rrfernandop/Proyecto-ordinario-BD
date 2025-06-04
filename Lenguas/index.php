<?php
include 'db.php'; // incluimos la conexión

// 1) Consultar todas las lenguas, junto con familia y región para mostrarlas en la tabla
$sql = "
    SELECT 
      l.id_lengua, 
      l.nombre_lengua, 
      f.nombre_familia, 
      r.nombre_region, 
      l.numero_hablantes
    FROM lenguas AS l
    JOIN familias_linguisticas AS f ON l.id_familia = f.id_familia
    JOIN regiones AS r ON l.id_region = r.id_region
    ORDER BY l.id_lengua
";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lenguas Indígenas de Oaxaca</title>
    <style>
        /* Estilos básicos para que se vea decente */
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { margin-bottom: 15px; }
        table { border-collapse: collapse; width: 100%; max-width: 900px; }
        th, td { border: 1px solid #666; padding: 8px 12px; text-align: left; }
        th { background-color: #eee; }
        a.button {
            display: inline-block;
            padding: 6px 12px;
            margin: 10px 0;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a.button:hover { background-color: #218838; }
        .actions a {
            margin-right: 8px;
            text-decoration: none;
            color: #007bff;
        }
        .actions a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>🗺️ Lenguas Indígenas de Oaxaca</h1>

    <!-- Botón para agregar nueva lengua -->
    <a href="insert.php" class="button">➕ Agregar Nueva Lengua</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Familia</th>
            <th>Región</th>
            <th>Hablantes</th>
            <th>Acciones</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_lengua']; ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_lengua'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_familia'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_region'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo $row['numero_hablantes']; ?></td>
                    <td class="actions">
                        <!-- Editar y Eliminar -->
                        <a href="update.php?id=<?php echo $row['id_lengua']; ?>">✏️ Editar</a>
                        <a href="delete.php?id=<?php echo $row['id_lengua']; ?>" 
                           onclick="return confirm('¿Seguro que deseas eliminar esta lengua?');">
                           🗑️ Eliminar
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center;">No hay registros aún.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>