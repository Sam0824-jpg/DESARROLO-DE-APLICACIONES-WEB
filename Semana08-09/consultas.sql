-- Agregamos la columna 'rol' (si no existe)
ALTER TABLE usuarios ADD COLUMN rol VARCHAR(30) NOT NULL DEFAULT 'consulta';

-- Borramos usuarios anteriores para evitar conflictos (Opcional, pero recomendado para pruebas limpias)
TRUNCATE TABLE usuarios;

-- Insertamos dos usuarios con contraseña encriptada (admin123) y roles diferentes
INSERT INTO usuarios (nombre, usuario, password_hash, rol) 
VALUES ('Administrador Supremo', 'admin', '$2y$10$wN3I.U/DDB0.oP6A9vV.1e1qL1D.P.eK/Uu0b.X/0X/0X/0X/0X/O', 'administrador');

INSERT INTO usuarios (nombre, usuario, password_hash, rol) 
VALUES ('Usuario de Lectura', 'consulta', '$2y$10$wN3I.U/DDB0.oP6A9vV.1e1qL1D.P.eK/Uu0b.X/0X/0X/0X/0X/O', 'consulta');