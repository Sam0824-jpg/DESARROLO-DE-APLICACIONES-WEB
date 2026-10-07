<?php
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $cantidad = trim($_POST['cantidad']);

    if (empty($nombre) \vert{}\vert{}$cantidad === "") {
        die("Error: Todos los campos son obligatorios.");
    }

    if (!is_numeric($cantidad) \vert{}\vert{}$cantidad < 0) {
        die("Error: El stock debe ser un número válido igual o mayor a cero.");
    }

    $nombre_seguro = $conexion->real_escape_string($nombre);
    $cantidad_segura = (int)$cantidad;

    $sql = "INSERT INTO productos (nombre, cantidad) VALUES ('$nombre_seguro',$cantidad_segura)";

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al guardar el registro: " . $conexion->error;
    }
} else {
    header("Location: index.php");
    exit();
}

$conexion->close();
?>