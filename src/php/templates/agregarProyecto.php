<section id="modal-id" class="visually-hidden">
    <div class="modal-shadow" onclick="closeModal('modal-id')"></div>
    <div class="modal-content" id="modal-content">
        <div >
            <header> 
                <nav class="nav">
                    <ul class="nav__list f-align-center bg-light-light-gray" id="ul_list" style="margin: unset;">
                        <li class="btn-solo"><a class="btn btn-selected btn-section" >Agregar Proyecto</a></li>
                        <div class="modal-close bg-light-light-gray">
                            <a onclick="closeModal('modal-id')" class="close">
                                <span class="material-icons md-32 white">close</span>
                            </a>
                        </div>
                    </ul>
                </nav>
            </header>
            <div class="modal-body">
                <div class="flex-column">
                    <!-- dentro de este div va todo el contenido del modal -->
                    <div class="entrada">
                        <div class="alert visually-hidden" id="alerta"></div>
                    </div>
                    <div id="formulario">
                        <form method="post" onsubmit="return false">
                          <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                          </div>
                          <br>
                          <div class="form-group">
                            <label for="status">Status</label>
                            <select name="select" name="status" id="status" class="form-control" disabled>
                              <option value="en diseño" selected>Diseño</option>
                              <option value="en desarrollo">Desarrollo</option>
                              <option value="en pruebas">Pruebas</option>
                              <option value="implementado">Implementado</option>
                            </select>                          
                          </div>
                          <br>
                          <div class="form-group">
                            <label for="fechadc">Fecha de contratación</label>
                            <input type="date" name="fechadc" id="fechadc" data-date="" data-date-format="DD/MM/YYYY" value="2020-08-29">
                          </div>
                          <br>
                          <div class="form-group">
                            <label for="contratista">Contratista - CLIENTE</label>
                            <select name="contratista" id="contratista" class="form-control">
                            </select>
                          </div>
                          <br>
                          <div class="form-group">
                            <button class="btn-add" id="btn-add-proyecto" onclick="agregarProyecto()"> Agregar</button>
                          </div>
                        </form>
                    </div>
                    <!-- Aquí termina el contenido -->
                </div>
            </div>
        </div>
    </div>  
</section>