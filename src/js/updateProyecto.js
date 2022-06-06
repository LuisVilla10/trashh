const actualizarProyecto = () => {
    const updateData = document.querySelector('#modal-id');

    const id = updateData.dataset.id;
    const nombre = document.querySelector('#nombre').value;
    const status = document.querySelector('#status').value;
    const contratista = document.querySelector('#contratista').value;
    let fechadc = document.querySelector('#fechadc').value.replaceAll("-", "/");

    if (nombre.trim() === "") {
        mostrarAlerta("No dejes el nombre vacio");
        return;
    }

    fechadc = fechadc.split('/');
    fechadc = fechadc.reverse();
    fechadc = fechadc.join('/');

    fetch('/src/php/functions/update-proyecto.php',{
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            id,
            nombre,
            status,
            fechadc,
            contratista,
        }),
    })
    .then((res) => res.text())
    .then((res) => {
        try {
            const response = JSON.parse(res);
            if (response.success) {
                location.reload();
            }
        } catch (e) {
            console.log(e);
            mostrarAlerta("No se pudo conectar con la base de datos");
        }
    })
    .catch((err) => {
        console.log(err);
        mostrarAlerta("No se pudo conectar con el servidor");
    });
}

function cargarClientes(correo){
    var clientes = document.getElementById("contratista");
    axios.get('/src/php/functions/consultarClientes.php')
    .then(function(res) {
        if(res.data.success){
                var arreglo=res.data.clientes;
                arreglo.forEach(cliente => {
                var value = "";
                if(correo == cliente.correo){
                    value = "selected";
                };
                str='<option value="' + cliente.correo + '" '+ value + '>' + cliente.nombre + '</option>';
                clientes.innerHTML += str;
            });
        }
    })
    .catch(function(err) {
        console.log(err);
    });
}