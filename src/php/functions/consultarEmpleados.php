<?php
//Establece el tipo de contenido que regresará a aplicacion/json
header('Content-Type: application/json');

//importar todas las clases
require_once("../classes/importar-clases.php");
session_start();
if(isset($_SESSION['usuario'])){
    $usuario=$_SESSION['usuario'];
    $tipoUsuario= get_class($usuario);
    $esEmpleado=false;
    if(strcmp($tipoUsuario, "Empleado")===0){
        $esEmpleado=true;
        if(!$usuario->getEsDirector()){
            $response = ['success' => false, 'errorCode' => 'FORBIDDEN', 'errorMessage' => 'Este usuario no cuenta con permisos suficientes'];
            echo json_encode($response);
            die;
        }
    }
}else{
    $response = ['success' => false, 'errorCode' => 'USER_ERROR', 'errorMessage' => 'No Session'];
    echo json_encode($response);
    die;
}

$dao = new DAO;

if($dao->error != null) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    echo json_encode($response);
    die;
}

if(($empleados = $dao->getAll(DAO::EMPLEADO))=== FALSE){
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    echo json_encode($response);
    die;
}

echo json_encode(['success'=> true, 'empleados'=>$empleados]);

?>
