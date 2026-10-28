document.addEventListener('DOMContentLoaded', () => {
    // Validación en el cliente (Frontend)
    const formRegistro = document.getElementById('registro-productos');
    
    if (formRegistro) {
        formRegistro.addEventListener('submit', (e) => {
            const nombre = document.getElementById('nombre').value.trim();
            const cantidad = document.getElementById('cantidad').value;

            if (nombre === "") {
                e.preventDefault();
                alert("Por favor, ingresa el nombre del producto.");
            } else if (cantidad < 0 || cantidad === "") {
                e.preventDefault();
                alert("El stock no puede ser negativo ni estar vacío.");
            }
        });
    }
});