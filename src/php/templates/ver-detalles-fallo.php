<?php
//recuperacion de la solicitud POST

$request = json_decode(file_get_contents("php://input"));

$fallo = $request->fallo;
$vista = $request->vista;

switch ($vista) {
    case 'Mis proyectos':
        $verComoDirector = false;
        break;
    case 'Todos los proyectos':
        $verComoDirector = true;
        break;
}
?>

<!-- Modal -->
<section id="modal-id" class="visually-hidden">
    <div class="modal-shadow" onclick="closeModal('modal-id')"></div>
    <div class="mini-modal-content" id="modal-content">
        <div >
            <header> 
                <nav class="nav">
                    <ul class="nav__list f-align-center bg-light-light-gray" id="ul_list" style="margin: unset;">
                        <li class="btn-solo"><a class="btn btn-selected btn-section" >Detalles de Fallo</a></li>
                        <div class="modal-close bg-light-light-gray">
                            <a onclick="closeModal('modal-id')" class="close">
                                <span class="material-icons md-32 white">close</span>
                            </a>
                        </div>
                    </ul>
                </nav>
            </header>
            <div class="modal-body f f-justify-center f-column">
                <div class="entrada">
                    <div class="alert visually-hidden" id="alerta"></div>
                </div>
                <div>
                    <h2><?php echo $fallo->id;?></h2>
                </div>
                <div class="f">
                    <h3 class="f f-align-center">Status:</h3>
                    <div class="project-status acotation">
                        <span id="status-fallo-selected" class="status-<?php echo str_replace(" ", "-", $fallo->status);?>"></span>
                        
                        <?php
                        if($verComoDirector) {
                            echo '<select name="" id="status-select">';
                            echo '<option value="notificado" ' . ($fallo->status == 'notificado' ? 'selected' : '') . '>Notificado</option>';
                            echo '<option value="asignado"' . ($fallo->status == 'asignado' ? 'selected' : '') . '>Asignado</option>';
                            echo '<option value="en atención"' . ($fallo->status == 'en atención' ? 'selected' : '') . '>En atención</option>';
                            echo '<option value="reparado" ' . ($fallo->status == 'reparado' ? 'selected' : '') . '>Reparado</option>';
                            echo '</select>';
                        } else {
                            echo '<p>' . $fallo->status . '</p>';
                        }
                        ?>
                    </div>
                    <?php
                        if($verComoDirector) {
                            echo '<button class="btn btn-fallo" onclick="actualziarStatusFallo(' . "'" . $fallo->id . "'" . ')">Actualizar Status</button>';
                        }
                    ?>
                </div>
                <div>
                    <div class="f">
                        <div>Descripción:</div>
                        <div class="f f-grow f-center"><?php echo $fallo->descripcion;?></div>
                    </div>
                </div>
                <div>
                    <div>
                        <h3>Asignados:</h3>
                        <?php
                        if(count($fallo->asignados) > 0) {
                            echo "<ul></ul>";
                            foreach ($fallo->asignados as $asignado) {
                                echo '<li class="item-asignados"><p>' . $asignado->nombre . "</p></li>";
                            }   
                        } else {
                            echo "<p>Este fallo no está asignado</p>";
                        }
                        ?>
                    </div>
                </div>
                <div>
                <?php
                if($verComoDirector) {
                    echo '<button class="btn btn-fallo" onclick="editarAsignaciones(' . "'" . $fallo->id . "'" . ')">Editar asignaciones</button>';
                }
                ?>
                <?php
                if($fallo->status == 'reparado') {
                    echo '<button class="btn btn-fallo" onclick="verBitacora(' . "'" . $fallo->id . "'" . ')">Ver bitácora</button>';
                } else {
                    echo '<button class="btn btn-fallo" onclick="escribirNota(' . "'" . $fallo->id . "'" . ')">Escribir una nota</button>';
                    echo '<button class="btn btn-fallo" onclick="escribirBitacora(' . "'" . $fallo->id . "'" . ')">Escribir bitácora</button>';
                }
                ?>
                <button class="btn btn-fallo" onclick="verNotas('<?php echo $fallo->id; ?>')">Ver notas</button>
                </div>
            </div>
        </div>
    </div>  
</section>

