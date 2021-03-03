<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Podcast extends Conexion
{
    public function __construct(){
        parent::__construct();
    }

    public function listarCategoriaPodcast()
    {
        $sql="SELECT * FROM categoria_podcast ORDER BY id ASC";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute()){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($obj);
        }else{
            echo json_encode(false);
        }
    }

    public function listarPodcast($id = '')
    {
        if ($id != ''){
            $sql="SELECT p.*, c.id AS cat FROM podcast AS p
            INNER JOIN categoria_podcast AS c ON p.categoria = c.id
            WHERE p.id = ?";
            $rdb = $this->con_aleteo->prepare($sql);
            if($rdb->execute([(int) $id["id"]])){
                $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
                echo json_encode($obj);
            }else{
                echo json_encode(false);
            }
        }else{
            $sql="SELECT p.*, c.nombre AS cat FROM podcast AS p
            INNER JOIN categoria_podcast AS c ON p.categoria = c.id
            ORDER BY id ASC";
            $rdb = $this->con_aleteo->prepare($sql);
            if($rdb->execute()){
                $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
                echo json_encode($obj);
            }else{
                echo json_encode(false);
            }
        }
    }

    public function deletePodcast($parametro)
    {   
        $id = $parametro['id'];
        $link = $parametro['link'];

        unlink($link);

        $sql="DELETE FROM podcast WHERE id = ?";
        $rdb = $this->con_aleteo->prepare($sql);

        if($rdb->execute([$id])){
            echo json_encode('delete');
        }else{
            echo json_encode('nodelete');
        } 
    }

    public function upload()
    {   
        $nombre = $_POST['name'];
        $descripcion = $_POST['desc'];
        $categoria = $_POST['cat'];
        $id = uniqid();
        
        if (!file_exists($this->aleteo["rutaAudios"])){
            mkdir($this->aleteo["rutaAudios"]);
        }
        $audioName = explode(".", $_FILES["audio"]["name"]);
        $audio = $_FILES["audio"]["tmp_name"];
        $link = $this->aleteo["rutaAudios"].$audioName[0].'_'.$id.'.'.$audioName[1];
        move_uploaded_file($audio, $link);
        // $audioBase64 = "data:audio/". $audioName[1]. ";base64," . base64_encode(file_get_contents($link));

        $sql = "INSERT INTO podcast(nombre,descripcion,link,id_seccion,categoria) VALUES(?,?,?,?,?)";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$nombre, $descripcion, $audioName[0].'_'.$id.'.'.$audioName[1], 3, $categoria])){
            echo json_encode('insert');
        }else{
            echo json_encode('noinsert');
        }    
    }

    public function edit($parametros)
    {   
        $parametros = explode(",", $parametros);
        $id = $_POST['id'];
        $nombre = $_POST['name'];
        $descripcion = $_POST['desc'];
        $categoria = $_POST['cat'];
        $linkBorrar = $_POST['linkBorrar'];
        
        if($_FILES["audioEdit"]["tmp_name"] != ''){
            unlink($linkBorrar);
            $idFile = uniqid();
        
            if (!file_exists($this->aleteo["rutaAudios"])){
                mkdir($this->aleteo["rutaAudios"]);
            }
            $audioName = explode(".", $_FILES["audioEdit"]["name"]);
            $audio = $_FILES["audioEdit"]["tmp_name"];
            $link = $this->aleteo["rutaAudios"].$audioName[0].'_'.$idFile.'.'.$audioName[1];
            move_uploaded_file($audio, $link);

            $sql = "UPDATE podcast SET nombre = ?,
            descripcion = ?, link = ?, categoria = ?
            WHERE id = ?";
            $rdb = $this->con_aleteo->prepare($sql);
            if($rdb->execute([$nombre, $descripcion, $link, $categoria, $id])){
                echo json_encode('edit');
            }else{
                echo json_encode('noedit');
            }   
        }else{
            $sql = "UPDATE podcast SET nombre = ?,
            descripcion = ?, categoria = ?
            WHERE id = ?";
            $rdb = $this->con_aleteo->prepare($sql);
            if($rdb->execute([$nombre, $descripcion, $categoria, $id])){
                echo json_encode('edit');
            }else{
                echo json_encode('noedit');
            }   
        }
         
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