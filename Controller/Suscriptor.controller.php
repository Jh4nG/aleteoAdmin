<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Suscriptor extends Conexion{

    public $meses;
    public function __construct(){
        parent::__construct();
        date_default_timezone_set('America/Bogota');
        $this->meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    }

    public function listarSuscriptor(){
        $sql="SELECT *
                FROM suscripciones
                ORDER BY id ASC";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute()){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($obj);
        }else{
            echo json_encode(false);
        }
    }
}


if(isset($_POST) && count($_POST)>0){
    $metodo = $_POST['metodo'];
    $parametros = '';
    if(isset($_POST['parametros']) && $_POST['parametros'] != ''){
        $parametros = $_POST['parametros'];
    }
    $index = new Suscriptor();
    $index->$metodo($parametros);
}
?>