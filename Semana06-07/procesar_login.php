<?php
session_start();
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST["usuario"] ?? "");
    $contrasena = $_POST["contrasena"] ?? "";

    if ($usuario === "" || $contrasena === "") {
        header("Location: login.php?error=vacio");
        exit();
    }

    $sql = "SELECT id, nombre, usuario, password_hash, activo FROM usuarios WHERE usuario = ? LIMIT 1";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $fila = $resultado->fetch_assoc();

    if ($fila && (int)$fila["activo"] === 1 && password_verify($contrasena, $fila["password_hash"])) {
        session_regenerate_id(true);
        $_SESSION["usuario_id"] = (int)$fila["id"];
        $_SESSION["nombre"] = $fila["nombre"];
        $_SESSION["usuario"] = $fila["usuario"];
        
        header("Location: panel.php");
        exit();
    } else {
        header("Location: login.php?error=1");
        exit();
    }
}
?>