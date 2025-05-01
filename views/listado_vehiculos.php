<?php
require_once '../models/config.php';
require_once '../models/Vehiculo.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit;
}
$rol = $_SESSION['usuario']['rol'];

$vehiculo = new Vehiculo("", "", 0, 0);
$resultado = $vehiculo->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Vehículos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Listado de Vehículos</h2>
        <?php if ($rol === 'admin') : ?>
            <a href="alta_vehiculo.php" class="btn btn-success mb-3">Agregar Vehículo</a>
        <?php endif; ?>
    

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['marca'] ?></td>
                <td><?= $row['modelo'] ?></td>
                <td><?= $row['anio'] ?></td>
                <td>$<?= number_format($row['precio'], 2, ',', '.') ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table><div class="text-center mt-4">
  <a href="dashboard.php" class="btn btn-primary">Volver al Panel</a>
</div>

</body>
</html>
