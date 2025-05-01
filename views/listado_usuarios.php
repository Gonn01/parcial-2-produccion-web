<?php
require_once '../models/config.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    echo "Acceso denegado.";
    exit;
}
$rol = $_SESSION['usuario']['rol'];
$db = BaseDatos::conectar();
$result = $db->query("SELECT nombre, email, rol FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Usuarios Registrados</h2>
        <?php if ($rol === 'admin') : ?>
            <a href="../views/alta_usuario.php" class="btn btn-success mb-3">Crear nuevo usuario</a>
        <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['nombre'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= ucfirst($row['rol']) ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="text-center mt-4">
  <a href="dashboard.php" class="btn btn-primary">Volver al Panel</a>
</div>

</body>
</html>
