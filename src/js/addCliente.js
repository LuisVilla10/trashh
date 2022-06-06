function addCliente() {
    ocultarAlerta()
    var nombre = document.getElementById("nombre").value;
    var correo = document.getElementById("email").value;
    var pass = document.getElementById("password").value;
    var rfc =document.getElementById("rfc").value;

    if(nombre === "" || correo === "" || pass === "" || rfc === "" ) {
        mostrarAlerta("Rellene todos los campos");
        return;
    }
    if(!validateEmail(correo)) {
        mostrarAlerta("Ingrese un correo válido");
        return;
    }

    if(pass.length < 8) {
        mostrarAlerta("La contraseña debe ser de almenos 8 caracteres")
        return;
    }
    mostrarAlerta("Agregando Cliente...", "alertValidacion")
    axios.post('/src/php/functions/agregarCliente.php', {
        nombre,
        correo,
        password: pass,
        rfc,
        }
    )
    .then(function(res) {
        ocultarAlerta()
        console.log(res)
        if(res.data.success) {
            mostrarAlerta("El cliente ha sido agregado.", "alertValidado")
            return
        } else if(res.data.errorCode == "DUPLICATED") {
            console.log("DUPLICATED")
            mostrarAlerta("El correo ya se encuentra registrado")
            return
        } else {
            mostrarAlerta("Error en base de datos", "error");
            return
        }
    })
    .catch(function(err) {
        console.log(err);
        mostrarAlerta("Error en servidor", "error");
    });
}