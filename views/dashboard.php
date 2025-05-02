<?php
require_once '../models/config.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

$nombre = $_SESSION['usuario']['nombre'];
$rol = $_SESSION['usuario']['rol'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard | Agencia de Autos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h2 class="mb-4">Bienvenido, <?= htmlspecialchars($nombre) ?>!</h2>
    <p class="lead">Rol: <strong><?= htmlspecialchars($rol) ?></strong></p>

    <div class="d-grid gap-2 col-6 mx-auto">

        <a href="listado_vehiculos.php" class="btn btn-primary">Ver Vehículos</a>
        <?php if ($rol === 'admin'): ?>
            <a href="listado_usuarios.php" class="btn btn-secondary">Ver Usuarios</a>
        <?php endif; ?>

        <a href="../acciones/logout.php" class="btn btn-danger mt-3">Cerrar sesión</a>
    </div>
</body>

</html>