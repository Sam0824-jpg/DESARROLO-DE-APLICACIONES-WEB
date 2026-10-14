<?php
session_start();
if (isset($_SESSION["usuario_id"])) {
    header("Location: panel.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - FyNe</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="body-login">
    <div class="contenedor-login">
        <h2>Acceso al Sistema</h2>
        <?php
        if (isset($_GET['error'])) {
            echo "<div class='mensaje-error'>Credenciales incorrectas o usuario inactivo.</div>";
        }
        ?>
        <form action="procesar_login.php" method="POST" class="formulario-registro">
            <div class="grupo-input">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required autocomplete="off">
            </div>
            <div class="grupo-input">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            <button type="submit" class="btn-guardar">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>