<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando Registro</title>
</head>
<body>
    <h1>Resultado del Registro</h1>

    <?php
    // Verificamos si los datos llegaron por POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Recibimos los datos usando $_POST y limpiamos espacios vacíos
        $nombre = trim($_POST['nombre']);
        $cantidad = trim($_POST['cantidad']);
        $correo = trim($_POST['correo']);
        $categoria = trim($_POST['categoria']);

        // Arreglo para guardar los mensajes de error
        $errores = [];

        // VALIDACIONES
        // 1. Nombre vacío
        if (empty($nombre)) {
            $errores[] = "⚠️ El nombre del producto es obligatorio.";
        }

        // 2. Cantidad (no vacío y debe ser número)
        if (empty($cantidad)) {
            $errores[] = "⚠️ Debes ingresar una cantidad.";
        } elseif (!is_numeric($cantidad) || $cantidad < 0) {
            $errores[] = "⚠️ La cantidad debe ser un número válido mayor o igual a cero.";
        }

        // 3. Correo válido
        if (empty($correo)) {
            $errores[] = "⚠️ El correo del proveedor es obligatorio.";
        } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "⚠️ Debes proporcionar un formato de correo electrónico válido (ejemplo@dominio.com).";
        }

        // 4. Categoría seleccionada
        if (empty($categoria)) {
            $errores[] = "⚠️ Debes seleccionar una categoría para el producto.";
        }


        // PROCESAMIENTO (Mostrar errores o confirmación)
        if (count($errores) > 0) {
            // Si hay errores, los mostramos
            echo "<h2>Se encontraron los siguientes problemas:</h2>";
            echo "<ul>";
            foreach ($errores as $error) {
                echo "<li style='color: red;'>" . $error . "</li>";
            }
            echo "</ul>";
            echo '<p><a href="index.php">⬅️ Volver al formulario</a></p>';
        } else {
            // Si no hay errores, mostramos la confirmación
            echo "<h2 style='color: green;'>✔️ Producto registrado correctamente.</h2>";
            echo "<h3>Resumen de datos guardados:</h3>";
            echo "<ul>";
            echo "<li><strong>Producto:</strong> " . htmlspecialchars($nombre) . "</li>";
            echo "<li><strong>Stock inicial:</strong> " . htmlspecialchars($cantidad) . " unidades</li>";
            echo "<li><strong>Contacto Proveedor:</strong> " . htmlspecialchars($correo) . "</li>";
            echo "<li><strong>Categoría:</strong> " . htmlspecialchars($categoria) . "</li>";
            echo "</ul>";
            echo '<p><a href="index.php">⬅️ Registrar otro producto</a></p>';
        }

    } else {
        // Si alguien intenta entrar a procesar.php directo por la URL (GET)
        echo "<p>⚠️ Acceso denegado. Debes enviar el formulario primero.</p>";
        echo '<p><a href="index.php">Ir al formulario</a></p>';
    }
    ?>
</body>
</html>