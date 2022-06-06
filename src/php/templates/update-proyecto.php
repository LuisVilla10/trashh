<?php
$request = json_decode(file_get_contents("php://input"));
$id = $_GET['id'];
$proyecto = $request->proyecto;
?>

<section 
  data-id="<?= $id ?>"
  id="modal-id" 
  class="visually-hidden">
    <div class="modal-shadow" onclick="closeModal('modal-id')"></div>
    <div class="mini-modal-content" id="modal-content">
        <div >
            <header> 
                <nav class="nav">
                    <ul class="nav__list f-align-center bg-light-light-gray" id="ul_list" style="margin: unset;">
                        <li class="btn-solo"><a class="btn btn-selected btn-section" >Actualizar Proyecto</a></li>
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
                    <div id="formulario" class="padng-lft-1rem">
                    <form method="post" onsubmit="return false">
                      <div class="form-group">
                        <input type="hidden" name="id" id="id" value="<?php echo $id ?>" class="form-control" >
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="<?php echo $proyecto->nombre ?>" class="form-control">
                      </div>
                      <br>
                      <div class="form-group">
                        <label for="status">Status</label>
                        <select name="select" name="status" id="status" class="form-control">
                          <option value="en diseño" <?php 
                          if($proyecto->status == "en diseño"){
                            echo "selected";
                          }
                          ?>>Diseño</option>
                          <option value="en desarrollo" <?php 
                          if($proyecto->status == "en desarrollo"){
                            echo "selected";
                          }
                          ?>>Desarrollo</option>
                          <option value="en pruebas" <?php 
                          if($proyecto->status == "en pruebas"){
                            echo "selected";
                          }
                          ?>>Pruebas</option>
                          <option value="implementado" <?php 
                          if($proyecto->status == "implementado"){
                            echo "selected";
                          }
                          ?>>Implementado</option>
                        </select>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <label for="fechadc">Fecha de contratación</label>
                        <?php
                          $array = explode("/", $proyecto -> fecha_de_contratacion);
                        ?>
                        <input type="date" name="fechadc" id="fechadc" value="<?php echo $array[2] . "-" . $array[1] . "-" . $array[0]; ?>" date-format="DD/MM/YYYY">
                      </div>
                      <br>
                    <div class="form-group">
                        <label for="contratista">Contratista - CLIENTE</label>
                        <select name="contratista" id="contratista" value="<?php echo $proyecto->contratista->correo ?>" class="form-control">
                        </select>
                      </div>
                      <br>
                      <div class="form-group f f-center">
                        <button class="btn btn-details" id="btn-add-proyecto" onclick="actualizarProyecto()"> Actualizar</button>
                      </div>
                    </form>
                    </div>
                    <!-- Aquí termina el contenido -->
                </div>
            </div>
        </div>
    </div>  
</section>