<?php
require_once '../models/config.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    echo "Acceso denegado.";
    exit;
}

$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$anio = $_POST['anio'];
$precio = $_POST['precio'];

try {
    $conn = BaseDatos::conectar();
    $stmt = $conn->prepare("INSERT INTO vehiculos (marca, modelo, anio, precio) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $marca, $modelo, $anio, $precio);
    $stmt->execute();
    header("Location: ../views/listado_vehiculos.php");
} catch (Throwable $th) {
    new Exception("Error al dar de alta un vehiculo: " . $th->getMessage());
} finally {
    $stmt->close();
    $conn->close();
}
