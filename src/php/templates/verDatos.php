<?php
  $request = json_decode(file_get_contents("php://input"));
  $usuarioLoggeado = $request->usuarioLoggeado;
  $tipousuario = $request->tipo_de_usuario;
?>
<section id="modal-id" class="visually-hidden">
    <div class="modal-shadow" onclick="closeModal('modal-id')"></div>
    <div class="modal-content" id="modal-content">
        <div class="modal-close"><a onclick="closeModal('modal-id')" class="close"></a></div>
        <div>
            <header> 
                <nav class="nav">
                    <ul class="nav__list f-align-center bg-light-light-gray" id="ul_list" style="margin: unset;">
                        <li class="btn-solo"><a class="btn btn-selected btn-section" >Datos del usuario</a></li>
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
                          <div>
                            <h1>Nombre</h1>
                            <h2><?php echo $usuarioLoggeado->nombre ?></h2>
                          </div>
                          <br>
                          <div>
                            <h1>Correo</h1>
                            <h2><?php echo $usuarioLoggeado->correo ?></h2>
                          </div>
                          <br>
                          <div>
                            <h1>Es Director?</h1>
                            <h2><?php
                            $rfc = null;
                            if($tipousuario == "Empleado"){
                              if($usuarioLoggeado->esDirector){
                              $mensaje = $usuarioLoggeado->nombre . " eres un director.";
                              echo $mensaje;
                              }else{
                                  $mensaje = $usuarioLoggeado->nombre . " eres un empleado que no es director.";
                                  echo $mensaje;
                              }
                            }
                            elseif($tipousuario == "Cliente"){
                              $mensaje = $usuarioLoggeado->nombre . " eres un cliente con el rfc:";
                              echo $mensaje;
                              echo "<h1>RFC</h1>";
                              echo "<h2>" . $usuarioLoggeado->rfc . "<h2>";
                            }
                             ?></h2>
                          </div>        
                          <br>
                     </div>
                    <!-- Aquí termina el contenido -->
                </div>
            </div>
        </div>
    </div>  
</section>