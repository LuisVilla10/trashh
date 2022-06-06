<?php
?>

<!-- Modal -->
<section id="modal-id" class="visually-hidden">
    <div class="modal-shadow" onclick="closeModal('modal-id')"></div>
    <div class="mini-modal-content" id="modal-content">
        <div class="modal-close"><a onclick="closeModal('modal-id')" class="close"></a></div>
        <div class="f f-column h-100pc">
            <header> 
                <nav class="nav">
                    <ul class="nav__list f-align-center bg-light-light-gray" id="ul_list" style="margin: unset;">
                        <li class="btn-solo"><a class="btn btn-selected btn-section" >Registrar Empleado</a></li>
                        <div class="modal-close bg-light-light-gray">
                            <a onclick="closeModal('modal-id')" class="close">
                                <span class="material-icons md-32 white">close</span>
                            </a>
                        </div>
                    </ul>
                </nav>
            </header>
            <div class="modal-body f-grow">
                <div class="flex-column">
                    <!-- dentro de este div va todo el contenido del modal -->
                    <div class="entrada">
                        <div class="alert visually-hidden" id="alerta"></div>
                    </div>
                    <div id="formulario">
                        <form method="post" onsubmit="return false">
                            <div>
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control">
                            </div>
                            <div>
                                <label for="apellido">Correo</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div>
                                <label for="password">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div>
                                <label for="isDirector">¿Es director?</label>
                                <input type="checkbox" name="checkbox" id="isDirector"><br>
                            <div>
                                <button class="btn-add" id="btn-add-empleado" onclick="addEmpleado()"> Aceptar</button>
                                <button class="btn-can" id="btn-can-empleado" onclick="closeModal()"> Cancelar</button>
                            </div>
                        </form>
                    </div>

                    <!-- Aquí termina el contenido -->
                </div>
            </div>


        </div>
    </div>  
</section>

