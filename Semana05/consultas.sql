CREATE DATABASE inventario_fyne;
USE inventario_fyne;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    cantidad INT NOT NULL
);

INSERT INTO productos (nombre, cantidad) VALUES ('Teclado Mecánico', 15);
INSERT INTO productos (nombre, cantidad) VALUES ('Monitor 24 pulgadas', 8);

SELECT * FROM productos;