# Semana 03 - CSS

## Objetivo
Transformar la interfaz del Sistema de Inventario desarrollada en HTML y PHP, utilizando Hojas de Estilo en Cascada (CSS) para crear una estructura visualmente organizada, atractiva y adaptable a múltiples dispositivos.

## Aplicación web
El proyecto es un **Sistema de Inventario**. Ahora cuenta con un encabezado principal (Header), una sección central que aloja el formulario de registro y una tabla de visualización de productos en stock, terminando con un pie de página (Footer). Todo estilizado corporativamente.

## HTML utilizado
Se migró de etiquetas básicas a HTML5 Semántico. Se incorporaron contenedores lógicos como `<header>`, `<main>`, `<section>`, `<nav>` y `<footer>` para darle un orden estructural a la página antes de aplicar el CSS.

## Hoja de estilos
El archivo `estilos.css` se vinculó utilizando la etiqueta `<link rel="stylesheet" href="estilos.css">` dentro del `<head>`. Esto permite que el diseño se aplique de manera uniforme tanto en `index.php` como en `procesar.php` sin repetir código.

## Selectores CSS
*   **Por elemento:** Utilicé selectores como `body` o `h1` para definir colores y tipografías globales que afectan a toda la página.
*   **Por clase:** Utilicé clases como `.encabezado` o `.btn-guardar`. Son los que más utilizo porque permiten aplicar el mismo estilo a múltiples elementos o estructurar "componentes" específicos.
*   **Por id:** Solo se aplicaron indirectamente en el HTML para vincular los `<label>` con los `<input>`, pero para el diseño preferí las clases por su escalabilidad.

## Modelo de caja
Es el concepto fundamental de CSS que dicta que todo elemento HTML es un rectángulo compuesto por capas:
*   **Margin:** Es el margen exterior. Empuja a los elementos vecinos hacia lejos. Lo utilicé en `.contenedor-principal` (`margin: 40px auto;`) para separarlo del techo y centrarlo.
*   **Padding:** Es el relleno interior. Aleja el contenido del borde de su propia caja. Al agregarlo a `.seccion-formulario`, logré que los campos de texto no estuvieran pegados a las líneas exteriores de la tarjeta blanca.
*   **Border:** Es la línea visible que delimita la caja. Lo apliqué en los inputs (`border: 1px solid #ccc`) para darles definición visual.

## Flexbox
Es un modelo de diseño unidimensional que facilita alinear elementos y distribuir espacios dentro de un contenedor. 
*   **¿Qué hace display: flex?** Convierte a los elementos hijos inmediatos en ítems flexibles.
*   **¿Qué hace justify-content?** Los alinea sobre el eje principal. En `.encabezado` usé `space-between` para que el Título se pegara a la izquierda y el Menú a la derecha.
*   **¿Qué hace align-items?** Los alinea sobre el eje secundario (vertical). Usé `center` para que ambos quedaran a la misma altura sin importar el tamaño de su letra.

## Diseño del formulario
Se eliminó la apariencia rudimentaria apilada. Los `<input>` ahora tienen `width: 100%` para abarcar todo el espacio, bordes redondeados y un efecto `:focus` que cambia el borde a color azul para indicarle al usuario dónde está escribiendo.

## Diseño de la tabla
Se implementó `border-collapse: collapse` para eliminar los antiestéticos dobles bordes del HTML clásico. El encabezado (`<th>`) se pintó de oscuro para resaltar, y se agregó un efecto `:hover` en las filas (`<tr>`) para que se iluminen de gris al pasar el ratón, mejorando la legibilidad.

## Diseño adaptable
El diseño adaptable (Responsive Design) soluciona el problema de las pantallas móviles al permitir que la página reacomode sus elementos según el espacio disponible.
*   **@media:** Es una regla condicional. En mi experimento, escribí `@media (max-width: 600px)`. Al reducir la ventana, el flexbox del `.encabezado` cambia de `row` a `column`, haciendo que el menú se coloque de forma ordenada debajo del título para no encimarse.

## Herramientas de desarrollador
Utilicé la pestaña "Elementos" (Inspector) de Chrome. Me permitió seleccionar mi botón, ver qué propiedades se aplicaban y modificar temporalmente el color de fondo para probar tonos de verde. Estos cambios solo existen en la memoria temporal del navegador y se borran al recargar. Ayuda mucho a depurar fallas visuales sin tener que guardar y recargar archivos constantemente.

## Experimentos realizados
*   **Romper el diseño:** Eliminé intencionalmente el punto y coma (`;`) en la línea `display: flex` de mi encabezado. El resultado fue que la siguiente propiedad (`justify-content`) dejó de funcionar, y el menú se desalineó por completo.
*   **Cambiar clase:** Cambié la clase `.btn-guardar` por `.boton-azul` en mi HTML, pero no en el CSS. El botón perdió todo el estilo y regresó a su forma predeterminada gris de los 90s, demostrando que el vínculo exacto del nombre es obligatorio.

## Soluciones aplicadas
Para los problemas de sintaxis y clases rotas, revisé el Inspector del navegador. Al ver que mi botón no tenía estilos computados asociados en el panel derecho, supe que el enlace del nombre estaba roto, por lo que regresé al HTML y homologué los nombres.

## Relación entre HTML, CSS y PHP
*   **PHP (Procesamiento):** Es el cerebro en el servidor. Se ejecuta primero, procesa lógicas (como sumar inventario o validar correos) y su resultado escupe HTML.
*   **HTML (Estructura):** Es el esqueleto. Define dónde hay párrafos, cajas, imágenes y tablas.
*   **CSS (Presentación):** Es la pintura y la ropa. El navegador (quien lo interpreta localmente) lo lee y "viste" al esqueleto de HTML para que el Usuario final vea la Interfaz terminada.
*   **¿Por qué no se reemplazan?** Porque cada uno tiene una responsabilidad aislada. CSS no puede calcular matemáticas (PHP), ni PHP está optimizado para pintar sombras o curvas (CSS). Separarlos permite que el código sea mantenible, limpio y escalable.

## Reflexión final
Esta semana fue clave para comprender la división de responsabilidades (Frontend y Backend). Pude comprobar empíricamente que tener un archivo externo de estilos permite centralizar la estética de todo el sistema. Ahora, si decido cambiar el color corporativo del Sistema de Inventario, solo cambio una línea en el CSS y todas las páginas del sistema se actualizarán mágicamente de inmediato.