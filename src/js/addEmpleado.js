function addEmpleado() {
    ocultarAlerta()
    var nombre = document.getElementById("nombre").value;
    var correo = document.getElementById("email").value;
    var pass = document.getElementById("password").value;
    var esDirector = document.getElementById("isDirector").value;

    if(nombre == "" || correo == "" || pass == "" || esDirector == "") {
        mostrarAlerta("Rellene todos los campos")
        return;
    }
    if(!validateEmail(correo)) {
        mostrarAlerta("Ingrese un correo válido")
        return;
    }

    if(pass.length < 8) {
        mostrarAlerta("La contraseña debe ser de almenos 8 caracteres")
        return;
    }
    mostrarAlerta("Agregando empleado...", "alertValidacion")
    axios.post('/src/php/functions/agregarEmpleado.php', 
        {
        nombre: nombre,
        correo: correo,
        password: pass,
        esDirector: esDirector
        }
    )
    .then(function(res) {
        ocultarAlerta()
        console.log(res)
        if(res.data.success) {
            mostrarAlerta("El empleado ha sido agregado.", "alertValidado")
            return
        } else if(res.data.errorCode == "DUPLICATED") {
            console.log("DUPLICATED")
            mostrarAlerta("El correo ya se encuentra registrado")
            return
        } else if(res.data.errorCode == "MAIL_ERROR") {
            mostrarAlerta("Empleado guardado, pero falló la notificacion por correo. Comuníquese directamente con el empleado para darle los detalles de su nueva cuenta")
            return
        } else {
            mostrarAlerta("Estamos teniendo problemas, intente de nuevo más tarde")
            return
        }
    })
    .catch(function(err) {
        console.log(err);
    });
}