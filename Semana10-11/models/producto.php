<?php
class Producto {
    private mysqli $conexion;

    public function __construct(mysqli $conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerTodos() {
        $sql = "SELECT id, nombre, cantidad FROM productos ORDER BY id DESC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function buscar($termino) {
        $termino_limpio = str_replace(',', '', $termino);
        $parametro = "%" . $termino_limpio . "%";
        
        $sql = "SELECT id, nombre, cantidad FROM productos WHERE REPLACE(nombre, ',', '') LIKE ? ORDER BY id DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $parametro);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }
}
?>