<?php

class Empleado implements JsonSerializable {
    private $id;
    private $nombre;
    private $correo;
    private $password;
    private $esDirector;

    //Constructor 
    public function __construct($id =  "", $nombre = "", $correo = "", $password = "", $esDirector = false) {
        $this -> id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->password = $password;
        $this->esDirector = $esDirector;
    }

    public function __toString() {
        $str = "";
        $str .= "id:" . $this -> id . "<br>";
        $str .= "Correo: " . $this->correo . "<br>";
        $str .= "Nombre: " . $this->nombre . "<br>";
        $str .= "password: " . $this->password . "<br>";
        if($this->esDirector) {
            $str .= "¿Es director?: " .  "Sí <br>" ;
        }else {
            $str .= "¿Es director?: " .  "No<br>" ;
        }
        
        return $str;
    }

    //Setters and getters
    public function setID($id) {
        $this->id = $id;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setEsDirector($esDirector) {
        $this->esDirector = $esDirector;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getID() {
        return $this->id;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEsDirector() {
        return $this->esDirector;
    }

    // JsonSerializable (para poder codificarlo como json)
    public function jsonSerialize() {
        $array = [
            'id' => $this -> id,
            'correo' => $this -> correo,
            'nombre' => $this -> nombre,
            'password' => $this -> password,
            'esDirector' => $this -> esDirector,
        ];
        
        return $array;
    }

    //Contruir desde json 
    public static function fromJson($json) {
        $array = json_decode($json, true);

        $id = $array['id'];
        $correo = $array['correo'];
        $nombre = $array['nombre'];
        $password = $array['password'];
        $esDirector = $array['esDirector'];        

        $empleado = new Empleado($id, $nombre, $correo, $password, $esDirector);
        return $empleado;
    }
}
