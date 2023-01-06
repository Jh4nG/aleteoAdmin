<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Users extends Conexion{

    public $meses;
    public function __construct(){
        parent::__construct();
        date_default_timezone_set('America/Bogota');
        $this->meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    }

    public function listarUsers(){
        $sql="SELECT *
                FROM datauser du, rolesuser rol
                WHERE du.id_rol = rol.rol_id
                ORDER BY du_id ASC";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute()){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($obj);
        }else{
            echo json_encode(false);
        }
    }

    public function listarPerfiles(){
        $sql="SELECT * FROM rolesuser
                ORDER BY rol_id ASC";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute()){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($obj);
        }else{
            echo json_encode(false);
        }
    }

    public function addUsers (){
        $p = $_POST;
        $f = $_FILES;
        $name="";
        if($f['imgUsers']['tmp_name'] != ''){ // Mover archivo a carpeta
            $nameImg="ImgUser".uniqid().'.'.explode(".", $f["imgUsers"]["name"])[1];
            $link = $this->aleteo["rutaImagenes"].$nameImg;
            move_uploaded_file($f['imgUsers']['tmp_name'], $link);
        }
        $data = [$p['nombreUsers'],$p['descUsers'],$p['perfilUsers'],$nameImg];

        $sql = "INSERT INTO datauser(du_nombres,du_descripcion,id_rol ,du_img) 
                        VALUES (?,?,?,?)";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute($data)){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function getUsers($id,$type = 1){
        $sql="SELECT *
                FROM datauser
                WHERE du_id = ?
                ORDER BY du_id ASC";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$id['id']])){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            if($type==2){
                return $obj;
            }
            echo json_encode($obj);
        }else{
            echo json_encode(false);
        }
    }

    public function editUsers(){
        $p = $_POST;
        $f = $_FILES;
        $data = $this->getUsers(array('id'=>$p['idUser']),2);
        $nameImg = $data[0]->du_img;
        if($f['imgUsers']['tmp_name'] != ''){ // Mover archivo a carpeta
            if(file_exists($this->aleteo["rutaImagenes"].$data[0]->du_img) && $data[0]->du_img != null){
                unlink($this->aleteo["rutaImagenes"].$data[0]->du_img);
            }
            $nameImg="ImgUser".uniqid().'.'.explode(".", $f["imgUsers"]["name"])[1];
            $link = $this->aleteo["rutaImagenes"].$nameImg;
            move_uploaded_file($f['imgUsers']['tmp_name'], $link);
        }
        $data = [$p['nombreUsers'],$p['descUsers'],$p['perfilUsers'],$nameImg,$p['idUser']];

        $sql = "UPDATE datauser SET du_nombres = ?,
                                    du_descripcion = ?,
                                    id_rol = ?,
                                    du_img = ?
                                WHERE du_id = ?";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute($data)){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function deleteUsers($id){
        $sql = "DELETE FROM datauser WHERE du_id = ?";
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
    $index = new Users();
    $index->$metodo($parametros);
}
?>