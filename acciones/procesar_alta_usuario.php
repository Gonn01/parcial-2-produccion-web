<?php
require_once '../models/config.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    echo "Acceso denegado.";
    exit;
}

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$rol = $_POST['rol'];

try {
    $conn = BaseDatos::conectar();
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $email, $password, $rol);
    $stmt->execute();
    header("Location: ../views/listado_usuarios.php");
} catch (Throwable $th) {
    new Exception("Error al dar de alta un usuario: " . $th->getMessage());
} finally {
    $stmt->close();
    $conn->close();
}
