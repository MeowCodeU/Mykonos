<?php
class Conexion{
    protected $con;
    private $host;
    private $user;
    private $pass;
    private $db;
    private $error;

    public function __construct($host, $db, $user, $pass){
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
        try {
            $this->con = new PDO("mysql:host=".$this->host.";dbname=".$this->db, $this->user, $this->pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
    }
    

    public function getError(){
        return $this->error;
    }

    public function getCon(){
        return $this->con;
    }

    public function getHost(){
        return $this->host;
    }

    public function getDb(){
        return $this->db;
    }
}
?>  