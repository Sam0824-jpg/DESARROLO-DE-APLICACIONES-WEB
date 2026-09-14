# Semana 01 - Primera página web con PHP

## Objetivo
Comprender los fundamentos de una aplicación web, observar el ciclo de vida de una petición HTTP y aprender a integrar lógica de PHP dentro de una estructura HTML.

## Aplicación web
Para este proyecto integrador elegí desarrollar un **Sistema de Inventario**. Esta primera página sirve como prototipo para calcular el valor total de un producto almacenado en el sistema a partir de su precio y stock.

## Cliente y servidor
*   **Cliente:** Es el programa que hace la solicitud. En este contexto, es el navegador web (Chrome, Edge, Firefox) que uso para entrar a la página.
*   **Servidor:** Es la computadora (o programa, como Apache) que está a la escucha, recibe la petición del cliente, procesa el código (PHP) y devuelve un resultado.

## HTTP
Es el protocolo de comunicación (el "idioma" y las reglas) que usan el cliente y el servidor para hablar entre sí y transferir los datos de la web.

## PHP
Es un lenguaje de programación de propósito general enfocado en el desarrollo web. A diferencia de otros lenguajes, PHP se ejecuta **exclusivamente en el servidor**. Su trabajo es procesar datos y generar HTML antes de enviarlo al usuario.

## HTML
Es el lenguaje de marcado que estructura la información. Su función es decirle al navegador cómo debe dibujar la página (dónde van los títulos, los párrafos, las listas, etc.).

## localhost
Significa "este equipo local". Se utiliza para que mi propia computadora funcione tanto de cliente como de servidor al mismo tiempo, permitiendo hacer pruebas sin necesidad de subir los archivos a internet.

## Variables y tipos de datos
Una variable es un espacio en la memoria RAM que usamos para guardar información temporalmente.
En esta práctica utilicé:
*   `String` (Texto): Para el nombre del producto.
*   `Float` (Decimal): Para el precio unitario.
*   `Integer` (Entero): Para la cantidad en stock.

## Operadores
Utilicé el operador aritmético de multiplicación (`*`) para calcular el valor total del inventario.

## PHP + HTML
La integración ocurre porque el servidor lee el archivo `.php`, ejecuta todo lo que está entre las etiquetas `<?php ... ?>`, y en ese lugar inyecta el resultado final (como texto) dentro de la estructura HTML que lo rodea.

## Experimento con herramientas de desarrollador
*   **¿Qué archivo solicitó el navegador?** Solicitó el archivo `index.php` (o la ruta raíz `localhost/Practicas/Semana01/`).
*   **¿Qué código de respuesta recibió?** Recibió el código `200 OK`, lo que significa que la petición fue exitosa.
*   **¿Qué contenido recibió?** Recibió puro código HTML puro.
*   **¿Puedes encontrar literalmente el código PHP que escribiste?** No.
*   **¿Por qué?** Porque PHP se ejecuta en el servidor. El servidor procesa las variables y las matemáticas, y solo le envía al navegador el resultado final convertido en HTML.

## Pruebas realizadas
1.  **Modificación de datos:** Cambié el precio de 4500.50 a 5000. Al recargar la página, el valor total se actualizó automáticamente a 60000.
2.  **Modificación de una operación:** Cambié el `*` por un `+`. El sistema sumó el stock al precio en lugar de multiplicarlo, mostrando un valor financiero incorrecto pero procesando el código sin errores de sintaxis.
3.  **Nueva variable:** Agregué `$descuento = 100;` y lo resté al total. Se reflejó correctamente en el HTML.
4.  **Eliminación de código:** Borré temporalmente la declaración de `$cantidadStock`.

## Problemas encontrados
Al borrar la variable `$cantidadStock`, PHP me arrojó un `Warning: Undefined variable $cantidadStock` en la línea de la operación matemática.
Al hacer la Prueba 5 (Error de sintaxis), quité intencionalmente un punto y coma (`;`) al final de la declaración del precio. La página colapsó y me mostró un `Parse error: syntax error, unexpected token "..."`.

## Soluciones aplicadas
Para solucionar los errores, simplemente revisé la línea que me indicaba el navegador en el mensaje de error. En el primer caso, volví a declarar la variable. En el segundo caso, puse el `;` faltante y recargué la página, volviendo a funcionar todo con normalidad.

## ¿Qué recibe el navegador?
El ciclo funciona así:
1. El **Navegador** solicita la URL mediante una petición **HTTP**.
2. El **Servidor Web** recibe la petición y se da cuenta de que es un archivo PHP.
3. **PHP** se ejecuta en el servidor, procesa las operaciones matemáticas y une esos datos.
4. PHP traduce todo eso en un **Resultado HTML**.
5. El **Navegador** recibe ese documento HTML y lo dibuja en pantalla.
El navegador no necesita (ni puede) ejecutar PHP porque no tiene el motor para procesarlo; su único trabajo es renderizar etiquetas HTML.

## Reflexión final
Esta práctica me ayudó a comprobar de manera visual que el "backend" (PHP) es totalmente invisible para el usuario. Aunque en mi archivo de código fuente tengo cálculos y lógica, la persona que visita la página a través de su navegador solo ve texto plano y diseño, lo cual es fundamental para mantener la seguridad de cualquier sistema web.