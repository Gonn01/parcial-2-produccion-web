<?php
require_once '../models/config.php';
require_once '../models/Vehiculo.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit;
}
$rol = $_SESSION['usuario']['rol'];

$vehiculos = Vehiculo::listar(); // ahora es un array de objetos
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
    <?php if ($rol === 'admin'): ?>
        <a href="alta_vehiculo.php" class="btn btn-success mb-3">Agregar Vehículo</a>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Precio</th>
                <?php if ($rol === 'admin'): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehiculos as $v): ?>
                <tr>
                    <td><?= $v->getMarca() ?></td>
                    <td><?= $v->getModelo() ?></td>
                    <td><?= $v->getAnio() ?></td>
                    <td>$<?= number_format($v->getPrecio(), 2, ',', '.') ?></td>
                    <?php if ($rol === 'admin'): ?>
                        <td>
                            <a href="../acciones/eliminar_vehiculo.php?id=<?= $v->getId() ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Estás seguro de que querés eliminar este vehículo?')">
                                Eliminar
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="dashboard.php" class="btn btn-primary">Volver al Panel</a>
    </div>
</body>

</html>