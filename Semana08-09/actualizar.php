<?php
require_once "proteger.php";
require_once "conexion.php";

// RESTRICCIÓN: Solo administrador puede actualizar (Práctica 09)
exigirRol(['administrador']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nombre = trim($_POST['nombre'] ?? '');
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);

    // Validaciones estrictas de PHP (Práctica 08)
    if ($id === false || $id <= 0) {
        die("Error: Identificador no válido.");
    }
    if (empty($nombre)) {
        die("Error: El nombre es obligatorio.");
    }
    if ($cantidad === false || $cantidad < 0) {
        die("Error: La cantidad no es válida.");
    }

    // Consulta Preparada (Práctica 08)
    $sql = "UPDATE productos SET nombre = ?, cantidad = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sii", $nombre, $cantidad, $id);
    
    if ($stmt->execute()) {
        header("Location: panel.php");
        exit();
    } else {
        error_log("Error al actualizar producto: " . $stmt->error);
        die("Ocurrió un error al actualizar el registro.");
    }
} else {
    header("Location: panel.php");
    exit();
}
?>