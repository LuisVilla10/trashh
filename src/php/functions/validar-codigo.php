<?php
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    //recuperacion de la solicitud POST

    $request = json_decode(file_get_contents("php://input"));

    // Si fue el correcto reviso si los parametros enviados están completos
    if((!isset($request->correo)) || (!isset($request->codigo))) {
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

$time2 = new DateTime();
$timeZone = new DateTimeZone('America/Mexico_City');
$time2->setTimezone($timeZone);

$correo = $request->correo;
$codigo = $request->codigo;

session_start();

$identificador = $correo;

$array = $_SESSION[$identificador];

$codigo_compare = $array["codigo"];
$time = $array["fecha_de_creacion"];

if(strcmp($codigo, $codigo_compare) === 0) {
    $interval = $time->diff($time2);
    $diferencia = $interval->format('%i');
    if($diferencia > 15) {
        $response = ["success" => false, "errorCode" => "EXPIRED", "message" => "El código expiró"];
    } else {
        $response = ['success' => true];
    }
} else {
    $response = ["success" => false, "errorCode" => "NO_MATCH", "message" => "Código inválido"];
}

echo json_encode($response);
