<?php
//Establece el tipo de contenido que regresará a aplicacion/json
header('Content-Type: application/json');

//importar todas las clases
require_once("../classes/importar-clases.php");

session_start();


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    //recuperacion de la solicitud POST
    $request = json_decode(file_get_contents("php://input"));

    // Si fue el correcto reviso si los parametros enviados están completos
    if( (!isset($request->id)) || (!isset($request->empleados)) ) {
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

$id = $request->id;
$correos = $request->empleados;

$dao = new Dao;
if($dao->error != null) {
    //En caso de eror al conectar a base de datos regresa el mensaje de error
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    echo json_encode($response);
    die;
}

$empleados = array();

//recupero los empleados de la base de datos
foreach ($correos as $correo) {
    if(($empleado = $dao->getEmpleadoByID($correo)) === FALSE) {
    } else {
        array_push($empleados, $empleado);
    }
}

if(count($empleados) == 0 ) {
    $response = ['success' => false, 'errorCode' => 'NO_SENT', 'errorMessage' => "No se ha logrado notificar la asignación"];
    echo json_encode($response);
    die;
}

//generar email


$array = ["id" => $id];



$data = http_build_query($array);
$opciones = array('http' => array('method' => 'POST', 'header' => 'Content-type: application/x-www-form-urlencoded', 'content' => $data));
$context = stream_context_create($opciones);
$message = file_get_contents('http://localhost/src/php/templates/notificacion-asignacion.php', false, $context);


$alternativeText = "Se la ha asignado el fallo: " . $id;
$mail = new Mail("Fallo asignado", $message, $alternativeText);

$huboProblema = false;

foreach ($empleados as $empleado) {
    //se intenta enviar el código de notificación
    if(($mail->send($empleado->getCorreo(), $empleado->getNombre())) === FALSE) {
        //Si falla se activa la bandera
        $huboProblema = true;
    }
}

if($huboProblema) {
    $response = ['success' => false, 'errorCode' => 'MAIL_ERROR', 'errorMessage' => "Al menos uno de los empleados asignados no fue notificado"];
} else {
    $response = ["success" => true];
}
echo json_encode($response);