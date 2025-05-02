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

    $db = BaseDatos::conectar();
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
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

    $objUsuario = $usuario['rol'] === 'admin' ?
        new Administrador($usuario['nombre'], $usuario['email'], $usuario['password'], $usuario['rol'])
        :
        $objUsuario = new Empleado($usuario['nombre'], $usuario['email'], $usuario['password'], $usuario['rol']);

    $_SESSION['usuario'] = [
        'nombre' => $objUsuario->getNombre(),
        'email' => $objUsuario->getEmail(),
        'rol' => $objUsuario->getRol()
    ];

    header('Location: ../views/dashboard.php');

    exit;

} catch (Exception $e) {
    // Mostrar el error
    echo "<h3>❌ Error durante el login</h3>";
    echo "<p>{$e->getMessage()}</p>";
    echo "<p><a href='../index.php'>Volver al login</a></p>";
}
