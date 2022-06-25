<?php 

require_once '../../../../wp-config.php';

	try{

			$base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
        	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        	$base->exec("SET CHARACTER SET utf8");
            $sql="UPDATE `agentes` SET `nombre`=:valor1,`telefono`=:valor2,`correo`=:valor3,`contra_correo`=:valor4,`puerto`=:valor5,`host`=:valor6,`smtp_secure`=:valor7,`smtp_auth`=:valor8,`foto`=:valor9,`descripcion`=:valor10,`descripcion_en`=:valor11,`descripcion_fr`=:valor12,`descripcion_de`=:valor13,`descripcion_it`=:valor14,`descripcion_se`=:valor15 WHERE `nombre`=:valor1";

            $peticion=$base->prepare($sql);

                $peticion->execute(array(":valor1"=>$_POST['nombre'],
            							 ":valor2"=>$_POST['telefono'],
            							 ":valor3"=>$_POST['correo'],
            							 ":valor4"=>$_POST['contra'],
            							 ":valor5"=>$_POST['puerto'],
            							 ":valor6"=>$_POST['servidor'],
            							 ":valor7"=>$_POST['secure'],
            							 ":valor8"=>$_POST['auth'],
            							 ":valor9"=>$_POST['foto'],
                                         ":valor10"=>$_POST['descripcion'],
                                         ":valor11"=>$_POST['descripcion_en'],
                                         ":valor12"=>$_POST['descripcion_fr'],
                                         ":valor13"=>$_POST['descripcion_de'],
                                         ":valor14"=>$_POST['descripcion_it'],
                                         ":valor15"=>$_POST['descripcion_se'],));                        
			
        }catch (Exception $e){
          
            echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
        }finally{
            
            $base=NULL;
          
        }//FIN CONECTAR BASE DE DATOS.
	
