<?php 

    require '../js/class.phpmailer.php';
	require '../js/class.smtp.php';
	require '../js/PHPMailerAutoload.php';

	$mail = new PHPMailer;
	$mail->IsSMTP(); //cambiar de acuerdo al tipo de server
	$mail->SMTPDebug = 0; 
	//Borrar en servidor y probar
		// $mail->SMTPOptions = array(
	 //    'ssl' => array(
	 //        'verify_peer' => false,
	 //        'verify_peer_name' => false,
	 //        'allow_self_signed' => true
	 //    )
		// );
	$mail->SMTPAuth = $_POST['auth'];
	$mail->SMTPSecure = $_POST['secure'];
	$mail->Host = $_POST['host'];
	$mail->Port = $_POST['puerto'];
	$mail->Username = $_POST['correo'];
	$mail->Password =$_POST['password']; 

	$mail->CharSet = 'UTF-8';

	$mail->From         = $_POST['correo'];
	$mail->FromName     = 'Correo de prueba';
	$mail->AddAddress($_POST['correo'], 'Cliente');
	$mail->IsHTML(true);

	$mail->Subject = 'BORRAR - Correo de prueba';// email subject
	$mail->Body = 'El sistema de mensajería de Inmo WordPress funciona correctamente desde ' . $_POST['correo'];
	$mail->Send();




	if($mail->IsError()){

		echo ' ' . $mail->ErrorInfo;

	} else {

		echo 'ok';

	}