<?php
require_once './models/config.php';

if (isset($_SESSION['usuario'])) {
    header('Location: ../views/listado_vehiculos.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | Agencia de Autos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="min-width: 350px;">
        <h3 class="mb-4 text-center">Iniciar sesión</h3>

        <form action="acciones/procesar_login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>
    </div>

</body>
</html>
