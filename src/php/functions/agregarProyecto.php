<?php

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  //recuperacion de la solicitud POST
  $resultado = json_decode(file_get_contents("php://input"));


  if((!isset($resultado->nombre)) || (!isset($resultado->fechadc)) || (!isset($resultado->contratista))) {
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
$fecha_de_contratacion =$resultado->fechadc;
$contratista =$resultado->contratista;

// if (isset($_POST['submit'])) {
  $resultado = [
    'success' => true,
    'mensaje' => 'El proyecto ' . $nombre . ' ha sido agregado con éxito' 
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

  if (($client = $dao->getByID($contratista, "CLIENTE")) == false) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    echo $response;
    die;
  }

  $proyecto = new Proyecto($nombre, $fecha_de_contratacion, $client);

  if(($dao->create($proyecto)) !== false) {
    $resultado = json_encode($resultado);
    echo $resultado;
  } else {
    $pos = strpos($dao->error, 'Duplicate');
    if($pos !== false) {       
      $resultado = [
        'success' => false,
        'mensaje' => 'Creo que ese proyecto ya está registrado',
        'fallo' => $dao->error
      ];
      $resultado = json_encode($resultado);
      echo $resultado;
      die;
    }
    $resultado = [
      'success' => false,
      'mensaje' => 'No se pudo agregar el proyecto',
      'fallo' => $dao->error
    ];
    $resultado = json_encode($resultado);
      echo $resultado;
  }
   
    
    //Como el cliente nos pidió que fuera una API, ocupamos que los resultados sean en json, me parece que solo necesitas hacer un json_encode($resultado) 
  // }

?>
