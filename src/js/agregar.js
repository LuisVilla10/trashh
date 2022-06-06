function agregar(){
    var url = "../src/php/functions/agregarCliente.php"
    
    
    var name = document.getElementById("nombre")
    var rfc = document.getElementById("rfc")
    var pass = document.getElementById("password")
    var email = document.getElementById("correo")
      if (name.value ==" "|| rfc.value=="" || pass.value=="" || email.value ==""){
          alert("Campos vacios favor de ingresar datos completos ")
      }else{
        var data = {
            nombre : name.value,
            correo : descripcionInput.value, 
            password : fechaInput.value,
            rfc : rfc.value
        }
        //
        agregar(data);
         
      }
     
    axios.post(
        url,
        data
    )
    .then(function (response) {
        console.log(response.data)
    })
    }