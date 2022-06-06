
var empleadosSelect = []
var empleados = [];

// Ver fallos

function verFallos(id, esDirector) {

    //Defino como quiero recuperar los fallos, como empleado, o como director
    if(esDirector !== undefined) {
        url = "/src/php/functions/consultarFallos.php?id=" + id + "&esDirector=" + true;
    } else {
        url = "/src/php/functions/consultarFallos.php?id=" + id;
    }

    //Recupero los fallos
    axios.get(url)
    .then(function(response) {
        if (typeof response.data === "string") {
            mostrarAlerta("No se pudo conectar con la base de datos", undefined, "main-alert");
            return;
        }
    
        //Cargo el contenedor donde estarán todos los fallos
        var url = "/src/php/templates/fallo-container.php";
        axios.get(url)
        .then(function(respuesta) {
            document.getElementById("modal-container").innerHTML = respuesta.data
            var fallos = response.data.fallos
            url = "/src/php/templates/fallo-card.php"
            var contenedorFallos = document.getElementById("contenedor-fallos")
            //En caso de que sí haya fallos
            if(fallos.length > 0) {
                //Itero en el arreglo de fallos 
                fallos.forEach(fallo => {
                    data = {
                        fallo: fallo
                    }
                    //Obtengo el html de cada carta de fallo 
                    axios.post(url, data)
                    .then(function(res) {
                        //Inserto la carta de fallo en el html
                        document.getElementById("contenedor-fallos").innerHTML += res.data
                    })
                })
            } else {
                //Muestro en caso de que no haya fallos
                contenedorFallos.innerHTML += '<div class="project-card">No hay fallos qué mostrar</div>'
            }
            openModal()
        })
    })
    .catch(function(err) {
        console.log(err);
        mostrarAlerta("No se pudo conectar con el servidor", undefined, "main-alert")
    })
}

function verDetallesFallo(id){
    var fallo;
    let url = "/src/php/functions/obtenerFallo.php?id=" + id
    //Recupero el fallo el cual quiero ver los detalles
    mostrarAlerta("Cargando detalles del fallo.", "alertValidacion")
    axios.get(url)
    .then(function(response) {
        if(response.data.success) {
            fallo = response.data.fallo;
            //Obtengo la vista html para el fallo
            var url = "/src/php/templates/ver-detalles-fallo.php";
            var data = {
                fallo: fallo,
                vista: menuSelected
            }
            axios.post(url, data)
            .then(function(response) {
                //Inserto esa vista en el documento html
                document.getElementById("modal-container").innerHTML = response.data
                openModal()
                // Actualizar estado de fallo

                var falloStatusInput = document.getElementById("status-select")

                if(falloStatusInput != undefined) {
                    falloStatusInput.addEventListener("change", function(event) {
                        var statusSpan = document.getElementById("status-fallo-selected")
                        var classStatus = "status-" + event.target.value.replace(" ", "-")
                        statusSpan.classList = "status " + classStatus
                    })
                }                
            })
            // .catch(function(error) {
            //     mostrarAlerta("Ocurrió un error al tratar de recuperar la información del fallo, intente de nuevo más tarde.")
            // })
        } else {
            mostrarAlerta("Ocurrió un error al tratar de recuperar la información del fallo, intente de nuevo más tarde.")
        }
        
    })
    .catch(function(error) {
        mostrarAlerta("Ocurrió un error al tratar de recuperar la información del fallo, intente de nuevo más tarde.")
    })

    
}


// asignar fallos

function editarAsignaciones(id) {
    var fallo;
    let url = "/src/php/functions/obtenerFallo.php?id=" + id;
    axios.get(url)
    .then(function(response) {
        if(response.data.success) {
            fallo = response.data.fallo;
            var url = "/src/php/templates/editar-asignados.php";
            var data = {
                fallo: fallo
            }
            axios.post(url, data)
            .then(function(response) {
                document.getElementById("modal-container").innerHTML = response.data
                openModal()
                llenarEmpleados(fallo)
            })
        } else {
            mostrarAlerta("Estamos teniendo problemas")
        }
        
    })
}

function llenarEmpleados(fallo) {
    let url = "/src/php/functions/consultarEmpleados.php";
    axios.get(url)
    .then(function(response) {
        if(response.data.success) {
            empleados = response.data.empleados;
            empleados.forEach(element => {
                if(!estaAsignado(element.correo, fallo) === true) {
                    var option = document.createElement("option")
                    option.innerHTML = element.nombre
                    option.value = element.correo

                    document.getElementById("select-empleados").appendChild(option)
                } else {
                    empleadosSelect.push(element.correo)
                    var p = document.createElement("p")
                    p.innerHTML = element.nombre
                    var button = document.createElement("button")
                    button.innerHTML = "Eliminar Asignación"
                    button.setAttribute("onclick", "eliminarAsignacion('" + element.correo + "'" + ")")
                    var div = document.createElement("li")
                    div.classList.add("item-asignados")
                    div.id = element.correo
                    div.appendChild(p)
                    div.appendChild(button)
                    document.getElementById("lista-asignados").appendChild(div)
                }
            })
        }
        

    })
}

function estaAsignado(correo, fallo) {
    var retorno = false
    fallo.asignados.forEach(asignado => {
        if(asignado.correo == correo) {
            retorno = true
        }
    })
    return retorno
}

function añadirEmpleadoAsignados() {
    select = document.getElementById("select-empleados")
    if(!empleadosSelect.includes(select.value)) {
        empleadosSelect.push(select.value)
        empleados.forEach(element => {
            if(element.correo == select.value) {
                var p = document.createElement("p")
                p.innerHTML = element.nombre
                var button = document.createElement("button")
                button.innerHTML = "Eliminar Asignación"
                button.setAttribute("onclick", "eliminarAsignacion('" + select.value + "'" + ")")
                var div = document.createElement("li")
                div.classList.add("item-asignados")
                div.id = select.value
                div.appendChild(p)
                div.appendChild(button)
                document.getElementById("lista-asignados").appendChild(div)
            }
        })
        
    }
}

function eliminarAsignacion(correo) {
    var lista = document.getElementById("lista-asignados")
    lista.removeChild(document.getElementById(correo));
    var i = empleadosSelect.indexOf(correo);
    empleadosSelect.splice(i, 1);
}

function asignarFallo(id) {
    ocultarAlerta();
    let url = "/src/php/functions/asignarFallo.php";
    data = {
        id: id,
        empleados: empleadosSelect
    }
    mostrarAlerta("Actualizando asignaciones...", "alertValidacion");

    axios.post(url, data)
    .then(function(response) {
        ocultarAlerta()
        if(response.data.success) {
            mostrarAlerta("Asignaciones actualizadas", "alertValidado");
            notificarAsignacion(data);
        } else {
            mostrarAlerta("No se pudo conectar a la base de datos");
        }
    })
    .catch((e) => {
        mostrarAlerta("No se pudo conectar al servidor");
    });
}

function notificarAsignacion(data) {
    if(data.empleados.length > 0) {
        let url = "/src/php/functions/notificar-asignacion.php"
        axios.post(url, data)
        .then(function(response) {
            console.log(response);
        })
        .catch((e) => {
            console.log(e);
        });
    }     
}

//Actualizar status de fallo

function actualziarStatusFallo(id) {
    ocultarAlerta()
    mostrarAlerta("Actualizando", "alertValidacion")
    var falloStatusInput = document.getElementById("status-select")
    var options = falloStatusInput.options;

    for(var i = 0; i < options.length; i++) {
        if(options[i].getAttribute("selected") != undefined) {
            var selectedStatus = options[i].value
        }
    }
    nuevoStatus = falloStatusInput.value
    if(nuevoStatus != selectedStatus) {
        let url = "/src/php/functions/update-status-fallo.php"
        let data = {
            id : id,
            status : nuevoStatus
        }
        axios.post(url, data)
        .then(function(response) {
            if(response.data.success) {
                mostrarAlerta("Se ha actualizado es Status del fallo", "alertValidado")
            } else {
                mostrarAlerta("No se pudo conectar a la base de datos");
            }
        })
        .catch((e) => {
            console.log(e);
            mostrarAlerta("Fallo al conectar con el servidor");
        });
    } else {
        ocultarAlerta()
        mostrarAlerta("Es status debe ser distinto al actual")
    }
}

// Ver bitácora

function verNotas(id) {
    mostrarAlerta("Cargando notas", "alertValidacion")
    //Recupero las notas del fallo
    let url = "/src/php/functions/consultarNotasDeFallo.php?id=" + id;
    axios.get(url)
    .then(function(response) {
        console.log(response);
        ocultarAlerta()
        if(response.data.success) {
            //Cargo el contenedor donde estarán todos los notas
            var url = "/src/php/templates/notas-container.php";
            axios.get(url)
            .then(function(respuesta) {
                document.getElementById("modal-container").innerHTML = respuesta.data
                var notas = response.data.notas
                let url = "/src/php/templates/nota-card.php"
                var contenedorNotas = document.getElementById("contenedor-notas")
                //En caso de que sí haya notas
                if(notas.length > 0) {
                    //Itero en el arreglo de notas 
                    notas.forEach(nota => {
                        data = {
                            nota: nota
                        }
                        //Obtengo el html de cada carta de nota 
                        axios.post(url, data)
                        .then(function(res) {
                            //Inserto la carta de nota en el html
                            document.getElementById("contenedor-notas").innerHTML += res.data
                        })
                    })
                } else {
                    //Muestro en caso de que no haya notas
                    contenedorNotas.innerHTML += '<div class="project-card">No hya notas qué mostrar</div>'
                }
                openModal()
            })
        } else {
            mostrarAlerta("Hubo un problema al cargar los notas, intente de nuevo más tarde.", undefined, "main-alert")
        }
    })
    .catch(function(err) {
        mostrarAlerta("Parace que no tienes conexión, inténtalo de nuevo más tarde", undefined, "main-alert")
    })
}

//Ver bitácora

function verBitacora(id) {
    mostrarAlerta("Cargando bitácora", "alertValidacion")
    //Recupero las notas del fallo
    let url = "/src/php/functions/consultarBitacoraDeFallo.php?id=" + id;
    axios.get(url)
    .then(function(response) {
        ocultarAlerta()
        if(response.data.success) {
            //Cargo el contenedor donde estarán todos los notas
            var url = "/src/php/templates/bitacora-container.php";
            var bitacora = response.data.bitacora
            data = {
                bitacora: bitacora
            }
            
            //Obtengo el html de cada carta de nota 
            axios.post(url, data)
            .then(function(respuesta) {
                document.getElementById("modal-container").innerHTML = respuesta.data
                openModal()
            })
        } else {
            console.log(response);
            if (typeof response.data === "string") {
                mostrarAlerta("No se pudo conectar con la base de datos")
            }   
        }
    })
    .catch(function(err) {
        mostrarAlerta("no se pudo conectar con el servidor");
    })
}
