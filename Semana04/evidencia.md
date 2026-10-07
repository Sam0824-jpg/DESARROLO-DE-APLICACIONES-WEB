# Semana 04 - JavaScript
**Autor:** Samuel Villa Rivera  
**Programa:** Ingeniería en Sistemas Computacionales  
**Proyecto:** Sistema de Inventario Web

## Objetivo
Implementar interacción del lado del cliente utilizando JavaScript Vanilla para validar formularios en tiempo real, manipular el DOM y mejorar la experiencia de usuario antes de enviar los datos al servidor (PHP).

## Aplicación web
El proyecto mantiene la estructura de las Semanas 01 a 03 (Inventario Web), sumando ahora validación dinámica de entradas y retroalimentación visual inmediata.

## Archivo JavaScript
Se creó un archivo externo `script.js` separado del HTML y de los estilos, vinculado exitosamente usando la etiqueta `<script src="script.js"></script>` justo antes del cierre del `</body>` en `index.php`.

## Variables
Se utilizaron constantes (`const`) y variables de bloque (`let`) para almacenar referencias a elementos del DOM y valores de los campos. 
*   **¿Qué es una variable?** Es un espacio en memoria para almacenar un dato que puede ser reutilizado. 
*   **Tipos de datos usados:** Strings (texto en el nombre), Numbers (enteros en el stock), y Objetos (las referencias a los elementos HTML).

## Funciones
Se implementó una función reutilizable llamada `mostrarMensaje(texto, tipo)` que encapsula la lógica para cambiar el contenido y el color de un `div` dependiendo de si se requiere mostrar un error o un éxito, evitando repetir código.

## Eventos
*   **submit:** Aplicado al formulario para interceptar el envío de datos.
*   **click:** Aplicado al botón de ayuda para alternar su visibilidad.
*   **input:** Aplicado al campo de nombre para contar caracteres en tiempo real.

## DOM (Document Object Model)
Es la representación en forma de árbol que hace el navegador del documento HTML. Permitió que el código JavaScript interactuara, leyera valores y modificara estilos de etiquetas específicas del proyecto.

## Manipulación de elementos
Se utilizaron métodos como `.textContent` para inyectar texto en los contenedores de mensajes vacíos y `.style` para aplicar colores de fondo dinámicos sin necesidad de recargar la página.

## Validación del formulario
Se evaluó mediante estructuras condicionales (`if`) que:
1. El campo "nombre" no esté vacío (`trim() === ""`).
2. El campo "cantidad" no sea nulo ni un número negativo (`isNaN` y `< 0`).
Si no se cumplen, se utiliza `evento.preventDefault()` para abortar la petición a PHP.

## Mensajes dinámicos
Se eliminó la dependencia de `alert()` utilizando un `div` invisible que aparece e inyecta texto y colores (rojo para error, verde para éxito) dependiendo del estado de la validación.

## Mostrar y ocultar elementos
Se integró un botón "Mostrar Ayuda" que altera la propiedad CSS `display` de `none` a `block`, modificando también el texto del propio botón para indicar "Ocultar Ayuda" al hacer clic.

## Herramientas de desarrollador
*   **Console:** Utilizada para verificar la carga inicial de JavaScript (`console.log`) y diagnosticar variables no definidas.
*   **Elements:** Utilizada para modificar atributos en vivo y comprobar cómo reaccionan las reglas CSS.

## Experimentos realizados
*   **Experimento 1 (Cambiar contenido):** Se alteró el texto del `<h1>` desde la consola. Al recargar, el cambio desapareció, demostrando que JS en el cliente es volátil.
*   **Desafío Extra (Contador):** Se agregó un contador en tiempo real en el input del nombre que lee la longitud del string y la pinta de rojo si excede los 50 caracteres.

## Problemas encontrados y Errores de JavaScript
*   **Problema:** Al cambiar temporalmente el `id` del formulario en el HTML de `registro-productos` a `form-inventario`.
*   **Error mostrado:** `TypeError: Cannot read properties of null (reading 'addEventListener')`.
*   **Solución:** JS no encontraba el elemento porque el ID no coincidía. Se restauró la concordancia de IDs entre HTML y JS. Aprendí que `getElementById` devuelve `null` si falla, rompiendo el resto del script.

## Investigación: Relación entre HTML, CSS, JavaScript y PHP
1.  **HTML (Estructura):** Los cimientos y cajas del formulario.
2.  **CSS (Presentación):** La pintura y acomodo (colores y tipografía).
3.  **JavaScript (Interacción):** El comportamiento en el navegador (validaciones instantáneas, alertas en pantalla, sin recargar).
4.  **PHP (Procesamiento del servidor):** El cerebro backend. Recibe la petición final, vuelve a validar por seguridad y ejecuta la lógica permanente (bases de datos).

**¿Por qué validar también en PHP?** 
JavaScript se ejecuta del lado del cliente y un usuario avanzado puede desactivarlo o manipularlo desde las DevTools. PHP asegura que la información que llega al servidor sea íntegra, siendo la capa de seguridad definitiva.

## Reflexión final
Esta práctica unió las cuatro capas del desarrollo web. El proyecto pasó de ser una plantilla visual estática a un sistema que responde instantáneamente a las acciones del usuario, guiándolo para no cometer errores y mejorando drásticamente la usabilidad antes de involucrar al servidor.