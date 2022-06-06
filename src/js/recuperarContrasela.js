var submit = document.getElementById("submit")
var correo

function validarCorreo() {
    ocultarAlerta();
    correo = document.getElementById("correo");
    if(correo.value == "") {
        mostrarAlerta("Ingrese su correo antes de continuar");
        return false;
    }

    mostrarAlerta("Validando", "alertValidacion")
    url = "/src/php/functions/send-code.php?correo=" + correo.value;
    axios.get(url)
    .then(function(response) {
        ocultarAlerta();
        if (typeof response.data === "string") {
            mostrarAlerta("No se pudo conectar con la base de datos");
            return;
        }

        if(response.data.success) {
            solicitarCodigo();
        } else if(response.data.errorCode == "NO_MATCH") {
            mostrarAlerta("Usuario no registrado");
        }
    })
    .catch ((e) => {
        mostrarAlerta("No se pudo conectar con el servidor");
    });
}

function solicitarCodigo() {
    var contenedor = document.getElementById("contenedor")
    contenedor.innerHTML = ""
    var divEntrada = document.createElement("div")
    divEntrada.classList.add("entrada")
    var divEntrada2 = divEntrada
    var alerta = document.createElement("div")
    alerta.classList.add("alert")
    alerta.classList.add("visually-hidden")
    alerta.id = "alerta"
    divEntrada2.appendChild(alerta)
    var p = document.createElement("p")
    p.innerHTML = "Ingrese el código que fue enviado a su correo"
    var codigoInput = document.createElement("input")
    codigoInput.type = "text"
    codigoInput.name = "codigo"
    codigoInput.id = "codigo"
    var codigoLabel = document.createElement("label")
    codigoLabel.innerHTML = "Codigo "
    codigoLabel.for = "codigo"
    var p2 = document.createElement("p")
    p2.innerHTML = "¿No recibió nada? "
    var a = document.createElement("a")
    a.innerHTML = "Vuelva a enviar el código"
    a.id="resend"
    a.setAttribute("onclick", "reenviarCodigo()")
    p2.appendChild(document.createElement("br"))
    p2.appendChild(a)
    submit.setAttribute("onclick", "valdiarCodigo()")

    contenedor.appendChild(p)
    contenedor.appendChild(divEntrada2)
    contenedor.appendChild(codigoLabel)
    contenedor.appendChild(codigoInput)
    contenedor.appendChild(p2)
    var timerLabel = document.createElement("label")
    timerLabel.innerHTML = "Puede volver a enviar un código después de: "
    timerLabel.id = "label-timer"
    var timerSpan = document.createElement("span")
    timerSpan.id = "timer"
    timerLabel.appendChild(timerSpan)
    contenedor.appendChild(timerLabel)
    contenedor.appendChild(document.createElement("br"))
    timer(60)
    var a = document.getElementById("resend")
    a.setAttribute("onclick","")
    a.style.color = "#384553"
    a.style.cursor = "default"
}

function valdiarCodigo() {
    ocultarAlerta()
    codigo = document.getElementById("codigo");
    if(codigo.value == "") {
        mostrarAlerta("No ha ingresado ningún código")
        return false
    }
    mostrarAlerta("Validando", "alertValidacion")
    url = "/src/php/functions/validar-codigo.php";

    axios.post(url, {
        correo: correo.value,
        codigo: codigo.value
    })
    .then(function(response) {
        ocultarAlerta()
        if(response.data.success) {
            solicitarNuevoPass()
        } else {
            mostrarAlerta("Código inválido")
        }
    })
}

function reenviarCodigo() {
    var contenedor = document.getElementById("contenedor")
    var timerLabel = document.createElement("label")
    timerLabel.innerHTML = "Puede volver a enviar un código después de: "
    timerLabel.id = "label-timer"
    var timerSpan = document.createElement("span")
    timerSpan.id = "timer"
    timerLabel.appendChild(timerSpan)
    contenedor.appendChild(timerLabel)
    timer(60)
    var a = document.getElementById("resend")
    a.setAttribute("onclick","")
    a.style.color = "#384553"
    a.style.cursor = "default"
    url = "/src/php/functions/resend-code.php?correo=" + correo.value + "&esEmpleado=" + esEmpleado
    axios.get(url)
    .then(function(response) {
        
        if(response.data.success) {
            mostrarAlerta("Codigo enviado", "alertValidacion")
        } else if(response.data.errorCode == "MAIL_ERROR") {
            mostrarAlerta("Estamos teniendo problemas, intente de nuevo más tarde")
        }
    })
}

function solicitarNuevoPass() {
    var contenedor = document.getElementById("contenedor")
    contenedor.innerHTML = ""
    var divEntrada = document.createElement("div")
    divEntrada.classList.add("entrada")
    var divEntrada2 = document.createElement("div")
    divEntrada2.classList.add("entrada")
    var alerta = document.createElement("div")
    alerta.classList.add("alert")
    alerta.classList.add("visually-hidden")
    alerta.id = "alerta"
    divEntrada2.appendChild(alerta)
    var p = document.createElement("p")
    p.innerHTML = "Ingrese y confirme su nueva contraseña"
    var passwordInput = document.createElement("input")
    passwordInput.type = "password"
    passwordInput.name = "password"
    passwordInput.id = "password"
    var passwordLabel = document.createElement("label")
    passwordLabel.innerHTML = "Contraseña "
    passwordLabel.for = "password"

    var passwordInput2 = document.createElement("input")
    passwordInput2.type = "password"
    passwordInput2.name = "password2"
    passwordInput2.id = "password2"
    var passwordLabel2 = document.createElement("label")
    passwordLabel2.innerHTML = "Confirmar contraseña "
    passwordLabel2.for = "password2"

    submit.setAttribute("onclick", "actualizarPassword()")
    submit.value = "Actualizar contraseña"

    contenedor.appendChild(p)
    contenedor.appendChild(divEntrada2)

    divEntrada.appendChild(passwordLabel)
    divEntrada.appendChild(passwordInput)
    contenedor.appendChild(divEntrada)

    var divEntrada3 = document.createElement("div")
    divEntrada3.classList.add("entrada")

    divEntrada3.innerHTML = ""
    divEntrada3.appendChild(passwordLabel2)
    divEntrada3.appendChild(passwordInput2)
    contenedor.appendChild(divEntrada3)
}

function actualizarPassword() {
    ocultarAlerta()
    password = document.getElementById("password")
    password2 = document.getElementById("password2")

    if((password.value == "") || (password2.value == "")) {
        mostrarAlerta("Rellene todos los campos")
        return false
    }
    if(password.value !== password2.value) {
        mostrarAlerta("Las contraseñas no coinciden")
        return false
    }
    mostrarAlerta("Cargando...", "alertValidacion")
    url = "/src/php/functions/update-password.php"
    axios.post(url, {
        correo: correo.value,
        password: password.value
    })
    .then(function(response) {
        if (typeof response.data === "string") {
            mostrarAlerta("No se pudo conectar con la base de datos");
            return;
        }

        if(response.data.success) {
            mostrarMensajeExito()
        }
    })
    .catch((e) => {
        mostrarAlerta("No se pudo conectar con el servidor");
    });
}

function mostrarMensajeExito() {
    var contenedor = document.getElementById("contenedor")
    contenedor.innerHTML = ""
    var divEntrada = document.createElement("div")
    divEntrada.classList.add("entrada")
    var divEntrada2 = document.createElement("div")
    divEntrada2.classList.add("entrada")
    var alerta = document.createElement("div")
    alerta.classList.add("alert")
    alerta.classList.add("visually-hidden")
    alerta.id = "alerta"

    divEntrada2.appendChild(alerta)
    contenedor.appendChild(divEntrada2)

    submit.value = "Iniciar sesión"
    submit.setAttribute("onclick", "loadLogin()")
    mostrarAlerta("Contraseña actualizada", "alertValidado")
}

function loadLogin() {
    location.href = "/login.html"
}

function timer(segundos) {
    temp = new Timer("timer", segundos)
    temp.conteo()
}

function Timer(id, inicio) {
    this.id = id
    this.inicio = inicio
    this.contador = inicio 

    this.conteo = function() {
        if(this.contador < 0) {
            this.conteo = null
            var a = document.getElementById("resend")
            a.setAttribute("onclick","reenviarCodigo()")
            a.style.color = "#224467"
            a.style.cursor = "pointer"
            var contenedor = document.getElementById("contenedor")
            contenedor.removeChild(document.getElementById("label-timer"))
            return
        }

        document.getElementById(this.id).innerHTML = this.contador--
        setTimeout(this.conteo.bind(this), 1000)
    }
}



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
    alerta.innerHTML = mensaje
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