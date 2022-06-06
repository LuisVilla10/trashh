<?php


$request = json_decode(file_get_contents("php://input"));

$cliente = $request->cliente;

?>
<div class="project-card" id="<?php echo $cliente->rfc; ?>">
    <div class="project-body">
        <div class="project-data">
            <p class="alert alert-editar visually-hidden" id="alert_<?php echo $cliente->correo?>">Correo no valido</p>
            <div class="project-owner">
                <h4>RFC: </h4>
                <p><input style="border:0; border-radius:0;" value="<?php echo $cliente->rfc; ?>" type="text"  id="RFC_<?php echo $cliente->correo; ?>"></p>
                <input class="visually-hidden" style="border:0; border-radius:0;" value="<?php echo $cliente->rfc; ?>" type="text"  id="oldRFC_<?php echo $cliente->correo; ?>">
            </div>
            <div class="project-owner">
                <h4>NOMBRE: </h4>
                <p><input value="<?php echo $cliente->nombre; ?>" type="email"  id="Nombre_<?php echo $cliente->correo; ?>"></p>
                <input class="visually-hidden" value="<?php echo $cliente->nombre; ?>" type="email"  id="oldNombre_<?php echo $cliente->correo; ?>">
            </div>
            <div class="project-owner">
                <h4>CORREO: </h4>
                <p><input value="<?php echo $cliente->correo; ?>" type="email"  id="Email_<?php echo $cliente->correo; ?>" ></p>
            </div>
            <input class="visually-hidden" value="<?php echo $cliente->correo; ?>" type="email"  id="Old_<?php echo $cliente->correo; ?>" >
        </div>
        <div class="btn-container" style="max-width: 317px;">
            <a class="btn btn-details" onclick="editarCliente('<?php echo $cliente->correo; ?>')">Actualizar</a>
            <a class="btn btn-details" onclick="eliminarCliente(this,'<?php echo $cliente->correo; ?>')">Eliminar</a>
            <a class="btn btn-details" onclick="verProyectos('<?php echo $cliente->correo; ?>')">Ver proyectos</a>
        </div>
    </div>
</div>
               