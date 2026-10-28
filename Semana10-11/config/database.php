<?php
mysqli_report(MYSQLI_REPORT_OFF);

$servidor = "localhost";
$usuario = "root";
$contrasena = "root";
$base_datos = "inventario_fyne";

$conexion = @new mysqli($servidor, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    error_log("Error de conexión: " . $conexion->connect_error);
    die("Error crítico: El sistema no está disponible.");
}
$conexion->set_charset("utf8mb4");
?>