<?php


$request = json_decode(file_get_contents("php://input"));

$fallo = $request->fallo;

?>
<div class="project-card" id="<?php echo $fallo->id; ?>">
    <div class="project-body">
        <div class="project-status">
            <span class="status-<?php echo str_replace(" ", "-", $fallo->status); ?>"></span>
        </div>
        <div class="project-data">
            <div class="project-owner">
                <h4>ID: </h4>
                <p><?php echo $fallo->id; ?></p>
            </div>
            <div class="project-owner">
                <h4>Fecha: </h4>
                <p><?php echo $fallo->fecha; ?></p>
            </div>
        </div>
        <div class="btn-container">
            <a class="btn btn-details" onclick="verDetallesFallo('<?php echo $fallo->id; ?>')">Ver detalles</a>
        </div>
    </div>
</div>
               