<?php
class BaseDatos
{
    private static $conexion = null;

    public static function conectar()
    {
        try {
            if (self::$conexion === null) {
                self::$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                if (self::$conexion->connect_error) {
                    die('Error de conexión: ' . self::$conexion->connect_error);
                }
            }
            return self::$conexion;
        } catch (\Throwable $th) {
            throw new Exception("Error al conectar a la base de datos: " . $th->getMessage());
        }

    }
}
