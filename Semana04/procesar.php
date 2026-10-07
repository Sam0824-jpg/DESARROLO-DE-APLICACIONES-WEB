<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando Registro</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header class="encabezado">
        <h1>📦 Sistema de Inventario</h1>
        <nav class="menu"><a href="index.php">Inicio</a></nav>
    </header>

    <main class="contenedor-principal">
        <section class="seccion-formulario">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nombre = trim($_POST['nombre']);
                $cantidad = trim($_POST['cantidad']);
                $correo = trim($_POST['correo']);
                $categoria = trim($_POST['categoria']);
                $errores = [];

                if (empty($nombre)) { $errores[] = "⚠️ El nombre del producto es obligatorio."; }
                if (empty($cantidad)) { $errores[] = "⚠️ Debes ingresar una cantidad."; } 
                elseif (!is_numeric($cantidad) || $cantidad < 0) { $errores[] = "⚠️ La cantidad debe ser un número válido mayor o igual a cero."; }
                if (empty($correo)) { $errores[] = "⚠️ El correo del proveedor es obligatorio."; } 
                elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) { $errores[] = "⚠️ Debes proporcionar un formato de correo electrónico válido."; }
                if (empty($categoria)) { $errores[] = "⚠️ Debes seleccionar una categoría para el producto."; }

                if (count($errores) > 0) {
                    echo "<h2>Se encontraron los siguientes problemas:</h2><ul>";
                    foreach ($errores as $error) { echo "<li style='color: red;'>" . $error . "</li>"; }
                    echo "</ul><br><a href='index.php' class='btn-guardar' style='text-align:center; display:block; text-decoration:none;'>⬅️ Volver al formulario</a>";
                } else {
                    echo "<h2 style='color: green;'>✔️ Producto registrado correctamente.</h2>";
                    echo "<ul>";
                    echo "<li><strong>Producto:</strong> " . htmlspecialchars($nombre) . "</li>";
                    echo "<li><strong>Stock inicial:</strong> " . htmlspecialchars($cantidad) . " unidades</li>";
                    echo "<li><strong>Contacto Proveedor:</strong> " . htmlspecialchars($correo) . "</li>";
                    echo "<li><strong>Categoría:</strong> " . htmlspecialchars($categoria) . "</li>";
                    echo "</ul><br><a href='index.php' class='btn-guardar' style='text-align:center; display:block; text-decoration:none;'>⬅️ Registrar otro producto</a>";
                }
            } else {
                echo "<h2>⚠️ Acceso denegado.</h2><p>Debes enviar el formulario primero.</p>";
                echo "<a href='index.php' class='btn-guardar' style='text-align:center; display:block; text-decoration:none;'>Ir al formulario</a>";
            }
            ?>
        </section>
    </main>

    <footer class="pie-pagina">
        <p>&copy; 2026 - Desarrollo de Aplicaciones Web | Sistema de Inventario</p>
    </footer>
</body>
</html>