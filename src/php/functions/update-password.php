<?php

//Establece el tipo de contenido que regresará a aplicacion/json
header('Content-Type: application/json');

//revisa si el motodo de solicitud fue con el método correcto

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    //recuperacion de la solicitud POST
    $request = json_decode(file_get_contents("php://input"));

    // Si fue el correcto reviso si los parametros enviados están completos
    if((!isset($request->correo)) || (!isset($request->password))) {
        // Si no están completos envío un mensaje de error
        $response = ['success' => false, 'errorCode' => 'INCOMPLETE_PARAMETERS', 'errorMessage' => 'Faltan parámetros en la solicitud'];
        echo json_encode($response);
        die;
    }
} else {
    //Si no es el correcto envío un mensaje de error
    $response = ['success' => false, 'errorCode' => 'BAD_METHOD', 'errorMessage' => 'Método solicitado no disponible'];
    echo json_encode($response);
    die;
}

//importar todas las clases
require_once("../classes/importar-clases.php");

//recuperación de parametros de la solicitud

$correo = $request->correo;
$password = $request->password;

//instancia de dao para consultas a DB
$dao = new DAO;
if($dao->error != null) {
    //En caso de eror al conectar a base de datos regresa el mensaje de error
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    echo $response;
    die;
}

if(($usuario = $dao->getByID($correo, DAO::EMPLEADO)) === FALSE) {
    if(($usuario = $dao->getByID($correo, DAO::CLIENTE)) === FALSE) {
        $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
        $response = json_encode($response);

        //envío respuesta
        echo $response;
        die;
    }
}

$usuario->setPassword($password);
if($dao->update($correo, $usuario) === FALSE) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    $response = json_encode($response);

    //envío respuesta
    echo $response;
    die;
}


$message = file_get_contents('http://localhost/src/php/templates/password-updated.php');
$alternativeText = "";
$alternativeText .= "Se ha actualizado su contraseña";

$mail = new Mail("Contraseña actualizada", $message, $alternativeText);

if(($mail->send($usuario->getCorreo(), $usuario->getNombre())) === FALSE) {
    $response = ["success" => false, "errorCode" => "MAIL_ERROR", "message" => "El código fue enviado"];
    echo json_encode($response);
    die;
}


$response = ['success' => true];
echo json_encode($response);