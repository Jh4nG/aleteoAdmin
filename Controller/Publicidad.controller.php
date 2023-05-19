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

    public function EnviarEmail()
    {
        $this->mail = new PHPMailer(true);
        // $this->mail->isSMTP();
		// $this->mail->Host = 'smtp.hostinger.co';
		// $this->mail->SMTPAuth = true;
		// $this->mail->Username = 'aleteo@aleteotransmedia.com';
		// $this->mail->Password = '3ef4fP0AJf[';
		// // $this->mail->SMTPSecure = 'tls';
		// $this->mail->Port = 587;
		// $this->mail->setFrom('aleteo@aleteotransmedia.com', 'Aleteo Transmedia');
		// $this->mail->isHTML(true);
		
		// // foreach($this->emails as $key => $email){
		// // 	$this->mail->addAddress($email['email']);
		// // }
		// $this->mail->addAddress('fabian.zabala22@gmail.com');
		// $this->mail->addAddress('jhonja971106@gmail.com');

		// $this->mail->Subject = 'ALETEO - TRANSMEDIA AVANZA HACIA EL FUTURO (NUEVA PUBLICACIÓN)';
		// // $this->mail->Body = $this->cuerpo;
		// $this->mail->Body = 'prueba';
		// $this->mail->AltBody = strip_tags('prueba');
		// $this->mail->CharSet = 'UTF-8';
		
		$this->mail->SMTPDebug = 0;                                     // Enable verbose debug output
		$this->mail->isSMTP();                                          // Send using SMTP
		$this->mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
		$this->mail->SMTPAuth   = true;                                 // Enable SMTP authentication
		$this->mail->Username   = 'proyectoaleteoproduccion@gmail.com';         // SMTP username
		$this->mail->Password   = 'Karmabencion11';                        // SMTP password
		$this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$this->mail->Port       = 587;                                  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
		
		$this->mail->setFrom('proyectoaleteoproduccion@gmail.com', 'Aleteo - Transmedia');
		
		foreach($this->emails as $key => $email){
			$this->mail->addBCC($email['email']);
			// $this->mail->addAddress($email['email']);
		}
		$this->firma = '<div dir="ltr" class="gmail_signature" data-smartmail="gmail_signature"><div dir="ltr"><b><i><font size="4">Aleteo - Transmedia</font></i></b><div><b><i>Edison González Lemus</i></b></div><div><b><i>Coordinador del proyecto</i></b></div><div><b><i><br></i></b></div><div><b><i>Un simple respiro puede cambiar todo lo que conocemos....</i></b></div><div><b><i><br></i></b></div><div><b><i>Página web:<br></i></b></div><div><i><a href="https://aleteotransmedia.com/index.php" target="_blank">https://aleteotransmedia.com/index.php</a></i></div><div><i><br></i></div><div><b><i><img src="https://docs.google.com/uc?export=download&amp;id=1eUJHMRO8RgDUR_XbNXfgjQRylI1GMHTm&amp;revid=0B9mVyFrxHIvLWFN0VjZDVEh2ZkpHWktmY1d3Y2p2MUlRbEFZPQ" width="200" height="175"><br></i></b></div></div></div>';
		$this->mail->isHTML(true);                                      // Set email format to HTML
		$this->mail->Subject = 'ALETEO - TRANSMEDIA AVANZA HACIA EL FUTURO (NUEVA PUBLICACIÓN)';
		$this->mail->Body    = $this->cuerpo.$this->firma;
		$this->mail->CharSet = 'UTF-8';

		try {
	    	$this->mail->send();
			return true;
		} catch (Exception $e) {
			throw new Exception($this->mail->ErrorInfo);
		}
	}

	public function EnviarPublicidad($parametro)
	{
		$this->tipo = $parametro['tipo'];
		$this->titulo = $parametro['titulo'];
		$this->imagen = $parametro['imagen'];
		$this->cuerpo = $parametro['html'];
		$this->emails = array();
	
		$sql="SELECT email,id FROM suscripciones WHERE estado = 1";
		$rdb = $this->con_aleteo->prepare($sql);

		if($rdb->execute()){
			$i=0;
			while($rows = $rdb->fetch(PDO::FETCH_ASSOC)){
				$this->emails[$i]['email'] = $rows['email'];
				$this->emails[$i]['id'] = $rows['id'];
				$i++;
			}
			$send = $this->EnviarEmail();
			if($send){
				$this->guardarPublicidad();
				echo json_encode(true);
			}else{
				echo json_encode('error');
			}
		}else{
			echo json_encode('nohay');
		}
	}

	public function guardarPublicidad()
	{
		$sql = "INSERT INTO publicidad(modulo,titulo,imagen) VALUES(?,?,?)";
        $rdb = $this->con_aleteo->prepare($sql);
		
		$rdb->execute([$this->tipo, $this->titulo, $this->imagen]);

		$idPublicidad = $this->con_aleteo->lastInsertId();

		foreach ($this->emails as $key => $value) {
			$sql = "INSERT INTO email_publicidad(id_publicidad,id_suscripcion) VALUES(?,?)";
        	$rdb = $this->con_aleteo->prepare($sql);
			$rdb->execute([$idPublicidad, $value['id']]);
		}
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

	public function listarPublicidades()
	{
		$sql="SELECT * FROM publicidad
		ORDER BY id ASC";
		$rdb = $this->con_aleteo->prepare($sql);
		if($rdb->execute()){
			$obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
			echo json_encode($obj);
		}else{
			echo json_encode(false);
		}
	}

	public function consultarEmails($parametro)
	{
		$idPublicidad = $parametro['id'];

		$sql="SELECT em.nombres, em.telefono, em.email, em.fecha_suscripcion 
		FROM email_publicidad AS pub
		INNER JOIN suscripciones AS em ON em.id = pub.id_suscripcion
		WHERE pub.id_publicidad = ?";
		$rdb = $this->con_aleteo->prepare($sql);

		if($rdb->execute([$idPublicidad])){
			$obj = $rdb -> fetchAll(PDO::FETCH_OBJ);
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
    $Publicidad = new Publicidad();
    $Publicidad->$metodo($parametros);
}