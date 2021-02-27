<?php 
require_once dirname(__FILE__).'/Conexion.php';

class prueba extends Conexion
{
    public function __construct(){
        parent::__construct();
        $sql = "INSERT INTO usuarios(usuario,nombres,estado,id_clie,id_rol,contrasena) VALUES(?,?, ?, ?,?,?)";
        $pass = password_hash('karmabencion11', PASSWORD_DEFAULT);
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute(['edalgole','Edison González', 1, 1, 1, $pass])){
            var_dump("si");
        }
    }
}

//$prueba = new prueba;
