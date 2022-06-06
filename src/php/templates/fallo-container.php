<!-- Modal -->
<section id="modal-id" class="visually-hidden">
    <div class="modal-shadow" onclick="closeModal('modal-id')"></div>
    <div class="modal-content" id="modal-content">
        <div>
            <div class="modal-body">
                <div class="entrada">
                    <div class="alert visually-hidden" id="alerta"></div>
                </div>
                <section class="g g-temp-rows-6-94 h-80vh">
                    <header> 
                        <nav class="nav">
                            <ul class="nav__list f-align-center bg-light-light-gray" id="ul_list" style="margin: unset;">
                                <li class="btn-solo"><a class="btn btn-selected btn-section" >Fallos</a></li>
                                <div class="modal-close bg-light-light-gray">
                                    <a onclick="closeModal('modal-id')" class="close">
                                        <span class="material-icons md-32 white">close</span>
                                    </a>
                                </div>
                            </ul>
                        </nav>
                    </header>
                    <div class="section-content overflow-auto scrollbar" style="margin: unset;">
                        <div class="acotations">
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
                        </div>
                        <div id="contenedor-fallos">
                            <!-- aquí van los proyectos -->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>  
</section>




