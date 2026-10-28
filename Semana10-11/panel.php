<?php
// Este archivo actúa como el Front Controller o Router de tu Panel
require_once __DIR__ . '/core/proteger.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/ProductoController.php';

$controlador = new ProductoController($conexion);
$controlador->index();
?>