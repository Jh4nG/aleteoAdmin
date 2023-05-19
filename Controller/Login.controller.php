<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Index extends Conexion{

    public function __construct(){
        parent::__construct();
    }

    public function iniciarSesion($parametros)
    {
        $user = $parametros['user'];
        $password = $parametros['password'];
        $sql="SELECT * FROM usuarios WHERE usuario='$user'";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute()){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            if(count($obj)>0){
                session_start();
                if (password_verify($password,$obj[0]->contrasena)){
                    $_SESSION['aleteo_user'] = $obj[0]->usuario;
                    $_SESSION['aleteo_rol']  = $obj[0]->id_rol;
                    echo json_encode(array("status"=>200,"msj"=>"Ingreso correcto"));
                }else{
                    echo json_encode(array("status"=>401,"msj"=>"Contraseña Incorrecta"));
                }
            }else{
                echo json_encode(array("status"=>403,"msj"=>"Usuario no encontrado"));
            }
        }else{
            echo json_encode(array("status"=>500,"msj"=>"Error en consulta a Base de datos"));
        }
    }

    public function cerrarSession(){
        session_start();
        session_destroy();
        echo json_encode(true);
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