<?php

require_once("../classes/importar-clases.php");
$request = json_decode((file_get_contents("php://input")));
session_start();

$usuario = $request -> user;
$esEmpleado = $request -> esEmpleado;

if($esEmpleado) {
    $usuario = Empleado::fromJson(json_encode($usuario));
} else {
    $usuario = Cliente::fromJson(json_encode($usuario));
}

$_SESSION['usuario'] = $usuario;

?>