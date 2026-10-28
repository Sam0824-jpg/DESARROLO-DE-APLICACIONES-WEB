<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso al Sistema - FyNe</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="contenedor-login">
        <h2>Iniciar Sesión</h2>
        
        <?php if (isset($_GET['error'])): ?>
            <p style="color: red; background: #fee; padding: 10px; border-radius: 5px;">
                <?php 
                // Evitamos XSS al mostrar errores
                $error = $_GET['error'];
                if ($error === 'credenciales') echo "Usuario o contraseña incorrectos.";
                else if ($error === 'acceso_denegado') echo "Debes iniciar sesión para continuar.";
                else echo "Ocurrió un error. Intenta de nuevo.";
                ?>
            </p>
        <?php endif; ?>

        <form action="procesar_login.php" method="POST">
            <div class="grupo-input">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div class="grupo-input">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            <button type="submit" class="btn-guardar">Ingresar</button>
        </form>
    </div>
</body>
</html>