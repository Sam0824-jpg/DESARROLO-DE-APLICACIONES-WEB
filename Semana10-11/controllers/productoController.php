<?php
require_once __DIR__ . '/../models/Producto.php';

class ProductoController {
    private Producto $modelo;

    public function __construct(mysqli $conexion) {
        $this->modelo = new Producto($conexion);
    }

    public function index() {
        // Obtenemos los datos desde el modelo
        $productos = $this->modelo->obtenerTodos();
        $rolActual = $_SESSION['rol'] ?? 'consulta';
        
        // Entregamos los datos a la vista
        require_once __DIR__ . '/../views/panel_vista.php';
    }
}
?>