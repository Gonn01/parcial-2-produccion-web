<?php
require_once 'Gestionable.php';
require_once 'BaseDatos.php';

class Vehiculo implements Gestionable {
    private $marca;
    private $modelo;
    private $anio;
    private $precio;

    private static $contador = 0;

    public function __construct($marca, $modelo, $anio, $precio) {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->anio = $anio;
        $this->precio = $precio;
        self::$contador++;
    }

    public static function getContador() {
        return self::$contador;
    }

    public function listar() {
        $db = BaseDatos::conectar();
        $result = $db->query("SELECT * FROM vehiculos");
        return $result;
    }
}
