  <?php
global $wpdb;
	$datos= $wpdb->get_results( "SELECT `nombre`,`correo`,`contra_correo`, `puerto`, `host`, `smtp_secure`, `smtp_auth` FROM `configuracion`" );


  header('access-control-allow-origin: *');
  
    require 'js/class.phpmailer.php';
	require 'js/class.smtp.php';
	require 'js/PHPMailerAutoload.php';


	$nombre=$_POST['nombre'];
	$telefono=$_POST['telefono'];
	$correo=$_POST['correo'];
	if(!empty($_POST['asunto'])){
		$asunto=$_POST['asunto'];
	}	
	$mensaje=$_POST['mensaje'];

	$mail = new PHPMailer;
	$mail->IsSMTP(); //cambiar de acuerdo al tipo de server
	$mail->SMTPDebug = 0; 
	//BORRAR AL SUBIR AL SERVIDOR
	$mail->SMTPOptions = array(
	    'ssl' => array(
	        'verify_peer' => false,
	        'verify_peer_name' => false,
	        'allow_self_signed' => true
	    )
		);
	$mail->SMTPAuth = $datos[0]->smtp_auth;
	$mail->SMTPSecure = $datos[0]->smtp_secure;
	$mail->Host = $datos[0]->host;
	$mail->Port = $datos[0]->puerto;
	$mail->Username = $datos[0]->correo;
	$mail->Password = $datos[0]->contra_correo; 

	$mail->CharSet = 'UTF-8';

	$mail->From         = $datos[0]->correo;
	$mail->FromName     = $datos[0]->nombre;
	$mail->AddAddress($correo, 'Cliente');
	$mail->IsHTML(true);

	$mail->Subject =  $datos[0]->nombre;
	$mail->Body = '<html>'.
		'<head><title>' .  $datos[0]->nombre .'</title></head>'.
		'<body><h1>' .  $datos[0]->nombre .' </h1>'.
		'<h3>Gracias por contactar con nosotros, en breve nos pondremos en contacto contigo.</h3>'.
		'</body>'.
		'</html>';
	$mail->Send();

	$respuesta = new PHPMailer;
	$respuesta->IsSMTP(); //cambiar de acuerdo al tipo de server
	$respuesta->SMTPDebug = 0; 
	//BORRAR AL SUBIR AL SERVIDOR
	$respuesta->SMTPOptions = array(
	    'ssl' => array(
	        'verify_peer' => false,
	        'verify_peer_name' => false,
	        'allow_self_signed' => true
	    )
		);
	$respuesta->SMTPAuth = $datos[0]->smtp_auth;
	$respuesta->SMTPSecure = $datos[0]->smtp_secure;
	$respuesta->Host = $datos[0]->host;
	$respuesta->Port = $datos[0]->puerto;
	$respuesta->Username = $datos[0]->correo;
	$respuesta->Password = $datos[0]->contra_correo;

	$respuesta->CharSet = 'UTF-8';

	$respuesta->From         = $datos[0]->correo;
	$respuesta->FromName     = $datos[0]->nombre;
	$respuesta->AddAddress($datos[0]->correo,'Cliente');
	$respuesta->IsHTML(true);

	$respuesta->Subject = 'Mensaje de ' . $nombre . ' a traves de ' . $datos[0]->nombre;  

	if(empty($asunto)){
		$respuesta->Body = 	'<html>'.
		'<head><title>Mensaje a través de ' . $datos[0]->nombre . '</title></head>'.
		'<body><h1>Tienes un mensaje a través de ' . $datos[0]->nombre . '</h1>'.
		'<h2>Datos del contacto:</h2>'.
		'<h3>Nombre: ' . $nombre . '</h3>'.
		'<h3>Teléfono: ' . $telefono . '</h3>'.
		'<h3>Correo: ' . $correo . '</h3>'.
		'<h3>Mensaje: ' . $mensaje . '</h3>'.
		'</body>'.
		'</html>';

	}else{
		$respuesta->Body = 	'<html>'.
		'<head><title>Mensaje a través de ' . $datos[0]->nombre . '</title></head>'.
		'<body><h1>Tienes un mensaje a través de ' . $datos[0]->nombre . '</h1>'.
		'<h2>Datos del contacto:</h2>'.
		'<h3>Nombre: ' . $nombre . '</h3>'.
		'<h3>Teléfono: ' . $telefono . '</h3>'.
		'<h3>Correo: ' . $correo . '</h3>'.
		'<h3>Asunto: ' . $asunto . '</h3>'.
		'<h3>Mensaje: ' . $mensaje . '</h3>'.
		'</body>'.
		'</html>';
	}
	
	$respuesta->Send();


	if($mail->IsError() || $respuesta->IsError()){

		echo 'rechazado';

		} else {

		echo 'enviado';	

	
	}
?>