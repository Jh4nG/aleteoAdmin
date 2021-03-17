<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Apoyanos extends Conexion
{
    public function __construct(){
        parent::__construct();
    }

    public function listarApoyanos($id = '')
    {
        if ($id != ''){
            $sql="SELECT * FROM apoyanos WHERE id = ?";
            $rdb = $this->con_aleteo->prepare($sql);
            if($rdb->execute([(int) $id["id"]])){
                $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
                echo json_encode($obj);
            }else{
                echo json_encode(false);
            }
        }else{
            $sql="SELECT * FROM apoyanos ORDER BY id ASC";
            $rdb = $this->con_aleteo->prepare($sql);
            if($rdb->execute()){
                $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
                echo json_encode($obj);
            }else{
                echo json_encode(false);
            }
        }
    }

    public function upload($parametros)
    {  
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['desc'];
        $url = $_POST['url'];
        
        if($_FILES['imagenApoyanos']['tmp_name'] != ''){ // Mover archivo a carpeta
            $nameImg="ImgApoy".uniqid().'.'.explode(".", $_FILES["imagenApoyanos"]["name"])[1];
            $link = $this->aleteo["rutaImagenes"].$nameImg;
            move_uploaded_file($_FILES['imagenApoyanos']['tmp_name'], $link);
        }
        
        $sql = "INSERT INTO apoyanos(titulo,descripcion,imagen,video) VALUES(?,?,?,?)";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$titulo, $descripcion, $nameImg, $url])){
            echo json_encode('insert');
        }else{
            echo json_encode('noinsert');
        }    
    }

    public function edit($parametros)
    {   
        $id = $_POST['idApoyanos'];
        $titulo = $_POST['tituloApoyanosEdit'];
        $descripcion = $_POST['descripcionApoyanosEdit'];
        $video = $_POST['urlApoyanosEdit'];
        $imagenBorrar = $_POST['imagenApoyanosBorrar'];
        
        if($_FILES["imagenApoyanosEdit"]["tmp_name"] != ''){

            if(file_exists($this->aleteo["rutaImagenes"].$imagenBorrar)){
                unlink($this->aleteo["rutaImagenes"].$imagenBorrar);
            }

            $nameImg="ImgApoy".uniqid().'.'.explode(".", $_FILES["imagenApoyanosEdit"]["name"])[1];
            $link = $this->aleteo["rutaImagenes"].$nameImg;
            move_uploaded_file($_FILES['imagenApoyanosEdit']['tmp_name'], $link);

            $sql = "UPDATE apoyanos SET titulo = ?,
            descripcion = ?, imagen = ?, video = ?
            WHERE id = ?";
            $rdb = $this->con_aleteo->prepare($sql);
            if($rdb->execute([$titulo, $descripcion, $link, $video, $id])){
                echo json_encode('edit');
            }else{
                echo json_encode('noedit');
            }   
        }else{
            $sql = "UPDATE apoyanos SET titulo = ?,
            descripcion = ?, video = ?
            WHERE id = ?";
            $rdb = $this->con_aleteo->prepare($sql);
            if($rdb->execute([$titulo, $descripcion, $video, $id])){
                echo json_encode('edit');
            }else{
                echo json_encode('noedit');
            }   
        }
         
    }

    public function deleteApoyanos($parametro)
    {   
        $id = $parametro['id'];
        $imagen = $parametro['imagen'];

        if(file_exists($this->aleteo["rutaImagenes"].$imagen)){
            unlink($this->aleteo["rutaImagenes"].$imagen);
        }

        $sql="DELETE FROM apoyanos WHERE id = ?";
        $rdb = $this->con_aleteo->prepare($sql);

        if($rdb->execute([$id])){
            echo json_encode('delete');
        }else{
            echo json_encode('nodelete');
        } 
    }
}

if(isset($_POST) && count($_POST)>0){
    $metodo = $_POST['metodo'];
    $parametros = '';
    if(isset($_POST['parametros']) && $_POST['parametros'] != ''){
        $parametros = $_POST['parametros'];
    }
    $Apoyanos = new Apoyanos();
    $Apoyanos->$metodo($parametros);
}