<?php
require_once "proteger.php";
require_once "conexion.php";

// RESTRICCIÓN: Ni siquiera accediendo por URL directa podrán borrar.
exigirRol(['administrador']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    
    if ($id === false || $id === null || $id <= 0) {
        die("Error 400: El identificador no es válido.");
    }

    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: panel.php");
        exit();
    } else {
        error_log("Error DELETE: " . $stmt->error);
        die("Error al intentar eliminar el registro.");
    }
} else {
    // Si intentan entrar por GET (escribiendo la url) los rebotamos.
    header("Location: panel.php");
    exit();
}
?>