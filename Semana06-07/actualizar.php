<?php
require_once "proteger.php";
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = trim($_POST['nombre']);
    $cantidad = $_POST['cantidad'];

    if (empty($id) || empty($nombre) || !is_numeric($cantidad) || $cantidad < 0) {
        die("Datos inválidos.");
    }

    $sql = "UPDATE productos SET nombre = ?, cantidad = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sii", $nombre, $cantidad, $id);

    if ($stmt->execute()) {
        header("Location: panel.php");
        exit();
    } else {
        echo "Error al actualizar.";
    }
}
?>