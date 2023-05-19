<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Perfiles extends Conexion{

    public $meses;
    public function __construct(){
        parent::__construct();
        date_default_timezone_set('America/Bogota');
        $this->meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    }

    public function listarPerfiles(){
        $sql="SELECT *
                FROM rolesuser
                ORDER BY rol_id ASC";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute()){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($obj);
        }else{
            echo json_encode(false);
        }
    }

    public function addPerfiles (){
        $p = $_POST;
        $data = [$p['nombrePerfiles']];
        $sql = "INSERT INTO rolesuser(rol_nombre) 
                        VALUES (?)";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute($data)){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function editPerfiles(){
        $p = $_POST;
        $data = [$p['nombrePerfiles'],$p['idPerfil']];
        $sql = "UPDATE rolesuser SET rol_nombre = ?
                                WHERE rol_id = ?";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute($data)){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    
    public function getPerfiles($id){
        $sql="SELECT *
                FROM rolesuser
                WHERE rol_id = ?
                ORDER BY rol_id ASC";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$id['id']])){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($obj);
        }else{
            echo json_encode(false);
        }
    }

    public function deletePerfiles($id){
        $sql = "DELETE FROM rolesuser WHERE rol_id = ?";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$id['id']])){
            echo json_encode(true);
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
    $index = new Perfiles();
    $index->$metodo($parametros);
}
?>