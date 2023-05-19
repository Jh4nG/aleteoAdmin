<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Construccion extends Conexion{

    public function __construct(){
        parent::__construct();
    }

    public function listarConstruc(){
        $sql="SELECT * FROM construccion
                ORDER BY id_constr ASC";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute()){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($obj);
        }else{
            echo json_encode(false);
        }
    }

    public function editConstruc(){
        $p = $_POST;
        $f = $_FILES;
        if($f['imgConstr']['tmp_name'] != ''){ // Mover archivo a carpeta
            $data = $this->getConstruccion(array('id'=>$p['idConstr']),2);
            if(file_exists($this->aleteo["rutaImagenes"].$data[0]->img_constr) && $data[0]->img_constr != ''){
                unlink($this->aleteo["rutaImagenes"].$data[0]->img_constr);
            }

            $name="Img".uniqid().'.'.explode(".", $f["imgConstr"]["name"])[1];
            $link = $this->aleteo["rutaImagenes"].$name;
            move_uploaded_file($f['imgConstr']['tmp_name'], $link);

            $data = [$p['nomConstr'],$p['selConstr'],$name,$p['idConstr']];
            $sql = "UPDATE construccion SET nom_pagina = ?,
                                        estado = ?,
                                        img_constr = ? 
                            WHERE id_constr = ?";
        }else{
            $data = [$p['nomConstr'],$p['selConstr'],$p['idConstr']];
            $sql = "UPDATE construccion SET nom_pagina = ?,
                                        estado = ?
                            WHERE id_constr = ?";
        }
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute($data)){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function getConstruccion($id,$type = 1)
    {
        $sql = "SELECT * FROM construccion WHERE id_constr = ?";
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
    
}

if(isset($_POST) && count($_POST)>0){
    $metodo = $_POST['metodo'];
    $parametros = '';
    if(isset($_POST['parametros']) && $_POST['parametros'] != ''){
        $parametros = $_POST['parametros'];
    }
    $index = new Construccion();
    $index->$metodo($parametros);
}
?>