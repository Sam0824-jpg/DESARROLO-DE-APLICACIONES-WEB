<?php
session_start();

// Importamos la conexión desde la nueva ruta MVC
require_once __DIR__ . '/config/database.php';

$usuario = trim($_POST['usuario'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';

if (empty($usuario) || empty($contrasena)) {
    header("Location: login.php?error=vacios");
    exit();
}

// Consulta preparada (Seguridad Práctica 08)
$sql = "SELECT id, nombre, usuario, password_hash, rol FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($fila = $resultado->fetch_assoc()) {
    // Verificamos el hash
    if (password_verify($contrasena, $fila['password_hash'])) {
        // Regenerar ID de sesión por seguridad
        session_regenerate_id(true);
        
        // Guardamos los datos en la sesión, incluyendo el ROL
        $_SESSION['usuario_id'] = $fila['id'];
        $_SESSION['usuario'] = $fila['usuario'];
        $_SESSION['nombre'] = $fila['nombre'];
        $_SESSION['rol'] = $fila['rol']; 
        
        header("Location: panel.php");
        exit();
    }
}

// Si falla, regresamos al login con error genérico
header("Location: login.php?error=credenciales");
exit();
?>