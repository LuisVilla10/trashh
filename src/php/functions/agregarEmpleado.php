<?php

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
//recuperacion de la solicitud POST
    $request = json_decode(file_get_contents("php://input"));

    if((!isset($request->nombre)) || (!isset($request->correo)) || (!isset($request->password)) || (!isset($request->esDirector))) {
        // Si no están completos envío un mensaje de error
        $request = ['success' => false, 'errorCode' => 'INCOMPLETE_PARAMETERS', 'errorMessage' => 'Campos vacios favor de llenar todos los campos'];
        echo json_encode($request);
        die;
    }
} else {
//Si no es el correcto envío un mensaje de error
    $resultado = ['success' => false, 'errorCode' => 'BAD_METHOD', 'errorMessage' => 'Error, favor de llenar correctamente los campos'];
    echo json_encode($resultado);
    die;
}

$nombre = $request->nombre;
$correo = $request->correo;
$password = $request->password;
$esDirector = $request->esDirector;


$resultado = [
    'success' => true,
    'mensaje' => 'El Empleado' . $nombre . ' ha sido agregado ' 
];

//Para poder trabajar con las clases se importa todo de las clases
require_once('../classes/importar-clases.php');
//Para hacer las conexiones a base de datos es con un objeto de la clase DAO, en la clase DAO hasta arriba dejé el cómo se usa
$dao = new DAO;
if($dao->error != null) {
    //En caso de eror al conectar a base de datos regresa el mensaje de error
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    echo $response;
    die;
}

$empleado = new Empleado("", $nombre, $correo, $password, $esDirector);

if(($dao->create($empleado)) !== false) {
    $resultado = json_encode($resultado);
    notify($empleado, $request->password);
    echo $resultado;
} else {
    $pos = strpos($dao->error, 'Duplicate');
    if($pos !== false) {       
        $resultado = [
            'success' => false,
            'errorCode' => 'DUPLICATED',
            'errorMessage' => $dao->error
        ];
        $resultado = json_encode($resultado);
        echo $resultado;
        die;
    }
    $resultado = [
        'success' => false,
        'errorCode' => 'DB_ERROR',
        'errorMessage' => $dao->error
    ];
    $resultado = json_encode($resultado);
    echo $resultado;
}

function notify(Empleado $empleado, $password) {
    //Genero un html que será enviado apor correo

    $data = http_build_query(array('empleado' => json_encode($empleado), 'password' => $password));
    $opciones = array('http' => array('method' => 'POST', 'header' => 'Content-type: application/x-www-form-urlencoded', 'content' => $data));
    $context = stream_context_create($opciones);
    $message = file_get_contents('http://localhost/src/php/templates/empleado-agregado.php', false, $context);
    $alternativeText = "";
    $alternativeText .= "Nuevo empleado: ";
    $alternativeText .= $empleado;

    $mail = new Mail("Su nueva cuenta", $message, $alternativeText);
    $dao = new Dao;
    // if($dao->error != null) {
    //     //En caso de eror al conectar a base de datos regresa el mensaje de error
    //     $response = ['success' => false, 'errorCode' => 'MAIL_DB', 'errorMessage' => "No se notificó el nuevo empleado"];
    //     echo $response;
    //     die;
    // }

    if(($mail->send($empleado->getCorreo(), $empleado->getNombre())) === FALSE) {
        $response = ['success' => false, 'errorCode' => 'MAIL_ERROR', 'errorMessage' => "empleado al notificar a al menos uno de los directores"];
        $response = json_encode($response);
        echo $response;
        die;
    }   
}

?>





