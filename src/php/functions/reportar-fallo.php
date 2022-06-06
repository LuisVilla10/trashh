<?php
//Establece el tipo de contenido que regresará a aplicacion/json
// header('Content-Type: application/json');

//revisa si el motodo de solicitud fue con el método correcto

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    //recuperacion de la solicitud POST

    $request = json_decode(file_get_contents("php://input"));

    // Si fue el correcto reviso si los parametros enviados están completos
    if((!isset($request->descripcion)) || (!isset($request->proyecto_id)) || (!isset($request->fecha))) {
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

$descripcion = $request->descripcion;
$proyecto_id = $request->proyecto_id;
$fecha = $request->fecha;

//instancia de dao para consultas a DB

$dao = new DAO;
if($dao->error != null) {
    //En caso de eror al conectar a base de datos regresa el mensaje de error
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    echo json_encode($response);
    die;
}
//Recupero el proyecto de la BD (necesario para instanciar el nuevo fallo)

if(($proyecto = $dao->getByID($proyecto_id, DAO::PROYECTO)) === FALSE) {

    //Si falla creo respuesta de error

    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    $response = json_encode($response);

    //envío respuesta 

    echo $response;
    die;
}

//creo una instancia del nuevo fallo

$fallo = new Fallo($descripcion, $fecha, $proyecto);

//Intento guardar en BD en nuevo fallo


if(($dao->create($fallo)) === TRUE) {
    //En caso de exito notificar al director
    notifyDirector($fallo);
} else {
    //creo mensaje de respuesta fallida
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    $response = json_encode($response);
    echo $response;
    die;
}

//Si todo salió bien creo mensaje de respuesta exitosa
$response = ['success' => 'true'];
// envio de respuesta
$response = json_encode($response);
echo $response;

function notifyDirector(Fallo $fallo) {
    //Genero un html que será enviado apor correo

    $data = http_build_query(array('fallo' => json_encode($fallo)));
    $opciones = array('http' => array('method' => 'POST', 'header' => 'Content-type: application/x-www-form-urlencoded', 'content' => $data));
    $context = stream_context_create($opciones);
    $message = file_get_contents('http://localhost/src/php/templates/message.php', false, $context);
    $alternativeText = "";
    $alternativeText .= "Nuevo Fallo: ";
    $alternativeText .= $fallo;

    $mail = new Mail("Nuevo Fallo Reportado", $message, $alternativeText);
    $dao = new Dao;
    if($dao->error != null) {
        //En caso de eror al conectar a base de datos regresa el mensaje de error
        $response = ['success' => false, 'errorCode' => 'MAIL_DB', 'errorMessage' => "No se notificó el nuevo fallo"];
        echo $response;
        die;
    }
    if(($directores = $dao->getDirectores()) !== FALSE) {
        $ocurrioError = false;
        foreach ($directores as $director) {
            if(($result = $mail->send($director->getCorreo(), $director->getNombre())) === FALSE) {
                $ocurrioError = true;
            }
        }
        if($ocurrioError) {
            $response = ['success' => false, 'errorCode' => 'MAIL_ERROR', 'errorMessage' => "Fallo al notificar a al menos uno de los directores"];
            $response = json_encode($response);
            echo $response;
            die;
        }
    } else {
        $response = ['success' => false, 'errorCode' => 'MAIL_DB', 'errorMessage' => $dao->error];
        $response = json_encode($response);
        echo $response;
        die;
    }    
}

?>