<?php
require_once 'BaseDatos.php';
require_once 'Eliminable.php';

class Vehiculo implements Eliminable
{
    private $id;
    private $marca;
    private $modelo;
    private $anio;
    private $precio;
    public function getId()
    {
        return $this->id;
    }

    public function getMarca()
    {
        return $this->marca;
    }
    public function getModelo()
    {
        return $this->modelo;
    }
    public function getAnio()
    {
        return $this->anio;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function __construct($id, $marca, $modelo, $anio, $precio)
    {
        $this->id = $id;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->anio = $anio;
        $this->precio = $precio;
    }

    static public function listar(): array
    {
        $vehiculos = [];

        try {
            $conn = BaseDatos::conectar();
            $stmt = $conn->prepare("SELECT * FROM vehiculos");
            $stmt->execute();
            $resultado = $stmt->get_result();

            while ($row = $resultado->fetch_assoc()) {
                $vehiculos[] = new Vehiculo(
                    $row['id'],
                    $row['marca'],
                    $row['modelo'],
                    $row['anio'],
                    $row['precio']
                );
            }
        } catch (\Throwable $th) {
            echo "Error al listar los vehículos: " . $th->getMessage();
        } finally {
            $stmt->close();
            $conn->close();
        }

        return $vehiculos;
    }

    static public function eliminar($id)
    {
        try {
            $conn = BaseDatos::conectar();
            $stmt = $conn->prepare("DELETE FROM vehiculos WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
        } catch (\Throwable $th) {
            throw new Exception("Error al eliminar el vehículo: " . $th->getMessage());
        } finally {
            $stmt->close();
            $conn->close();
        }
    }

}
