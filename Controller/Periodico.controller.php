<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Categoria extends Conexion{

    public function __construct(){
        parent::__construct();
    }
    
}

if(isset($_POST) && count($_POST)>0){
    $metodo = $_POST['metodo'];
    $parametros = '';
    if(isset($_POST['parametros']) && $_POST['parametros'] != ''){
        $parametros = $_POST['parametros'];
    }
    $index = new Categoria();
    $index->$metodo($parametros);
}
?>