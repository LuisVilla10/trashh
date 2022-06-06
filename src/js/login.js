//Variables
const buttonLogin = document.getElementById("login-button");
const emailLogin = document.getElementById("emailInput");
const passwordLogin = document.getElementById("passwordInput");
const alertaLogin =document.getElementById("alerta");

const welcomeLabel = document.querySelector('.welcome');

const words = ["Bienvenido", "welkom", "bienvenu", "benvenuto", "bem-vinda", "Welcome"];
let intervalCounter = 0;

const changeWelcome = (i) => {
    welcomeLabel.style.opacity = 0;
    setTimeout(() => { welcomeLabel.textContent = words[i] }, 301);
    setTimeout(() => { welcomeLabel.style.opacity = 100; }, 602);
}

setInterval(() => {
    changeWelcome(intervalCounter);
    
    if (intervalCounter === words.length-1) {
        intervalCounter = 0;
    } else {
        intervalCounter++;
    }
}, 2450);

buttonLogin.addEventListener("click", validarCampos);

function validarCampos(e) {
    e.preventDefault();

    alertaLogin.classList.remove("alertValidado");
    let resumen = "";
    let estado=0;

    if (emailLogin.value === "" || passwordLogin.value === "") {
        estado++;
        resumen += "Campos vacios";
    }
    
    if(estado>=1){
        alertaLogin.innerHTML=resumen;
        alertaLogin.classList.remove("visually-hidden");
    }else{
        alertaLogin.innerHTML="";
        alertaLogin.classList.add("visually-hidden");
    }

    if(estado==0){
        resumen = "Validando Credenciales";
        const passwordL = passwordLogin.value;
        const correoL = emailLogin.value;
        
        alertaLogin.innerHTML=resumen;
        alertaLogin.classList.add("alertValidacion");
        alertaLogin.classList.remove("visually-hidden");
        validarLogin(correoL,passwordL);
        
    }
    return false;
}

function validarLogin(correo, pass) {
    axios.post('../../src/php/functions/login.php', {
        correo: correo,
        password: pass
    })
    .then(function(res) {
        if(res.data.success == true){
            
            resumen = "Iniciado";
            alertaLogin.innerHTML = resumen;

            location.href = "/";
        }else{
            switch (res.data.errorCode){
                case "DB_ERROR":
                    resumen = "El Sistema no logra conectarse con la base de datos.";
                    break;
                case "CRED_01":
                    resumen = res.data.errorMessage;
                    break;
                case "CRED_02":
                    resumen = res.data.errorMessage;
                    break;
                case "NO_MATCH":
                    resumen = res.data.errorMessage;
                    break;
                default:
                    resumen = "El Sistema no logra conectarse con la base de datos.";
                    break;
            }
            
            alertaLogin.innerHTML=resumen;
            
            alertaLogin.classList.remove("alertValidacion");
            alertaLogin.classList.remove("visually-hidden");
            
        }
    })
    .catch(function(err) {
        console.log(err);
    });
}
