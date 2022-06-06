<?php

$id = $_GET['id'];
$nombre = $_GET['nombre'];
?>

<!-- Modal -->
<section id="modal-id" class="visually-hidden">
    <div class="modal-shadow" onclick="closeModal('modal-id')"></div>
    <div class="modal-content" id="modal-content">
        <div >
            <header>
                <nav class="nav">
                    <ul class="nav__list f-align-center bg-light-light-gray" id="ul_list" style="margin: unset;">
                        <li class="btn-solo"><a class="btn btn-selected btn-section">Reportar Proyecto</a></li>
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
                        <h2><?php echo $nombre; ?></h2>
                        <form action="../src/php/reportar-fallo.html" onsubmit="return validarFormularioReporte()">
                            <input type="text" id="proyectoid" name="proyectoid" value="<?php echo $id; ?>" disabled style="display: none">
                            <div style="display: flex;align-items: center;">
                                <label for="descripcionInput">Descripción</label>
                                <textarea rows="4" style="margin-left:10px;resize: none; overflow: auto; width: 50%; min-width: 200px; border-radius:20px; padding: 1em 1em 1em 1em;" type="text" id="descripcionInput" name="descripcion" placeholder="Describa el fallo"></textarea>
                            </div>
                            <div>
                                <label for="fechaInput">Fecha</label>
                                <input type="date" id="fechaInput" name="fecha" placeholder="Fecha de ocurrencia del fallo">
                            </div>
                            <input type="submit"class="btn btn-selected" value="Enviar reporte">
                        </form>
                    </div>

                    <!-- Aquí termina el contenido -->
                </div>
            </div>


        </div>
    </div>  
</section>

