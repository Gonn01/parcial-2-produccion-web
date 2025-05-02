<?php
require_once '../models/config.php';
require_once '../models/Vehiculo.php';
require_once '../models/BaseDatos.php';

if (!isset($_GET['id'])) {
    die("ID de vehículo no especificado.");
}

$id = intval($_GET['id']);
$conn = BaseDatos::conectar();

$stmt = $conn->prepare("SELECT * FROM vehiculos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("Vehículo no encontrado.");
}

$vehiculo = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Vehículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-5">

    <h2>Editar Vehículo</h2>
    <form action="../acciones/procesar_editar_vehiculo.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($vehiculo['id']) ?>">

        <div class="mb-3">
            <label class="form-label">Marca</label>
            <input type="text" name="marca" class="form-control" value="<?= htmlspecialchars($vehiculo['marca']) ?>"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Modelo</label>
            <input type="text" name="modelo" class="form-control" value="<?= htmlspecialchars($vehiculo['modelo']) ?>"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Año</label>
            <input type="number" name="anio" class="form-control" value="<?= htmlspecialchars($vehiculo['anio']) ?>"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control"
                value="<?= htmlspecialchars($vehiculo['precio']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="../views/listado_vehiculos.php" class="btn btn-secondary">Cancelar</a>
    </form>

</body>

</html>