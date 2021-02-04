<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Podcast extends Conexion
{
    public function __construct(){
        parent::__construct();
    }

    public function upload($parametros)
    {   
        $parametros = explode(",", $parametros);
        exit(var_dump($parametros));
    }
}

if(isset($_POST) && count($_POST)>0){
    $metodo = $_POST['metodo'];
    $parametros = '';
    if(isset($_POST['parametros']) && $_POST['parametros'] != ''){
        $parametros = $_POST['parametros'];
    }
    $Podcast = new Podcast();
    $Podcast->$metodo($parametros);
}