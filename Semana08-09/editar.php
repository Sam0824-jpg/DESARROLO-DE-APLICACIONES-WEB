<?php
require_once "proteger.php";
require_once "conexion.php";

// RESTRICCIÓN
exigirRol(['administrador']);

// Validar ID (Práctica 08)
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null || $id <= 0) {
    die("Identificador no válido.");
}

$sql = "SELECT id, nombre, cantidad FROM productos WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("El producto no existe.");
}

$producto = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="contenedor-login">
        <h2>Editar Producto</h2>
        <form action="procesar_editar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="grupo-input">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="grupo-input">
                <label>Cantidad:</label>
                <input type="number" name="cantidad" value="<?php echo htmlspecialchars($producto['cantidad'], ENT_QUOTES, 'UTF-8'); ?>" required min="0">
            </div>
            <button type="submit" class="btn-guardar">Actualizar</button>
            <a href="panel.php" class="btn-salir" style="text-decoration:none; padding:10px; display:inline-block; margin-top:10px;">Cancelar</a>
        </form>
    </div>
</body>
</html>