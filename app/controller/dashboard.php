<?php

require_once 'app/model/inventario.php';

class DashboardController {
    private $inventario;

    public function __construct() {
        $this->inventario = new Inventario();

        // Detectar acciones (por POST o GET)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['accion'])) {
                switch ($_POST['accion']) {
                    case 'agregar':
                        $this->agregar();
                        break;
                    case 'editar':
                        $this->editar();
                        break;
                    case 'eliminar':
                        $this->eliminar();
                        break;
                }
            }
        }

        // Siempre mostrar la vista con datos actualizados
        $this->mostrarVista();
    }

    private function agregar() {
        $this->inventario->setNombre($_POST['nombre']);
        $this->inventario->setPresentacion($_POST['presentacion']);
        $this->inventario->setStock($_POST['stock']);
        $this->inventario->setUnidades($_POST['unidades']);
        $this->inventario->setVencimiento($_POST['vencimiento']);
        $resultado = $this->inventario->insertar();
    
        if (!$resultado) {
            echo "<script>alert('Hubo un error al registrar.');</script>";
        }
        else {
            echo "<script>alert('Registro correcto.');</script>";
        }
    }

    private function editar() {
        $this->inventario->setId($_POST['id']);
        $this->inventario->setNombre($_POST['nombre']);
        $this->inventario->setPresentacion($_POST['presentacion']);
        $this->inventario->setStock($_POST['stock']);
        $this->inventario->setUnidades($_POST['unidades']);
        $this->inventario->setVencimiento($_POST['vencimiento']);
        $this->inventario->actualizar();
    }

    private function eliminar() {
        $this->inventario->setId($_POST['id']);
        $this->inventario->eliminar();
    }

    private function mostrarVista() {
        $listaInventario = $this->inventario->consultarTodos();
        include 'vista/dashboard.php';
    }
}

new DashboardController();
