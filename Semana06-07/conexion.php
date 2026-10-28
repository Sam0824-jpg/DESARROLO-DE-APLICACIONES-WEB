<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servidor = "localhost";
$usuario = "root";
$password = "root"; 
$base_datos = "inventario_fyne";

try {
    $conexion = new mysqli($servidor, $usuario, $password, $base_datos);
    $conexion->set_charset("utf8mb4");
} catch (Exception $e) {
    die("Error crítico: No se pudo conectar a la base de datos.");
}
?>