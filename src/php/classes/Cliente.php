<?php

class Cliente implements JsonSerializable {
    public string $nombre;
    public string $correo;
    public string $password;
    public string $rfc;

    //Constructor 

    public function __construct(string $nombre = "", string $correo = "", string $password = "", string $rfc = "") {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->password = $password;
        $this->rfc = $rfc;
    }

    public function __toString() {
        $str = "";
        $str .= "Correo: " . $this->correo . "<br>";
        $str .= "Nombre: " . $this->nombre . "<br>";
        $str .= "password: " . $this->password . "<br>";
        $str .= "rfc: " . $this->rfc . "<br>";
        return $str;
    }

    //Setters and getters

    public function setNombre(string $nombre) {
        $this->nombre = $nombre;
    }

    public function setCorreo(string $correo) {
        $this->correo = $correo;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function setRFC(string $rfc) {
        $this->rfc = $rfc;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRFC() {
        return $this->rfc;
    }

    // JsonSerializable (para poder codificarlo como json)

    public function jsonSerialize() {
        $array = ['correo' => $this->correo, 'nombre' => $this->nombre, 'password' => $this->password, 'rfc' => $this->rfc];
        return $array;
    }
    
    //Contruir desde json 

    public static function fromJson($json) {
        $cliente = new Cliente();
        $array = json_decode($json, true);
        $cliente->correo = $array['correo'];
        $cliente->nombre = $array['nombre'];
        $cliente->password = $array['password'];
        $cliente->rfc = $array['rfc'];
        return $cliente;
    }

}