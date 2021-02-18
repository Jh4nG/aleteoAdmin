<?php 
require_once dirname(__FILE__).'/Conexion.php';

class Organizaciones extends Conexion
{
    public function __construct(){
        parent::__construct();
    }

    public function listarOrg($id = '')
    {
        if ($id != ''){
            $sql="SELECT * FROM organizaciones WHERE id = ?";
            $rdb = $this->con_aleteo->prepare($sql);
            if($rdb->execute([(int) $id["id"]])){
                $obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
                echo json_encode($obj);
            }else{
                echo json_encode(false);
            }
        }else{
            $sql="SELECT * FROM organizaciones ORDER BY id ASC";
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
        $parametros = explode(",", $parametros);
        $titulo = $parametros[0];
        $descripcion = $parametros[1];
        $activo = $parametros[2] == 'true' ? 1 : 0;
        
        $bytes = file_get_contents($_FILES["imagenOrg"]["tmp_name"]);
		$code64 = base64_encode($bytes);
		$extension = explode(".", $_FILES["imagenOrg"]["name"]);
		$icon = "data:image/".$extension[1].";base64,".$code64; 

        $sql = "INSERT INTO organizaciones(titulo,descripcion,imagen,activo) VALUES(?,?,?,?)";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$titulo, $descripcion, $icon, $activo])){
            echo json_encode('insert');
        }else{
            echo json_encode('noinsert');
        }    
    }

    public function edit($parametros)
    {   
        $parametros = explode(",", $parametros);
        $id = $parametros[0];
        $titulo = $parametros[1];
        $descripcion = $parametros[2];
        $activo = $parametros[3] == 'true' ? 1 : 0;
        
        if($_FILES["imagenOrgEdit"]["tmp_name"] != ''){
            
            $bytes = file_get_contents($_FILES["imagenOrgEdit"]["tmp_name"]);
            $code64 = base64_encode($bytes);
            $extension = explode(".", $_FILES["imagenOrgEdit"]["name"]);
            $icon = "data:image/".$extension[1].";base64,".$code64;

            $sql = "UPDATE organizaciones SET titulo = ?,
            descripcion = ?, activo = ?, imagen = ?
            WHERE id = ?";
            $rdb = $this->con_aleteo->prepare($sql);
            if($rdb->execute([$titulo, $descripcion, $activo, $icon, $id])){
                echo json_encode('edit');
            }else{
                echo json_encode('noedit');
            }   
        }else{
            $sql = "UPDATE organizaciones SET titulo = ?,
            descripcion = ?, activo = ?
            WHERE id = ?";
            $rdb = $this->con_aleteo->prepare($sql);
            if($rdb->execute([$titulo, $descripcion, $activo, $id])){
                echo json_encode('edit');
            }else{
                echo json_encode('noedit');
            }   
        }
         
    }

    public function deleteOrg($parametro)
    {   
        $id = $parametro['id'];

        $sql="DELETE FROM organizaciones WHERE id = ?";
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
    $Organizaciones = new Organizaciones();
    $Organizaciones->$metodo($parametros);
}