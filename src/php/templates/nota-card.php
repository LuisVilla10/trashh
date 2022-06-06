<?php


$request = json_decode(file_get_contents("php://input"));

$nota = $request->nota;

?>
<div class="project-card" id="<?php echo $nota->id; ?>">
    <div class="project-body">
        <div class="project-status">
            <span></span>
        </div>
        <div class="project-data">
            <div class="project-owner">
                <h4>ID: </h4>
                <p><?php echo $nota->id; ?></p>
            </div>
            <div class="project-owner">
                <h4>Fecha: </h4>
                <p><?php echo $nota->fecha; ?></p>
            </div>
            <div class="project-owner">
                <h4>Contenido: </h4>
                <p style="font-size: 15px;"><?php echo $nota->contenido; ?></p>
            </div>
            <div class="project-owner">
                <h4>Autor: </h4>
                <p><?php echo $nota->autor->nombre; ?></p>
            </div>
        </div>
    </div>
</div>
               