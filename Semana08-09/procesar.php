<?php
require_once "proteger.php";
require_once "conexion.php";

// RESTRICCIÓN DE BACKEND: Solo el admin puede ejecutar esto (Práctica 09)
exigirRol(['administrador']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre'] ?? '');
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);

    // Validación estricta del lado del servidor (Práctica 08)
    if (empty($nombre)) {
        die("Error: El nombre es obligatorio.");
    }
    if ($cantidad === false || $cantidad < 0) {
        die("Error: La cantidad no es válida. Debe ser un número positivo.");
    }

    // Consulta Preparada (Práctica 08)
    $sql = "INSERT INTO productos (nombre, cantidad) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $nombre, $cantidad);
    
    if ($stmt->execute()) {
        header("Location: panel.php");
        exit();
    } else {
        error_log("Error al insertar producto: " . $stmt->error);
        die("Ocurrió un error al guardar el producto.");
    }
}
?>