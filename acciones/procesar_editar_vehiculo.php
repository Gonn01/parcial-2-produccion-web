<?php
require_once '../models/config.php';
require_once '../models/BaseDatos.php';

try {
    if (!isset($_POST['id'], $_POST['marca'], $_POST['modelo'], $_POST['anio'], $_POST['precio'])) {
        throw new Exception("Faltan datos del formulario.");
    }

    $id = intval($_POST['id']);
    $marca = trim($_POST['marca']);
    $modelo = trim($_POST['modelo']);
    $anio = intval($_POST['anio']);
    $precio = floatval($_POST['precio']);

    $conn = BaseDatos::conectar();
    $stmt = $conn->prepare("UPDATE vehiculos SET marca = ?, modelo = ?, anio = ?, precio = ? WHERE id = ?");
    $stmt->bind_param("ssidi", $marca, $modelo, $anio, $precio, $id);

    if (!$stmt->execute()) {
        throw new Exception("Error al actualizar el vehículo.");
    }

    header("Location: ../views/listado_vehiculos.php");
    exit;

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $stmt->close();
    $conn->close();
}
