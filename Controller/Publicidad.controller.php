<?php 
require_once (dirname(__DIR__).'/assets/PHPMailer-master/src/PHPMailer.php');
require_once (dirname(__DIR__).'/assets/PHPMailer-master/src/Exception.php');
require_once (dirname(__DIR__).'/assets/PHPMailer-master/src/SMTP.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';

require_once dirname(__FILE__).'/Conexion.php';

class Publicidad extends Conexion
{
    public function __construct(){
        parent::__construct();
    }

    public function EnviarPublicidad()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
		$this->mail->Host = 'smtp.hostinger.co';
		$this->mail->SMTPAuth = true;
		$this->mail->Username = 'aleteo@aleteotransmedia.com';
		$this->mail->Password = '?RvkMSn$?9Vh';
		// $this->mail->SMTPSecure = 'tls';
		$this->mail->Port = 587;
		$this->mail->setFrom('aleteo@aleteotransmedia.com', 'Aleteo Transmedia');
		$this->mail->isHTML(true);

        $this->mail->addAddress('fabianzabala22@gmail.com');
		$this->mail->Subject = 'prueba correo';
		$this->mail->Body = 'prueba';
		$this->mail->AltBody = strip_tags('prueba');
		$this->mail->CharSet = 'UTF-8';

		try {
	    	$this->mail->send();
			echo json_encode(true);
		} catch (Exception $e) {
			throw new Exception($this->mail->ErrorInfo);
		}

        var_dump($this->mail);
    }

	public function listarItemsPublicidad($modulo)
	{	
		switch ($modulo["modulo"]) {
			case 'podcast':
				$sql="SELECT nombre AS titulo FROM podcast ORDER BY id ASC";
			break;
			
			case 'periodico':
				$sql="SELECT per_titulo AS titulo FROM periodico ORDER BY id_periodico ASC";
			break;

			default:
				exit(var_dump("Modulo no encontrado"));
			break;
		}
		
		$rdb = $this->con_aleteo->prepare($sql);
		
		if($rdb->execute()){
			$obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
			echo json_encode($obj);
		}else{
			echo json_encode(false);
		}
	}

	public function traerTarjetas()
	{
		$images = array();
		// $podcast = base64_encode(file_get_contents($this->aleteo["rutaImagenes"].'publicidadPodcast.jpg'));
		$podcast = "data:image/jpg;base64,".base64_encode(file_get_contents(dirname(__DIR__).'/images/img-projects/publicidadPodcast.jpg'));
		$serieweb = "data:image/jpg;base64,".base64_encode(file_get_contents(dirname(__DIR__).'/images/img-projects/publicidadSerieWeb.jpg'));
		$periodico = "data:image/jpg;base64,".base64_encode(file_get_contents(dirname(__DIR__).'/images/img-projects/publicidadPeriodico.jpg'));
		$images['podcast'] = $podcast;
		$images['serieweb'] = $serieweb;
		$images['periodico'] = $periodico;

		echo json_encode($images);
	}
}

if(isset($_POST) && count($_POST)>0){
    $metodo = $_POST['metodo'];
    $parametros = '';
    if(isset($_POST['parametros']) && $_POST['parametros'] != ''){
        $parametros = $_POST['parametros'];
    }
    $Publicidad = new Publicidad();
    $Publicidad->$metodo($parametros);
}