<?php 
require_once "proteger.php";
require_once "conexion.php"; 

// Inicializamos la variable de búsqueda para usarla en el HTML
$busqueda = "";
if (isset($_GET['busqueda'])) {
    $busqueda = trim($_GET['busqueda']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel CRUD - FyNe</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header class="encabezado">
        <h1>Sistema de Inventario FyNe</h1>
        <nav class="menu">
            <span>Bienvenido, <?php echo htmlspecialchars($_SESSION["nombre"]); ?></span>
            <a href="logout.php" class="btn-salir">Cerrar Sesión</a>
        </nav>
    </header>

    <main>
        <section class="seccion-formulario">
            <h2>Registrar Nuevo Producto</h2>
            <div id="mensaje-sistema" style="display: none;"></div>
            
            <form action="procesar.php" method="POST" class="formulario-registro" id="registro-productos">
                <div class="grupo-input">
                    <label for="nombre">Nombre del Producto:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="grupo-input">
                    <label for="cantidad">Stock Inicial:</label>
                    <input type="number" id="cantidad" name="cantidad" required min="0">
                </div>
                <button type="submit" class="btn-guardar">Crear Registro</button>
            </form>
        </section>

        <section class="seccion-tabla">
            <h2>Inventario Actual (READ / UPDATE / DELETE)</h2>
            
            <!-- NUEVO: Barra de Búsqueda -->
            <form method="GET" action="" style="margin-bottom: 20px; display: flex; gap: 10px; align-items: center;">
                <input type="text" name="busqueda" placeholder="Buscar por nombre..." value="<?php echo htmlspecialchars($busqueda, ENT_QUOTES, 'UTF-8'); ?>" style="padding: 6px; width: 250px;">
                <button type="submit" style="padding: 6px 15px; cursor: pointer;">Buscar</button>
                <?php if (!empty($busqueda)): ?>
                    <a href="panel.php" style="text-decoration: none; color: #dc3545;">Limpiar filtro</a>
                <?php endif; ?>
            </form>

            <table class="tabla-inventario">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // NUEVO: Lógica de SQL dinámica para la búsqueda
                    if (!empty($busqueda)) {
                        // Limpiamos las comas de lo que el usuario escribió
                        $termino_limpio = str_replace(',', '', $busqueda);
                        $parametro = "%" . $termino_limpio . "%";
                        
                        // Buscamos ignorando las comas en la base de datos
                        $sql = "SELECT * FROM productos WHERE REPLACE(nombre, ',', '') LIKE ? ORDER BY id DESC";
                        $stmt = $conexion->prepare($sql);
                        $stmt->bind_param("s", $parametro);
                    } else {
                        // Si no hay búsqueda, mostramos todo como lo tenías originalmente
                        $sql = "SELECT * FROM productos ORDER BY id DESC";
                        $stmt = $conexion->prepare($sql);
                    }

                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $fila["id"] . "</td>";
                            echo "<td>" . htmlspecialchars($fila["nombre"], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td>" . htmlspecialchars($fila["cantidad"], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td class='acciones'>";
                            // UPDATE
                            echo "<a href='editar.php?id=" . $fila["id"] . "' class='btn-editar'>Editar</a> ";
                            // DELETE seguro por POST
                            echo "<form action='eliminar.php' method='POST' style='display:inline;' onsubmit='return confirm(\"¿Estás seguro de eliminar este producto?\");'>";
                            echo "<input type='hidden' name='id' value='" . $fila["id"] . "'>";
                            echo "<button type='submit' class='btn-eliminar'>Eliminar</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay productos registrados que coincidan con la búsqueda.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
    <script src="script.js"></script>
</body>
</html>