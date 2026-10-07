// Comprobación en consola
console.log("JavaScript conectado correctamente al Sistema de Inventario.");

// Variables y selección del DOM
const formulario = document.getElementById('registro-productos');
const inputNombre = document.getElementById('nombre');
const inputStock = document.getElementById('cantidad');
const divMensaje = document.getElementById('mensaje-sistema');
const btnAyuda = document.getElementById('btn-ayuda');
const panelAyuda = document.getElementById('panel-ayuda');
const contador = document.getElementById('contador-caracteres');

// Función para generar mensajes visuales dinámicos
function mostrarMensaje(texto, tipo) {
    divMensaje.textContent = texto;
    divMensaje.style.display = 'block';
    divMensaje.style.padding = '10px';
    divMensaje.className = ''; // Limpia clases anteriores
    
    if (tipo === 'error') {
        divMensaje.style.backgroundColor = '#f8d7da';
        divMensaje.style.color = '#721c24';
        divMensaje.style.border = '1px solid #f5c6cb';
    } else {
        divMensaje.style.backgroundColor = '#d4edda';
        divMensaje.style.color = '#155724';
        divMensaje.style.border = '1px solid #c3e6cb';
    }
}

// Evento: Validación antes de enviar el formulario a PHP
formulario.addEventListener('submit', function(evento) {
    let nombreValor = inputNombre.value.trim();
    let stockValor = parseInt(inputStock.value);

    // Validación 1: Campo vacío
    if (nombreValor === "") {
        evento.preventDefault(); // Evita que se recargue la página y envíe el form
        mostrarMensaje("Error: El nombre del producto es obligatorio.", "error");
        inputNombre.focus();
        return;
    }

    // Validación 2: Número inválido o negativo
    if (isNaN(stockValor) || stockValor < 0) {
        evento.preventDefault();
        mostrarMensaje("Error: El stock debe ser un número igual o mayor a cero.", "error");
        inputStock.focus();
        return;
    }

    // Si todo es correcto
    mostrarMensaje("Validación exitosa. Enviando datos al servidor...", "exito");
});

// Evento: Mostrar y ocultar panel de ayuda
btnAyuda.addEventListener('click', function() {
    if (panelAyuda.style.display === 'none') {
        panelAyuda.style.display = 'block';
        btnAyuda.textContent = "Ocultar Ayuda";
    } else {
        panelAyuda.style.display = 'none';
        btnAyuda.textContent = "Mostrar Ayuda";
    }
});

// Desafío de la semana: Contador de caracteres en tiempo real
inputNombre.addEventListener('input', function() {
    let longitud = inputNombre.value.length;
    contador.textContent = `${longitud}/50 caracteres`;

    // Cambio de estilos dinámico si supera el límite recomendado
    if (longitud > 50) {
        contador.style.color = 'red';
        contador.style.fontWeight = 'bold';
    } else {
        contador.style.color = '#666';
        contador.style.fontWeight = 'normal';
    }
});