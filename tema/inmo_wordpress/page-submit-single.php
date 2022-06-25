  <?php

  header('access-control-allow-origin: *');

require_once 'wp-config.php';

try{


        $base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");

            $sql="SELECT * FROM `agentes` WHERE `agentes`.`nombre` = :valor1";
            $peticion=$base->prepare($sql);
            $peticion->execute(array(":valor1"=>$_POST['agente_activo']));
            $resultado=$peticion->fetchAll(PDO::FETCH_BOTH);
            $peticion->closeCursor();

            $array_solicitud=$resultado;
            
                foreach ($array_solicitud as $campo) {

                    if(strcmp($_POST['agente_activo'],$campo['nombre'])==0){
                    	$nombre_agente=$campo['nombre'];
	                    $correo_agente=$campo['correo'];
	                    $contra_agente=$campo['contra_correo'];
	                    $puerto_agente=intval($campo['puerto']);
	                    $host_agente=$campo['host'];
	                    if(strcmp($campo['smtp_secure'],'true')==0){
	                    	 $secure_agente=true;
	                    }else if(strcmp($campo['smtp_secure'],'false')==0){
	                    	$secure_agente=false;
	                    }else if(is_numeric($campo['smtp_secure'])){
	                    	$secure_agente=intval($campo['smtp_secure']);
	                    }else{
	                    	$secure_agente=$campo['smtp_secure'];
	                    }
	                    if(strcmp($campo['smtp_auth'],'true')==0){
	                    	 $auth_agente=true;
	                    }else{
	                    	$auth_agente=false;
	                    }
	                   
                    }                    
                }

       

        $sql="SELECT * FROM `configuracion`";
        $peticion=$base->prepare($sql);
            $peticion->execute(array());
            $resultado=$peticion->fetchAll(PDO::FETCH_BOTH);
            $peticion->closeCursor();
            $array_solicitud=$resultado;

            	foreach ($array_solicitud as $campo) {
            		$nombre_inmobiliaria=$campo['nombre'];
					if(strcmp($_POST['agente_activo'],$campo['nombre'])==0){
                    	$nombre_agente=$campo['nombre'];
	                    $correo_agente=$campo['correo'];
	                    $contra_agente=$campo['contra_correo'];
	                    $puerto_agente=intval($campo['puerto']);
	                    $host_agente=$campo['host'];
	                    if(strcmp($campo['smtp_secure'],'true')==0){
	                    	 $secure_agente=true;
	                    }else if(strcmp($campo['smtp_secure'],'false')==0){
	                    	$secure_agente=false;
	                    }else if(is_numeric($campo['smtp_secure'])){
	                    	$secure_agente=intval($campo['smtp_secure']);
	                    }else{
	                    	$secure_agente=$campo['smtp_secure'];
	                    }
	                    if(strcmp($campo['smtp_auth'],'true')==0){
	                    	 $auth_agente=true;
	                    }else{
	                    	$auth_agente=false;
	                    }	                   
                    }
            	}

    }catch (Exception $e){
          
        echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
    }finally{
            
         $base=NULL;
          
}//FIN CONECTAR BASE DE DATOS.
 
    require 'js/class.phpmailer.php';
	require 'js/class.smtp.php';
	require 'js/PHPMailerAutoload.php';


	$nombre=$_POST['nombre'];
	$telefono=$_POST['telefono'];
	$correo=$_POST['correo'];
	$mensaje=$_POST['mensaje'];

	$mail = new PHPMailer;
	$mail->IsSMTP(); //cambiar de acuerdo al tipo de server
	$mail->SMTPDebug = 0; 
	//Borrar en servidor y probar
		$mail->SMTPOptions = array(
	    'ssl' => array(
	        'verify_peer' => false,
	        'verify_peer_name' => false,
	        'allow_self_signed' => true
	    )
		);
	$mail->SMTPAuth = $auth_agente;
	$mail->SMTPSecure = $secure_agente;
	$mail->Host = $host_agente;
	$mail->Port = $puerto_agente;
	$mail->Username = $correo_agente;
	$mail->Password = $contra_agente; 

	$mail->CharSet = 'UTF-8';

	$mail->From         = $correo_agente;
	$mail->FromName     = $nombre_agente;
	$mail->AddAddress($correo, 'Cliente');
	$mail->IsHTML(true);

	$mail->Subject = $nombre_inmobiliaria; 
	$mail->Body = '<html>'.
		'<head><title>' . $nombre_inmobiliaria . '</title></head>'.
		'<body><h1>' . $nombre_inmobiliaria . '</h1>'.
		'<h3>Gracias por contactar con nosotros, en breve nos pondremos en contacto contigo.</h3>'.
		'</body>'.
		'</html>';
	$mail->Send();

	$respuesta = new PHPMailer;
	$respuesta->IsSMTP(); //cambiar de acuerdo al tipo de server
	$respuesta->SMTPDebug = 0; 
	//Borrar en servidor y probar
		$respuesta->SMTPOptions = array(
	    'ssl' => array(
	        'verify_peer' => false,
	        'verify_peer_name' => false,
	        'allow_self_signed' => true
	    )
		);
	$respuesta->SMTPAuth = $auth_agente;
	$respuesta->SMTPSecure = $secure_agente;
	$respuesta->Host = $host_agente;
	$respuesta->Port = $puerto_agente;
	$respuesta->Username = $correo_agente;
	$respuesta->Password = $contra_agente; 

	$respuesta->CharSet = 'UTF-8';

	$respuesta->From         = $correo_agente;
	$respuesta->FromName     = $nombre_inmobiliaria;
	$respuesta->AddAddress($correo_agente,'Cliente');
	$respuesta->IsHTML(true);

	$respuesta->Subject = 'Mensaje de ' . $nombre . ' a traves de ' . $nombre_inmobiliaria;  
	$respuesta->Body = 	'<html>'.
		'<head><title>Mensaje a través de ' . $nombre_inmobiliaria . ' </title></head>'.
		'<body><h1>Tienes un mensaje a través de ' . $nombre_inmobiliaria . '</h1>'.
		'<h2>Datos del contacto:</h2>'.
		'<h3>Nombre: ' . $nombre . '</h3>'.
		'<h3>Teléfono: ' . $telefono . '</h3>'.
		'<h3>Correo: ' . $correo . '</h3>'.
		'<h3>Mensaje: ' . $mensaje . '</h3>'.
		'</body>'.
		'</html>';
	
	$respuesta->Send();


	if($mail->IsError() || $respuesta->IsError()){

		echo 'rechazado';

		} else {

		echo 'enviado';	

	
	}