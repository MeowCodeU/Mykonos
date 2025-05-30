<?php
namespace App\Model;
use App\Config\Conexion;
use PDO;
use PDOException;

class Inventario extends Conexion {
    private $id;
    private $nombre;
    private $presentacion;
    private $stock;
    private $unidades;
    private $vencimiento;

    public function __construct() {
        parent::__construct(_DB_HOST_, _DB_NAME_, _DB_USER_, _DB_PASS_);
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPresentacion() {
        return $this->presentacion;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getUnidades() {
        return $this->unidades;
    }

    public function getVencimiento() {
        return $this->vencimiento;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPresentacion($presentacion) {
        $this->presentacion = $presentacion;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function setUnidades($unidades) {
        $this->unidades = $unidades;
    }

    public function setVencimiento($vencimiento) {
        $this->vencimiento = $vencimiento;
    }

    // Métodos CRUD
    public function insertar() {
        try {
            $sql = "INSERT INTO inventario (nombre, presentacion, stock, unidades, vencimiento)
                    VALUES (:nombre, :presentacion, :stock, :unidades, :vencimiento)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':presentacion', $this->presentacion);
            $stmt->bindParam(':stock', $this->stock);
            $stmt->bindParam(':unidades', $this->unidades);
            $stmt->bindParam(':vencimiento', $this->vencimiento);
            $stmt->execute();
            return $this->con->lastInsertId();
        } catch (PDOException $e) { // Error en la conexión
            die("Error al insertar: " . $e->getMessage());
        }
    }
    
    

    public function actualizar() {
        $sql = "UPDATE inventario SET nombre = :nombre, presentacion = :presentacion, stock = :stock,
                unidades = :unidades, vencimiento = :vencimiento WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':presentacion', $this->presentacion);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':unidades', $this->unidades);
        $stmt->bindParam(':vencimiento', $this->vencimiento);
        $stmt->execute();
    }

    public function eliminar() {
        $sql = "DELETE FROM inventario WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    public function consultar() {
        $sql = "SELECT * FROM inventario WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function consultarTodos() {
        $sql = "SELECT * FROM inventario";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>