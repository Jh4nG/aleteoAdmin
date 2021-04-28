<?php 
require_once dirname(__FILE__).'/Conexion.php';

class SerieWeb extends Conexion{

    public $meses;
    public function __construct(){
        parent::__construct();
        date_default_timezone_set('America/Bogota');
        $this->meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    }

    public function listarSerie(){
        $sql="SELECT *,
                (CASE WHEN serie_clasificacion = 1 THEN 'Adicionales'
                    ELSE 'Capítulos' END) AS clasificacion
                FROM serieweb
                ORDER BY id ASC";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute()){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($obj);
        }else{
            echo json_encode(false);
        }
    }

    public function addSerieWeb(){
        $p = $_POST;
        $f = $_FILES;
        $name="";
        if($f['imgSerieWeb']['tmp_name'] != ''){ // Mover archivo a carpeta
            $nameImg="ImgSer".uniqid().'.'.explode(".", $f["imgSerieWeb"]["name"])[1];
            $link = $this->aleteo["rutaImagenes"].$nameImg;
            move_uploaded_file($f['imgSerieWeb']['tmp_name'], $link);
        }
        $data = [$p['titSerieWeb'],$p['descSerieWeb'],$p['videoSerie'],$p['clasificaSerieWeb'],$nameImg];

        $sql = "INSERT INTO serieweb(serie_titulo,serie_descipcion,serie_video,serie_clasificacion,serie_img) 
                        VALUES (?,?,?,?,?)";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute($data)){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function getSerieWeb($id,$type = 1){
        $sql="SELECT *
                FROM serieweb
                WHERE id = ?
                ORDER BY id ASC";
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


    public function editSerieWeb(){
        $p = $_POST;
        $f = $_FILES;
        $data = $this->getSerieWeb(array('id'=>$p['idSer']),2);
        $nameImg = $data[0]->serie_img;
        if($f['imgSerieWeb']['tmp_name'] != ''){ // Mover archivo a carpeta
            if(file_exists($this->aleteo["rutaImagenes"].$data[0]->serie_img)){
                unlink($this->aleteo["rutaImagenes"].$data[0]->serie_img);
            }
            $nameImg="ImgPer".uniqid().'.'.explode(".", $f["imgSerieWeb"]["name"])[1];
            $link = $this->aleteo["rutaImagenes"].$nameImg;
            move_uploaded_file($f['imgSerieWeb']['tmp_name'], $link);
        }
        $data = [$p['titSerieWeb'],$p['descSerieWeb'],$p['videoSerie'],$p['clasificaSerieWeb'],$nameImg,$p['idSer']];

        $sql = "UPDATE serieweb SET serie_titulo = ?,
                                    serie_descipcion = ?,
                                    serie_video = ?,
                                    serie_clasificacion = ?,
                                    serie_img = ?
                                WHERE id = ?";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute($data)){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function deleteSerie($id){
        $sql = "DELETE FROM serieweb WHERE id = ?";
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
    $index = new SerieWeb();
    $index->$metodo($parametros);
}
?>