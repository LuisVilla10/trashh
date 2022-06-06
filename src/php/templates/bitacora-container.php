<?php


$request = json_decode(file_get_contents("php://input"));

$bitacora = $request->bitacora;

?>

<!-- Modal -->
<section id="modal-id" class="visually-hidden">
    <div class="modal-shadow" onclick="closeModal('modal-id')"></div>
    <div class="modal-content" id="modal-content">
        <div class="modal-close"><a onclick="closeModal('modal-id')" class="close"></a></div>
        <div >
            <div class="modal-body">
                <div class="entrada">
                    <div class="alert visually-hidden" id="alerta"></div>
                </div>
                <section>
                    <header> 
                        <nav class="nav">
                            <ul class="nav__list f-align-center bg-light-light-gray" id="ul_list" style="margin: unset;">
                                <li class="btn-solo"><a class="btn btn-selected btn-section" >Bitacora</a></li>
                                <div class="modal-close bg-light-light-gray">
                                    <a onclick="closeModal('modal-id')" class="close">
                                        <span class="material-icons md-32 white">close</span>
                                    </a>
                                </div>
                            </ul>
                        </nav>
                    </header>
                    <div class="section-content" style="margin: unset;">
                        <div id="contenedor-bitacora">
                            <div class="project-card" id="<?php echo $bitacora->id; ?>">
                                <div class="project-body">
                                    <div class="project-status">
                                        <span></span>
                                    </div>
                                    <div class="project-data">
                                        <div class="project-owner">
                                            <h4>ID: </h4>
                                            <p><?php echo $bitacora->id; ?></p>
                                        </div>
                                        <div class="project-owner">
                                            <h4>Causa: </h4>
                                            <p style="font-size: 15px;"><?php echo $bitacora->causa; ?></p>
                                        </div>
                                        <div class="project-owner">
                                            <h4>Solución: </h4>
                                            <p style="font-size: 15px;"><?php echo $bitacora->solucion; ?></p>
                                        </div>
                                        <div class="project-owner">
                                            <h4>Tiempo consumido: </h4>
                                            <p><?php echo $bitacora->tiempo_consumido; ?>Hrs.</p>
                                        </div>
                                        <div class="project-owner">
                                            <h4>Autor: </h4>
                                            <p><?php echo $bitacora->autor->nombre; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="acotations">
                            <div class="project-status acotation">
                                <span class="status-notificado"></span>
                                <p>Notificado</p>
                            </div>
                            <div class="project-status acotation">
                                <span class="status-asignado"></span>
                                <p>Asignado</p>
                            </div>
                            <div class="project-status acotation">
                                <span class="status-en-atención"></span>
                                <p>En atención</p>
                            </div>
                            <div class="project-status acotation">
                                <span class="status-reparado"></span>
                                <p>Reparado</p>
                            </div>
                        </div> -->
                    </div>
                </section>
            </div>
        </div>
    </div>  
</section>




