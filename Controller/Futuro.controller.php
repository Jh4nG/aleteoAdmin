<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Futuro extends Conexion
{
    public $meses;
    public function __construct(){
        parent::__construct();
        $this->meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    }

    public function getFuturo(){
        $sql="SELECT *
                FROM futuro
                ORDER BY id ASC";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute()){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($obj);
        }else{
            echo json_encode(false);
        }
    }

    public function getFuturoUnique($id,$type=1){
        $id = $id['id'];
        $sql="SELECT *
                FROM futuro
                WHERE id = ?";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$id])){
            if($type == 2){
                return $rdb -> fetchAll(PDO::FETCH_OBJ);
            }else{
                $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
                echo json_encode($obj);
            }
        }else{
            echo json_encode(false);
        }
    }

    public function addFuturo(){
        $p = $_POST;
        $f = $_FILES;
        $name="";
        if($f['imgFuturo']['tmp_name'] != ''){ // Mover archivo a carpeta
            $nameImg="ImgFut".uniqid().'.'.explode(".", $f["imgFuturo"]["name"])[1];
            $link = $this->aleteo["rutaImagenes"].$nameImg;
            move_uploaded_file($f['imgFuturo']['tmp_name'], $link);
        }

        date_default_timezone_set('America/Bogota');
        $fecha = date('Y-m-d');
        $fecha = substr($fecha,8,9).' '.substr($this->meses[substr($fecha,5,-3)-1],0,3).' '.substr($fecha,0,4);
        
        $data = [$p['titFuturo'],$p['textPer'],$nameImg,$fecha];
        $sql = "INSERT INTO futuro(fut_titulo,fut_descripcion,fut_imagen,fecha_creacion_text) 
                        VALUES (?,?,?,?)";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute($data)){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function deleteFuturo($parametro){
        $id = $parametro['id'];
        $futuro = $this->getFuturoUnique($parametro,2);
        if(file_exists($this->aleteo["rutaImagenes"].$futuro[0]->fut_imagen)){
            unlink($this->aleteo["rutaImagenes"].$futuro[0]->fut_imagen);
        }
        $sql="DELETE FROM futuro WHERE id = ?";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$id])){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function editFuturo(){
        $p = $_POST;
        $f = $_FILES;
        $data = $this->getFuturoUnique(array('id'=>$p['idFut']),2);
        $nameImg = $data[0]->fut_imagen;
        if($f['imgFuturo']['tmp_name'] != ''){ // Mover archivo a carpeta
            if(file_exists($this->aleteo["rutaImagenes"].$data[0]->fut_imagen)){
                unlink($this->aleteo["rutaImagenes"].$data[0]->fut_imagen);
            }
            $nameImg="ImgFut".uniqid().'.'.explode(".", $f["imgFuturo"]["name"])[1];
            $link = $this->aleteo["rutaImagenes"].$nameImg;
            move_uploaded_file($f['imgFuturo']['tmp_name'], $link);
        }
        
        $data = [$p['titFuturo'],$p['textPer'],$nameImg,$p['idFut']];
        $sql = "UPDATE futuro SET fut_titulo = ?,
                                  fut_descripcion = ?,
                                  fut_imagen = ?
                            WHERE id = ?";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute($data)){
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
    $Futuro = new Futuro();
    $Futuro->$metodo($parametros);
}