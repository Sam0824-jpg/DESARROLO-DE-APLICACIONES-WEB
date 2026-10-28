<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel MVC - FyNe</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header class="encabezado">
        <h1>Sistema de Inventario FyNe</h1>
        <nav class="menu">
            <span>Bienvenido, <?php echo htmlspecialchars($_SESSION["nombre"], ENT_QUOTES, 'UTF-8'); ?> (<?php echo ucfirst($rolActual); ?>)</span>
            <a href="logout.php" class="btn-salir">Cerrar Sesión</a>
        </nav>
    </header>

    <main>
        <?php 
        // Restauramos el formulario de creación exclusivamente para el admin
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
            <h2>Inventario Actual (Búsqueda en Tiempo Real)</h2>
            
            <form id="form-busqueda" class="barra-busqueda">
                <input type="text" id="input-busqueda" placeholder="Buscar producto (Fetch API)..." style="padding: 10px; width: 300px;">
                <span id="indicador-carga" style="display:none; color: gray;">Buscando...</span>
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
                <tbody id="cuerpo-tabla">
                    <!-- Renderizado inicial por PHP -->
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?= (int)$producto['id'] ?></td>
                            <td><?= htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($producto['cantidad'], ENT_QUOTES, 'UTF-8') ?></td>
                            <?php if ($rolActual === 'administrador'): ?>
                                <td class='acciones'>
                                    <!-- Enlaces restaurados al CRUD original -->
                                    <a href='editar.php?id=<?= $producto["id"] ?>' class='btn-editar'>Editar</a>
                                    
                                    <form action='eliminar.php' method='POST' style='display:inline;' onsubmit='return confirm("¿Estás seguro de eliminar este producto?");'>
                                        <input type='hidden' name='id' value='<?= $producto["id"] ?>'>
                                        <button type='submit' class='btn-eliminar'>Eliminar</button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($productos)): ?>
                        <tr><td colspan="4">No hay productos.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>
    <script>
        const ROL_USUARIO = "<?= htmlspecialchars($rolActual, ENT_QUOTES, 'UTF-8') ?>";
    </script>
    <script src="js/app.js"></script>
</body>
</html>