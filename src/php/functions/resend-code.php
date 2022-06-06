<?php
header('Content-Type: application/json');

//importar todas las clases

require_once("../classes/importar-clases.php");

session_start();

$correo = $_GET['correo'];
$esEmpleado = $_GET['esEmpleado'];

$identificador =  $correo . ":" . $esEmpleado;


$dao = new Dao;
if($dao->error != null) {
    //En caso de eror al conectar a base de datos regresa el mensaje de error
    $response = ['success' => false, 'errorCode' => 'MAIL_DB', 'errorMessage' => "No se notificó el nuevo fallo"];
    echo $response;
    die;
}

if($esEmpleado) {
    $tipo = DAO::EMPLEADO;
} else {
    $tipo = DAO::CLIENTE;
}

if(($usuario = $dao->getByID($correo, $tipo)) === FALSE) {
    $response = ["success" => false, "errorCode" => "NO_MACTH", "message" => $correo .  " no fue encontrado"];
    echo json_encode($response);
    die;
}



$array = $_SESSION[$identificador];

$codigo = $array['codigo'];

$data = http_build_query($array);
$opciones = array('http' => array('method' => 'POST', 'header' => 'Content-type: application/x-www-form-urlencoded', 'content' => $data));
$context = stream_context_create($opciones);
$message = file_get_contents('http://localhost/src/php/templates/code.php', false, $context);
$alternativeText = "";
$alternativeText .= "Este es el código de recuperación de contraseña: ";
$alternativeText .= $codigo;

$mail = new Mail("Restablecimiento de contraseña", $message, $alternativeText);

if(($mail->send($usuario->getCorreo(), $usuario->getNombre())) === FALSE) {
    $response = ["success" => false, "errorCode" => "MAIL_ERROR", "message" => "El código fue enviado"];
    echo json_encode($response);
    die;
}



$response = ["success" => true];
echo json_encode($response);