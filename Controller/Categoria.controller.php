<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Index extends Conexion{

    public function __construct(){
        parent::__construct();
    }

    public function listarCategoria()
    {
        $sql="SELECT * FROM categoria ORDER BY id ASC";
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
    $index = new Index();
    $index->$metodo($parametros);
}
?>