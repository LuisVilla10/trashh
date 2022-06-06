<?php
//Establece el tipo de contenido que regresará a aplicacion/json
header('Content-Type: application/json');

//importar todas las clases
require_once("../classes/importar-clases.php");
session_start();

if(isset($_SESSION['usuario'])){
    $correo=$_SESSION['usuario']->getCorreo();
    $password=$_SESSION['usuario']->getPassword();
    $usuario=$_SESSION['usuario'];
    $tipoUsuario= get_class($usuario);
    $esEmpleado=false;
    if($tipoUsuario=="Empleado"){
        $esEmpleado=true;  
    }
}else{
    $response = ['success' => false, 'errorCode' => 'USER_ERROR', 'errorMessage' => 'No Session'];
    echo json_encode($response);
    die;
}

$tipo;
if($esEmpleado){
    $tipo=0;
    $esDirector=$_SESSION['usuario']->getEsDirector();
    if($esDirector){
        $tipo=1;
    }
}else{
    $tipo=2;
}

$dao = new DAO();
if($dao->error != null) {
    $json = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    echo json_encode($json);
    die;
}

switch ($tipo){
    case 0:
        //empleado
        if(($drafts = $dao -> getProyectosByEmpleado($_SESSION['usuario'])) === false){
            $json = ['success'=>false, 'errorMessage'=>$dao->error, 'errorCode' => 'DB_ERROR' ];
            echo json_encode($json);
            die;
        };
        echo json_encode(["misProyectos" => $drafts]);
        break;
    case 1:
        //director
        if(($drafts = $dao -> getProyectosByEmpleado($_SESSION['usuario'])) === false){
            $json = ['success' => false, 'errorMessage' => $dao -> error, 'errorCode' => 'DB__ERROR' ];
            echo json_encode($json);
            die; 
        };

        if(($alldrafts = $dao -> getAllProyectos()) === false){
            $json = ['success' => false, 'errorMessage' => $dao -> error, 'errorCode' => 'DB_ERROR' ];
            $json = ["data" => "no algo"];
            echo json_encode($json);
            die;
        };
        
        $drafts = utf8ize($drafts);
        $alldrafts = utf8ize($alldrafts);

        echo json_encode(["misProyectos" => $drafts, "todos" => $alldrafts]);
        die;

        break;
    case 2:
        //cliente
        if(($drafts=$dao -> getProyectosByCliente($_SESSION['usuario'])) === false){
            $json = ['success'=>false, 'errorMessage'=>$dao->error, 'errorCode' => 'DB_ERROR' ];
            echo json_encode($json);
            die;
        };
        echo json_encode(["misProyectos"=>$drafts]);
        break;
}

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string($d)) {
        if (strpos($d, "ñ")) {
            $d = str_replace("ñ","n",$d);
            return utf8_encode($d);
        }

        return utf8_encode($d);
    }
    return $d;
}

?>
