<?php
require_once '../models/config.php';
require_once '../models/Empleado.php';
require_once '../models/Administrador.php';

try {
    // Verificar si llegaron datos del form
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        throw new Exception("Email o contraseña vacíos.");
    }

    // Conectar a la base
    $db = BaseDatos::conectar();

    // Buscar el usuario
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $db->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        throw new Exception("No se encontró ningún usuario con el email: <strong>$email</strong>");
    }

    $usuario = $resultado->fetch_assoc();

    // Verificar la contraseña
    echo "<p>Contraseña ingresada: <strong>$password</strong></p>";
    echo "<p>Contraseña en la base: <strong>{$usuario['password']}</strong></p>";
    if (!password_verify($password, $usuario['password'])) {
        throw new Exception("la contraseña deberia haber sido: <strong>{$usuario['password']}</strong>");
    }

    // Determinar tipo de usuario (admin o empleado)
    if ($usuario['rol'] === 'admin') {
        $objUsuario = new Administrador($usuario['nombre'], $usuario['email'], $usuario['password'], $usuario['rol']);
    } else {
        $objUsuario = new Empleado($usuario['nombre'], $usuario['email'], $usuario['password'], $usuario['rol']);
    }

    // Guardar en sesión
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
