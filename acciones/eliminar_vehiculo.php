<?php
require_once '../models/config.php';
require_once '../models/Vehiculo.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    echo "Acceso denegado.";
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID de vehículo no especificado.";
    exit;
}

$id = intval($_GET['id']);
Vehiculo::eliminar($id);

header('Location: ../views/listado_vehiculos.php');
exit;
