<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>
</head>
<body>
    <h1>Prototipo: Sistema de Inventario</h1>
    
    <?php
        // 1. Un dato de texto
        $nombreProducto = "Monitor Ultrawide 29 pulgadas"; 
        
        // 2. Un dato numérico (precio)
        $precioUnitario = 4500.50; 
        
        // 3. Un segundo dato numérico (cantidad en stock)
        $cantidadStock = 12; 
        
        // 4. Una operación utilizando los datos anteriores
        $valorTotalInventario = $precioUnitario * $cantidadStock;
    ?>

    <h2>Detalles del Producto</h2>
    <ul>
        <li><strong>Producto:</strong> <?php echo $nombreProducto; ?></li>
        <li><strong>Precio unitario:</strong> $<?php echo $precioUnitario; ?></li>
        <li><strong>Unidades disponibles:</strong> <?php echo $cantidadStock; ?></li>
    </ul>

    <h3>Resumen Financiero</h3>
    <!-- 5. Mostrar los resultados dentro de la página web -->
    <p>El valor total del inventario para este producto es de: <strong>$<?php echo $valorTotalInventario; ?></strong></p>

</body>
</html>