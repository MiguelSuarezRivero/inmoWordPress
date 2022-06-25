<?php 

require_once '../../../../wp-config.php';

	try{

			$base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
        	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        	$base->exec("SET CHARACTER SET utf8");
           
            $sql="UPDATE `configuracion` SET `correo`=:valor1,`contra_correo`=:valor2,`host`=:valor3, `puerto`=:valor4, `smtp_secure`=:valor5, `smtp_auth`=:valor6";
            $peticion=$base->prepare($sql);
            $peticion->execute(array(":valor1"=>$_POST['correo'],
            						 ":valor2"=>$_POST['contra'],
                                     ":valor3"=>$_POST['servidor'],
                                     ":valor4"=>$_POST['puerto'],
                                     ":valor5"=>$_POST['secure'],
                                     ":valor6"=>$_POST['auth']));                        
			
        }catch (Exception $e){
          
            echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
        }finally{
            
            $base=NULL;
          
        }//FIN CONECTAR BASE DE DATOS.
$retorno=$_POST['retornar'];
header('Location: ' . $retorno);