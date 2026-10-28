<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php?error=acceso_denegado");
    exit();
}

function exigirRol(array $rolesPermitidos) {
    $rolActual = $_SESSION['rol'] ?? '';
    if (!in_array($rolActual, $rolesPermitidos, true)) {
        http_response_code(403);
        die(json_encode(['ok' => false, 'mensaje' => 'No tienes permiso.']));
    }
}
?>