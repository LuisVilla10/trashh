<?php


$request = json_decode(file_get_contents("php://input"));

$empleado = $request->empleado;

?>
<div class="project-card" id="<?php echo $empleado->id; ?>">
    <div class="project-body">
        <div class="project-data">
            <div class="project-owner">
                <h4>Nombre: </h4>
                <p><?php echo $empleado->nombre; ?></p>
            </div>
            <div class="project-owner">
                <h4>Correo: </h4>
                <p><?php echo $empleado->correo; ?></p>
            </div>
            <div class="project-owner">
                <h4>Es director: </h4>
                <p><?php echo $empleado->esDirector; ?></p>
            </div>
        </div>
    </div>
</div>
               