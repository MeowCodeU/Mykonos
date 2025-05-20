<?php
require_once 'app/config/config.php'; // ← Asegura que las constantes estén disponibles
require_once 'app/config/conexion.php';


$pagina = 'dashboard';

if(!empty($GET['url'])){
    $pagina = $_GET['url'];
}

if (is_file('app/controller/' .$pagina.'.php')){
    require_once 'app/controller/' .$pagina.'.php';
}
?>