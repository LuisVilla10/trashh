<?php

// header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  //recuperacion de la solicitud POST

  $resultado = json_decode(file_get_contents("php://input"));


  if((!isset($resultado->nombre)) || (!isset($resultado->oldCorreo)) || (!isset($resultado->correo)) || (!isset($resultado->rfc))) {
      // Si no están completos envío un mensaje de error
      $resultado = ['success' => false, 'errorCode' => 'INCOMPLETE_PARAMETERS', 'errorMessage' => 'Campos vacios favor de llenar todos los campos'];
      echo json_encode($resultado);
      die;
  }
} else {
  //Si no es el correcto envío un mensaje de error
  $resultado = ['success' => false, 'errorCode' => 'BAD_METHOD', 'errorMessage' => 'Error, favor de llenar correctamente los campos'];
  echo json_encode($resultado);
  die;
}
$nombre = $resultado->nombre;
$correo = $resultado->correo;
$oldCorreo = $resultado->oldCorreo;
$rfc = $resultado->rfc;


//Para poder trabajar con las clases se importa todo de las clases
require_once('../classes/importar-clases.php');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

//Para hacer las conexiones a base de datos es con un objeto de la clase DAO, en la clase DAO hasta arriba dejé el cómo se usa
$dao = new DAO;
if($dao->error != null) {
    //En caso de eror al conectar a base de datos regresa el mensaje de error
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    echo json_encode($response);
    die;
}
if(($usuario = $dao->getByID($oldCorreo, DAO::CLIENTE)) === FALSE) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    $response = json_encode($response);

    //envío respuesta 
    echo $response;
    die;
}

$usuario->setNombre($nombre);
$usuario->setCorreo($correo);
$usuario->setRFC($rfc);


if($dao->update($oldCorreo, $usuario) === FALSE) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    $response = json_encode($response);

    //envío respuesta 
    echo $response;
    die;
}

$data = http_build_query(array('usuario' => json_encode($usuario)));
$opciones = array('http' => array('method' => 'POST', 'header' => 'Content-type: application/x-www-form-urlencoded', 'content' => $data));
$context = stream_context_create($opciones);
$url='http://localhost/src/php/templates/cliente-updated.php';
$message = file_get_contents($url, false, $context);


$alternativeText = "";
$alternativeText .= "Se han actualizado sus datos";

$mail = new Mail("Datos Actualizados", $message, $alternativeText);

if(($mail->send($usuario->getCorreo(), $usuario->getNombre())) === FALSE) {
    $response = ["success" => false, "errorCode" => "MAIL_ERROR", "errorMessage" => $mail->error];
    echo json_encode($response);
    die;
}

$response = ['success' => true];
echo json_encode($response);   
?>