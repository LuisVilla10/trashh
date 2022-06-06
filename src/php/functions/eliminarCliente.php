<?php

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  //recuperacion de la solicitud POST

  $resultado = json_decode(file_get_contents("php://input"));


  if((!isset($resultado->correo))) {
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
$correo = $resultado->correo;


// if (isset($_POST['submit'])) {
  $resultado = [
    'success' => true,
    'mensaje' => 'El Cliente' . $correo . ' ha sido borrado ' 
  ];

  //Para poder trabajar con las clases se importa todo de las clases
  require_once('../classes/importar-clases.php');
  //Para hacer las conexiones a base de datos es con un objeto de la clase DAO, en la clase DAO hasta arriba dejé el cómo se usa
  $dao = new DAO;
if($dao->error != null) {
    //En caso de eror al conectar a base de datos regresa el mensaje de error
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    echo json_encode($response);
    die;
}
if(($usuario = $dao->deleteClienteByID($correo)) === FALSE) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    $response = json_encode($response);

    //envío respuesta 
    echo json_encode($response);
    die;
}
$response = ['success' => true];
echo json_encode($response);
 

 
   
?>