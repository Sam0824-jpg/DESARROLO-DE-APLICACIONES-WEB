# Diseño Fetch API

- **Módulo seleccionado:** Buscador en tiempo real de Productos.
- **Archivo que inicia la petición:** `js/app.js` mediante el evento `input` en el buscador.
- **Ruta del endpoint:** `api/buscar.php`
- **Datos que envía JS:** Término de búsqueda por URL (GET).
- **Formato de respuesta:** JSON `{"ok": true, "datos": [...]}`
- **Permisos:** Requiere sesión iniciada (verificado en PHP).
- **Elemento que se actualiza:** `<tbody id="cuerpo-tabla">` manipulando el DOM.

# Pruebas Fetch API

1. **Abre el módulo y carga normalmente:** Correcta.
2. **Escribir en el buscador:** Correcta. JS intercepta y lanza el Fetch.
3. **Navegador recibe respuesta JSON:** Correcta (Revisado en pestaña Network).
4. **Interfaz se actualiza sin recargar:** Correcta. La tabla cambia dinámicamente.
5. **Comportamiento ante XSS:** Correcta. JS usa `textContent` para crear los `<td>`, neutralizando scripts.
6. **Manejo de errores HTTP:** Correcta. Capturado en el bloque `catch` de app.js.
7. **Seguridad y roles:** Correcta. Si es "consulta", JS omite dibujar la columna de "Acciones" basado en la variable `ROL_USUARIO`.

# Práctica 10 — Desarrollo de Aplicaciones Web

## Objetivo
Implementar una operación CRUD con Fetch API para crear dinamismo sin recargas.

## Funcionalidad implementada
Búsqueda de inventario en tiempo real. Al teclear, el navegador solicita los datos a un endpoint PHP vía GET.

## Archivos creados o modificados
- `js/app.js`
- `api/buscar.php`

## Reflexión final
Fetch API permite separar la interfaz visual del servidor. El servidor ahora solo provee datos estructurados (JSON), y el navegador asume la responsabilidad de dibujar la interfaz, logrando una experiencia rápida y moderna.

# Estructura MVC Implementada

- **Modelo (`models/Producto.php`):** Contiene la lógica de base de datos (`SELECT`, `INSERT`, consultas preparadas). Ya no imprime HTML.
- **Controlador (`controllers/ProductoController.php`):** Conecta el router (`panel.php`) con el Modelo. Pide los datos y manda llamar a la Vista.
- **Vista (`views/panel_vista.php`):** Únicamente contiene el HTML y ciclos `foreach` de PHP para mostrar variables.

# Pruebas MVC

1. **Abrir la app tras reorganizar:** Correcta.
2. **Iniciar sesión:** Correcta.
3. **Consultar listado por Modelo:** Correcta. `ProductoController->index()` lo coordina.
4. **Verificar roles en MVC:** Correcta. `proteger.php` sigue operando globalmente.
5. **Endpoint Fetch tras el refactor:** Correcta. `api/buscar.php` ahora instancia `Producto` (Modelo) para hacer sus búsquedas, reciclando el código.

# Práctica 11 — Desarrollo de Aplicaciones Web

## Objetivo
Reorganizar el código "Spaghetti" en un patrón MVC profesional, separando acceso a datos, lógica de negocio y HTML.

## Funcionalidad implementada
Refactorización completa del panel de inventario y la API Fetch hacia clases y vistas separadas.

## Tablas de la base de datos involucradas
`productos`, `usuarios`.

## Reflexión final
Aunque al principio toma más tiempo crear varias carpetas y archivos, el patrón MVC facilita el mantenimiento. El endpoint de la semana 10 se redujo significativamente al poder reciclar el método `buscar()` del Modelo `Producto`, demostrando la potencia de separar las responsabilidades del código.