<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Podcast extends Conexion
{
    public function __construct(){
        parent::__construct();
        $this->dirAudios = dirname(__DIR__). '/audios/';
    }

    public function listarPodcast($id = '')
    {
        exit(var_dump($id));
        if ($id != ''){
            $sql="SELECT * FROM podcast WHERE id = ?";
            $rdb = $this->con_aleteo->prepare($sql);
            if($rdb->execute($id)){
                $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
                echo json_encode($obj);
            }else{
                echo json_encode(false);
            }
        }else{
            $sql="SELECT * FROM podcast ORDER BY id ASC";
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

        $sql="DELETE FROM podcast WHERE ID = ?";
        $rdb = $this->con_aleteo->prepare($sql);

        if($rdb->execute([$id])){
            echo json_encode('delete');
        }else{
            echo json_encode('nodelete');
        } 
    }

    public function upload($parametros)
    {   
        $parametros = explode(",", $parametros);
        $nombre = $parametros[0];
        $descripcion = $parametros[1];
        $id = uniqid();
        
        if (!file_exists($this->dirAudios)){
            mkdir($this->dirAudios);
        }
        $audioName = explode(".", $_FILES["audio"]["name"]);
        $audio = $_FILES["audio"]["tmp_name"];
        $link = $this->dirAudios.$audioName[0].'_'.$id.'.'.$audioName[1];
        move_uploaded_file($audio, $link);
        // $audioBase64 = "data:audio/". $audioName[1]. ";base64," . base64_encode(file_get_contents($link));

        $sql = "INSERT INTO podcast(nombre,descripcion,link,id_seccion) VALUES(?,?, ?,?)";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$nombre, $descripcion, $link, 3])){
            echo json_encode('insert');
        }else{
            echo json_encode('noinsert');
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