var menuSelected = "Mis proyectos"

function intercambiar(element){
    var divCardAll=document.getElementById("Todos los proyectos");
    var divCards=document.getElementById("Mis proyectos");
    if(element.innerHTML=="Todos los proyectos"){
        menuSelected = "Todos los proyectos"
        if(!divCards.classList.contains("visually-hidden")){
            divCards.classList.add("visually-hidden");
            document.getElementById("btn-mis-proyectos").classList.remove("btn-selected");
        }
        divCardAll.classList.remove("visually-hidden");
        element.classList.add("btn-selected");
    }else{
        
        menuSelected = "Mis proyectos"
        if(!divCardAll.classList.contains("visually-hidden")){
            divCardAll.classList.add("visually-hidden");
            document.getElementById("btn-todos-proyectos").classList.remove("btn-selected");
        }
        divCards.classList.remove("visually-hidden");
        element.classList.add("btn-selected");
    }

}
