<?php

class Proyecto implements JsonSerializable {
    private string $nombre;
    private string $status;
    private string $id;
    private string $fecha_de_contratacion;
    private Cliente $contratista;

    //Constructor 

    public function __construct(string $nombre = "", string $fecha_de_contratacion = "", Cliente $contratista = null) {
        $this->nombre = $nombre;
        $this->fecha_de_contratacion = $fecha_de_contratacion;
        $this->id = uniqid("proy-", false);
        $this->status = "en diseño";
        if($contratista == null) {
            $this->contratista = new Cliente;
        } else {
            $this->contratista = $contratista;
        }
    }

    public function __toString() {
        $str = "";
        $str .= "ID: " . $this->id . "<br>";
        $str .= "Nombre: " . $this->nombre . "<br>";
        $str .= "Status: " . $this->status . "<br>";
        $str .= "Fecha de contratación: " . $this->fecha_de_contratacion . "<br>";
        $str .= "Contratista: " . $this->contratista->getRFC() . "<br>";
        return $str;
    }

    //Setters and getters

    public function setNombre(string $nombre) {
        $this->nombre = $nombre;
    }

    public function setStatus(string $status) {
        $this->status = $status;
    }

    public function setID(string $id) {
        $this->id = $id;
    }

    public function setFechaDeContratacion(string $fecha_de_contratacion) {
        $this->fecha_de_contratacion = $fecha_de_contratacion;
    }

    public function setContratista(Cliente $contratista) {
        $this->contratista = $contratista;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getID() {
        return $this->id;
    }

    public function getFechaDeContratacion() {
        return $this->fecha_de_contratacion;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getContratista() {
        return $this->contratista;
    }

    // JsonSerializable (para poder codificarlo como json)

    public function jsonSerialize() {
        $array = ['id' => $this->id, 'nombre' => $this->nombre, 'status' => $this->status, 'fecha_de_contratacion' => $this->fecha_de_contratacion, 'contratista' => $this->contratista];
        return $array;
    }

    //Contruir desde json 

    public static function fromJson($json) {
        $proyecto = new Proyecto;
        $array = json_decode($json, true);
        $proyecto->id = $array['id'];
        $proyecto->nombre = $array['nombre'];
        $proyecto->status = $array['status'];
        $proyecto->fecha_de_contratacion = $array['fecha_de_contratacion'];
        $proyecto->contratista = Cliente::fromJson(json_encode($array['contratista']));

        return $proyecto;
    }
}