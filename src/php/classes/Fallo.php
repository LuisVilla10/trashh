<?php

class Fallo implements JsonSerializable {
    private string $descripcion;
    private string $status;
    private string $id;
    private string $fecha;
    private array $asignados;
    private Proyecto $proyecto;
    //Constructor 

    public function __construct(string $descripcion = "", string $fecha = "", Proyecto $proyecto = null) {
        $this->descripcion = $descripcion;
        $this->fecha = $fecha;
        $this->id = uniqid("fallo-", false);
        $this->status = "notificado";
        $this->asignados = array();
        if($proyecto == null) {
            $this->proyecto = new Proyecto;
        } else {
            $this->proyecto = $proyecto;
        }
    }

    public function __toString() {
        $str = "";
        $str .= "ID: " . $this->id . "<br>";
        $str .= "Descripción: " . $this->descripcion . "<br>";
        $str .= "Status: " . $this->status . "<br>";
        $str .= "Fecha de incidencia: " . $this->fecha . "<br>";
        $str .= "Asignados: ";
        foreach($this->asignados as $asignado) {
            $str .= ":" . $asignado->getCorreo() . ":";
        }
        $str .= "<br>";
        $str .= "Proyecto: " . $this->proyecto->getNombre() . "<br>";
        return $str;
    }

    //Setters and getters

    public function setDescripcion(string $descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setStatus(string $status) {
        $this->status = $status;
    }

    public function setID(string $id) {
        $this->id = $id;
    }

    public function setAsignados(array $asignados) {
        $this->asignados = $asignados;
    }

    public function setFecha(string $fecha) {
        $this->fecha = $fecha;
    }

    public function setProyecto(Proyecto $proyecto) {
        $this->proyecto = $proyecto;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getID() {
        return $this->id;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getAsignados() {
        return $this->asignados;
    }

    public function getProyecto() {
        return $this->proyecto;
    }

    public function asignar(Empleado $empleado) {
        if(array_search($empleado, $this->asignados) !== false) {
            
        } else {
            array_push($this->asignados, $empleado);
        }
    }

    public function deasignar($empleado) {
        if(($indice = array_search($empleado, $this->asignados)) !== false) {
            unset($this->asignados[$indice]);
        }
    }

    // JsonSerializable (para poder codificarlo como json)

    public function jsonSerialize() {
        $array = ['id' => $this->id, 'descripcion' => $this->descripcion, 'status' => $this->status, 'fecha' => $this->fecha, 'asignados' => $this->asignados, 'proyecto' => $this->proyecto];
        return $array;
    }

    //Contruir desde json 

    public static function fromJson($json) {
        $fallo = new Fallo("", "");
        $array = json_decode($json, true);
        $fallo->id = $array['id'];
        $fallo->descripcion = $array['descripcion'];
        $fallo->status = $array['status'];
        $fallo->fecha = $array['fecha'];
        if(isset($array['asignados'])) {
            $fallo->asignados = $array['asignados'];
        }
        $fallo->proyecto = Proyecto::fromJson(json_encode($array['proyecto']));
        return $fallo;
    }
}