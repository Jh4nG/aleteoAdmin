<?php 
require_once dirname(__FILE__).'/Conexion.php';

class prueba extends Conexion
{
    public function __construct(){
        parent::__construct();
        $sql = "INSERT INTO usuarios(usuario,nombres,estado,id_clie,id_rol,contrasena) VALUES(?,?, ?, ?,?,?)";
        $pass = password_hash('', PASSWORD_DEFAULT);
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute(['','', 1, 1, 1, $pass])){
            echo 'hecho';
        }
    }
}

//$prueba = new prueba;
