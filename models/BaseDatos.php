<?php
class BaseDatos {
    private static $conexion = null;

    public static function conectar() {
        if (self::$conexion === null) {
            self::$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (self::$conexion->connect_error) {
                die('Error de conexión: ' . self::$conexion->connect_error);
            }
        }
        return self::$conexion;
    }
}
