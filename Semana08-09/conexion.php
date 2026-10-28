<?php
// Desactivar el reporte de errores automático de MySQLi para no filtrar datos sensibles al usuario
mysqli_report(MYSQLI_REPORT_OFF);

$servidor = "localhost"; // o "localhost:8889" según tu configuración
$usuario = "root";
$contrasena = "root";
$base_datos = "inventario_fyne";

$conexion = @new mysqli($servidor, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    // Mensaje genérico de error, sin revelar las credenciales o el error real de SQL
    error_log("Error de conexión: " . $conexion->connect_error); // Se guarda en el log del servidor
    die("Error crítico: El sistema no está disponible en este momento. Intente más tarde.");
}

// Forzar codificación para evitar problemas con caracteres especiales
$conexion->set_charset("utf8mb4");
?>