<?php
require_once '../models/config.php';
require_once '../models/Empleado.php';
require_once '../models/Administrador.php';

try {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!isset($email) || !isset($password) || empty($email) || empty($password)) {
        throw new Exception("Email o contraseña vacíos.");
    }

    $conn = BaseDatos::conectar();
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        throw new Exception("No se encontró ningún usuario con el email: <strong>$email</strong>");
    }

    $usuario = $resultado->fetch_assoc();

    if (!password_verify($password, $usuario['password'])) {
        throw new Exception("Contraseña incorrecta.");
    }

    $objUsuario = $usuario['rol'] === 'admin'
        ? new Administrador($usuario['id'], $usuario['nombre'], $usuario['email'], $usuario['password'], $usuario['rol'])
        : new Empleado($usuario['id'], $usuario['nombre'], $usuario['email'], $usuario['password'], $usuario['rol']);

    $_SESSION['usuario'] = [
        'nombre' => $objUsuario->getNombre(),
        'email' => $objUsuario->getEmail(),
        'rol' => $objUsuario->getRol()
    ];

    header('Location: ../views/dashboard.php');
    exit;

} catch (Exception $e) {
    new Exception("Error en login: " . $th->getMessage());
} finally {
    $stmt->close();
    $conn->close();
}
