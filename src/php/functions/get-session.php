<?php
//Establece el tipo de contenido que regresará a aplicacion/json
header('Content-Type: application/json');

require_once("../classes/importar-clases.php");
session_start();

if(isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];    
    $response = ['mensaje' => 'logged', 'usuario' => $usuario, 'tipo_de_usuario' => get_class($usuario)];
    echo json_encode($response);
} else {
    $response = ['mensaje' => 'unlogged'];
    echo json_encode($response);
}
