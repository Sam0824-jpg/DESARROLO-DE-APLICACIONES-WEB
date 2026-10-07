<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header class="encabezado">
        <h1>Sistema de Inventario</h1>
        <nav class="menu">
            <a href="index.php">Inicio</a>
            <a href="#">Reportes</a>
            <a href="#">Ajustes</a>
        </nav>
    </header>

    <main>
        <section class="seccion-formulario">
            <h2>Registrar Nuevo Producto</h2>

            <!-- Botón y Panel de Ayuda (Mostrar/Ocultar) -->
            <button type="button" id="btn-ayuda" class="btn-guardar" style="background-color: #34495e; margin-bottom: 20px;">Mostrar Ayuda</button>
            <div id="panel-ayuda" style="display: none; background: #eee; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                <p><strong>Instrucciones:</strong> Llena todos los campos obligatorios. El stock no puede ser negativo.</p>
            </div>

            <!-- Contenedor de Mensajes Dinámicos -->
            <div id="mensaje-sistema" style="display: none; margin-bottom: 15px; border-radius: 4px;"></div>

            <!-- Formulario con ID para selección en JS -->
            <form action="procesar.php" method="POST" class="formulario-registro" id="registro-productos">
                <div class="grupo-input">
                    <label for="nombre">Nombre del Producto:</label>
                    <input type="text" id="nombre" name="nombre">
                    <!-- Desafío Extra: Contador dinámico -->
                    <small id="contador-caracteres" style="color: #666; display: block; margin-top: 5px; margin-bottom: 10px;">0/50 caracteres</small>
                </div>
                
                <div class="grupo-input">
                    <label for="cantidad">Stock Inicial:</label>
                    <input type="number" id="cantidad" name="cantidad">
                </div>

                <button type="submit" class="btn-guardar">Guardar Producto</button>
            </form>
        </section>
    </main>

    <!-- Conexión del archivo JavaScript -->
    <script src="script.js"></script>
</body>
</html>