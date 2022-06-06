<?php

header('Content-Type: application/json');

//Para poder trabajar con las clases se importa todo de las clases
require_once('../classes/importar-clases.php');

//borrar desupés (Código para desplegar errores)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  //recuperacion de la solicitud POST

  $resultado = json_decode(file_get_contents("php://input"));


  if((!isset($resultado->id)) || (!isset($resultado->causa)) || (!isset($resultado->solucion)) || (!isset($resultado->tiempo_consumido))) {
    // Si no están completos envío un mensaje de error
    $resultado = ['success' => false, 'errorCode' => 'INCOMPLETE_PARAMETERS', 'errorMessage' => 'Campos vacios favor de ingresar datos completos'];
    echo json_encode($resultado);
    die;
  }
} else {
  //Si no es el método correcto envío un mensaje de error
  $resultado = ['success' => false, 'errorCode' => 'BAD_METHOD', 'errorMessage' => 'Falla'];
  echo json_encode($resultado);
  die;
}

session_start();
//Verifico que el usuario sea empleado
if(isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $tipoUsuario = get_class($usuario);
    if(strcmp($tipoUsuario, "Empleado")!==0) {
        //Si no es empleado regreso mensaje de error
        $response = ['success' => false, 'errorCode' => 'FORBIDDEN', 'errorMessage' => 'Este usuario no cuenta con permisos suficientes'];
        echo json_encode($response);
        die;
    }
}

//Recupero parámetros del post
$id = $resultado->id;
$causa = $resultado->causa;
$solucion = $resultado->solucion;
$tiempo_consumido = $resultado->tiempo_consumido;

  
//Para hacer las conexiones a base de datos es con un objeto de la clase DAO, en la clase DAO hasta arriba dejé el cómo se usa
$dao = new DAO;
if($dao->error != null) {
    //En caso de eror al conectar a base de datos regresa el mensaje de error
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    echo $response;
    die;
}

//Recupero el fallo al que voy a escribirle una bitácora
if(($fallo = $dao->getFalloByID($id)) === FALSE) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => 'No se encontró el fallo con id:' . $id . ". " . $dao->error];
    echo json_encode($response);
    die;
}

//Instancio la bitácora con los datos recibidos
$bitacora = new Bitacora($causa, $solucion, $tiempo_consumido, $usuario, $fallo);

//la creo en base de datos
if($dao->createBitacora($bitacora) === FALSE) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => 'Hubo un problema al guardar la bitacora' . ". " . $dao->error];
    echo json_encode($response);
    die;
}

//Actualizo el status del fallo a reparado ya que la bitácora se escribe cuando se repara el fallo
$fallo->setStatus("reparado");
if($dao->updateFallo($fallo->getID(), $fallo) === false) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => 'Hubo un problema al actualizar el fallo' . ". " . $dao->error];
    echo json_encode($response);
    die;
}

//Si no falló nada regreso el mensaje de éxito
$response = ['success' => true];
echo json_encode($response);





