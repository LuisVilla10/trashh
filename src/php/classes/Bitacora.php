<?php

class Bitacora implements JsonSerializable {
    private string $causa;
    private string $solucion;
    private string $id;
    private int $tiempo_consumido;
    private Empleado $autor;
    private Fallo $fallo;

    //Constructor 

    public function __construct(string $causa = "", string $solucion = "", int $tiempo_consumido = 0, Empleado $autor = null, Fallo $fallo = null) {
        $this->causa = $causa;
        $this->tiempo_consumido = $tiempo_consumido;
        $this->id = uniqid("bitac-", false);
        $this->solucion = $solucion;
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
        $str .= "Causa: " . $this->causa . "<br>";
        $str .= "Solucion: " . $this->solucion . "<br>";
        $str .= "Tiempo consumido: " . $this->tiempo_consumido . " horas<br>";
        $str .= "Autor: " . $this->autor->getNombre() . "<br>";
        $str .= "Fallo: " . $this->fallo->getId() . "<br>";
        return $str;
    }

    //Setters and getters

    public function setCausa(string $causa) {
        $this->causa = $causa;
    }

    public function setSolucion(string $solucion) {
        $this->solucion = $solucion;
    }

    public function setID(string $id) {
        $this->id = $id;
    }

    public function setAutor(Empleado $autor) {
        $this->autor = $autor;
    }

    public function setFallo(Fallo $fallo) {
        $this->fallo = $fallo;
    }

    public function setTiempoConsumido(int $tiempo_consumido) {
        $this->tiempo_consumido = $tiempo_consumido;
    }

    public function getCausa() {
        return $this->causa;
    }

    public function getID() {
        return $this->id;
    }

    public function getTiempoConsumido() {
        return $this->tiempo_consumido;
    }

    public function getSolucion() {
        return $this->solucion;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getFallo() {
        return $this->fallo;
    }

    // JsonSerializable (para poder codificarlo como json)

    public function jsonSerialize() {
        $array = ['id' => $this->id, 'causa' => $this->causa, 'solucion' => $this->solucion, 'tiempo_consumido' => $this->tiempo_consumido, 'autor' => $this->autor, 'fallo' => $this->fallo];
        return $array;
    }

    //Contruir desde json 

    public static function fromJson($json) {
        $bitacora = new Bitacora;
        $array = json_decode($json, true);
        $bitacora->id = $array['id'];
        $bitacora->causa = $array['causa'];
        $bitacora->solucion = $array['solucion'];
        $bitacora->tiempo_consumido = $array['tiempo_consumido'];
        $bitacora->autor = Empleado::fromJson(json_encode($array['autor']));
        $bitacora->fallo = Fallo::fromJson(json_encode($array['fallo']));
        return $bitacora;
    }
}