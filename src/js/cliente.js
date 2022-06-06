
var clientes = [];

function reportarFallo(id, nombre) {
    console.log(id)
    var url = "/src/php/templates/reportar-fallo-form.php?nombre=" + nombre + "&id=" + id
    axios.get(url)
    .then(function(response) {
        document.getElementById("modal-container").innerHTML = response.data
        establecerFechaDeInput()
        ocultarAlerta()
        openModal()
    })
}

function enviarReporte(data) {
    var url = "../src/php/functions/reportar-fallo.php"
    ocultarAlerta()
    mostrarAlerta("Cargando...", "alertValidacion")
   
    axios.post(url, data)
    .then(function (response) {
        ocultarAlerta()
        console.log(response);

        if (typeof response.data === "string") {
            mostrarAlerta("No se estableció una conexión con la base de datos");
            return;
        }

        if(response.data.errorCode == "MAIL_ERROR") {
            mostrarAlerta("El reporte fue enviado", "alertValidado");
            return;
        }

        mostrarAlerta("Reporte enviado!", "alertValidado")
        var contenido = document.getElementById("formulario")
        contenido.innerHTML = ""

        var p = document.createElement("p")
        p.innerHTML = "Ya puede cerrar esta ventana"
        p.style= "text-align: center;font-size: 1.2em;"
        contenido.appendChild(p)
    })
    .catch((e) => {
        mostrarAlerta("Fallo al intentar conectar con servidor");
    });
}

function validarFormularioReporte() {

    var fechaInput = document.getElementById("fechaInput")
    var descripcionInput = document.getElementById("descripcionInput")
    var proyecto_id = document.getElementById("proyectoid")

    if(fechaInput.value == "" || descripcionInput.value == "") {
        mostrarAlerta("Rellene el formulario antes de continuar")
    } else {
        var data = {
            proyecto_id : proyecto_id.value,
            descripcion : descripcionInput.value, 
            fecha : fechaInput.value
        }
        //
        enviarReporte(data);
    }

    return false;
}

function establecerFechaDeInput() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
    dd = '0' + dd;
    }

    if (mm < 10) {
    mm = '0' + mm;
    } 
        
    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("fechaInput").setAttribute("max", today);
}


// function mostrarAlerta(mensaje, clase) {
//     var alerta = document.getElementById("alerta")
//     alerta.style.display = ""
//     if(clase != undefined) {
//         alerta.classList.add(clase)
//     }
//     alerta.innerHTML = mensaje
// }

// function ocultarAlerta() {
//     var alerta = document.getElementById("alerta")
//     alerta.classList = "";
//     alerta.style.display = "none"
//     alerta.classList.add("alert")
//     alerta.innerHTML = ""
// }

function verClientes() {
    //Cargo el contenedor donde estarán todos los clientes
    var url = "/src/php/templates/cliente-container.php";
    axios.get(url)
    .then(function(respuesta) {
        document.getElementById("modal-container").innerHTML = respuesta.data
        url = "/src/php/templates/cliente-card.php"
        var contenedorClientes = document.getElementById("contenedor-cliente")
        //En caso de que sí haya clientes
        axios.get('/src/php/functions/consultarClientes.php')
        .then(function(res) {
            console.log(res);
            if (typeof res.data === "string") {
                mostrarAlerta("No se pudo conectar con la base de datos", undefined, "main-alert");
                return;
            }

            if(res.data.success){
                    var clientes = res.data.clientes;
                    if(clientes.length > 0) {
                        //Itero en el arreglo de clientes 
                        clientes.forEach(cliente => {
                            data = {
                                cliente: cliente
                            }
                            //Obtengo el html de cada carta de cliente
                            axios.post(url, data)
                            .then(function(res) {
                                //Inserto la carta de cliente en el html
                                document.getElementById("contenedor-clientes").innerHTML += res.data
                            })
                        })
                    } else {
                        //Muestro en caso de que no haya fallos
                        contenedorClientes.innerHTML += '<div class="project-card">No hay clientes registrados </div>'
                    }
                    openModal()
            }
        })
        .catch((e) => {
            mostrarAlerta("No se pudo conectar con el servidor", undefined, "main-alert");
        });
    })
}

//Ver proyectos del cliente

function verProyectos(id) {
    mostrarAlerta("Cargando proyectos", "alertValidacion")
    //Recupero las proyectos del cliente
    url = "/src/php/functions/consultarProyectosDeCliente.php?id=" + id;
    axios.get(url)
    .then(function(response) {
        ocultarAlerta()
        if(response.data.success) {
            //Cargo el contenedor donde estarán todos los proyectos
            var url = "/src/php/templates/proyectos-container.php";
            axios.get(url)
            .then(function(respuesta) {
                document.getElementById("modal-container").innerHTML = respuesta.data
                var proyectos = response.data.proyectos
                url = "/src/php/templates/proyecto-card.php"
                var contenedorProyectos = document.getElementById("contenedor-proyectos-de-cliente")
                //En caso de que sí haya proyectos
                if(proyectos.length > 0) {
                    //Itero en el arreglo de proyectos 
                    proyectos.forEach(proyecto => {
                        data = {
                            proyecto: proyecto
                        }
                        //Obtengo el html de cada carta de proyecto 
                        axios.post(url, data)
                        .then(function(res) {
                            //Inserto la carta de proyecto en el html
                            document.getElementById("contenedor-proyectos-de-cliente").innerHTML += res.data
                        })
                    })
                } else {
                    //Muestro en caso de que no haya proyectos
                    contenedorProyectos.innerHTML += '<div class="project-card">No hay proyectos qué mostrar</div>'
                }
                openModal()
            })
        } else {
            mostrarAlerta("Hubo un problema al cargar los proyectos, intente de nuevo más tarde.", undefined, "main-alert")
        }
    })
    // .catch(function(err) {
    //     mostrarAlerta("Parace que no tienes conexión, inténtalo de nuevo más tarde", undefined, "main-alert")
    // })
}
