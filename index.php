<?php
// Composer autoload
require_once _DIR_ . '/vendor/autoload.php';

// Configuraciones
require_once _DIR_ . '/app/config/config.php';
require_once _DIR_ . '/app/config/conexion.php';

// Obtener la página desde la URL
$pagina = 'Dashboard'; 

if (!empty($_GET['url'])) {
    $pagina = $_GET['url'];
}

// Convertir a nombre de clase
$clase = ucfirst($pagina);
$controlador = 'App\\Controller\\' . $clase.'Controller';


// Verificar si la clase existe
if (class_exists($controlador)) {
    $obj = new $controlador();

    if (method_exists($obj, 'index')) {
        $obj->index();
    } else {
        echo "El método 'index' no existe en $clase.";
    }
} else {
    echo "El controlador '$clase' no fue encontrado.";
}