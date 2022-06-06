<?php

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    //recuperacion de la solicitud POST

    $resultado = json_decode(file_get_contents("php://input"));


    if((!isset($resultado->nombre)) || (!isset($resultado->correo)) || (!isset($resultado->password)) || (!isset($resultado->rfc))) {
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
$nombre = $resultado->nombre;
$correo = $resultado->correo;
$password = $resultado->password;
$rfc = $resultado->rfc;

// if(isset($_POST['submit'])) {
$resultado = [
    'success' => true,
    'mensaje' => 'Cliente ' . $nombre. ' ha sido agregado con éxito'
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

$cliente = new Cliente($nombre, $correo, $password, $rfc);

if(($dao->create($cliente)) !== false) {

    $resultado = json_encode($resultado);
    echo $resultado;
} else {

    //Verificar si alguno de los datos (Correo o RFC) ya existe en la base de datos 
    $pos = strpos($dao->error, 'Duplicate');
    if($pos !== false) {
        $resultado = [
            'success' => false,
             'errorCode'=>'DUPLICATED',
            'errorMessage' => $dao->error
        ];
        $resultado = json_encode($resultado);
        echo $resultado;
        die;
    }
    $resultado = [
        'success' => false,
        'errorCode'=>'DB_ERROR',
        'errorMessage' => $dao->error
    ];
    $resultado = json_encode($resultado);
    echo $resultado;
} 
?>