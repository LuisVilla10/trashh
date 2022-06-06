
<?php
//Establece el tipo de contenido que regresará a aplicacion/json
header('Content-Type: application/json');
session_start();
//revisa si el motodo de solicitud fue con el método correcto

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    //recuperacion de la solicitud POST

    $request = json_decode(file_get_contents("php://input"));

    // Si fue el correcto reviso si los parametros enviados están completos
    if((!isset($request->correo)) || (!isset($request->password)) ) {
        // Si no están completos envío un mensaje de error
        $response = ['success' => false, 'tipoDeFallo' => 'INCOMPLETE_PARAMETERS', 'fallo' => 'Faltan parámetros en la solicitud'];
        echo json_encode($response);
        die;
    }
} else {
    //Si no es el correcto envío un mensaje de error
    $response = ['success' => false, 'tipoDeFallo' => 'BAD_METHOD', 'fallo' => 'Método solicitado no disponible'];
    echo json_encode($response);
    die;
}


//importar todas las clases
require_once("../classes/importar-clases.php");

$solicitud= json_decode(file_get_contents('php://input'));
$correo=$solicitud->correo;
$password=$solicitud->password;
//$password=password_hash($password,PASSWORD_DEFAULT);
$dao = new DAO();

if($dao->error != null) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    echo json_encode($response);
    die;
}
if(($usuario = $dao->getEmpleadoByID($correo)) !== false ){
    if(strcmp($usuario->getPassword(),$password) ===0){	
        $json = ['success'=>true, 'usuario'=> $usuario];
        echo json_encode($json);
        $_SESSION['usuario'] = $usuario;
        die;
    }else{
        $json = ['success'=>false, 'errorMessage'=>'Credenciales incorrectas.', 'errorCode' => 'CRED_01' ];
        echo json_encode($json);
        die;
    }
}
if(($usuario=$dao->getClienteByID($correo))!== false ){
    if(strcmp($usuario->getPassword(),$password) ===0){	
        $json = ['success'=>true, 'usuario'=> $usuario];
        echo json_encode($json);
        $_SESSION['usuario'] = $usuario;
        die;
    }else{
        $json = ['success'=>false, 'errorMessage'=>'Credenciales incorrectas.', 'errorCode' => 'CRED_01' ];
        echo json_encode($json);
        die;
    }
}
$json = ['success'=>false, 'errorMessage'=>'Usuario no encontrado.', 'errorCode' => 'NO_MATCH' ];
echo json_encode($json);
die;


/*
Variables necesarias:
Bool esEmpleado
String password
String correo
*/
?>
