<?php


$request = json_decode(file_get_contents("php://input"));

$empleado = $request->empleado;
?>

<div class="project-card" id="<?php echo $empleado->id; ?>">
    <div class="project-body">
        <div class="project-status">
            <span style="cursor:pointer;" id="esDirector_<?php echo $empleado->correo; ?>" onclick="alternarEsDirector(this,'<?php echo $empleado->correo; ?>');" class="status-<?php 
            if($empleado->esDirector){
                echo "Director";
            }else{
                echo "No-Director";
            }
             ?>"></span>
        </div>
        <div class="project-data">
            <p class="alert alert-editar visually-hidden" id="alert_<?php echo $empleado->correo?>">Correo no valido</p>
            <div class="project-owner">
                <h4>Nombre: </h4>
                <p><input style="border:0; border-radius:0;" value="<?php echo $empleado->nombre; ?>" type="text"  id="Nombre_<?php echo $empleado->correo; ?>" ></p>
            </div>
            <div class="project-owner">
                <h4>Correo: </h4>
                <p><input value="<?php echo $empleado->correo; ?>" type="email"  id="Email_<?php echo $empleado->correo; ?>" ></p>
                <input class="visually-hidden" id="ValorEsDirector_<?php echo $empleado->correo; ?>" type="text" value="<?php 
                if($empleado->esDirector){
                    echo "Director";
                }else{
                    echo "NoDirector";
                }
             ?>">
             <input class="visually-hidden" value="<?php echo $empleado->correo; ?>" type="email"  id="Old_<?php echo $empleado->correo; ?>" >
            </div>
        </div>
        <div class="btn-container" style="max-width: 317px;">
            <a class="btn btn-details" onclick="editarEmpleado(this,'<?php echo $empleado->correo; ?>')">Actualizar</a>
            <a class="btn btn-details" id="deleteButtom_<?php echo $empleado->correo; ?>" onclick="eliminarEmpleado(this,'<?php echo $empleado->correo; ?>')">Eliminar</a>
        </div>
    </div>
</div>