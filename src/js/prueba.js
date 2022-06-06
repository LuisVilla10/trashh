


function timer(segundos) {
    temp = new Timer("time", segundos)
    temp.conteo()
}

function Timer(id, inicio) {
    this.id = id
    this.inicio = inicio
    this.contador = inicio 

    this.conteo = function() {
        if(this.contador < 0) {
            this.conteo = null
            return
        }

        document.getElementById(this.id).innerHTML = this.contador--
        setTimeout(this.conteo.bind(this), 1000)
    }
}
