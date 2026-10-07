<?php require_once "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario FyNe</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header class="encabezado">
        <h1>Sistema de Inventario FyNe</h1>
        <nav class="menu">
            <a href="index.php">Inicio</a>
            <a href="#">Reportes</a>
            <a href="#">Ajustes</a>
        </nav>
    </header>

    <main>
        <section class="seccion-formulario">
            <h2>Registrar Nuevo Producto</h2>
            <div id="mensaje-sistema" style="display: none;"></div>
            
            <form action="procesar.php" method="POST" class="formulario-registro" id="registro-productos">
                <div class="grupo-input">
                    <label for="nombre">Nombre del Producto:</label>
                    <input type="text" id="nombre" name="nombre">
                    <small id="contador-caracteres" style="color: #666; display: block; margin-top: 5px;">0/50 caracteres</small>
                </div>
                
                <div class="grupo-input">
                    <label for="cantidad">Stock Inicial:</label>
                    <input type="number" id="cantidad" name="cantidad">
                </div>

                <button type="submit" class="btn-guardar">Guardar Producto</button>
            </form>
        </section>

        <section class="seccion-tabla">
            <h2>Inventario Actual (Ordenado por Stock)</h2>
            <div class="contenedor-tabla">
                <table class="tabla-inventario">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM productos ORDER BY cantidad ASC";
                        $resultado = $conexion->query($sql);

                        if ($resultado->num_rows > 0) {
                            while ($fila =$resultado->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $fila["id"] . "</td>";
                                echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
                                echo "<td>" . htmlspecialchars($fila["cantidad"]) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No hay productos registrados en la base de datos.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>