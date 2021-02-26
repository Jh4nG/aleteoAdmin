<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Categoria extends Conexion{

    public function __construct(){
        parent::__construct();
    }

    public function listarCategoria()
    {
        $sql="SELECT * FROM categoria ORDER BY id ASC";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute()){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($obj);
        }else{
            echo json_encode(false);
        }
    }

    public function addCategoria(){
        $nombre = $_POST['nomCategoria'];
        $desc = $_POST['descCategoria'];
        $cant = $_POST['cantCategoria'];
        $data = [$nombre,$desc,$cant];
        $sql = "INSERT INTO categoria(nombre_categoria,desc_categoria,cant_reg) VALUES (?,?,?)";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute($data)){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function getCategoria($id){
        $sql = "SELECT * FROM categoria WHERE id = ?";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$id['id']])){
            $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
            echo json_encode($obj);
        }else{
            echo json_encode(false);
        }
    }

    public function editCategoria(){
        $nombre = $_POST['nomCategoria'];
        $desc = $_POST['descCategoria'];
        $cant = $_POST['cantCategoria'];
        $id = $_POST['idCat'];
        $data = [$nombre,$desc,$cant,$id];
        $sql = "UPDATE categoria SET nombre_categoria = ?, 
                                     desc_categoria = ?,
                                     cant_reg = ? 
                                WHERE id = ?";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute($data)){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function deleteCategoria($parametros)
    {
        $id = $parametros['id'];
        $sql = "DELETE FROM categoria WHERE id = ?";
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
    $index = new Categoria();
    $index->$metodo($parametros);
}
?>