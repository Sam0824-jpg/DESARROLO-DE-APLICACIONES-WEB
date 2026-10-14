<?php
require_once "proteger.php";
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    if (is_numeric($id)) {
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    header("Location: panel.php");
    exit();
}
?>