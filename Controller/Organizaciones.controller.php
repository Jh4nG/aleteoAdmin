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
        $titulo = $_POST['nameOrg'];
        $descripcion = $_POST['desc'];
        $activo = $_POST['activo'] == 'true' ? 1 : 0;
        $tipo = $_POST['tipo'];
        $url = $_POST['url'];
        
        $bytes = file_get_contents($_FILES["imagenOrg"]["tmp_name"]);
		$code64 = base64_encode($bytes);
		$extension = explode(".", $_FILES["imagenOrg"]["name"]);
		$icon = "data:image/".$extension[1].";base64,".$code64; 

        $sql = "INSERT INTO organizaciones(titulo,descripcion,imagen,activo,tipo,url) VALUES(?,?,?,?,?,?)";
        $rdb = $this->con_aleteo->prepare($sql);
        if($rdb->execute([$titulo, $descripcion, $icon, $activo, $tipo, $url])){
            echo json_encode('insert');
        }else{
            echo json_encode('noinsert');
        }    
    }

    public function edit($parametros)
    {   
        $id = $_POST['id'];
        $titulo = $_POST['name'];
        $descripcion = $_POST['desc'];
        $activo = $_POST['activo'] == 'true' ? 1 : 0;
        $tipo = $_POST['tipo'];
        $url = $_POST['url'];
        
        if($_FILES["imagenOrgEdit"]["tmp_name"] != ''){
            
            $bytes = file_get_contents($_FILES["imagenOrgEdit"]["tmp_name"]);
            $code64 = base64_encode($bytes);
            $extension = explode(".", $_FILES["imagenOrgEdit"]["name"]);
            $icon = "data:image/".$extension[1].";base64,".$code64;

            $sql = "UPDATE organizaciones SET titulo = ?,
            descripcion = ?, activo = ?, imagen = ?, tipo = ?, url = ?
            WHERE id = ?";
            $rdb = $this->con_aleteo->prepare($sql);
            if($rdb->execute([$titulo, $descripcion, $activo, $icon, $tipo, $url, $id])){
                echo json_encode('edit');
            }else{
                echo json_encode('noedit');
            }   
        }else{
            $sql = "UPDATE organizaciones SET titulo = ?,
            descripcion = ?, activo = ?, tipo = ?, url = ?
            WHERE id = ?";
            $rdb = $this->con_aleteo->prepare($sql);
            if($rdb->execute([$titulo, $descripcion, $activo, $tipo, $url, $id])){
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