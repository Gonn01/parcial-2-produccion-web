<?php
require_once 'BaseDatos.php';
require_once 'Administrador.php';
require_once 'Empleado.php';

class RepositorioUsuario
{

    public static function listar()
    {
        $usuarios = [];

        try {
            $conn = BaseDatos::conectar();
            $stmt = $conn->prepare("SELECT * FROM usuarios");
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                if ($row['rol'] === 'admin') {
                    $usuarios[] = new Administrador($row['id'], $row['nombre'], $row['email'], $row['password'], $row['rol']);
                } else {
                    $usuarios[] = new Empleado($row['id'], $row['nombre'], $row['email'], $row['password'], $row['rol']);
                }
            }
        } catch (\Throwable $th) {
            throw new Exception("Error al listar usuarios: " . $th->getMessage());
        } finally {
            $stmt->close();
            $conn->close();
        }

        return $usuarios;
    }
}

