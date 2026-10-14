<?php
require_once "proteger.php";
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $cantidad = trim($_POST['cantidad']);

    if (empty($nombre) || !is_numeric($cantidad) || $cantidad < 0) {
        die("Datos inválidos.");
    }

    $sql = "INSERT INTO productos (nombre, cantidad) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $nombre, $cantidad);

    if ($stmt->execute()) {
        header("Location: panel.php");
        exit();
    } else {
        echo "Error al guardar.";
    }
}
?>