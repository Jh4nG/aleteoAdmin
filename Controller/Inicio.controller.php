<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Index extends Conexion{

    public function __construct(){
        parent::__construct();
    }

    public function listarSecciones(){
        $sql="SELECT s.id,s.nombre,s.sec_titulo,s.sec_desc,s.sec_img,s.sec_iframe,s.sec_link_redirect,s.sec_icon,s.sec_estado,s.sec_posicion,c.nombre_categoria,s.fecha_creacion
                FROM secciones s,categoria c
                WHERE s.id_categoria = c.id
                ORDER BY s.id ASC";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute()){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($obj);
        }else{
            echo json_encode(false);
        }
    }

    public function addSeccion(){
        $p = $_POST;
        $f = $_FILES;
        $name="";
        if($f['imgSeccion']['tmp_name'] != ''){ // Mover archivo a carpeta
            $name="Img".uniqid().'.'.explode(".", $f["imgSeccion"]["name"])[1];
            $link = $this->aleteo["rutaImagenes"].$name;
            move_uploaded_file($f['imgSeccion']['tmp_name'], $link);
        }
        $video = str_replace('width="560" height="315"','width="650" height="400"',$p['videoSeccion']);
        $data = [$p['nomSeccion'],$p['titSeccion'],$p['descSeccion'],$name,$video,$p['linkSeccion'],$p['iconSeccion'],$p['selSeccion'],$p['posSeccion'],$p['catSeccion']];
        $sql = "INSERT INTO secciones(nombre,sec_titulo,sec_desc,sec_img,sec_iframe,sec_link_redirect,sec_icon,sec_estado,sec_posicion,id_categoria) 
                        VALUES (?,?,?,?,?,?,?,?,?,?)";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute($data)){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function getSeccion($id,$type = 1)
    {
        $sql = "SELECT * FROM secciones WHERE id = ?";
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

    public function editSecciones(){
        $p = $_POST;
        $f = $_FILES;
        $video = str_replace('width="560" height="315"','width="650" height="400"',$p['videoSeccion']);
        if($f['imgSeccion']['tmp_name'] != ''){ // Mover archivo a carpeta
            $data = $this->getSeccion(array('id'=>$p['idSec']),2);
            if(file_exists($this->aleteo["rutaImagenes"].$data[0]->sec_img)){
                unlink($this->aleteo["rutaImagenes"].$data[0]->sec_img);
            }
            $name="Img".uniqid().'.'.explode(".", $f["imgSeccion"]["name"])[1];
            $link = $this->aleteo["rutaImagenes"].$name;
            move_uploaded_file($f['imgSeccion']['tmp_name'], $link);
            $data = [$p['nomSeccion'],$p['titSeccion'],$p['descSeccion'],$video,$p['linkSeccion'],$p['iconSeccion'],$p['selSeccion'],$p['posSeccion'],$p['catSeccion'],$name,$p['idSec']];
            $sql = "UPDATE secciones SET nombre = ?,
                                        sec_titulo = ?,
                                        sec_desc = ?,
                                        sec_iframe = ?,
                                        sec_link_redirect = ?,
                                        sec_icon = ?,
                                        sec_estado = ?,
                                        sec_posicion = ?,
                                        id_categoria = ?,
                                        sec_img = ?
                            WHERE id = ?";
        }else{
            $data = [$p['nomSeccion'],$p['titSeccion'],$p['descSeccion'],$video,$p['linkSeccion'],$p['iconSeccion'],$p['selSeccion'],$p['posSeccion'],$p['catSeccion'],$p['idSec']];
            $sql = "UPDATE secciones SET nombre = ?,
                                        sec_titulo = ?,
                                        sec_desc = ?,
                                        sec_iframe = ?,
                                        sec_link_redirect = ?,
                                        sec_icon = ?,
                                        sec_estado = ?,
                                        sec_posicion = ?,
                                        id_categoria = ?
                            WHERE id = ?";
        }
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute($data)){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function deleteSeccion($parametros){
        $id = $parametros['id'];
        $sql = "DELETE FROM secciones WHERE id = ?";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$id])){
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
    $index = new Index();
    $index->$metodo($parametros);
}
?>