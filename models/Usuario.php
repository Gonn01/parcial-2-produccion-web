<?php
require_once 'BaseDatos.php';
require_once 'Eliminable.php';

abstract class Usuario implements Eliminable
{
    protected $id;
    protected $nombre;
    protected $email;
    protected $password;
    protected $rol;

    public function __construct($id, $nombre, $email, $password, $rol)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getRol()
    {
        return $this->rol;
    }
    public static function eliminar($id)
    {
        try {
            $conn = BaseDatos::conectar();
            $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
        } catch (\Throwable $th) {
            throw new Exception("Error al eliminar el usuario: " . $th->getMessage());
        } finally {
            $stmt->close();
            $conn->close();
        }
    }

}
