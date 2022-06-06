document.getElementById("response-output").value= ""

function sendRequest() {
    var url = "http://" + document.getElementById("url-input").value
    var method = document.getElementById("method-input").value
    var status = document.getElementById("status-output")
    var respuesta = document.getElementById("response-output")
    switch (method) {
        case "GET":
            axios.get(url)
            .then(function (response) {
                status.innerHTML = response.status + " ("  + response.statusText + ")"
                if(response.headers["content-type"] == "application/json") {
                    respuesta.value = JSON.stringify(response.data)
                } else {
                    respuesta.value = response.data
                }
            })
            .catch(function (err) {
                status.innerHTML = err
                respuesta.value = ""
            }) 
            break;
        case "POST":
            var json = document.getElementById("json-input").value
            json = JSON.parse(json)
            axios.post(url, json)
            .then(function (response) {
                if(response.headers["content-type"] == "application/json") {
                    respuesta.value = JSON.stringify(response.data)
                } else {
                    respuesta.value = response.data
                }
                status.innerHTML = response.status + " ("  + response.statusText + ")"
            })
            .catch(function (err) {
                status.innerHTML = err
                respuesta.value = ""
            }) 
            break;
    }
    return false;
}

function addAtribute() {
    var json = document.getElementById("json-input")
    var contenido = json.value
    if(contenido == "") {
        contenido = '{\n   "key" : "value"\n}'
    } else {
        contenido = contenido.substring(0, contenido.length -2)
        contenido += ',\n   "key" : "value"\n}'
    }
    json.value = contenido

}

function limpiar() {
    document.getElementById("json-input").value = ""
}

function limpiarOutput() {
    document.getElementById("response-output").value = ""
}