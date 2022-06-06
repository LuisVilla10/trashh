<?php

header('Content-Type: application/json');

//Para poder trabajar con las clases se importa todo de las clases
require_once('../classes/importar-clases.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  //recuperacion de la solicitud POST

  $resultado = json_decode(file_get_contents("php://input"));


  if((!isset($resultado->id)) || (!isset($resultado->contenido))) {
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

if(isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $tipoUsuario = get_class($usuario);
    if(strcmp($tipoUsuario, "Empleado")!==0){
        $response = ['success' => false, 'errorCode' => 'FORBIDDEN', 'errorMessage' => 'Este usuario no cuenta con permisos suficientes'];
        echo json_encode($response);
        die;
    }
}

$id = $resultado->id;
$contenido = $resultado->contenido;

  
//Para hacer las conexiones a base de datos es con un objeto de la clase DAO, en la clase DAO hasta arriba dejé el cómo se usa
$dao = new DAO;
if($dao->error != null) {
  //En caso de eror al conectar a base de datos regresa el mensaje de error
  $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
  echo $response;
  die;
}

if(($fallo = $dao->getFalloByID($id)) === FALSE) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => 'No se encontró el fallo con id:' . $id . ". " . $dao->error];
    echo json_encode($response);
    die;
}

//Obtengo la fecha actual
$time = new DateTime();
$timeZone = new DateTimeZone('America/Mexico_City');
$time->setTimezone($timeZone);

$fecha_actual = $time->format('d-m-Y');

$nota = new Nota($contenido, $fecha_actual, $usuario, $fallo);

if($dao->createNota($nota) === FALSE) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => 'Hubo un problema al guardar la nota' . ". " . $dao->error];
    echo json_encode($response);
    die;
}

$response = ['success' => true];
echo json_encode($response);





