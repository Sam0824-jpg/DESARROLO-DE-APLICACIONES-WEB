const formulario = document.getElementById('registro-productos');
const inputNombre = document.getElementById('nombre');
const inputStock = document.getElementById('cantidad');
const divMensaje = document.getElementById('mensaje-sistema');
const contador = document.getElementById('contador-caracteres');

function mostrarMensaje(texto, tipo) {
    divMensaje.textContent = texto;
    divMensaje.style.display = 'block';
    divMensaje.style.padding = '10px';
    divMensaje.style.marginBottom = '15px';
    divMensaje.className = ''; 
    
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

formulario.addEventListener('submit', function(evento) {
    let nombreValor = inputNombre.value.trim();
    let stockValor = parseInt(inputStock.value);

    if (nombreValor === "") {
        evento.preventDefault(); 
        mostrarMensaje("Error: El nombre del producto es obligatorio.", "error");
        inputNombre.focus();
        return;
    }

    if (isNaN(stockValor) || stockValor < 0) {
        evento.preventDefault();
        mostrarMensaje("Error: El stock debe ser un número igual o mayor a cero.", "error");
        inputStock.focus();
        return;
    }
});

if(inputNombre && contador) {
    inputNombre.addEventListener('input', function() {
        let longitud = inputNombre.value.length;
        contador.textContent = `${longitud}/50 caracteres`;

        if (longitud > 50) {
            contador.style.color = 'red';
            contador.style.fontWeight = 'bold';
        } else {
            contador.style.color = '#666';
            contador.style.fontWeight = 'normal';
        }
    });
}