<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  //recuperacion de la solicitud POST

  $request = json_decode(file_get_contents("php://input"));


  if((!isset($request->id)) || (!isset($request->empleados))) {
      // Si no están completos envío un mensaje de error
      $response = ['success' => false, 'errorCode' => 'INCOMPLETE_PARAMETERS', 'errorMessage' => 'Campos vacios favor de ingresar datos completos'];
      echo json_encode($response);
      die;
  }
} else {
  //Si no es el correcto envío un mensaje de error
  $request = ['success' => false, 'errorCode' => 'BAD_METHOD', 'errorMessage' => 'Falla'];
  echo json_encode($resultado);
  die;
}
//Para poder trabajar con las clases se importa todo de las clases
require_once('../classes/importar-clases.php');

$id = $request->id;
$correos = $request->empleados;

  
//Para hacer las conexiones a base de datos es con un objeto de la clase DAO, en la clase DAO hasta arriba dejé el cómo se usa
$dao = new DAO;
if($dao->error != null) {
  //En caso de eror al conectar a base de datos regresa el mensaje de error
  $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
  echo $response;
  die;
}

if(($fallo = $dao->getByID($id, DAO::FALLO)) === FALSE) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    $response = json_encode($response);

    //envío respuesta 
    echo $response;
    die;
}

$asignados = array();

foreach($correos as $correo) {
    if(($empleado = $dao->getByID($correo, DAO::EMPLEADO)) === FALSE) {
        $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
        $response = json_encode($response);
    
        //envío respuesta 
        echo $response;
        die;
    }
    array_push($asignados, $empleado);
}

$fallo->setAsignados($asignados);

if(count($asignados) > 0) {
  $fallo->setStatus("asignado");
} else {
  $fallo->setStatus("notificado");
}

if($dao->update($id, $fallo) === FALSE) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    $response = json_encode($response);

    //envío respuesta 
    echo $response;
    die;
}
$response = ['success' => true];
echo json_encode($response);
?>
