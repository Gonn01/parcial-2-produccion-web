<?php
require_once '../models/config.php';
require_once '../models/Usuario.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    echo "Acceso denegado.";
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID del usuario no especificado.";
    exit;
}

$id = intval($_GET['id']);
Usuario::eliminar($id);

header('Location: ../views/listado_usuarios.php');
exit;
