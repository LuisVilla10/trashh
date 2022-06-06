<!-- Modal -->
<section id="modal-id" class="visually-hidden">
    <div class="modal-shadow" onclick="closeModal('modal-id')"></div>
    <div class="modal-content" id="modal-content">
        <div >
            <div class="modal-body">
                <div class="entrada">
                    <div class="alert visually-hidden" id="alerta"></div>
                </div>
                <section class="g g-temp-rows-6-94 h-80vh">
                    <header>
                        <nav class="nav">
                            <ul class="nav__list" id="ul_list" style="margin: unset;">
                                <li class="btn-solo f f-center bg-light-gray">
                                        <span class="white">Empleados</span>
                                </li>
                                <li><a onclick="agregarEmpleadoForm()" class="btn btn-section">Nuevo</a></li>
                                <div class="modal-close">
                                    <a onclick="closeModal('modal-id')" class="close">
                                        <span class="material-icons md-32 md-light">close</span>
                                    </a>
                                </div>
                            </ul>
                        </nav>
                    </header>
                    <div class="section-content overflow-auto scrollbar" style="margin: unset;">
                        <div id="acotacionEmpleados" >
                            <div class="acotations" >
                                <div class="project-status acotation">
                                    <span class="status-Director"></span>
                                    <p>Es Director</p>
                                </div>
                                <div class="project-status acotation">
                                    <span class="status-No-Director"></span>
                                    <p>No es director</p>
                                </div>
                            </div>
                            <p style="text-align:center;">Click sobre el circulo para alternar entre director y no director.</p>
                        </div>
                        <div id="contenedor-Empleados">
                            <!-- aquí van los empleados -->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>  
</section>