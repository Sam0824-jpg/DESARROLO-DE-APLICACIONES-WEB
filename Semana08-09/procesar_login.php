<?php
session_start();
require_once "conexion.php";

$usuario = trim($_POST['usuario'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';

if (empty($usuario) || empty($contrasena)) {
    header("Location: login.php?error=vacios");
    exit();
}

// Consulta preparada para evitar inyección SQL
$sql = "SELECT id, nombre, usuario, password_hash, rol FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($fila = $resultado->fetch_assoc()) {
    // Validar contraseña encriptada (Práctica 08)
    if (password_verify($contrasena, $fila['password_hash'])) {
        // Regenerar ID de sesión por seguridad (evita secuestro de sesión)
        session_regenerate_id(true);
        
        $_SESSION['usuario_id'] = $fila['id'];
        $_SESSION['usuario'] = $fila['usuario'];
        $_SESSION['nombre'] = $fila['nombre'];
        $_SESSION['rol'] = $fila['rol']; // Guardamos el rol en la sesión
        
        header("Location: panel.php");
        exit();
    }
}

// Mensaje genérico, no especifica si falló el usuario o la contraseña
header("Location: login.php?error=credenciales");
exit();
?>