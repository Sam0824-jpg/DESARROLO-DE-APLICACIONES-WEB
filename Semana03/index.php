<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>
    <!-- Vinculación de la hoja de estilos externa -->
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    
    <!-- ENCABEZADO CON FLEXBOX -->
    <header class="encabezado">
        <h1>📦 Sistema de Inventario</h1>
        <nav class="menu">
            <a href="index.php">Inicio</a>
            <a href="#">Reportes</a>
            <a href="#">Ajustes</a>
        </nav>
    </header>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="contenedor-principal">
        
        <!-- SECCIÓN 1: FORMULARIO -->
        <section class="seccion-formulario">
            <h2>Registrar Nuevo Producto</h2>
            <form action="procesar.php" method="POST" class="formulario-registro">
                <div class="grupo-input">
                    <label for="nombre">Nombre del Producto:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ej. Monitor 29 pulgadas">
                </div>
                <div class="grupo-input">
                    <label for="cantidad">Cantidad en Stock:</label>
                    <input type="number" id="cantidad" name="cantidad" placeholder="Ej. 15">
                </div>
                <div class="grupo-input">
                    <label for="correo">Correo del Proveedor:</label>
                    <input type="email" id="correo" name="correo" placeholder="contacto@proveedor.com">
                </div>
                <div class="grupo-input">
                    <label for="categoria">Categoría:</label>
                    <select id="categoria" name="categoria">
                        <option value="">Selecciona una opción...</option>
                        <option value="Electronica">Electrónica</option>
                        <option value="Mobiliario">Mobiliario</option>
                        <option value="Papeleria">Papelería</option>
                    </select>
                </div>
                <button type="submit" class="btn-guardar">Guardar Producto</button>
            </form>
        </section>

        <!-- SECCIÓN 2: TABLA DE INVENTARIO -->
        <section class="seccion-tabla">
            <h2>Inventario Actual</h2>
            <table class="tabla-inventario">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Stock</th>
                        <th>Contacto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Teclado Mecánico</td>
                        <td>Electrónica</td>
                        <td>25</td>
                        <td>teclados@tech.com</td>
                    </tr>
                    <tr>
                        <td>Silla Ergonómica</td>
                        <td>Mobiliario</td>
                        <td>5</td>
                        <td>ventas@sillas.com</td>
                    </tr>
                    <tr>
                        <td>Hojas Blancas Tamaño Carta</td>
                        <td>Papelería</td>
                        <td>120</td>
                        <td>papel@distribuidora.com</td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>

    <!-- PIE DE PÁGINA -->
    <footer class="pie-pagina">
        <p>&copy; 2026 - Desarrollo de Aplicaciones Web | Sistema de Inventario</p>
    </footer>

</body>
</html>