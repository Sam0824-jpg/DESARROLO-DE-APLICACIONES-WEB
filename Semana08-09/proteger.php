<?php
session_start();

// 1. Validar que la sesión exista
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php?error=acceso_denegado");
    exit();
}

// 2. Función reutilizable para exigir roles (Práctica 09)
function exigirRol(array $rolesPermitidos) {
    $rolActual = $_SESSION['rol'] ?? '';

    if (!in_array($rolActual, $rolesPermitidos, true)) {
        // Si no tiene el rol, devolvemos error 403 y detenemos la ejecución
        http_response_code(403);
        die("Error 403: No tienes permiso para realizar esta operación.");
    }
}
?>