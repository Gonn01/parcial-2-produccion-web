<?php
require_once 'Autenticable.php';
require_once 'BaseDatos.php';

abstract class Usuario implements Autenticable {
    protected $id;
    protected $nombre;
    protected $email;
    protected $password;
    protected $rol;

    public function __construct($nombre, $email, $password, $rol) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
    }

    public function getNombre() { return $this->nombre; }
    public function getEmail() { return $this->email; }
    public function getRol() { return $this->rol; }
}
