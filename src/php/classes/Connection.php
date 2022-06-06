<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

class Connection {
    private $server = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'tisupport';

    private $mysql;

    public function __construct() {
        $this -> mysql = new mysqli($this -> server, $this -> user, $this -> pass, $this -> dbname);

        if($this -> mysql === false){
            error_log("No se pudo conectar a la db");
            die("ERROR: Could not connect. " . $this -> mysql -> connect_error);
        }
    }

    public function getConnection() {
        return $this -> mysql;
    }
}

$GLOBALS['conn'] = new Connection();
