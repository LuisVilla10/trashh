<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

//-----------------------------------------------
//------------ Como usar DAO --------------------

        // $dao = new Dao;
        // $id = "akjsdhkajsd";

        // Para guardar una entidad 
        // $dao->create($cliente);    Se le envia la entidad creada 

        // Para recuperar una entidad mediante su id
        // $empleado = $dao->getByID($id, DAO::EMPLEADO);   Se manda su id, asi como el tipo de entidad

        // Para recuperar todas las entidades de una clase
        // $fallos = $dao->getAll(DAO::FALLO);     Se manda solo el tipo de entidad


        // Para actualizar una entidad
        // $dao->update($id, $bitacora_actualizada);  //id de la entidad a la que se quiere actualizar, y luego el objeto que ya tiene las modificaciones

        // Para borrar una entidad
        // $dao->deleteByID($id, DAO::NOTA);

//-----------------------------------------------
//-----------------------------------------------


require_once("Connection.php");

class DAO {
    const CLIENTE = "CLIENTE";
    const EMPLEADO = "EMPLEADO";
    const FALLO = "FALLO";
    const PROYECTO = "PROYECTO";
    const NOTA = "NOTA";
    const BITACORA = "BITACORA";

    public $error;
    private $mysql;

    public function __construct() {
        $this -> mysql = $GLOBALS['conn'] -> getConnection();
    }

    public function create(Object $object) {
        $this->error = "No error";
        switch (get_class($object)) {
            case "Empleado": 
                return $this->createEmpleado($object);
                break;
            case "Cliente":
                return $this->createCliente($object);
                break;
            case "Proyecto":
                return $this->createProyecto($object);
                break;
            case "Nota":
                return $this->createNota($object);
                break;
            case "Bitacora":
                return $this->createBitacora($object);
                break;
            case "Fallo":
                return $this->createFallo($object);
                break;
            default:
                return "No se reconoce la clase";
                break;
        }
    }

    public function getByID(string $id, string $type) {
        $this->error = "No error";
        switch ($type) {
            case $this::EMPLEADO : 
                return $this->getEmpleadoByID($id);
                break;
            case $this::CLIENTE:
                return $this->getClienteByID($id);
                break;
            case $this::PROYECTO:
                return $this->getProyectoByID($id);
                break;
            case $this::NOTA:
                return $this->getNotaByID($id);
                break;
            case $this::BITACORA:
                return $this->getBitacoraByID($id);
                break;
            case $this::FALLO:
                return $this->getFalloByID($id);
                break;
            default:
                return "No se reconoce la clase";
                break;
        }
    }

    public function getAll(string $type) {
        $this->error = "No error";
        switch ($type) {
            case $this::EMPLEADO : 
                return $this->getAllEmpleados();
                break;
            case $this::CLIENTE:
                return $this->getAllClientes();
                break;
            case $this::PROYECTO:
                return $this->getAllProyectos();
                break;
            case $this::NOTA:
                return $this->getAllNotas();
                break;
            case $this::BITACORA:
                return $this->getAllBitacoras();
                break;
            case $this::FALLO:
                return $this->getAllFallos();
                break;
            default:
                return "No se reconoce la clase";
                break;
        }
    }

    public function update(string $id, Object $Object) {
        $this->error = "No error";
        switch (get_class($Object)) {
            case "Empleado": 
                return $this->updateEmpleado($id, $Object);
                break;
            case "Cliente":
                return $this->updateCliente($id, $Object);
                break;
            case "Proyecto":
                return $this->updateProyecto($id, $Object);
                break;
            case "Nota":
                return $this->updateNota($id, $Object);
                break;
            case "Bitacora":
                return $this->updateBitacora($id, $Object);
                break;
            case "Fallo":
                return $this->updateFallo($id, $Object);
                break;
            default:
                return "No se reconoce la clase";
                break;
        }
    }

    public function deleteByID(string $id, string $type) {
        $this->error = "No error";
        switch ($type) {
            case $this::EMPLEADO : 
                return $this->deleteEmpleadoByID($id);
                break;
            case $this::CLIENTE:
                return $this->deleteClienteByID($id);
                break;
            case $this::PROYECTO:
                return $this->deleteProyectoByID($id);
                break;
            case $this::NOTA:
                return $this->deleteNotaByID($id);
                break;
            case $this::BITACORA:
                return $this->deleteBitacoraByID($id);
                break;
            case $this::FALLO:
                return $this->deleteFalloByID($id);
                break;
            default:
                return "No se reconoce la clase";
                break;
        }
    }

//Create

    //Empleado 

    public function createEmpleado(Empleado $empleado) {
        $correo = $empleado->getCorreo();
        $nombre = $empleado->getNombre();
        $password = $empleado->getPassword();
        $esDirector = $empleado->getEsDirector();
        // if($esDirector) {
        //     $esDirector = "true";
        // } else {
        //     $esDirector = "false";
        // }

        $sql_query = "INSERT INTO empleado (nombre, correo, password, esDirector) VALUES (?, ?, ?, ?)";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("sssi", $param_nombre, $param_correo, $param_password, $param_esDirector);
            $param_correo = $correo;
            $param_nombre = $nombre;
            $param_password = $password;
            $param_esDirector = $esDirector;

            if($stmt->execute()) {
                
                return true;
            } else {
                $this->error = $this->mysql->error;
                
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
        
    }

    //Cliente 

    public function createCliente(Cliente $cliente) {
        $correo = $cliente->getCorreo();
        $nombre = $cliente->getNombre();
        $password = $cliente->getPassword();
        $rfc = $cliente->getRFC();

        $sql_query = "INSERT INTO cliente (nombre, correo, password, rfc) VALUES (?, ?, ?, ?)";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("ssss", $param_nombre, $param_correo, $param_password, $param_rfc);
            $param_correo = $correo;
            $param_nombre = $nombre;
            $param_password = $password;
            $param_rfc = $rfc;

            if($stmt->execute()) {
                
                return true;
            } else {
                $this->error = $this->mysql->error;
                
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
        
    }

    //Proyecto 

    public function createProyecto(Proyecto $proyecto) {
        $id = $proyecto->getId();
        $nombre = $proyecto->getNombre();
        $status = $proyecto->getStatus();
        $fecha_de_contratacion = $proyecto->getFechaDeContratacion();
        $contratista = $proyecto->getContratista();

        $sql_query = "INSERT INTO proyecto (nombre, id, status, fechaDeContratacion) VALUES (?, ?, ?, ?)";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("ssss", $param_nombre, $param_id, $param_status, $param_fecha_de_contratacion);
            $param_id = $id;
            $param_nombre = $nombre;
            $param_status = $status;
            $param_fecha_de_contratacion = $fecha_de_contratacion;

            if($stmt->execute()) {
                
                $sql_query2 = "INSERT INTO contrata (correo, id) VALUES (?, ?)";
                if($stmt2 = $this->mysql->prepare($sql_query2)) {
                    $stmt2->bind_param("ss", $param_correo, $param_id);
                    $param_id = $id;
                    $param_correo = $contratista->getCorreo();

                    if($stmt2->execute()) {
                        return true;
                    } else {
                        $this->error = $this->mysql->error;
                        
                        return false;
                    }
                } else {
                    $this->error = $this->mysql->error;
                    
                    return false;
                }
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            return false;
        }
    }

    //Fallo
    
    public function createFallo(Fallo $fallo) {

        $estado = true;

        $id = $fallo->getId();
        $descripcion = $fallo->getDescripcion();
        $fecha = $fallo->getFecha();
        $status = $fallo->getStatus();
        $asignados = $fallo->getAsignados();
        $proyecto = $fallo->getProyecto();

        $sql_query = "INSERT INTO fallo (descripcion, id, fecha, status) VALUES (?, ?, ?, ?)";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("ssss", $param_descripcion, $param_id, $param_fecha, $param_status);
            $param_id = $id;
            $param_descripcion = $descripcion;
            $param_fecha = $fecha;
            $param_status = $status;

            if($stmt->execute()) {
                
                $estado = true;
                
            } else {
                $this->error = $this->mysql->error;
                
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }

        foreach($asignados as $asignado) {
            $correo = $asignado->getCorreo();
            $sql_query2 = "INSERT INTO tieneAsignado (correo, id) VALUES (?, ?)";
            if($stmt2 = $this->mysql->prepare($sql_query2)) {
                $stmt2->bind_param("ss", $param_correo, $param_id);
                $param_id = $id;
                $param_correo = $correo;

                if($stmt2->execute()) {
                    
                    $estado = true;
                    
                } else {
                    $this->error = $this->mysql->error;
                    
                    return false;
                }
            } else {
                $this->error = $this->mysql->error;
                
                return false;
            }
        }

        $id_proyecto = $proyecto->getID();

        $sql_query3 = "INSERT INTO tieneFallo (id_proyecto, id_fallo) VALUES (?, ?)";
        if($stmt3 = $this->mysql->prepare($sql_query3)) {
            $stmt3->bind_param("ss", $param_id_proyecto, $param_id_fallo);
            $param_id_proyecto = $id_proyecto;
            $param_id_fallo = $id;

            if($stmt3->execute()) {
                
                $estado = true;
                
            } else {
                $this->error = $this->mysql->error;
                
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }

        return $estado;
        
    }

    //Nota
    
    public function createNota(Nota $nota) {
        $id = $nota->getId();
        $contenido = $nota->getContenido();
        $fecha = $nota->getFecha();
        $autor = $nota->getAutor();
        $fallo = $nota->getFallo();

        $sql_query = "INSERT INTO nota (contenido, id, fecha) VALUES (?, ?, ?)";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("sss", $param_contenido, $param_id, $param_fecha);
            $param_id = $id;
            $param_contenido = $contenido;
            $param_fecha = $fecha;

            if($stmt->execute()) {
                
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }

        $id_fallo = $fallo->getID();

        $sql_query = "INSERT INTO tieneNota (id_nota, id_fallo) VALUES (?, ?)";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("ss", $param_id_nota, $param_id_fallo);
            $param_id_fallo = $id_fallo;
            $param_id_nota = $id;

            if($stmt->execute()) {
                
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }

        $correo = $autor->getCorreo();

        $sql_query = "INSERT INTO escribeNota (correo, id) VALUES (?, ?)";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("ss", $param_correo, $param_id);
            $param_correo = $correo;
            $param_id = $id;

            if($stmt->execute()) {

            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            return false;
        }
        
        return true;
        
    }

    //Bitacora
    
    public function createBitacora(Bitacora $bitacora) {
        $id = $bitacora->getId();
        $causa = $bitacora->getCausa();
        $solucion = $bitacora->getSolucion();
        $tiempoConsumido = $bitacora->getTiempoConsumido();
        $autor = $bitacora->getAutor();
        $fallo = $bitacora->getFallo();

        $sql_query = "INSERT INTO bitacora (id, causa, solucion, tiempoConsumido) VALUES (?, ?, ?, ?)";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("sssi", $param_id, $param_causa, $param_solucion, $param_tiempoConsumido);
            $param_id = $id;
            $param_causa = $causa;
            $param_solucion = $solucion;
            $param_tiempoConsumido = $tiempoConsumido;

            if($stmt->execute()) {
                
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }

        $id_fallo = $fallo->getID();

        $sql_query = "INSERT INTO tieneBitacora (id_bitacora, id_fallo) VALUES (?, ?)";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("ss", $param_id_bitacora, $param_id_fallo);
            $param_id_fallo = $id_fallo;
            $param_id_bitacora = $id;

            if($stmt->execute()) {
                
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }

        $correo = $autor->getCorreo();

        $sql_query = "INSERT INTO escribeBitacora (correo, id) VALUES (?, ?)";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("ss", $param_correo, $param_id);
            $param_correo = $correo;
            $param_id = $id;

            if($stmt->execute()) {
                
                return true;
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
        
        
    }

//Get By ID

    //Cliente

    public function getClienteByID(string $id) {
        $sql = "SELECT * FROM cliente where correo = '" . $id . "'";
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $correo = $row['correo'];
                    $rfc = $row['rfc'];
                    $nombre = $row['nombre'];
                    $password = $row['password'];
                    $cliente = new Cliente($nombre, $correo, $password, $rfc);
                    return $cliente;
                }
            } else {
                $this->error = "No encontrado";
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            return false;
        }
    }

    //Empleado

    public function getEmpleadoByID(string $id) {
        $sql = "SELECT * FROM empleado where correo = '" . $id . "'";
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $id = $row['id'];
                    $correo = $row['correo'];
                    $nombre = $row['nombre'];
                    $password = $row['password'];
                    $esDirector = $row['esDirector'];
                    $empleado = new Empleado($id, $nombre, $correo, $password, $esDirector);
                    return $empleado;
                }
            } else {
                $this->error = "No encontrado";
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            return false;
        }
    }

    //Empleado by Nombre

    public function getEmpleadoByNombre(string $nombre) {
        $sql = "SELECT * FROM empleado where nombre = '" . $nombre . "'";
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $correo = $row['correo'];
                    $nombre = $row['nombre'];
                    $password = $row['password'];
                    $esDirector = $row['esDirector'];
                    $empleado = new Empleado($nombre, $correo, $password, $esDirector);
                    return $empleado;
                }
            } else {
                $this->error = "No encontrado";
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            return false;
        }
    }

    //Get Director

    public function getDirectores() {
        $sql = "SELECT * FROM empleado where esDirector = TRUE";
        $directores = array();
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $correo = $row['correo'];
                    $nombre = $row['nombre'];
                    $password = $row['password'];
                    $esDirector = $row['esDirector'];
                    $empleado = new Empleado($nombre, $correo, $password, $esDirector);
                    array_push($directores, $empleado);
                }
                return $directores;
            } else {
                $this->error = "No hay directores registrados";
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            return false;
        }
    }

    //Proyecto

    public function getProyectoByID(string $id) {
        $sql = "SELECT * FROM proyecto where id = '" . $id . "'";
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $id = $row['id'];
                    $nombre = $row['nombre'];
                    $status = $row['status'];
                    $fechaDeContratacion = $row['fechaDeContratacion'];
                    
                    //recuperar cliente que lo contrata
                    $correo = "";
                    $sql = "SELECT * FROM contrata where id = '" . $id . "'";
                    if($result2 = $this->mysql->query($sql)) {
                        if($result2->num_rows > 0) {
                            while($row2 = $result2->fetch_array()) {
                                $correo = $row2['correo'];
                            }
                        } else {
                            $this->error = "No encontrado";
                            return false;
                        }
                    }
                    $cliente = $this->getClienteByID($correo);

                    $proyecto = new Proyecto($nombre, $fechaDeContratacion, $cliente);
                    $proyecto->setStatus($status);
                    $proyecto->setID($id);
                    return $proyecto;
                }
            } else {
                $this->error = "No encontrado";
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }

    //Fallo

    public function getFalloByID(string $id) {
        $sql = "SELECT * FROM fallo where id = '" . $id . "'";
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $id = $row['id'];
                    $descripcion = $row['descripcion'];
                    $status = $row['status'];
                    $fecha = $row['fecha'];
                    //recuperar Proyecto al que pertenece
                    $id_proyecto = "";
                    $sql = "SELECT * FROM tieneFallo where id_fallo = '" . $id . "'";
                    if($result2 = $this->mysql->query($sql)) {
                        if($result2->num_rows > 0) {
                            while($row2 = $result2->fetch_array()) {
                                $id_proyecto = $row2['id_proyecto'];
                            }
                        } else {
                            $this->error = "No encontrado";
                            return false;
                        }
                    }
                    $proyecto = $this->getProyectoByID($id_proyecto);
                    
                    //recuperar los empleados a los que fue asignado el fallo

                    $correos = array();
                    $asignados = array();
                    $sql = "SELECT * FROM tieneAsignado where id = '" . $id . "'";
                    if($result2 = $this->mysql->query($sql)) {
                        if($result2->num_rows > 0) {
                            while($row2 = $result2->fetch_array()) {
                                array_push($correos, $row2['correo']);
                            }
                        } else {
                            $this->error = "No encontrado";
                        }
                    } else {
                        $this->error = $this->mysql->error;
                        return false;
                    }
                    foreach($correos as $correo) {
                        $empleado = $this->getEmpleadoByID($correo);
                        array_push($asignados, $empleado);
                    }

                    $proyecto = $this->getProyectoByID($id_proyecto);


                    $fallo = new Fallo($descripcion, $fecha, $proyecto);
                    $fallo->setStatus($status);
                    $fallo->setID($id);
                    $fallo->setAsignados($asignados);
                    return $fallo;
                }
            } else {
                $this->error = "No encontrado";
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }

    //Nota

    public function getNotaByID(string $id) {
        $sql = "SELECT * FROM nota where id = '" . $id . "'";
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $id = $row['id'];
                    $contenido = $row['contenido'];
                    $fecha = $row['fecha'];
                    
                    //recuperar Fallo al que pertenece
                    $id_fallo = "";
                    $sql = "SELECT * FROM tieneNota where id_nota = '" . $id . "'";
                    if($result2 = $this->mysql->query($sql)) {
                        if($result2->num_rows > 0) {
                            while($row2 = $result2->fetch_array()) {
                                $id_fallo = $row2['id_fallo'];
                            }
                        } else {
                            $this->error = "Fallo no encontrado";
                            return false;
                        }
                    }

                    $fallo = $this->getFalloByID($id_fallo);

                    //recuperar el empleado que escribió la Nota

                    $correo = "";
                    $sql = "SELECT * FROM escribeNota where id = '" . $id . "'";
                    if($result2 = $this->mysql->query($sql)) {
                        if($result2->num_rows > 0) {
                            while($row2 = $result2->fetch_array()) {
                                $correo = $row2['correo'];
                            }
                        } else {
                            $this->error = "No encontrado";
                            return false;
                        }
                    }
                    $autor = $this->getEmpleadoByID($correo);


                    $nota = new Nota($contenido, $fecha, $autor, $fallo);
                    $nota->setID($id);
                    return $nota;
                }
            } else {
                $this->error = "No encontrado";
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }

    //Bitacora

    public function getBitacoraByID(string $id) {
        $sql = "SELECT * FROM bitacora where id = '" . $id . "'";
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $id = $row['id'];
                    $causa = $row['causa'];
                    $solucion = $row['solucion'];
                    $tiempoConsumido = $row['tiempoConsumido'];
                    
                    //recuperar Fallo al que pertenece
                    $id_fallo = "";
                    $sql = "SELECT * FROM tieneBitacora where id_bitacora = '" . $id . "'";
                    if($result2 = $this->mysql->query($sql)) {
                        if($result2->num_rows > 0) {
                            while($row2 = $result2->fetch_array()) {
                                $id_fallo = $row2['id_fallo'];
                            }
                        } else {
                            $this->error = "No econtrado";
                            return false;
                        }
                    }
                    $fallo = $this->getFalloByID($id_fallo);

                    //recuperar el empleado que escribió la Bitácora

                    $correos = "";
                    $sql = "SELECT * FROM escribeBitacora where id = '" . $id . "'";
                    if($result2 = $this->mysql->query($sql)) {
                        if($result2->num_rows > 0) {
                            while($row2 = $result2->fetch_array()) {
                                $correo = $row['correo'];
                            }
                        } else {
                            $this->error = "No encontrado";
                            return false;
                        }
                    }
                    $autor = $this->getEmpleadoByID($correo);


                    $bitacora = new Bitacora($causa, $solucion, $tiempoConsumido, $autor, $fallo);
                    $bitacora->setID($id);
                    return $bitacora;
                }
            } else {
                $this->error = "No encontrado";
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }


//Get All

    //Cliente

    public function getAllClientes() {
        $sql = "SELECT * FROM cliente";
        $clientes = array();
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $correo = $row['correo'];
                    $rfc = $row['rfc'];
                    $nombre = $row['nombre'];
                    $password = $row['password'];
                    $cliente = new Cliente($nombre, $correo, $password, $rfc);
                    array_push($clientes, $cliente);
                }
                return $clientes;
            } else {
                return $clientes;
            }
        } else {
            $this->error = $this->mysql->error;
            return false;
        }
    }

    //Empleado

    public function getAllEmpleados() {
        $sql = "SELECT * FROM empleado";
        $empleados = array();
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $id = $row['id'];
                    $correo = $row['correo'];
                    $nombre = $row['nombre'];
                    $password = $row['password'];
                    $esDirector = $row['esDirector'];
                    $empleado = new Empleado($id, $nombre, $correo, $password, $esDirector);

                    array_push($empleados, $empleado);                    
                }
                return $empleados;
            } else {
                $this->error = "Empty table";
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
        }
    }

    //Proyecto

    public function getAllProyectos() {
        $sql = "SELECT * FROM proyecto";
        $proyectos = array();
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $id = $row['id'];
                    $nombre = $row['nombre'];
                    $status = $row['status'];
                    $fechaDeContratacion = $row['fechaDeContratacion'];
                    
                    //recuperar cliente que lo contrata
                    $correo = "";
                    $sql = "SELECT * FROM contrata where id = '" . $id . "'";
                    if($result2 = $this->mysql->query($sql)) {
                        if($result2->num_rows > 0) {
                            while($row2 = $result2->fetch_array()) {
                                $correo = $row2['correo'];
                            }
                        } else {
                            $this->error = "No se ha encontrado el cliente del proyecto " . $nombre;
                            return false;
                        }
                    }

                    $cliente = $this->getClienteByID($correo);
                    if($cliente === FALSE) {
                        $cliente = new Cliente("Inaccesible", "sin correo", "", "XXXXXXXXXX");
                    }

                    $proyectos[] = [
                        "id" => $id,
                        "nombre" => $nombre,
                        "fecha_de_contratacion" => $fechaDeContratacion,
                        "status" => $status,
                        "contratista" => get_object_vars($cliente),
                    ];
                }
            }
        } else {
            $this->error = $this->mysql->error;
            return false;
        }

        return $proyectos;
    }

    // obtener proyectos según Empleado 
    public function getProyectosByEmpleado(Empleado $empleado) {
        $correo = $empleado -> getCorreo();
        $sql = "SELECT DISTINCT proyecto.* from tieneAsignado left join tieneFallo on tieneAsignado.id = tieneFallo.id_fallo left join proyecto on proyecto.id = id_proyecto where tieneAsignado.correo = '" . $correo . "'";
        $proyectos = array();
        if($result = $this -> mysql -> query($sql)) {
            if($result -> num_rows > 0) {
                while($row = $result -> fetch_array()) {

                    $id = $row['id'];
                    $nombre = $row['nombre'];
                    $status = $row['status'];
                    $fechaDeContratacion = $row['fechaDeContratacion'];
                    
                    //recuperar cliente que lo contrata
                    $correo = "";
                    $sql = "SELECT * FROM contrata where id = '" . $id . "'";
                    if($result2 = $this->mysql->query($sql)) {
                        if($result2->num_rows > 0) {
                            while($row2 = $result2->fetch_array()) {
                                $correo = $row2['correo'];
                            }
                        } else {
                            $this->error = "No encontrado";
                            return false;
                        }
                    }
                    $cliente = $this->getClienteByID($correo);

                    $proyectos[] = [
                        "id" => $id,
                        "nombre" => $nombre,
                        "fecha_de_contratacion" => $fechaDeContratacion,
                        "status" => $status,
                        "contratista" => get_object_vars($cliente),
                    ];
                }
            }
        } else {
            $this->error = $this->mysql->error;
            return false;
        }

        return $proyectos;
    }

    // obtener proyectos según Cliente 
    public function getProyectosByCliente(Cliente $cliente) {
        $correo = $cliente->getCorreo();
        $sql = "SELECT * FROM contrata where correo = '" . $correo . "'";
        $ids = array();
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $id = $row['id'];
                    array_push($ids, $id);
                }
            } else {
                return array();
            }
        } else {
            $this->error = $this->mysql->error;
            return false;
        }


        
        $proyectos = array();
        foreach ($ids as $id) {
            $proyecto = $this->getProyectoByID($id);
            array_push($proyectos, $proyecto);
        }


        return $proyectos;
    }

    // obtener fallos según proyecto

    public function getFallosByProyecto($id) {
        $sql = "SELECT DISTINCT fallo.id from tieneFallo left join fallo on tieneFallo.id_fallo = fallo.id where tieneFallo.id_proyecto = '" . $id . "'";
        $fallos = array();
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $id = $row['id'];
                    $fallo = $this->getFalloByID($id);
                    array_push($fallos, $fallo);
                }
            } else {
                return array();
            }
        } else {
            $this->error = $this->mysql->error;
            return false;
        }
        return $fallos;
    }

    public function getFallosByProyectoAndEmpleado($id, $correo) {
        $sql = "SELECT distinct fallo.* from tieneAsignado left join tieneFallo on tieneAsignado.id = tieneFallo.id_fallo left join fallo on fallo.id = tieneFallo.id_fallo where correo = '" . $correo . "' and id_proyecto='" . $id . "'";
        $fallos = array();
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $id = $row['id'];
                    $fallo = $this->getFalloByID($id);
                    array_push($fallos, $fallo);
                }
            } else {
                return array();
            }
        } else {
            $this->error = $this->mysql->error;
            return false;
        }
        return $fallos;
    }


    //Fallo

    public function getAllFallos() {
        $sql = "SELECT * FROM fallo";
        $fallos = array();
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $id = $row['id'];
                    $descripcion = $row['descripcion'];
                    $status = $row['status'];
                    $fecha = $row['fecha'];
                    
                    //recuperar Proyecto al que pertenece
                    $id_proyecto = "";
                    $sql = "SELECT * FROM tieneFallo where id_fallo = '" . $id . "'";
                    if($result = $this->mysql->query($sql)) {
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_array()) {
                                $id_proyecto = $row['id_proyecto'];
                            }
                        } else {
                            $this->error = "No encontrado";
                            return false;
                        }
                    }

                    $proyecto = $this->getProyectoByID($id_proyecto);

                    //recuperar los empleados a los que fue asignado el fallo

                    $correos = array();
                    $asignados = array();
                    $sql = "SELECT * FROM tieneAsignado where id = '" . $id . "'";
                    if($result = $this->mysql->query($sql)) {
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_array()) {
                                array_push($asignados, $row['correo']);
                            }
                        } else {
                            $this->error = "No encontrado";
                            return false;
                        }
                    }
                    foreach($correos as $correo) {
                        $empleado = $this->getEmpleadoByID($correo);
                        array_push($asignados, $empleado);
                    }

                    $proyecto = $this->getProyectoByID($id_proyecto);


                    $fallo = new Fallo($descripcion, $fecha, $proyecto);
                    $fallo->setStatus($status);
                    $fallo->setID($id);
                    $fallo->setAsignados($asignados);
                    array_push($fallos, $fallo);
                }
                return $fallos;
            } else {
                $this->error = "Empty table";
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }

    //Nota

    public function getAllNotas() {
        $sql = "SELECT * FROM nota";
        $notas = array();
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $id = $row['id'];
                    $contenido = $row['contenido'];
                    $fecha = $row['fecha'];
                    
                    //recuperar Fallo al que pertenece
                    $id_fallo = "";
                    $sql = "SELECT * FROM tieneNota where id_nota = '" . $id . "'";
                    if($result2 = $this->mysql->query($sql)) {
                        if($result2->num_rows > 0) {
                            while($row = $result2->fetch_array()) {
                                $id_fallo = $row['id_fallo'];
                            }
                        } else {
                            $this->error = "No encontrado";
                            return false;
                        }
                    }

                    $fallo = $this->getFalloByID($id_fallo);

                    //recuperar el empleado que escribió la Nota

                    $sql = "SELECT * FROM escribeNota where id = '" . $id . "'";
                    if($result2 = $this->mysql->query($sql)) {
                        if($result2->num_rows > 0) {
                            while($row = $result2->fetch_array()) {
                                $correo = $row['correo'];
                            }
                        } else {
                            $this->error = "No encontrado";
                            return false;
                        }
                    }
                    $autor = $this->getEmpleadoByID($correo);


                    $nota = new Nota($contenido, $fecha, $autor, $fallo);
                    $nota->setID($id);
                    array_push($notas, $nota);
                }
                return $notas;
            } else {
                $this->error = "Empty table";
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }

    public function getNotasByFallo(string $id) {
        $sql = "SELECT nota.* from nota left join tieneNota on nota.id = tieneNota.id_nota where id_fallo = '" . $id . "' order by fecha";
        $notas = array();
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $id = $row['id'];
                    $contenido = $row['contenido'];
                    $fecha = $row['fecha'];
                    
                    //recuperar Fallo al que pertenece
                    $id_fallo = "";
                    $sql = "SELECT * FROM tieneNota where id_nota = '" . $id . "'";
                    if($result2 = $this->mysql->query($sql)) {
                        if($result2->num_rows > 0) {
                            while($row = $result2->fetch_array()) {
                                $id_fallo = $row['id_fallo'];
                            }
                        } else {
                            $this->error = "No encontrado";
                            return false;
                        }
                    }

                    $fallo = $this->getFalloByID($id_fallo);

                    //recuperar el empleado que escribió la Nota

                    $sql = "SELECT * FROM escribeNota where id = '" . $id . "'";
                    if($result2 = $this->mysql->query($sql)) {
                        if($result2->num_rows > 0) {
                            while($row = $result2->fetch_array()) {
                                $correo = $row['correo'];
                            }
                        } else {
                            $this->error = "No encontrado";
                            return false;
                        }
                    }
                    $autor = $this->getEmpleadoByID($correo);


                    $nota = new Nota($contenido, $fecha, $autor, $fallo);
                    $nota->setID($id);
                    array_push($notas, $nota);
                }
                return $notas;
            } else {
                $this->error = "Empty table";
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }

    //Bitacora

    public function getAllBitacoras() {
        $sql = "SELECT * FROM bitacora";
        $bitacoras = array();
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $id = $row['id'];
                    $causa = $row['causa'];
                    $solucion = $row['solucion'];
                    $tiempoConsumido = $row['tiempoConsumido'];
                    
                    //recuperar Fallo al que pertenece
                    $id_fallo = "";
                    $sql = "SELECT * FROM tienebitacora where id_bitacora = '" . $id . "'";
                    if($result = $this->mysql->query($sql)) {
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_array()) {
                                $id_fallo = $row['id_fallo'];
                            }
                        } else {
                            $this->error = "No encontrado";
                            return false;
                        }
                    }

                    $fallo = $this->getFalloByID($id_fallo);

                    //recuperar el empleado que escribió la Bitácora

                    $sql = "SELECT * FROM escribeBitacora where id = '" . $id . "'";
                    if($result = $this->mysql->query($sql)) {
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_array()) {
                                $correo = $row['correo'];
                            }
                        } else {
                            $this->error = "No se encontró le autor en la base de datos";
                            return false;
                        }
                    }
                    $autor = $this->getEmpleadoByID($correo);


                    $bitacora = new Bitacora($causa, $solucion, $tiempoConsumido, $autor, $fallo);
                    $bitacora->setID($id);
                    array_push($bitacoras, $bitacora);
                }
                return $bitacora;
            } else {
                $this->error = "Empty table";
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }

    public function getBitacoraByFallo(string $id) {
        $sql = "SELECT bitacora.* from bitacora left join tieneBitacora on bitacora.id = tieneBitacora.id_bitacora where id_fallo = '" . $id . "'";
        if($result = $this->mysql->query($sql)) {
            if($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $idBitacora = $row['id'];
                    $causa = $row['causa'];
                    $solucion = $row['solucion'];
                    $tiempoConsumido = $row['tiempoConsumido'];
                    
                    //recuperar Fallo al que pertenece
                    
                    $fallo = $this->getFalloByID($id);

                    //recuperar el empleado que escribió la Bitácora

                    $sql = "SELECT * FROM escribeBitacora where id = '" . $idBitacora . "'";
                    if($result = $this->mysql->query($sql)) {
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_array()) {
                                $correo = $row['correo'];
                            }
                        } else {
                            $this->error = "No se encontró el autor en la base de datos";
                            return false;
                        }
                    }
                    $autor = $this->getEmpleadoByID($correo);


                    $bitacora = new Bitacora($causa, $solucion, $tiempoConsumido, $autor, $fallo);
                    $bitacora->setID($idBitacora);
                    return $bitacora;
                }
            } else {
                $this->error = "Bitácora no encontrada.";
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }

//Update 

    //Cliente

    public function updateCliente(string $id, Cliente $cliente) {
        $correo = $cliente->getCorreo();
        $nombre = $cliente->getNombre();
        $password = $cliente->getPassword();
        $rfc = $cliente->getRFC();

        $oldCliente = $this->getByID($id, $this::CLIENTE);

        $sql_query = "UPDATE cliente set correo = ?, nombre = ?, password = ?, rfc = ? WHERE correo = ?";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("sssss", $param_correo, $param_nombre, $param_password, $param_rfc, $param_old_correo);
            $param_correo = $correo;
            $param_nombre = $nombre;
            $param_password = $password;
            $param_rfc = $rfc;
            $param_old_correo = $oldCliente->getCorreo();

            if($stmt->execute()) {
                
                return true;
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }

    //Empleado

    public function updateEmpleado(string $oldID, Empleado $empleado) {
        $correo = $empleado->getCorreo();
        $nombre = $empleado->getNombre();
        $password = $empleado->getPassword();
        $esDirector =$empleado->getEsDirector();
        $oldEmpleado = $this->getByID($oldID, $this::EMPLEADO);

        $sql_query = "UPDATE empleado set correo = ?, esDirector = ? , nombre = ?, password = ? WHERE correo = ?";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("sisss", $param_correo,$param_esDirector, $param_nombre, $param_password, $param_old_correo);
            $param_correo = $correo;
            $param_esDirector = $esDirector; 
            $param_nombre = $nombre;
            $param_password = $password;
            $param_old_correo = $oldEmpleado->getCorreo();

            if($stmt->execute()) {
                
                return true;
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }

    //Empleado

    public function updateProyecto(string $id, Proyecto $proyecto) {
        $status = $proyecto->getStatus();
        $nombre = $proyecto->getNombre();
        $fecha_de_contratacion = $proyecto->getFechaDeContratacion();
        $cliente = $proyecto->getContratista();

        $old_proyecto = $this->getByID($id, $this::PROYECTO);

        
        $sql_query = "UPDATE proyecto set status = ?, nombre = ?, fechaDeContratacion = ? WHERE id = ?";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("ssss", $param_status, $param_nombre, $param_fecha_de_contratacion, $param_id);
            $param_status = $status;
            $param_nombre = $nombre;
            $param_fecha_de_contratacion = $fecha_de_contratacion;
            $param_id = $id;

            if(!$stmt->execute()) {             
                $this->error = $this->mysql->error;
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
        //Actualzar el cliente que contrata en caso de ser necesario
        $old_cliente = $old_proyecto->getContratista();
        $cliente = $proyecto->getContratista();

        if($old_cliente == $cliente) {
            return true;
        }

        $new_correo = $cliente->getCorreo();
        $old_correo = $cliente->getCorreo();

        $sql_query = "UPDATE contrata set correo = ? WHERE id = ? AND correo = ? ";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("sss", $param_new_correo, $param_id, $param_old_correo);
            $param_new_correo = $new_correo;
            $param_id = $id;
            $param_old_correo = $old_correo;

            if($stmt->execute()) {
                return true;                
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }
    //Fallo

    public function updateFallo(string $oldID, Fallo $fallo) {
        $id = $oldID;
        $descripcion = $fallo->getDescripcion();
        $fecha = $fallo->getFecha();
        $status = $fallo->getStatus();
        $asignados = $fallo->getAsignados();
        $proyecto = $fallo->getProyecto();

        $oldFallo = $this->getByID($id, $this::FALLO);

        $sql_query = "UPDATE fallo set descripcion = ?, fecha = ?, status = ? WHERE id = '" . $id . "'";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("sss", $param_descripcion, $param_fecha, $param_status);
            $param_descripcion = $descripcion;
            $param_fecha = $fecha;
            $param_status = $status;
            if($stmt->execute()) {
                
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }

        //Consulto los empleados ya asignados para compararlos con los nuevos

        $oldAsignados = $oldFallo->getAsignados();

        foreach($asignados as $asignado) {
            if(array_search($asignado, $oldAsignados) === false) {
                //Inserto los empleados que no estaban asignados
                $correo = $asignado->getCorreo();
                $sql_query = "INSERT INTO tieneAsignado (correo, id) VALUES (?, ?)";
                if($stmt = $this->mysql->prepare($sql_query)) {
                    $stmt->bind_param("ss", $param_correo, $param_id);
                    $param_id = $id;
                    $param_correo = $correo;

                    if($stmt->execute()) {
                        
                    } else {
                        $this->error = $this->mysql->error;
                        return false;
                    }
                } else {
                    $this->error = $this->mysql->error;
                    return false;
                }
                
            }
        }

        foreach($oldAsignados as $oldAsignado) {
            if(array_search($oldAsignado, $asignados) === false) {
                //Borro los empleados que ya no estarán asignados
                $correo = $oldAsignado->getCorreo();
                $sql_query = "DELETE FROM tieneAsignado where correo = ? and id = ?";
                if($stmt = $this->mysql->prepare($sql_query)) {
                    $stmt->bind_param("ss", $param_correo, $param_id);
                    $param_id = $id;
                    $param_correo = $correo;

                    if($stmt->execute()) {

                    } else {
                        $this->error = $this->mysql->error;
                        return false;
                    }
                } else {
                    $this->error = $this->mysql->error;
                    return false;
                }
            }
        }

        $id_proyecto = $proyecto->getID();
        $old_proyecto = $oldFallo->getProyecto();
        $old_id_proyecto = $old_proyecto->getID();

        if($old_id_proyecto =! $id_proyecto) {
            //Actualizo el proyecto al que está asignado el fallo en caso de que haya cambiado
            $sql_query = "UPDATE tieneFallo SET id_proyecto = ? WHERE id_fallo = ' " . $id . "'";
            if($stmt = $this->mysql->prepare($sql_query)) {
                $stmt->bind_param("s", $param_id_proyecto);
                $param_id_proyecto = $id_proyecto;

                if($stmt->execute()) {
                    
                } else {
                    $this->error = $this->mysql->error;
                    return false;
                }
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        }
        
    }

    //Nota

    public function updateNota(string $oldID, Nota $nota) {
        $id = $oldID;
        $contenido = $nota->getContenido();
        $fecha = $nota->getFecha();
        $autor = $nota->getAutor();
        $fallo = $nota->getFallo();

        $oldNota = $this->getByID($id, $this::NOTA);

        $sql_query = "UPDATE nota set contenido = ?, fecha = ?  WHERE id = ?";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("sss", $param_contenido, $param_fecha, $param_id);
            $param_contenido = $contenido;
            $param_fecha = $fecha;
            $param_id = $oldID;

            if($stmt->execute()) {

            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        } else {
            $this->error = $this->mysql->error;           
            return false;
        }

        $id_fallo = $fallo->getID();
        $old_fallo = $oldNota->getFallo();
        $old_id_fallo = $old_fallo->getID();

        if(strcmp($old_id_fallo, $id_fallo) !== 0) {
            //Actualizo el fallo al que está asignado el fallo en caso de que haya cambiado
            $sql_query = "UPDATE tieneNota SET id_fallo = ? WHERE id_nota = '" . $id . "'";
            if($stmt = $this->mysql->prepare($sql_query)) {
                $stmt->bind_param("s", $param_id_fallo);
                $param_id_fallo = $id_fallo;

                if($stmt->execute()) {
                    
                } else {
                    $this->error = $this->mysql->error;
                    return false;
                }
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        }

        $correo_autor = $autor->getCorreo();
        $old_autor = $oldNota->getAutor();
        $old_correo_autor = $old_autor->getCorreo();

        if(strcmp($old_correo_autor, $correo_autor) !== 0) {
            //Actualizo el autor al que está asignado el autor en caso de que haya cambiado
            $sql_query = "UPDATE escribeNota SET correo = ? WHERE id = '" . $id . "'";
            if($stmt = $this->mysql->prepare($sql_query)) {
                $stmt->bind_param("s", $param_correo_autor);
                $param_correo_autor = $correo_autor;

                if($stmt->execute()) {

                } else {
                    $this->error = $this->mysql->error;
                    return false;
                }
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        }
        return true;
    }

    //Bitacora

    public function updateBitacora(string $oldID, Bitacora $bitacora) {
        $id = $oldID;
        $causa = $bitacora->getCausa();
        $solucion = $bitacora->getSolucion();
        $tiempoConsumido = $bitacora->getTiempoConsumido();
        $autor = $bitacora->getAutor();
        $fallo = $bitacora->getFallo();

        $oldBitacora = $this->getByID($oldID, $this::BITACORA);

        $sql_query = "UPDATE bitacora set causa = ?, solucion = ?, tiempoConsumido = ? WHERE id = ?";
        if($stmt = $this->mysql->prepare($sql_query)) {
            $stmt->bind_param("ssis", $param_causa, $param_solucion, $param_tiempoConsumido, $param_id);
            $param_causa = $causa;
            $param_solucion = $solucion;
            $param_tiempoConsumido = $tiempoConsumido;
            $param_id = $id;

            if($stmt->execute()) {
                
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }

        $id_fallo = $fallo->getID();
        $old_fallo = $oldBitacora->getFallo();
        $old_id_fallo = $old_fallo->getID();
        

        if(strcmp($old_id_fallo, $id_fallo) !== 0) {
            //Actualizo el fallo al que está asignado el fallo en caso de que haya cambiado
            $sql_query = "UPDATE tieneBitacora SET id_fallo = ? WHERE id_bitacora = '" . $id . "'";
            if($stmt = $this->mysql->prepare($sql_query)) {
                $stmt->bind_param("s", $param_id_fallo);
                $param_id_fallo = $id_fallo;

                if($stmt->execute()) {
                    
                } else {
                    $this->error = $this->mysql->error;
                    return false;
                }
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        }
        $correo_autor = $autor->getCorreo();
        $old_autor = $oldBitacora->getAutor();
        $old_correo_autor = $old_autor->getCorreo();

        if(strcmp($old_correo_autor, $correo_autor) !== 0) {
            //Actualizo el autor al que está asignado el autor en caso de que haya cambiado
            $sql_query = "UPDATE escribeBitacora SET correo = ? WHERE id = '" . $id . "'";
            if($stmt = $this->mysql->prepare($sql_query)) {
                $stmt->bind_param("s", $param_correo_autor);
                $param_correo_autor = $correo_autor;

                if($stmt->execute()) {
                    
                } else {
                    $this->error = $this->mysql->error;
                    return false;
                }
            } else {
                $this->error = $this->mysql->error;
                return false;
            }
        }
        return true;
    }

//Delete

    //Fallo

    public function deleteFalloByID(string $id) {
        $sql = "DELETE FROM fallo  WHERE id = '" . $id . "'";
        if($this->mysql->query($sql) === TRUE) {
            
            return true;
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    } 
    
    //Cliente

    public function deleteClienteByID(string $id) {
        $sql = "DELETE FROM cliente  WHERE correo = '" . $id . "'";
        if($this->mysql->query($sql) === TRUE) {
            
            return true;
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }

    //Empleado

    public function deleteEmpleadoByID(string $id) {
        $sql = "DELETE FROM empleado  WHERE correo = '" . $id . "'";
        if($this->mysql->query($sql) === TRUE) {
            
            return true;
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }

    //Nota

    public function deleteNotaByID(string $id) {
        $sql = "DELETE FROM nota  WHERE id = '" . $id . "'";
        if($this->mysql->query($sql) === TRUE) {
            
            return true;
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }

    //Bitacora

    public function deleteBitacoraByID(string $id) {
        $sql = "DELETE FROM bitacora  WHERE id = '" . $id . "'";
        if($this->mysql->query($sql) === TRUE) {
            
            return true;
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }

    //Proyecto

    public function deleteProyectoByID(string $id) {
        $sql = "DELETE FROM proyecto  WHERE id = '" . $id . "'";
        if($this->mysql->query($sql) === TRUE) {
            
            return true;
        } else {
            $this->error = $this->mysql->error;
            
            return false;
        }
    }
}



