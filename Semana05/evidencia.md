# Semana 05 - PHP + MySQL
**Autor:** Samuel Villa Rivera  
**Carrera:** Ingeniería en Sistemas Computacionales  
**Proyecto:** Sistema de Inventario (FyNe)

## Objetivo
Lograr la persistencia de datos en la aplicación web mediante la integración de una base de datos MySQL, permitiendo al sistema almacenar registros enviados desde el formulario y consultarlos dinámicamente.

## Base de datos
*   **Nombre de la base de datos:** `inventario_fyne`
*   **Tabla principal:** `productos`
*   **Campos de la tabla:** 
    * `id` (INT)
    * `nombre` (VARCHAR 100)
    * `cantidad` (INT)
*   **Llave primaria:** El campo `id`. Sirve para identificar de manera única e irrepetible cada producto registrado.
*   **AUTO_INCREMENT:** Configurado en el campo `id`. Permite que MySQL asigne automáticamente el siguiente número consecutivo sin tener que programarlo manualmente en PHP.

## Comandos SQL utilizados
*   **INSERT:** `INSERT INTO productos (nombre, cantidad) VALUES ('Teclado', 15);` (Utilizado en `procesar.php` para guardar los datos enviados por el usuario).
*   **SELECT:** `SELECT * FROM productos ORDER BY cantidad ASC;` (Utilizado en `index.php` para leer la información y dibujarla en la tabla HTML).

## Conexión PHP + MySQL
La conexión se centralizó en el archivo `conexion.php` utilizando el objeto `mysqli`. Esto permite incluir la conexión en cualquier archivo usando `require_once "conexion.php";` manteniendo el código ordenado y separando la configuración del servidor de la lógica de la interfaz.

## Formularios, Validaciones y Flujo
1. **Captura:** El usuario ingresa datos en el formulario HTML.
2. **Validación JS (Cliente):** `script.js` intercepta el `submit`. Si el campo está vacío o es negativo, detiene el envío con `preventDefault()` y muestra un mensaje dinámico.
3. **Procesamiento PHP (Servidor):** Si JS aprueba, los datos viajan a `procesar.php`. PHP limpia los datos y vuelve a validar. 
4. **Almacenamiento (MySQL):** PHP ejecuta el `INSERT`.
5. **Consulta (Select):** Al recargar `index.php`, PHP se conecta a MySQL, recupera los registros con un bucle `while` y genera las etiquetas `<tr>` y `<td>` para la tabla.

## Experimentos realizados
*   **Experimento (Romper la conexión):** Modifiqué intencionalmente el nombre de la base de datos en `conexion.php` a `inventario_falso`.
*   **Error obtenido:** `Unknown database 'inventario_falso'`.
*   **Solución:** Restauré la variable `$base_datos = "inventario_fyne";`.
*   **Aprendizaje:** Comprendí que PHP depende estrictamente de las credenciales exactas. Si la conexión falla en la primera línea de `conexion.php`, el script se detiene mediante la instrucción `die()`, impidiendo que cargue el resto del sistema.

## Investigación: Relación entre Tecnologías
*   **HTML:** Mantiene la estructura de las cajas y la tabla.
*   **CSS:** Aplica el diseño visual sin alterar el contenido.
*   **JavaScript:** Interactúa con el usuario en tiempo real antes de enviar datos. No sustituye a PHP porque se ejecuta en el navegador y puede ser burlado.
*   **PHP:** Es el intermediario de seguridad. Recibe, valida y envía instrucciones SQL.
*   **MySQL:** Garantiza que los datos sean persistentes, es decir, que no se borren al cerrar el navegador o reiniciar el servidor.

## Desafío de la semana
**¿Qué agregué?** 
Un ordenamiento dinámico de menor a mayor stock (`ORDER BY cantidad ASC`).
**¿Por qué lo agregué?** 
Para que el sistema de inventario priorice visualmente los productos que están a punto de agotarse.
**¿Cómo funciona?** 
Modifiqué la instrucción SQL en el archivo `index.php`. En lugar de hacer un `SELECT *` básico, le pedí directamente al motor de MySQL que devolviera los registros ordenados antes de que PHP comenzara a iterarlos para generar el HTML.