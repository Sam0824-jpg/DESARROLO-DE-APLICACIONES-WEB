<?php
require_once "proteger.php";
require_once "conexion.php";

// RESTRICCIÓN
exigirRol(['administrador']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nombre = trim($_POST['nombre'] ?? '');
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);

    if ($id === false || $id <= 0) die("Identificador no válido.");
    if (empty($nombre)) die("El nombre es obligatorio.");
    if ($cantidad === false || $cantidad < 0) die("Cantidad no válida.");

    $sql = "UPDATE productos SET nombre = ?, cantidad = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sii", $nombre, $cantidad, $id);
    
    if ($stmt->execute()) {
        header("Location: panel.php");
        exit();
    } else {
        error_log("Error UPDATE: " . $stmt->error);
        die("Error al actualizar.");
    }
}
?>