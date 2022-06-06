var usuarioLoggeado;
var tipo_de_usuario;
var proyectos = [];
checkLogin()

function editarCliente(id){
    ocultarAlerta("alert_"+id);
    alerta=document.getElementById("alert_"+id)
    
    var correo =document.getElementById("Email_"+id).value
    var nombre =document.getElementById("Nombre_"+id).value
    var oldCorreo =document.getElementById("Old_"+id).value
    var rfc =document.getElementById("RFC_"+id).value
    var oldNombre = document.getElementById("oldNombre_"+id).value
    var oldRFC = document.getElementById("oldRFC_"+id).value

    if(correo.length == 0 || nombre.length == 0 || rfc.length === 0) {
        mostrarAlerta('No puede dejar los campos vacíos',"editar","alert_"+id);
    } else if (correo == oldCorreo && rfc == oldRFC && nombre == oldNombre) {
        mostrarAlerta('Debe hacer cambios en los datos para actualizarlos',"editar","alert_"+id);
    } else {
        if(validateEmail(correo)) {
            mostrarAlerta('Procesando Consulta',"alertValidacion","alert_"+id)
            var url = "src/php/functions/editarCliente.php"
            axios.post(url,{
                oldCorreo : oldCorreo,
                nombre : nombre,
                correo : correo,
                rfc : rfc
            })
            .then(function(response) {
                ocultarAlerta("alert_"+id);
                if(response.data.success) {
                    mostrarAlerta('Actualizado con éxito',"alertValidado","alert_"+id);
                    document.getElementById("Email_"+id).id="Email_"+correo;
                    document.getElementById("Nombre_"+id).id="Nombre_"+correo;
                    document.getElementById("Old_"+id).id="Old_"+correo;
                    document.getElementById("RFC_"+id).id="RFC_"+correo;  
                }else{
                    if(response.data.errorMessage.includes('Duplicate entry')){
                        mostrarAlerta('El usuario ya se encuentra registrado',"error","alert_"+id);
                    }else{
                        if(response.data.errorCode.includes('MAIL_ERROR')){
                            mostrarAlerta('Datos actualizados, pero fallo la notificacion.',"error","alert_"+id); 
                            document.getElementById("Email_"+id).id="Email_"+correo;
                            document.getElementById("Nombre_"+id).id="Nombre_"+correo;
                            document.getElementById("Old_"+id).id="Old_"+correo;
                            document.getElementById("ValorEsDirector_"+id).id="ValorEsDirector_"+correo;  
                        }else{
                            mostrarAlerta('Estamos teniendo problemas. Intente de nuevo más tarde.',"error","alert_"+id); 
                        }
                       
                    }
                     
                }
            });
        }else{
            mostrarAlerta('El correo ingresado no es válido',"editar","alert_"+id);  
        }
    }
}

function editarEmpleado(element,id){
    ocultarAlerta("alert_"+id);
    alerta=document.getElementById("alert_"+id);
    
    var correo =document.getElementById("Email_"+id).value;
    var nombre =document.getElementById("Nombre_"+id).value;
    var OldCorreo =document.getElementById("Old_"+id).value;
    var esDirector =document.getElementById("ValorEsDirector_"+id).value;
    if(esDirector=="Director"){
        esDirector="1";
    }else{
        esDirector="0";
    }

    if(correo.length==0||nombre.length==0){
        mostrarAlerta('Revise los datos',"editar","alert_"+id);
    }else{
        if(validateEmail(correo)){
            mostrarAlerta('Procesando Consulta',"alertValidacion","alert_"+id);
            var url = "src/php/functions/editarEmpleado.php"
            axios.post(url,{
                id,
                nombre : nombre,
                correo : correo,
                OldCorreo : OldCorreo,
                esDirector : esDirector
            })
            .then(function(response) {
                ocultarAlerta("alert_"+id);

                if (typeof response.data === "string") {
                    mostrarAlerta("No se pudo conectar con la base de datos");
                    return;
                }

                if(response.data.success){
                    mostrarAlerta('Actualizado',"alertValidado","alert_"+id);
                    document.getElementById("Email_"+id).id="Email_"+correo;
                    document.getElementById("Nombre_"+id).id="Nombre_"+correo;
                    document.getElementById("Old_"+id).id="Old_"+correo;
                    document.getElementById("ValorEsDirector_"+id).id="ValorEsDirector_"+correo;
                    document.getElementById("deleteButtom_"+id).id="deleteButtom_"+correo;   
                }else{
                    console.log("Errores");
                    if(response.data.errorMessage.includes('Duplicate entry')){
                        mostrarAlerta('Accion no realizada: El correo ya existe',"error","alert_"+id);
                    }else{
                        if(response.data.errorCode.includes('MAIL_ERROR')){
                            mostrarAlerta('Datos actualizados, pero fallo la notificacion.',"alertValidado","alert_"+id); 
                            document.getElementById("Email_"+id).id="Email_"+correo;
                            document.getElementById("Nombre_"+id).id="Nombre_"+correo;
                            document.getElementById("Old_"+id).id="Old_"+correo;
                            document.getElementById("ValorEsDirector_"+id).id="ValorEsDirector_"+correo; 
                            document.getElementById("deleteButtom_"+id).id="deleteButtom_"+correo; 
                            
                        }else{
                            mostrarAlerta('Ocurrio un Error: '+response.data.errorCode ,"error","alert_"+id); 
                        }
                    }
                }
            })
            .catch((e) => {
                mostrarAlerta("No se pudo conectar con el servidor");
            });
        }else{
            mostrarAlerta('Revise el correo',"editar","alert_"+id);  
        }
    }
}

function alternarEsDirector(element,id){
    if(element.classList.contains("status-Director")){
        element.classList.remove("status-Director");
        element.classList.add("status-No-Director");
        document.getElementById("ValorEsDirector_"+id).value="NoDirector";
    }else{
        element.classList.add("status-Director");
        element.classList.remove("status-No-Director");
        document.getElementById("ValorEsDirector_"+id).value="Director";
    }
}
function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }
function eliminarEmpleado(element,id){
    
    alerta=document.getElementById("alert_"+id);
    ocultarAlerta("alert_"+id);
    //
        mostrarAlerta('Seguro que desea eliminar al empleado?',"confirmar","alert_"+id);
        var aConfirmar=document.createElement("a");
        aConfirmar.innerHTML="&nbsp Confirmar  &nbsp";
        aConfirmar.setAttribute("onclick","delEmpleado('"+id+"')");
        aConfirmar.setAttribute("class","confirmar_Eliminacion");
        var aCancelar=document.createElement("a");
        aCancelar.innerHTML="&nbsp Cancelar &nbsp";
        aCancelar.setAttribute("onclick","cancelar_Eliminacion('"+id+"')");
        aCancelar.setAttribute("class","cancelar_Eliminacion");
        console.log(aCancelar);
        var alerta=document.getElementById("alert_"+id);
        alerta.appendChild(aConfirmar);
        alerta.appendChild(aCancelar);
}

function delEmpleado(id){
    var correo =document.getElementById("Old_"+id).value;
    ocultarAlerta("alert_"+id);
        //eliminar
        var url = "src/php/functions/eliminarEmpleado.php"
        axios.post(url,{
            correo : correo
        })
        .then(function(response) {
            if(response.data.success){
                mostrarAlerta('Empleado a sido eliminado',"alertValidado","alert_"+id);
                document.getElementById("deleteButtom_"+id).parentNode.classList.add("visually-hidden");
            }else{
                mostrarAlerta('No se pudo conectar con la base de datos',"error","alert_"+id);  
            }
        })
        .catch((e) => {
            mostrarAlerta("No se pudo conectar con el servidor");
        });
}
function cancelar_Eliminacion(id){
    ocultarAlerta("alert_"+id);
}

function checkLogin() {
    var url = "src/php/functions/get-session.php"
    axios.get(url)
    .then(function(response) {
        if(response.data.mensaje == "logged") {
            if(window.location.pathname == "/login.html") {
                alert("Usted tiene sesión iniciada, será redirigido a la página principal")
                location.href = "/"
            } else {
                usuarioLoggeado=response.data.usuario;
                tipo_de_usuario=response.data.tipo_de_usuario;
                cargarProyectos()
                cargarDatos()
            }
            
        } else if(window.location.pathname != "/login.html") {

            location.href = "/login.html"
        }
    })
}

function cerrarSesion() {
    location.href = "src/php/functions/close-session"
}

function toggleCargando() {
    if(document.getElementById("cargando").classList.contains("cargando-shadow")) {
        document.getElementById("cargando").classList.remove("cargando-shadow")
    } else {
        document.getElementById("cargando").classList.add("cargando-shadow")
    }
    
}

function esperarCarga() {
    toggleCargando()
    url = "src/php/functions/wait"
    axios.get(url)
    .then(function(response) {
        toggleCargando()
    })
}

function openModal() {
    document.getElementById("modal-id").classList.remove("visually-hidden")

}

function closeModal() {
    document.getElementById("modal-id").classList.add("visually-hidden")
}


function cargarDatos(){
    var h2nombreUsuario =document.getElementById("nombre-usuario");
    var array = usuarioLoggeado.nombre.split(" ");
    let nombre = array[0] + " " + (array[1] !== undefined ? array[1] : "") + " " + (array[2] !== undefined ? array[2] : "");
    
    h2nombreUsuario.innerHTML = nombre.replace(/^\w/, (c) => c.toUpperCase());
}

function cargarProyectos(){
    var ul_Item=document.getElementById("ul_list");
    var esDirector = !!parseInt(usuarioLoggeado.esDirector);
    var tipo=0; //0->cliente 1->empleado 2->director
    var sectionContainerDrafts= document.getElementById("contenedor-proyectos");
    //Creacion div mis proyectos
    var divCards=document.createElement("div");
    divCards.id="Mis proyectos";
    sectionContainerDrafts.appendChild(divCards);
   
    // button to see user data
    const userData = document.querySelector('.user-data');
    userData.addEventListener('click', verUsuario);
    
    if(tipo_de_usuario=="Empleado"){
        document.getElementById("allStatus").classList.remove("visually-hidden");
        tipo = 1;
        if(esDirector){       
            document.getElementById("LiContainsMis").classList.remove("btn-solo");

            // Adding hamburguer menu
            const hamMenuPanel = document.querySelector('.ham-menu-panel');
            const hamMList = hamMenuListTemplate([{
                label: "Clientes",
                action: "verClientes",
            },
            {
                label: "Empleados",
                action: "verEmpleados",
            }]);

            hamMenuPanel.innerHTML = hamMList;
            hamMenuPanel.parentNode.style.display = 'flex';

            // Agregar proyecto option
            const accionAddProyectos=document.createElement("div");
            accionAddProyectos.classList.add('material-icons');
            accionAddProyectos.classList.add('md-48');
            accionAddProyectos.classList.add('md-light');
            accionAddProyectos.classList.add('addProject');
            accionAddProyectos.innerHTML="add";

            accionAddProyectos.setAttribute("onclick","addProyecto()");
            //onclick
            document.querySelector('main').appendChild(accionAddProyectos);

            // Panel de mirar todos los proyectos
            var li_TodosLosProyectos=document.createElement("li");
            li_TodosLosProyectos.id="Todos los proyectosLI";
            li_TodosLosProyectos.classList.add('f');
            li_TodosLosProyectos.classList.add('f-center');

            var a_TodosLosProyectos=document.createElement("a");
            a_TodosLosProyectos.classList.add("btn");
            a_TodosLosProyectos.classList.add("btn-section");
            a_TodosLosProyectos.id="btn-todos-proyectos";
            a_TodosLosProyectos.setAttribute("onclick","intercambiar(this)");
            a_TodosLosProyectos.innerHTML="Todos los proyectos";

            li_TodosLosProyectos.appendChild(a_TodosLosProyectos);
            ul_Item.appendChild(li_TodosLosProyectos);
            tipo=2;

            //Creacion div todos los proyectos
            var divCardAll=document.createElement("div");
            divCardAll.id="Todos los proyectos";
            divCardAll.classList.add("visually-hidden");
            sectionContainerDrafts.appendChild(divCardAll);
        }
    }else{        
        tipo=0;
    }
    // Avisar que está cargando
    var loadingCard = document.createElement("div");
    loadingCard.classList.add("project-card");
    loadingCard.innerHTML="<p>Cargando proyectos...</p>";
    divCards.appendChild(loadingCard);

    axios.get('/src/php/functions/regresarTodosLosProyectos.php')
    .then(function(res) {
        divCards.removeChild(loadingCard)
        // Falta obtener el contratista de cada draft, lo que causa un error al ejecutar el for each
        const mydrafts = res.data.misProyectos;

        if(mydrafts.length === 0){
            var divProjectCard = document.createElement("div");
            divProjectCard.classList.add("project-card");
            divProjectCard.innerHTML="<p>No hay proyectos que mostrar</p>";
            divCards.appendChild(divProjectCard);
        }else{
            mydrafts.forEach(draft => {
                // card container
                var divProjectCard = document.createElement("div");
                divProjectCard.classList.add("project-card");
                divProjectCard.id=draft.id;

                var divProjectTittle = document.createElement("div");
                divProjectTittle.classList.add("project-title");
                divProjectTittle.innerHTML = draft.nombre;

                var divProjectBody = document.createElement("div");
                divProjectBody.classList.add("project-body");

                var divProjectStatus = document.createElement("div");
                divProjectStatus.classList.add("project-status");
                    var spanStatus = document.createElement("span");
                    let proyStatus = getCleanedString(draft.status);
                    console.log(proyStatus);
                    var claseStatus ="status-"+draft.status.replace(' ','-');
                    spanStatus.classList.add(claseStatus);
                divProjectStatus.appendChild(spanStatus);

                var divProjectData =document.createElement("div");
                divProjectData.classList.add("project-data");
                    var divProjectOwner =document.createElement("div");
                    divProjectOwner.classList.add("project-owner");
                        var h4Cliente =document.createElement("h4");
                        h4Cliente.innerHTML="Cliente: ";
                        var pCliente =document.createElement("p");
                        pCliente.innerHTML = draft.contratista.nombre;
                    divProjectOwner.appendChild(h4Cliente);
                    divProjectOwner.appendChild(pCliente);
                    var divProjectDate =document.createElement("div");
                    divProjectDate.classList.add("project-owner");
                        var h4Date =document.createElement("h4");
                        h4Date.innerHTML="Contratacion: ";
                        var pDate =document.createElement("p");
                        pDate.innerHTML=draft.fecha_de_contratacion;
                    divProjectDate.appendChild(h4Date);
                    divProjectDate.appendChild(pDate);
                divProjectData.appendChild(divProjectOwner);
                divProjectData.appendChild(divProjectDate);

                var divButtomContainer = document.createElement("div");
                divButtomContainer.classList.add("btn-container");
                    var abtn = document.createElement("a");
                    abtn.classList.add("btn");
                    abtn.classList.add("btn-details");

                if(tipo==0){
                    abtn.innerHTML="Reportar Fallo";
                    //onclick
                    abtn.setAttribute("onclick", "reportarFallo('" + draft.id + "','" + draft.nombre + "')");
                }else{
                    abtn.innerHTML="Ver fallos";
                    var user = usuarioLoggeado.correo;
                    abtn.setAttribute("onclick", "verFallos('" + draft.id + "')");
                    //onclick
                    divProjectBody.appendChild(divProjectStatus);

                }
                divButtomContainer.appendChild(abtn);
                divProjectBody.appendChild(divProjectTittle);
                divProjectBody.appendChild(divProjectData);
                divProjectBody.appendChild(divButtomContainer);
                divProjectCard.appendChild(divProjectBody);
                divCards.appendChild(divProjectCard);

            });
        }
        if(res.data.todos !== undefined){
            var alldrafts = res.data.todos;
            if(alldrafts.length === 0) {
                var divProjectCard = document.createElement("div");
                divProjectCard.classList.add("section-content");
                divProjectCard.innerHTML="<p>No hay proyectos que mostrar</p>";
                alldrafts.appendChild(divProjectCard);
            }else{
                alldrafts.forEach(draft => {
                    //proyecto = draft;
                    proyectos.push(draft);
                    var divProjectCard = document.createElement("div");
                    divProjectCard.classList.add("project-card");
                    divProjectCard.id=draft.id;

                    var divProjectTittle = document.createElement("div");
                    divProjectTittle.classList.add("project-title");
                    divProjectTittle.innerHTML=draft.nombre;

                    var divProjectBody = document.createElement("div");
                    divProjectBody.classList.add("project-body");

                    var divProjectStatus = document.createElement("div");
                    divProjectStatus.classList.add("project-status");
                        var spanStatus = document.createElement("span");
                        var claseStatus ="status-"+draft.status.replace(' ','-');
                        spanStatus.classList.add(claseStatus);
                    divProjectStatus.appendChild(spanStatus);

                    var divProjectData =document.createElement("div");
                    divProjectData.classList.add("project-data");
                        var divProjectOwner =document.createElement("div");
                        divProjectOwner.classList.add("project-owner");
                            var h4Cliente =document.createElement("h4");
                            h4Cliente.innerHTML="Cliente: ";
                            var pCliente =document.createElement("p");
                            pCliente.innerHTML=draft.contratista.nombre;
                        divProjectOwner.appendChild(h4Cliente);
                        divProjectOwner.appendChild(pCliente);
                        var divProjectDate =document.createElement("div");
                        divProjectDate.classList.add("project-owner");
                            var h4Date =document.createElement("h4");
                            h4Date.innerHTML="Contratacion: ";
                            var pDate =document.createElement("p");
                            pDate.innerHTML=draft.fecha_de_contratacion;
                        divProjectDate.appendChild(h4Date);
                        divProjectDate.appendChild(pDate);
                    divProjectData.appendChild(divProjectOwner);
                    divProjectData.appendChild(divProjectDate);
                    
                    var divButtomContainer = document.createElement("div");
                    divButtomContainer.classList.add("btn-container");
                        var abtn = document.createElement("a");
                        abtn.classList.add("btn");
                        abtn.classList.add("btn-details");

                    if(tipo==0){
                        abtn.innerHTML="Reportar Fallo";
                        //onclick
                    }else{
                        abtn.innerHTML="Ver fallos";
                        //onclick
                        abtn.setAttribute("onclick", "verFallos('" + draft.id + "', true)");
                        
                        var eBtn = document.createElement("a");
                        eBtn.classList.add("btn");
                        eBtn.classList.add("btn-details");
                        eBtn.innerHTML="Editar";
                        //onclick
                        eBtn.setAttribute("onclick","updateProyecto('"+draft.id+"')");

                        divProjectBody.appendChild(divProjectStatus);


                    }
                    divButtomContainer.appendChild(abtn);
                    divButtomContainer.appendChild(eBtn);
                    divProjectBody.appendChild(divProjectStatus);
                    divProjectBody.appendChild(divProjectTittle);
                    divProjectBody.appendChild(divProjectData);
                    divProjectBody.appendChild(divButtomContainer);
                    divProjectCard.appendChild(divProjectBody);
                    divCardAll.appendChild(divProjectCard);
                });
            }  
        }
    })
    .catch(function(err) {
        console.log(err);
    });
}

//Funciones modal Empleado
function mostrarAlerta(mensaje, clase, id) {
    if(id != undefined) {
        var alerta = document.getElementById(id)
    } else {
        var alerta = document.getElementById("alerta")
    }
    alerta.classList.remove("visually-hidden")
    if(clase != undefined) {
        alerta.classList.add(clase)
    }
    alerta.innerHTML = mensaje;
    // url = "/src/php/functions/wait.php?segundos=10"
    // axios.get(url)
    // .then(function(response) {
    //     if(id != undefined) {
            
    //         ocultarAlerta(id, 'main_alert')
    //     } else {
    //         ocultarAlerta()
    //     }
    // })
}

function ocultarAlerta(id, clase) {
    if(id != undefined) {
        var alerta = document.getElementById(id)
    } else {
        var alerta = document.getElementById("alerta")
    }
    alerta.classList = "";
    alerta.classList.add("visually-hidden")
    alerta.classList.add("alert")
    if(clase != undefined) {
        alerta.classList.add(clase)
    }
    alerta.innerHTML = ""
}

function verEmpleados(){
    url = "/src/php/functions/consultarEmpleados.php";
    //Recupero los empleados
    axios.get(url).then(function(response) {
        if(response.data.success) {
            //Cargo el contenedor donde estarán todos los empleados
            var url = "/src/php/templates/ver-empleados-container.php";
            axios.get(url)
            .then(function(respuesta) {
                document.getElementById("modal-container").innerHTML = respuesta.data
                var empleados = response.data.empleados
                url = "/src/php/templates/empleado-card.php"
                var contenedorempleados = document.getElementById("contenedor-Empleados")
                //En caso de que sí haya empleados
                if(empleados.length > 0) {
                    //Itero en el arreglo de empleados 
                    empleados.forEach(empleado => {
                        data = {
                            empleado: empleado
                        }
                        //Obtengo el html de cada carta de fallo 
                        axios.post(url, data)
                        .then(function(res) {
                            //Inserto la carta de fallo en el html
                            document.getElementById("contenedor-Empleados").innerHTML += res.data
                        })
                    })
                } else {
                    //Muestro en caso de que no haya fallos
                    contenedorempleados.innerHTML += '<div class="project-card">No hay empleados qué mostrar</div>'
                }
                openModal()
            })
        } else {
            mostrarAlerta("No se pudo conectar con la base de datos", undefined, "main-alert")
        }
    })
    .catch(function(err) {
        mostrarAlerta("No se pudo conectar con el servidor", undefined, "main-alert")
    })
}

function verUsuario(){
    var url = "/src/php/templates/verDatos.php";
    const data = {
        usuarioLoggeado: usuarioLoggeado, 
        tipo_de_usuario: tipo_de_usuario
    }

    axios.post(url, data)
    .then(function(respuesta) {
        document.getElementById("modal-container").innerHTML = respuesta.data
        openModal();
    })
    .catch((e) => {
        console.log(e);
        mostrarAlerta("No se pudo conectar con el servidor", undefined, "main-alert");
    });
}

function addProyecto(){
        var url = "/src/php/templates/agregarProyecto.php";
        axios.get(url)
    .then(function(respuesta) {
        document.getElementById("modal-container").innerHTML = respuesta.data
        openModal()
        cargarClientes()
    })
}

function updateProyecto(id){
    var url = "/src/php/templates/update-proyecto.php?id=" + id;
    var proyecto = proyectos.find(function(proyect){
        return proyect.id == id;
    });
    data = {proyecto: proyecto}
    axios.post(url, data)
.then(function(respuesta) {
    document.getElementById("modal-container").innerHTML = respuesta.data
    cargarClientes(proyecto.contratista.correo)
    openModal()
})
}

function eliminarCliente(element,id){
    
    alerta=document.getElementById("alert_"+id);
    ocultarAlerta("alert_"+id);
    //
        mostrarAlerta('Seguro que desea eliminar al cliente?',"confirmar","alert_"+id);
        var aConfirmar=document.createElement("a");
        aConfirmar.innerHTML="&nbsp Confirmar  &nbsp";
        aConfirmar.setAttribute("onclick","delCliente('"+id+"')");
        aConfirmar.setAttribute("class","confirmar_Eliminacion");
        var aCancelar=document.createElement("a");
        aCancelar.innerHTML="&nbsp Cancelar &nbsp";
        aCancelar.setAttribute("onclick","cancelar_Eliminacion('"+id+"')");
        aCancelar.setAttribute("class","cancelar_Eliminacion");
        console.log(aCancelar);
        var alerta=document.getElementById("alert_"+id);
        alerta.appendChild(aConfirmar);
        alerta.appendChild(aCancelar);
}
function delCliente(id){
    var correo =document.getElementById("Old_"+id).value;
    ocultarAlerta("alert_"+id);
    //eliminar
    var url = "src/php/functions/eliminarCliente.php"
    axios.post(url,{
        correo : correo
    })
    .then(function(response) {
        if(response.data.success){
            mostrarAlerta('El cliente ha sido eliminado',"alertValidado","alert_"+id);
            document.getElementById("deleteButtom_"+id).parentNode.classList.add("visually-hidden");
        }else{
            mostrarAlerta('No se pudo conectar con la base de datos',"error","alert_"+id);  
        }
    })
    .catch((e) => {
        mostrarAlerta('No se pudo conectar con el servidor');
    });
}

function agregarEmpleadoForm(){
    url = "/src/php/templates/agregar-empleado-form.php";
    axios.get(url)
    .then(function(respuesta) {
        document.getElementById("modal-container").innerHTML = respuesta.data
        openModal()
    })
}

function agregarCliente(){
    url = "/src/php/templates/agregar-cliente-form.php";
    axios.get(url)
    .then(function(respuesta) {
        document.getElementById("modal-container").innerHTML = respuesta.data
        openModal()
    })
}

function getCleanedString(cadena){
   // Definimos los caracteres que queremos eliminar
   var specialChars = "!@#$^&%*()+=-[]\/{}|:<>?,.";

   // Los eliminamos todos
   for (var i = 0; i < specialChars.length; i++) {
       cadena= cadena.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
   }   

   // Lo queremos devolver limpio en minusculas
   cadena = cadena.toLowerCase();

   // Quitamos espacios y los sustituimos por _ porque nos gusta mas asi
   cadena = cadena.replace(/ /g,"_");

   // Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
   cadena = cadena.replace(/á/gi,"a");
   cadena = cadena.replace(/é/gi,"e");
   cadena = cadena.replace(/í/gi,"i");
   cadena = cadena.replace(/ó/gi,"o");
   cadena = cadena.replace(/ú/gi,"u");
   cadena = cadena.replace(/ñ/gi,"n");
   return cadena;
}
