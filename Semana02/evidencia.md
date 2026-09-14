# Semana 02 - Formularios

## Objetivo
Incorporar formularios HTML para capturar información del usuario, enviarla al servidor y utilizar PHP para recibirla, validarla (detectando errores) y procesarla para emitir una respuesta adecuada.

## Aplicación web
El proyecto es un **Sistema de Inventario**. Esta semana, la página permite registrar un nuevo producto en el sistema, pidiendo datos básicos como el nombre, stock, datos de contacto del proveedor y la categoría a la que pertenece el producto.

## Formulario HTML
El formulario es la interfaz principal donde el usuario interactúa. Permite la captura de datos estructurados para enviarlos de forma ordenada al servidor web.

## Campos utilizados
*   **Texto (`type="text"`):** Para el nombre del producto.
*   **Numérico (`type="number"`):** Para la cantidad en stock.
*   **Correo (`type="email"`):** Para el contacto del proveedor.
*   **Adicional (`<select>`):** Una lista desplegable para elegir la categoría (Electrónica, Mobiliario, etc.).

## GET
Al usar `method="GET"`, los datos del formulario se envían adjuntos directamente en la URL del navegador después de un signo de interrogación `?`. 
*   **¿Dónde observas los datos?** En la barra de direcciones (ej. `procesar.php?nombre=Monitor&cantidad=15`).
*   **¿Qué ocurre si modificas la URL?** Si cambio el valor directo en la URL y doy Enter, la página procesa ese nuevo dato inmediatamente.
*   **Ventajas/Limitaciones:** Es útil para búsquedas o filtros que quieras compartir como un link, pero es muy inseguro para contraseñas o datos sensibles porque todo queda visible y se guarda en el historial.

## POST
Al usar `method="POST"`, los datos viajan "ocultos" en el cuerpo de la petición HTTP.
*   **¿Los datos aparecen en la URL?** No, la URL permanece limpia (solo se ve `procesar.php`).
*   **¿Cuándo usarlo?** Cuando se envían datos sensibles (contraseñas), información muy extensa, o cuando la petición modifica algo en el sistema (como insertar un producto a una base de datos).

## Recepción de datos con PHP
Para acceder a los datos uso las variables superglobales `$_GET` o `$_POST`. Si el formulario envía los datos por POST, del lado de PHP los extraigo usando la sintaxis `$_POST['nombre_del_campo']`.

## Validaciones
Validar significa verificar que la información ingresada cumpla con las reglas del negocio antes de aceptarla. Implementé:
1. Revisión de campos vacíos.
2. Comprobación de que la cantidad sea un número válido.
3. Comprobación del formato de correo mediante `filter_var()`.

*   **¿Qué ocurrió con información incorrecta?** El sistema detuvo el proceso y mostró la lista de errores encontrados.
*   **¿Qué ocurrió con información correcta?** El sistema omitió los errores y dibujó el resumen de confirmación en color verde.

## Mensajes de error
Cumplen la función de guiar al usuario. Si ingresé "usuario" en el correo, me apareció: "⚠️ Debes proporcionar un formato de correo electrónico válido". Esto indica exactamente qué me equivoqué y cómo solucionarlo.

## Mensaje de confirmación
Le da seguridad al usuario de que el sistema hizo su trabajo. Muestra un "✔️ Producto registrado correctamente" seguido de un resumen en viñetas con los datos finales.

## Herramientas de desarrollador
Revisando la pestaña de **Red (Network)**:
*   **Método HTTP:** El formulario usó el método `POST`.
*   **Diferencia GET/POST:** En la petición POST, existe una sección llamada "Carga útil" (Payload) donde van los datos del formulario, mientras que en GET no existe, los datos van pegados a la URL de la petición.
*   **¿Qué recibe/devuelve el servidor?** El servidor recibe la petición POST con el Payload. PHP lo procesa y le devuelve al navegador un documento HTML con un código de estado `200 OK`.

## Experimento GET vs POST
Cuando modifiqué el formulario a `GET`, el arreglo `$_POST` en PHP quedó vacío y me arrojó advertencias (Warnings) de que las variables no existían, porque PHP estaba buscando en la "puerta" equivocada. Tuve que cambiar mi código en PHP a `$_GET` para que los volviera a leer. Al regresarlo a POST, la seguridad y limpieza de la URL volvieron.

## Pruebas realizadas
1. Formulario vacío -> Me arrojó 4 errores distintos (uno por cada campo).
2. Correo incorrecto -> Me rechazó específicamente el correo.
3. Modificación de datos -> Si cambiaba el nombre a "Teclado", el mensaje de confirmación reflejaba el cambio correctamente.

## Problemas encontrados
Al principio, si dejaba la cantidad vacía, PHP no me daba un error de "campo vacío", sino un error extraño de validación numérica. 
**Causa:** Estaba validando `is_numeric()` antes de verificar si estaba vacío.
**Solución:** Cambié el orden del código para revisar primero con `empty()` y, solo si no estaba vacío, revisar si era un número con `elseif`.

## Investigación
1. **Formulario HTML:** Es una sección interactiva de la página con controles (cajas, botones) que permite al usuario ingresar información.
2. **input:** Etiqueta que crea un control interactivo. Su forma cambia dependiendo del tipo (texto, número, etc.).
3. **name:** Es el identificador crucial. Es el "nombre de la variable" con el que PHP buscará el dato al recibirlo.
4. **action:** Define hacia qué archivo o URL se va a enviar la información al dar clic en el botón (en este caso `procesar.php`).
5. **method:** Define cómo viajarán los datos en el protocolo HTTP (GET o POST).
6. **$_GET / $_POST:** Son "superarreglos" en PHP que capturan y almacenan toda la información que llega desde la petición HTTP para que el programador pueda usarla.

## Recorrido de los datos
1. El **Usuario** escribe en un **input** dentro de un **formulario HTML**.
2. Al dar clic en enviar, el navegador arma una **Solicitud HTTP** (POST) dirigida al servidor web.
3. El **Servidor Web** recibe la solicitud, identifica que es para `procesar.php` y enciende **PHP**.
4. PHP extrae los datos del Payload mediante **$_POST**.
5. PHP aplica las **validaciones** programadas.
6. Dependiendo del resultado, construye un **Documento HTML** (errores o confirmación).
7. Este documento HTML terminado viaja de vuelta al **Navegador**, quien lo dibuja para el **Usuario**.

## Reflexión final
Esta práctica fue fundamental para entender que HTML es solo la "cara" de la página, pero no tiene memoria ni capacidad de decisión. PHP actúa como el cerebro del lado del servidor: atrapa lo que el usuario envía, decide si es válido y responde en consecuencia, asegurando que no entre basura al sistema de inventario.