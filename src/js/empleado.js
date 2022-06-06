// Comienza Escribir nota

function escribirNota(id) {
    let url  = "/src/php/templates/escribir-nota.php?id=" + id
    axios.get(url)
    .then(function(response) {
        document.getElementById("modal-container").innerHTML = response.data
        ocultarAlerta()
        openModal()
    })
}

function enviarNota() {
    let contenido = document.getElementById("contenido-input").value
    let id = document.getElementById("fallo-id").value

    let url = "/src/php/functions/escribir-nota.php"
    let data = {
        id : id,
        contenido: contenido
    }
    axios.post(url, data)
    .then(function(response) {
        if(response.data.success) {
            document.getElementById("formulario").innerHTML = ""
            mostrarAlerta("Se guardó la nota, ya puede cerrar esta ventana", "alertValidado")
        } else {
            mostrarAlerta("No se pudo conectar con la base de datos");
        }
    })
    .catch((e) => {
        console.log(e);
        mostrarAlerta("Error al conectar con el servidor");
    });

    return false;
}

//Termina Escribir nota

// Comienza Escribir bitacora

function escribirBitacora(id) {
    let url  = "/src/php/templates/escribir-bitacora.php?id=" + id
    axios.get(url)
    .then(function(response) {
        document.getElementById("modal-container").innerHTML = response.data
        ocultarAlerta()
        openModal()
    })
}

function enviarBitacora() {
    let causa = document.getElementById("causa-input").value
    let solucion = document.getElementById("solucion-input").value
    let tiempoConsumido = document.getElementById("tiempo-input").value
    let id = document.getElementById("fallo-id").value

    let url = "/src/php/functions/escribir-bitacora.php"
    let data = {
        id : id,
        causa : causa,
        solucion : solucion,
        tiempo_consumido : tiempoConsumido
    }
    axios.post(url, data)
    .then(function(response) {
        if(response.data.success) {
            document.getElementById("formulario").innerHTML = ""
            mostrarAlerta("Se guardó la bitacora, ya puede cerrar esta ventana", "alertValidado")
        } else {
            mostrarAlerta("No se pudo conectar con la base de datos");
        }
    })
    .catch((e) => {
        console.log(e);
        mostrarAlerta("No se pudo conectar con el servidor");
    });

    return false;
}

//Termina Escribir bitácora