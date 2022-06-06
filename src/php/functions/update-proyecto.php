<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  //recuperacion de la solicitud POST

  $resultado = json_decode(file_get_contents("php://input"));


  if((!isset($resultado->nombre)) || (!isset($resultado->status)) || (!isset($resultado->id)) || (!isset($resultado->fechadc)) || (!isset($resultado->contratista))) {
      // Si no están completos envío un mensaje de error
      $resultado = ['success' => false, 'errorCode' => 'INCOMPLETE_PARAMETERS', 'errorMessage' => 'Campos vacios favor de ingresar datos completos'];
      echo json_encode($resultado);
      die;
  }
} else {
  //Si no es el correcto envío un mensaje de error
  $resultado = ['success' => false, 'errorCode' => 'BAD_METHOD', 'errorMessage' => 'Falla'];
  echo json_encode($resultado);
  die;
}
//Para poder trabajar con las clases se importa todo de las clases
require_once('../classes/importar-clases.php');

$nombre = $resultado->nombre;
$status = $resultado->status;
$id = $resultado->id;
$fecha_de_contratacion =$resultado->fechadc;
$contratista =$resultado->contratista;

  
//Para hacer las conexiones a base de datos es con un objeto de la clase DAO, en la clase DAO hasta arriba dejé el cómo se usa
$dao = new DAO;
if($dao->error != null) {
  //En caso de eror al conectar a base de datos regresa el mensaje de error
  $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
  json_encode($response);
  die;
}

$tipo = DAO::PROYECTO;

if(($proyecto = $dao->getByID($id, $tipo)) === false) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    
    json_encode($response);
    die;
}

if(($cliente = $dao->getByID($contratista, DAO::CLIENTE)) === FALSE) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    json_encode($response);
    die;
}

$proyecto->setNombre($nombre);
$proyecto->setStatus($status);
$proyecto->setID($id);
$proyecto->setFechaDeContratacion($fecha_de_contratacion);
$proyecto->setContratista($cliente);

if($dao->updateProyecto($id, $proyecto) === FALSE) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    
    json_encode($response);
    die;
}

$response = ['success' => true];
echo json_encode($response);
?>
