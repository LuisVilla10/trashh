function agregarProyecto(){
    var nombre = document.getElementById("nombre").value;
    var fechadc =document.getElementById("fechadc").value;
    var contratista = document.getElementById("contratista").value;
    axios.post('/src/php/functions/agregarProyecto.php', {
            nombre,
            fechadc,
            contratista
        }
    )
    .then(function(res) {
        if (typeof res.data === "string") {
            if (res.data.includes("No se puede establecer una conexión")) {
                mostrarAlerta("No se pudo conectar a la base de datos");
                return;
            }

            console.log(res);
            mostrarAlerta("Error desconocido");
            return;
        }

        mostrarAlerta("Proyecto Guardado", "alertValidado");
    })
    .catch(function(err) {
        console.log(err);
        mostrarAlerta("No se pudo conectar al servidor");
    });
}
