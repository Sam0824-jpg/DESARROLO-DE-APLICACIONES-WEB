<?php
require_once "proteger.php";
require_once "conexion.php";

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    die("ID no válido.");
}

$sql = "SELECT id, nombre, cantidad FROM productos WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$producto = $resultado->fetch_assoc();

if (!$producto) {
    die("Producto no encontrado.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <main>
        <section class="seccion-formulario">
            <h2>Actualizar Producto</h2>
            <form action="actualizar.php" method="POST" class="formulario-registro">
                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                <div class="grupo-input">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
                </div>
                <div class="grupo-input">
                    <label>Stock:</label>
                    <input type="number" name="cantidad" value="<?php echo htmlspecialchars($producto['cantidad']); ?>" required min="0">
                </div>
                <button type="submit" class="btn-guardar">Guardar Cambios</button>
                <a href="panel.php" class="btn-eliminar" style="display:block; text-align:center; margin-top:10px; text-decoration:none;">Cancelar</a>
            </form>
        </section>
    </main>
</body>
</html>