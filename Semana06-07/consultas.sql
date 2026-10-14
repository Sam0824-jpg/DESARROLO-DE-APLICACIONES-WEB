USE inventario_fyne;

-- Tabla de Usuarios (Semana 07)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    correo VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertar usuario administrador de prueba (Contraseña: admin123)
-- El hash generado corresponde a "admin123" usando PASSWORD_DEFAULT
INSERT INTO usuarios (nombre, usuario, correo, password_hash) 
VALUES ('Administrador FyNe', 'admin', 'admin@fyne.com', '$2y$10$wN3I.U/DDB0.oP6A9vV.6uX9Vd9B2l/P4m.lQn3kU2k.xW0x.L61m');