<?php
require_once dirname(__FILE__)."/.global.php";
class Conexion {

    protected $con_aleteo;
    private $host     = "localhost";
    private $port     = 3306;
    private $socket   = "";
    private $user     = "root";
    private $password = "";
    private $dbname   = "aleteo";
    public $aleteo;

    public function __construct(){
        global $aleteo;
        
        self::iniciar();
        $this->aleteo = $aleteo;
    }

    private function iniciar(){
        try {
            $this->con_aleteo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        // $this->con_aleteo = new mysqli($host, $user, $password, $dbname, $port, $socket)
        //     or die ('Could not connect to the database server' . mysqli_connect_error());
    }
}

?>