<?php
require_once __DIR__ . '/../core/proteger.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Producto.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';
    
    $modelo = new Producto($conexion);
    
    if ($busqueda === '') {
        $resultados = $modelo->obtenerTodos();
    } else {
        $resultados = $modelo->buscar($busqueda);
    }

    echo json_encode([
        'ok' => true,
        'datos' => $resultados
    ], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'ok' => false,
        'mensaje' => 'Error en el servidor al buscar productos.'
    ]);
}
?>