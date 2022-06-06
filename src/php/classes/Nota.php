<?php

class Nota implements JsonSerializable {
    private string $contenido;
    private string $id;
    private string $fecha;
    private Empleado $autor;
    private Fallo $fallo;
    //Constructor 

    public function __construct(string $contenido = "", string $fecha = "", Empleado $autor = null, Fallo $fallo = null) {
        $this->contenido = $contenido;
        $this->fecha = $fecha;
        $this->id = uniqid("nota-", false);
        if($autor == null) {
            $this->autor = new Empleado;
        } else {
            $this->autor = $autor;
        }
        if($fallo == null) {
            $this->fallo = new Fallo;
        } else {
            $this->fallo = $fallo;
        }
    }

    public function __toString() {
        $str = "";
        $str .= "ID: " . $this->id . "<br>";
        $str .= "Contenido: " . $this->contenido . "<br>";
        $str .= "Fecha: " . $this->fecha . "<br>";
        $str .= "Autor: " . $this->autor->getNombre() . "<br>";
        $str .= "Fallo: " . $this->fallo->getID() . "<br>";
        return $str;
    }

    //Setters and getters

    public function setContenido(string $contenido) {
        $this->contenido = $contenido;
    }

    public function setID(string $id) {
        $this->id = $id;
    }

    public function setFecha(string $fecha) {
        $this->fecha = $fecha;
    }

    public function setAutor(Empleado $autor) {
        $this->autor = $autor;
    }

    public function setFallo(Fallo $fallo) {
        $this->fallo = $fallo;
    }

    public function getContenido() {
        return $this->contenido;
    }

    public function getID() {
        return $this->id;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getAutor() { 
        return $this->autor;
    }

    public function getFallo() { 
        return $this->fallo;
    }

    // JsonSerializable (para poder codificarlo como json)

    public function jsonSerialize() {
        $array = ['id' => $this->id, 'contenido' => $this->contenido, 'fecha' => $this->fecha, 'autor' => $this->autor, 'fallo' => $this->fallo];
        return $array;
    }

    //Contruir desde json 

    public static function fromJson($json) {
        $nota = new Nota;
        $array = json_decode($json, true);
        $nota->id = $array['id'];
        $nota->contenido = $array['contenido'];
        $nota->fecha = $array['fecha'];
        $nota->autor = Empleado::fromJson(json_encode($array['autor']));
        $nota->fallo = Fallo::fromJson(json_encode($array['fallo']));
        return $nota;
    }
}