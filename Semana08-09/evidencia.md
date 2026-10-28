# Inventario de Seguridad - Práctica 08

| Archivo o módulo | Datos que recibe | Riesgo que revisaré | Corrección realizada |
| :--- | :--- | :--- | :--- |
| `procesar.php` | `nombre`, `cantidad` | Datos vacíos o inválidos | Validación estricta con `filter_input()` y `trim()` en PHP. |
| `actualizar.php` | `id`, `nombre`, `cantidad` | Inyección SQL y manipulación de ID | Se implementaron consultas preparadas y validación de `id` numérico. |
| `panel.php` | Datos de MySQL (`nombre`, `id`, `cantidad`) | Salida HTML sin escapar (XSS) | Se aplicó `htmlspecialchars($fila['campo'], ENT_QUOTES, 'UTF-8')` en todo el `echo`. |
| `procesar_login.php` | `usuario`, `contrasena` | Verificación incorrecta y SQLi | Uso de `password_verify()` y consulta preparada para buscar al usuario. |
| `proteger.php` | Sesión activa | Acceso sin autenticación | Comprobación de `$_SESSION['usuario']` al inicio de cada archivo privado. |
| `conexion.php` | Credenciales de DB | Exposición de secretos y trazas | Se usó `mysqli_report(MYSQLI_REPORT_OFF)` y `error_log()` en lugar de mostrar `connect_error`. |

# Pruebas de Seguridad - Semana 08

1. **Enviar un formulario con un campo obligatorio vacío:** Correcta (PHP detiene la ejecución mostrando "El nombre es obligatorio").
2. **Enviar un identificador con formato inválido:** Correcta (Rechazado por `filter_input`).
3. **Intentar consultar o editar un identificador inexistente:** Correcta (Sistema responde "El producto no existe").
4. **Revisar que las operaciones del CRUD utilicen consultas preparadas:** Correcta (Implementado en `procesar.php`, `actualizar.php`, `eliminar.php`).
5. **Introducir texto con caracteres especiales:** Correcta (`htmlspecialchars` lo renderiza como texto inofensivo, sin ejecutar scripts).
6. **Iniciar sesión con contraseña correcta:** Correcta.
7. **Intentar iniciar sesión con contraseña incorrecta:** Correcta (Retorna al login con error genérico de credenciales).
8. **Base de datos no almacena contraseña original:** Correcta (Solo se observan hashes de `$2y$10$...`).
9. **Abrir página protegida sin sesión:** Correcta (Redirige automáticamente a `login.php`).
10. **Cerrar sesión y volver con URL directa:** Correcta (Redirige al login).
11. **Mensajes de error genéricos:** Correcta (No revelan trazas de MySQLi).
12. **El CRUD sigue funcionando:** Correcta.

# Práctica 08 — Desarrollo de Aplicaciones Web

## Objetivo
Revisar y fortalecer la seguridad del proyecto integrador mediante validaciones en el servidor, protección de contraseñas, consultas preparadas, escape de salida y manejo prudente de errores e información sensible.

## Funcionalidad implementada
- Validación de backend (campos vacíos y tipos de datos) en operaciones CRUD.
- Consultas preparadas (`prepare()`, `bind_param()`) en `SELECT`, `INSERT`, `UPDATE` y `DELETE`.
- Hasheo de contraseñas y autenticación con `password_verify()`.
- Prevención de XSS usando `htmlspecialchars()` en el HTML.
- Supresión de errores técnicos al usuario usando `mysqli_report(MYSQLI_REPORT_OFF)`.

## Archivos modificados o creados
- `conexion.php` (silencio de errores)
- `procesar_login.php` (consultas preparadas y verify)
- `procesar.php`, `actualizar.php`, `eliminar.php` (validaciones y stmt)
- `panel.php` (escape de variables dinámicas)

## Tablas de la base de datos utilizadas
- `usuarios`
- `productos`

## Pruebas realizadas y Errores encontrados
*(Detalladas en el archivo `pruebas_seguridad.md`)*
Ningún error crítico persistente. Se corrigió un problema inicial donde los errores de MySQL eran visibles usando la directiva de reporte apagado.

## Reflexión final
La seguridad no solo debe depender del frontend (JavaScript o atributos HTML `required`). PHP es la última barrera de defensa y las consultas preparadas son innegociables para proteger la base de datos contra inyecciones SQL.

# Diseño de Roles y Permisos - Práctica 09

| Rol | Responsabilidad | Operaciones permitidas | Operaciones restringidas |
| :--- | :--- | :--- | :--- |
| **Administrador** | Administrar el inventario completo. | Consultar, crear, editar y eliminar productos. | Ninguna. Tiene control total del CRUD. |
| **Consulta** | Visualizar el stock actual. | Ingresar al panel, ver tabla de productos y usar la barra de búsqueda. | Crear registros, ver botones de edición/eliminación, modificar URL para borrar. |

# Pruebas Funcionales de Roles - Semana 09

1. **Iniciar sesión como administrador:** Correcta.
2. **Confirmar que menú muestra opciones autorizadas (CRUD):** Correcta (Aparece formulario y botones de acciones).
3. **Consultar registros como administrador:** Correcta.
4. **Crear registro como administrador:** Correcta.
5. **Editar registro como administrador:** Correcta.
6. **Eliminar registro como administrador:** Correcta.
7. **Cerrar sesión e iniciar como consulta:** Correcta.
8. **Menú de consulta oculta restricciones:** Correcta (No hay formulario ni columna de acciones).
9. **Consultar registros como consulta:** Correcta.
10. **Intentar ruta directa `actualizar.php` sin permiso:** Correcta (El servidor responde Error 403 / Redirige).
11. **Intentar editar por URL:** Correcta (El backend invoca `exigirRol` y bloquea la operación).
12. **Intentar eliminar por POST directo sin permiso:** Correcta (Bloqueado).
13. **PHP rechaza sin afectar BD:** Correcta.
14. **Página privada sin sesión (directa):** Correcta (Redirige al login).
15. **CRUD general sigue funcionando:** Correcta.

# Práctica 09 — Desarrollo de Aplicaciones Web

## Objetivo
Implementar un control de acceso por roles para que cada usuario autenticado pueda realizar únicamente las operaciones autorizadas, validando restricciones tanto en la interfaz visual como en el backend con PHP.

## Funcionalidad implementada
- Se añadió la columna `rol` a la tabla de `usuarios`.
- Se creó la función `exigirRol()` en `proteger.php` para centralizar la autorización.
- Se crearon dos usuarios de prueba: "admin" (administrador) y "consulta" (solo lectura).
- El panel dinámico oculta el formulario de inserción y la columna de acciones (Editar/Eliminar) si el usuario es de nivel 'consulta'.
- Bloqueo en backend de rutas directas (`actualizar.php`, `procesar.php`, `eliminar.php`) para evitar que un usuario de consulta aplique ingeniería inversa.

## Archivos modificados o creados
- `proteger.php` (Contiene la función central `exigirRol`)
- `panel.php` (Lógica de vistas `if ($rolActual === 'administrador')`)
- Archivos CRUD: `procesar.php`, `actualizar.php`, `eliminar.php` (Restricción backend)

## Tablas de la base de datos utilizadas
- `usuarios` (Se agregó la columna `rol`).
- `productos`.

## Pruebas realizadas y Errores encontrados
*(Detalladas en `pruebas_roles_permisos.md`)*
Al principio, un usuario de consulta podía borrar un producto si forzaba el método POST hacia `eliminar.php`. Esto se solucionó llamando a `exigirRol(['administrador'])` en las primeras líneas de los archivos que procesan datos.

## Reflexión final
Ocultar botones en HTML no es seguridad. El verdadero control de acceso ocurre en el servidor verificando en cada solicitud si la sesión actual cuenta con los permisos necesarios para ejecutar la consulta SQL.