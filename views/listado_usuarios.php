<?php
require_once '../models/config.php';
require_once '../models/Administrador.php';
require_once '../models/UsuarioRepository.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    echo "Acceso denegado.";
    exit;
}

$rol = $_SESSION['usuario']['rol'];
$email = $_SESSION['usuario']['email'];
$usuarios = [];

try {
    $usuarios = RepositorioUsuario::listar();
} catch (\Throwable $th) {
    echo "Error al listar usuarios: " . $th->getMessage();
}
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
    <?php if ($rol === 'admin'): ?>
        <a href="../views/alta_usuario.php" class="btn btn-success mb-3">Crear nuevo usuario</a>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <?php if ($rol === 'admin'): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u->getNombre()) ?></td>
                    <td><?= htmlspecialchars($u->getEmail()) ?></td>
                    <td><?= $u instanceof Administrador ? 'administrador' : 'Empleado' ?></td>
                    <?php if ($rol === 'admin' && $email !== $u->getEmail()): ?>
                        <td>
                            <a href="../acciones/eliminar_usuario.php?id=<?= $u->getId() ?>" class="btn btn-danger btn-sm">
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