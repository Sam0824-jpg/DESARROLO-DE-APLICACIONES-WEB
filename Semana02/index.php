<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Producto - Inventario</title>
</head>
<body>
    <h1>Sistema de Inventario</h1>
    <h2>Registrar Nuevo Producto</h2>

    <!-- El formulario envía los datos a procesar.php mediante el método POST -->
    <form action="procesar.php" method="POST">
        
        <!-- 1. Campo de texto -->
        <div>
            <label for="nombre">Nombre del Producto:</label><br>
            <input type="text" id="nombre" name="nombre" placeholder="Ej. Monitor 29 pulgadas">
        </div>
        <br>

        <!-- 2. Campo numérico -->
        <div>
            <label for="cantidad">Cantidad en Stock:</label><br>
            <input type="number" id="cantidad" name="cantidad" placeholder="Ej. 15">
        </div>
        <br>

        <!-- 3. Campo de correo electrónico -->
        <div>
            <label for="correo">Correo del Proveedor:</label><br>
            <input type="email" id="correo" name="correo" placeholder="contacto@proveedor.com">
        </div>
        <br>

        <!-- 4. Campo adicional (Select) -->
        <div>
            <label for="categoria">Categoría:</label><br>
            <select id="categoria" name="categoria">
                <option value="">Selecciona una opción...</option>
                <option value="Electronica">Electrónica</option>
                <option value="Mobiliario">Mobiliario</option>
                <option value="Papeleria">Papelería</option>
            </select>
        </div>
        <br>

        <!-- 5. Botón de envío -->
        <button type="submit">Guardar Producto</button>
    </form>
</body>
</html>