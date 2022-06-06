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
                            <ul class="nav__list" id="ul_list" style="margin: unset;">
                                <li class="btn-solo f f-center bg-light-gray">
                                        <span class="white">Clientes</span>
                                </li>
                                <li><a onclick="agregarCliente()" class="btn btn-section">Nuevo</a></li>
                                <div class="modal-close">
                                    <a onclick="closeModal('modal-id')" class="close">
                                        <span class="material-icons md-32 md-light">close</span>
                                    </a>
                                </div>
                            </ul>
                        </nav>
                    </header>
                    <div class="section-content overflow-auto scrollbar" style="margin: unset;">
                        <div id="contenedor-clientes">
                            <!-- aquí van los Clientes -->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>  
</section>
