<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Periodico extends Conexion{

    public function __construct(){
        parent::__construct();
    }

    public function listarPeriodico (){
        $sql="SELECT *
                FROM periodico
                ORDER BY id_periodico ASC";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute()){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($obj);
        }else{
            echo json_encode(false);
        }
    }

    public function addPeriodico(){
        $p = $_POST;
        $f = $_FILES;
        $name="";
        if($f['imgPeriodico']['tmp_name'] != ''){ // Mover archivo a carpeta
            $nameImg="ImgPer".uniqid().'.'.explode(".", $f["imgPeriodico"]["name"])[1];
            $link = $this->aleteo["rutaImagenes"].$nameImg;
            move_uploaded_file($f['imgPeriodico']['tmp_name'], $link);
        }

        if($f['pieimgPeriodico']['tmp_name'] != ''){ // Mover archivo a carpeta
            $nameImgPie="ImgPie".uniqid().'.'.explode(".", $f["pieimgPeriodico"]["name"])[1];
            $linkPie = $this->aleteo["rutaImagenes"].$nameImgPie;
            move_uploaded_file($f['pieimgPeriodico']['tmp_name'], $link);
        }

        $data = [$p['titPeriodico'],$p['contitPeriodico'],$p['autorPeriodico'],$p['textPer'],$nameImg,$nameImgPie,$p['fecpublicoPeriodico'],$p['fecpublPeriodico']];
        $sql = "INSERT INTO periodico(per_titulo,per_contratitulo,per_autor,per_texto,per_link_img,per_link_pie_img,fecha_publico,fecha_publicacion) 
                        VALUES (?,?,?,?,?,?,?)";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute($data)){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function getPeriodico ($id,$type = 1)
    {
        $sql = "SELECT * FROM periodico WHERE id_periodico = ?";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$id['id']])){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            if($type == 2){
                return $obj;
            }
            echo json_encode($obj);
        }else{
            echo json_encode(false);
        }
    }

    public function editPeriodico(){
        $p = $_POST;
        $f = $_FILES;
        $data = $this->getPeriodico(array('id'=>$p['idPer']),2);
        $nameImg = $data[0]->per_link_img;
        $nameImgPie = $data[0]->per_link_pie_img;
        if($f['imgPeriodico']['tmp_name'] != ''){ // Mover archivo a carpeta
            if(file_exists($this->aleteo["rutaImagenes"].$data[0]->per_link_img)){
                unlink($this->aleteo["rutaImagenes"].$data[0]->per_link_img);
            }
            $nameImg="ImgPer".uniqid().'.'.explode(".", $f["imgPeriodico"]["name"])[1];
            $link = $this->aleteo["rutaImagenes"].$nameImg;
            move_uploaded_file($f['imgPeriodico']['tmp_name'], $link);
        }

        if($f['pieimgPeriodico']['tmp_name'] != ''){ // Mover archivo a carpeta
            if(file_exists($this->aleteo["rutaImagenes"].$data[0]->per_link_pie_img)){
                unlink($this->aleteo["rutaImagenes"].$data[0]->per_link_pie_img);
            }
            $nameImgPie="ImgPie".uniqid().'.'.explode(".", $f["pieimgPeriodico"]["name"])[1];
            $linkPie = $this->aleteo["rutaImagenes"].$nameImgPie;
            move_uploaded_file($f['pieimgPeriodico']['tmp_name'], $link);
        }
        $data = [$p['titPeriodico'],$p['contitPeriodico'],$p['autorPeriodico'],$p['textPer'],$nameImg,$nameImgPie,$p['fecpublicoPeriodico'],$p['fecpublPeriodico'],$p['idPer']];
        $sql = "UPDATE periodico SET per_titulo = ?
                                    ,per_contratitulo = ?
                                    ,per_autor = ?
                                    ,per_texto = ?
                                    ,per_link_img = ?
                                    ,per_link_pie_img = ?
                                    ,fecha_publico = ?
                                    ,fecha_publicacion = ?
                                WHERE id_periodico = ?";
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
    $index = new Periodico();
    $index->$metodo($parametros);
}
?>