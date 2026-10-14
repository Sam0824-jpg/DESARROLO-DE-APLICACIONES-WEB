const formulario = document.getElementById('registro-productos');
const inputNombre = document.getElementById('nombre');
const inputStock = document.getElementById('cantidad');

if (formulario) {
    formulario.addEventListener('submit', function(evento) {
        let nombreValor = inputNombre.value.trim();
        let stockValor = parseInt(inputStock.value);

        if (nombreValor === "" || isNaN(stockValor) || stockValor < 0) {
            evento.preventDefault(); 
            alert("Validación JS: Verifica que los campos no estén vacíos y el stock sea válido.");
        }
    });
}