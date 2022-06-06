<?php

include "conexion-bd.php";

$query = "SELECT * FROM Estudiante";

$resultado = $mysqli->query($query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="estilo.css">
</head>

<body class="text-center">


    <h1>Gracias por registrarse</h1>
    <br></br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Correo</th>
                <th scope="col">Edad</th>
                <th scope="col">Sexo</th>
                <th scope="col">Celular</th>
            </tr>
        </thead>
        <tbody>

            <?php

            while ($fila = $resultado->fetch_array()) {
            ?>

                <tr>
                    <th scope="row"><?php echo $fila['id']; ?></th>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['apellidos']; ?></td>
                    <td><?php echo $fila['correo']; ?></td>
                    <td><?php echo $fila['edad']; ?></td>
                    <td><?php echo $fila['sexo']; ?></td>
                    <td><?php echo $fila['celular']; ?></td>
                </tr>

            <?php


            }

            ?>

        </tbody>
    </table>
</body>

</html>