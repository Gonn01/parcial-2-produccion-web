<?php
require_once '../config.php';

try {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($nombre) || empty($email) || empty($password)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Validar que el email no esté registrado
    $db = BaseDatos::conectar();
    $stmt = $db->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        throw new Exception("Ya existe un usuario con ese correo.");
    }

    // Insertar nuevo usuario con rol fijo "empleado"
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, 'admin')");
    $stmt->bind_param("sss", $nombre, $email, $hash);

    if ($stmt->execute()) {
        echo "<h3>✅ Usuario registrado correctamente</h3>";
        echo "<a href='../index.php'>Iniciar sesión</a>";
    } else {
        throw new Exception("Error al registrar: " . $stmt->error);
    }

} catch (Exception $e) {
    echo "<h3>❌ Error</h3>";
    echo "<p>{$e->getMessage()}</p>";
    echo "<a href='registro.php'>Volver</a>";
}
