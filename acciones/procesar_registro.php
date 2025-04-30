<?php
require_once '../config.php';

try {
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
        throw new Exception("Acceso denegado.");
    }

    // Validar datos
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $rol = $_POST['rol'] ?? '';

    if (empty($nombre) || empty($email) || empty($password) || empty($rol)) {
        throw new Exception("Faltan campos obligatorios.");
    }

    if (!in_array($rol, ['admin', 'empleado'])) {
        throw new Exception("Rol inválido.");
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $db = BaseDatos::conectar();
    $stmt = $db->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Error al preparar SQL: " . $db->error);
    }

    $stmt->bind_param("ssss", $nombre, $email, $hash, $rol);

    if ($stmt->execute()) {
        header("Location: ../listado/usuarios.php");
    } else {
        throw new Exception("Error al insertar usuario: " . $stmt->error);
    }

} catch (Exception $e) {
    echo "<h3>❌ Error al registrar usuario</h3>";
    echo "<p>{$e->getMessage()}</p>";
    echo "<a href='../forms/registro.php'>Volver al formulario</a>";
}
