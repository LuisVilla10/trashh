<?php

header('Content-Type: application/json');

//importar todas las clases
require_once("../classes/importar-clases.php");

session_start();

//Verifico que la solicitud sea correcta
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if((!isset($_GET['correo']))) {
         // Si no están completos envío un mensaje de error
         $response = ['success' => false, 'errorCode' => 'INCOMPLETE_PARAMETERS', 'errorMessage' => 'Faltan parámetros en la solicitud'];
         echo json_encode($response);
         die;
    }
} else {
    //Si no es el método correcto envío un mensaje de error
    $response = ['success' => false, 'errorCode' => 'BAD_METHOD', 'errorMessage' => 'Método solicitado no disponible'];
    echo json_encode($response);
    die;
}

$correo = $_GET['correo'];

$identificador =  $correo;


unset($_SESSION[$identificador]);

$dao = new Dao;
if($dao->error != null) {
    //En caso de eror al conectar a base de datos regresa el mensaje de error
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    echo json_encode($response);
    die;
}

//Reviso si existe en la base de datos
if((($usuario = $dao->getByID($correo, DAO::CLIENTE)) === FALSE) && (($usuario = $dao->getByID($correo, DAO::EMPLEADO)) === FALSE)) {
    $response = ['success' => false, 'errorCode' => 'NO_MATCH', 'errorMessage' => $dao->error];
    echo json_encode($response);
    die;
}

//Creo un código numerico aleatorio
$codigo = sprintf("%06d", mt_Rand(1, 999999));

//Obtengo la fecha y hora para darle una expiración al código
$time = new DateTime();
$timeZone = new DateTimeZone('America/Mexico_City');
$time->setTimezone($timeZone);

$fecha_de_creacion = $time;

$array = ["codigo" => $codigo, "fecha_de_creacion" => $fecha_de_creacion];

$_SESSION[$identificador] = $array;//generar el codigo y guardarlo en session para luego poder consultarlo


$data = http_build_query($array);
$opciones = array('http' => array('method' => 'POST', 'header' => 'Content-type: application/x-www-form-urlencoded', 'content' => $data));
$context = stream_context_create($opciones);
$message = file_get_contents('http://localhost/src/php/templates/code.php', false, $context);
$alternativeText = "";
$alternativeText .= "Este es el código de recuperación de contraseña: ";
$alternativeText .= $codigo;

$mail = new Mail("Restablecimiento de contraseña", $message, $alternativeText);

if(($mail->send($usuario->getCorreo(), $usuario->getNombre())) === FALSE) {
    $response = ["success" => false, "errorCode" => "MAIL_ERROR", "message" => "El código no fue enviado"];
    echo json_encode($response);
    die;
}

$response = ["success" => true];
echo json_encode($response);