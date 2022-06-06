<?php

$nombre = $_POST['name'];
$apellidos = $_POST['surname'];
$edad = $_POST['age'];
$sexo = $_POST['sex'];
$celular = $_POST['phone'];
$correo = $_POST['email'];

include "conexion-bd.php";

$sql = "INSERT INTO Estudiante(nombre, apellidos, correo, edad, sexo, celular) values (?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("sssiss", $nombre, $apellidos, $correo, $edad, $sexo, $celular);

try {
    $stmt->execute();
} catch (Exception $e) {
    die($e);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="estilo.css">
</head>
<body class="text-center">


    <h1>Gracias por registrarse</h1>
    <br></br>
    <p>A continuacion se confirma su informacion:</p>


    <ul class="list-group container">
        <li class="list-group-item list-group-item-action container-fluid-2">
            <b>Nombre: </b>
            <p><?php echo $nombre ?></p>
        </li>
        <li class="list-group-item list-group-item-action container-fluid-2">
            <b>Apellidos: </b>
            <p><?php echo $apellidos ?></p>
        </li>
        <li class="list-group-item list-group-item-action container-fluid-2">
            <b>Edad: </b>
            <p><?php echo $edad ?></p>
        </li>
        <li class="list-group-item list-group-item-action container-fluid-2">
            <b>Sexo: </b>
            <p><?php echo $sexo ?></p>
        </li>
        <li class="list-group-item list-group-item-action container-fluid-2">
            <b>Celular: </b>
            <p><?php echo $celular ?></p>
        </li>
        <li class="list-group-item list-group-item-action container-fluid-2">
            <b>Correo: </b>
            <p><?php echo $correo ?></p>
        </li>
    </ul>    
</body>
</html>