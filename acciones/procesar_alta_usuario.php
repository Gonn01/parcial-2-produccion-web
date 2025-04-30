<?php
require_once '../config.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    echo "Acceso denegado.";
    exit;
}

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$rol = $_POST['rol'];

$db = BaseDatos::conectar();
$stmt = $db->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $email, $password, $rol);

if ($stmt->execute()) {
    header("Location: ../listado/usuarios.php");
} else {
    echo "Error al crear el usuario.";
}
