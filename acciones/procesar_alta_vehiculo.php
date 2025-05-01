<?php
require_once '../config.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    echo "Acceso denegado.";
    exit;
}

$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$anio = $_POST['anio'];
$precio = $_POST['precio'];

$db = BaseDatos::conectar();
$stmt = $db->prepare("INSERT INTO vehiculos (marca, modelo, anio, precio) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssd", $marca, $modelo, $anio, $precio);

if ($stmt->execute()) {
    header("Location: ../views/listado_vehiculos.php");
} else {
    echo "Error al guardar el vehículo.";
}
