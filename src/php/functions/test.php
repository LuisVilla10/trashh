<?php

require_once("../classes/importar-clases.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// header('Content-Type: application/json');


$id = "fallo-615094b0bfa86";

$dao = new DAO;

if(($bitacora = $dao->getBitacoraByFallo($id)) === FALSE) {
    $response = ['success' => false, 'errorCode' => 'DB_ERROR', 'errorMessage' => $dao->error];
    echo json_encode($response);
    die;
}

echo $bitacora;

// $response = ["success" => true, 'notas' => $notas];
// echo json_encode($response);