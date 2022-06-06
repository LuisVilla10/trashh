<?php

$id = $_GET['id'];

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
                        <li class="btn-solo"><a class="btn btn-selected btn-section">Escribir Nota</a></li>
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
                        <h2><?php echo $id; ?></h2>
                        <form onsubmit="return enviarNota()">
                            <input type="text" id="fallo-id" name="fallo-id" value="<?php echo $id; ?>" disabled style="display: none">
                            <div style="display: flex;align-items: center;">
                                <label for="contenido-input">Contenido</label>
                                <textarea rows="4" style="margin-left:10px;resize: none; overflow: auto; width: 50%; min-width: 200px; border-radius:20px; padding: 1em 1em 1em 1em;" type="text" id="contenido-input" name="contenido" placeholder="Ingrese el contenido de la nota" required></textarea>
                            </div>
                            <input type="submit"class="btn btn-selected" value="Enviar nota">
                        </form>
                    </div>

                    <!-- Aquí termina el contenido -->
                </div>
            </div>


        </div>
    </div>  
</section>


