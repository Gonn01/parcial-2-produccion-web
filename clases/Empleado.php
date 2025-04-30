<?php
require_once 'Usuario.php';

class Empleado extends Usuario {
    public static function login($email, $password) {
        $db = BaseDatos::conectar();
        $query = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if($usuario = $resultado->fetch_assoc()) {
            if (password_verify($password, $usuario['password'])) {
                return new Empleado($usuario['nombre'], $usuario['email'], $usuario['password'], $usuario['rol']);
            }
        }
        return null;
    }
}
