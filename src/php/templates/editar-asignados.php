<?php
//recuperacion de la solicitud POST

$request = json_decode(file_get_contents("php://input"));

$fallo = $request->fallo;

?>

<!-- Modal -->
<section id="modal-id" class="visually-hidden">
    <div class="modal-shadow" onclick="closeModal('modal-id')"></div>
    <div class="mini-modal-content" id="modal-content">
        <div class="modal-close"><a onclick="closeModal('modal-id')" class="close"></a></div>
        <div >
        <header>
            <nav class="nav">
                <ul class="nav__list f-align-center bg-light-light-gray" id="ul_list" style="margin: unset;">
                    <li class="btn-solo"><a class="btn btn-selected btn-section">Editar Asignados</a></li>
                    <div class="modal-close bg-light-light-gray">
                        <a onclick="closeModal('modal-id')" class="close">
                            <span class="material-icons md-32 white">close</span>
                        </a>
                    </div>
                </ul>
            </nav>
        </header>
            <div class="modal-body">
                <div class="entrada">
                    <div class="alert visually-hidden" id="alerta"></div>
                </div>
                <div>
                    <h2><?php echo $fallo->id;?></h2>
                </div>
                <div>
                    <div>
                        <h3>Asignados</h3>
                        <ul id="lista-asignados">
                            
                        </ul>
                        
                    </div>
                </div>
                <select name="" id="select-empleados">
                </select>
                <button class="btn btn-selected btn-fallo" onclick="añadirEmpleadoAsignados()">Añadir a asignados</button>
                <br>
                <div>
                    <button class="btn btn-selected btn-fallo" onclick="asignarFallo('<?php echo $fallo->id; ?>')">Confirmar edición</button>
                </div>
                
            </div>
        </div>
    </div>  
</section>