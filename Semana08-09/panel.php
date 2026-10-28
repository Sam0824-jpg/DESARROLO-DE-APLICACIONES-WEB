<?php 
require_once "proteger.php";
require_once "conexion.php"; 

$busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : "";
$rolActual = $_SESSION['rol'] ?? '';
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
            <span>Bienvenido, <?php echo htmlspecialchars($_SESSION["nombre"], ENT_QUOTES, 'UTF-8'); ?> (<?php echo ucfirst(htmlspecialchars($rolActual, ENT_QUOTES, 'UTF-8')); ?>)</span>
            <a href="logout.php" class="btn-salir">Cerrar Sesión</a>
        </nav>
    </header>

    <main>
        <?php 
        // MENÚ DINÁMICO: Solo mostramos el formulario si es administrador
        if ($rolActual === 'administrador'): 
        ?>
        <section class="seccion-formulario">
            <h2>Registrar Nuevo Producto</h2>
            <form action="procesar.php" method="POST" class="formulario-registro">
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
        <?php endif; ?>

        <section class="seccion-tabla">
            <h2>Inventario Actual</h2>
            
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
                        <?php if ($rolActual === 'administrador'): ?>
                            <th>Acciones</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta preparada para búsqueda
                    if (!empty($busqueda)) {
                        $termino_limpio = str_replace(',', '', $busqueda);
                        $parametro = "%" . $termino_limpio . "%";
                        $sql = "SELECT id, nombre, cantidad FROM productos WHERE REPLACE(nombre, ',', '') LIKE ? ORDER BY id DESC";
                        $stmt = $conexion->prepare($sql);
                        $stmt->bind_param("s", $parametro);
                    } else {
                        $sql = "SELECT id, nombre, cantidad FROM productos ORDER BY id DESC";
                        $stmt = $conexion->prepare($sql);
                    }

                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            // Escape obligatorio de todo dato proveniente de la DB (Práctica 08)
                            echo "<td>" . htmlspecialchars($fila["id"], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td>" . htmlspecialchars($fila["nombre"], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td>" . htmlspecialchars($fila["cantidad"], ENT_QUOTES, 'UTF-8') . "</td>";
                            
                            // Acciones exclusivas para administrador
                            if ($rolActual === 'administrador') {
                                echo "<td class='acciones'>";
                                echo "<a href='editar.php?id=" . htmlspecialchars($fila["id"], ENT_QUOTES, 'UTF-8') . "' class='btn-editar'>Editar</a> ";
                                
                                echo "<form action='eliminar.php' method='POST' style='display:inline;' onsubmit='return confirm(\"¿Estás seguro?\");'>";
                                echo "<input type='hidden' name='id' value='" . htmlspecialchars($fila["id"], ENT_QUOTES, 'UTF-8') . "'>";
                                echo "<button type='submit' class='btn-eliminar'>Eliminar</button>";
                                echo "</form>";
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        $columnas = ($rolActual === 'administrador') ? 4 : 3;
                        echo "<tr><td colspan='$columnas'>No hay productos registrados.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>