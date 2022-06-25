<?php 
require_once '../../../../wp-config.php';
if(isset($_POST['correo'])){
	try{

			$base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
        	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        	$base->exec("SET CHARACTER SET utf8");
            $sql="DELETE FROM `suscriptores` WHERE `correo`=:valor1";
            $peticion=$base->prepare($sql);

            if(is_array($_POST['correo'])){

                foreach ($_POST['correo'] as $value) {
                $peticion->execute(array(":valor1"=>$value));
                }

            }else{

                $peticion->execute(array(":valor1"=>$_POST['correo']));
            }
            
			
        }catch (Exception $e){
          
            echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
        }finally{
            
            $base=NULL;
          
        }//FIN CONECTAR BASE DE DATOS.
	
}