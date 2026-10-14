# Práctica 06 — Desarrollo de Aplicaciones Web: CRUD

## Objetivo
Desarrollar un módulo CRUD completo (Create, Read, Update, Delete) utilizando consultas preparadas en PHP para la administración segura del inventario.

## Funcionalidad implementada
- **CREAR:** Archivo `procesar.php` recibe datos e inserta.
- **LEER:** Tabla generada en `panel.php` iterando registros.
- **ACTUALIZAR:** Vistas e inserciones en `editar.php` y `actualizar.php`.
- **ELIMINAR:** Archivo `eliminar.php` que recibe el ID por POST por seguridad (evitando links GET).

## Tablas de la base de datos utilizadas
Entidad: `productos` | Clave Primaria: `id` | Campos: `nombre` (VARCHAR), `cantidad` (INT).

## Soluciones aplicadas
Se implementaron sentencias `$stmt = $conexion->prepare()` para evitar la concatenación directa de variables, previniendo vulnerabilidades de inyección SQL. Los datos impresos en HTML están protegidos con `htmlspecialchars()`.

# Pruebas CRUD (Semana 06)

1. **Registrar elemento válido:** Completado. El producto apareció inmediatamente en la lista de `panel.php`.
2. **Dejar campo vacío:** JS detiene el formulario. Si se fuerza el envío, PHP detiene la ejecución.
3. **Editar registro:** Se cambió el nombre de un producto existente. Al guardar, redirigió y el cambio persistió en la BD.
4. **Eliminar registro:** Al hacer clic en eliminar, apareció la alerta de confirmación (JS). Al aceptar, el POST eliminó la fila de MySQL.

# Práctica 07 — Desarrollo de Aplicaciones Web: Login y Sesiones

## Objetivo
Implementar autenticación de usuarios mediante hashes de contraseña y proteger las rutas del sistema para restringir el acceso a administradores.

## Archivos creados
- `login.php`: Interfaz del formulario.
- `procesar_login.php`: Validación `password_verify()` e inicialización de variable `$_SESSION`.
- `proteger.php`: Middleware requerido al inicio del panel y archivos CRUD para expulsar no autorizados.
- `logout.php`: Destrucción segura de cookies y sesión.

## Relación PHP y MySQL en autenticación
Se creó la tabla `usuarios` guardando la contraseña procesada con `password_hash()`. En el login, MySQL solo busca el nombre de usuario, devolviendo el hash a PHP, el cual ejecuta la validación algorítmica.

# Pruebas Login (Semana 07)

1. **Acceso con credenciales correctas:** Usuario `admin` y clave `admin123`. Acceso exitoso. Redirección a `panel.php` con mensaje de bienvenida.
2. **Acceso con credenciales incorrectas:** Se devuelve error genérico sin especificar si falló el correo o la clave.
3. **Acceso directo a rutas protegidas:** Intentar abrir `panel.php` sin sesión redirige instantáneamente a `login.php`.
4. **Cierre de sesión:** Clic en "Cerrar sesión" destruye el arreglo `$_SESSION`. Pulsar "Atrás" en el navegador pide login nuevamente.