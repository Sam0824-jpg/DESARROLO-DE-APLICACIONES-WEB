document.addEventListener('DOMContentLoaded', () => {
    const inputBusqueda = document.getElementById('input-busqueda');
    const tbody = document.getElementById('cuerpo-tabla');
    const indicador = document.getElementById('indicador-carga');

    inputBusqueda.addEventListener('input', async (e) => {
        const termino = e.target.value.trim();
        indicador.style.display = 'inline';

        try {
            const respuesta = await fetch(`api/buscar.php?busqueda=${encodeURIComponent(termino)}`, {
                headers: { 'Accept': 'application/json' }
            });

            if (!respuesta.ok) {
                throw new Error(`Error HTTP: ${respuesta.status}`);
            }

            const json = await respuesta.json();
            
            if (json.ok) {
                actualizarTabla(json.datos);
            } else {
                console.error(json.mensaje);
            }
        } catch (error) {
            console.error('Fallo la comunicación Fetch:', error.message);
        } finally {
            indicador.style.display = 'none';
        }
    });

    function actualizarTabla(productos) {
        tbody.innerHTML = ''; 

        if (productos.length === 0) {
            const tr = document.createElement('tr');
            const td = document.createElement('td');
            td.colSpan = ROL_USUARIO === 'administrador' ? 4 : 3;
            td.textContent = 'No se encontraron productos.';
            tr.appendChild(td);
            tbody.appendChild(tr);
            return;
        }

        productos.forEach(prod => {
            const tr = document.createElement('tr');

            const tdId = document.createElement('td');
            tdId.textContent = prod.id;
            tr.appendChild(tdId);

            const tdNombre = document.createElement('td');
            tdNombre.textContent = prod.nombre;
            tr.appendChild(tdNombre);

            const tdCant = document.createElement('td');
            tdCant.textContent = prod.cantidad;
            tr.appendChild(tdCant);

            // Reconstrucción dinámica de los enlaces de Editar y Eliminar
            if (ROL_USUARIO === 'administrador') {
                const tdAcciones = document.createElement('td');
                tdAcciones.className = 'acciones';
                
                // Botón Editar
                const enlaceEditar = document.createElement('a');
                enlaceEditar.href = `editar.php?id=${prod.id}`;
                enlaceEditar.className = 'btn-editar';
                enlaceEditar.textContent = 'Editar';
                tdAcciones.appendChild(enlaceEditar);
                
                // Formulario Eliminar
                const formEliminar = document.createElement('form');
                formEliminar.action = 'eliminar.php';
                formEliminar.method = 'POST';
                formEliminar.style.display = 'inline';
                formEliminar.onsubmit = () => confirm('¿Estás seguro de eliminar este producto?');
                
                const inputOculto = document.createElement('input');
                inputOculto.type = 'hidden';
                inputOculto.name = 'id';
                inputOculto.value = prod.id;
                
                const btnEliminar = document.createElement('button');
                btnEliminar.type = 'submit';
                btnEliminar.className = 'btn-eliminar';
                btnEliminar.textContent = 'Eliminar';
                
                formEliminar.appendChild(inputOculto);
                formEliminar.appendChild(btnEliminar);
                tdAcciones.appendChild(formEliminar);

                tr.appendChild(tdAcciones);
            }

            tbody.appendChild(tr);
        });
    }
});