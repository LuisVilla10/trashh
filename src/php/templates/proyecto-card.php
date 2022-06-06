<?php


$request = json_decode(file_get_contents("php://input"));

$proyecto = $request->proyecto;

?>
<div class="project-card" id="<?php echo $proyecto->id; ?>">
    <div class="project-body">
        <div class="project-status">
            <span class="status-<?php echo str_replace(" ", "-", $proyecto->status);?>"></span>
        </div>
        <div class="project-title">
            <?php echo $proyecto->nombre;?>        
        </div>
        <div class="project-data">
            <div class="project-owner">
                <h4>Cliente: </h4>
                <p><?php echo $proyecto->contratista->nombre?></p>
            </div>
            <div class="project-owner">
                <h4>Contratación: </h4>
                <p><?php echo $proyecto->fecha_de_contratacion; ?></p>
            </div>
        </div>
        <div class="btn-container" style="max-width: 317px;">
            <a class="btn btn-details" onclick="verFallos('<?php echo $proyecto->id; ?>')">Ver Fallos</a>
        </div>
    </div>
</div>
               