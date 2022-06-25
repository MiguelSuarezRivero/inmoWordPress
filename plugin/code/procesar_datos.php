<?php 

require_once '../../../../wp-config.php';

	try{

			$base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
        	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        	$base->exec("SET CHARACTER SET utf8");
           
            $sql="UPDATE `configuracion` SET `nombre`=:valor1,`telefono`=:valor2,`direccion`=:valor3, `mapa`=:valor4, `my_maps`=:valor5, `my_maps_mapa`=:valor7, `analytics`=:valor8";
            $peticion=$base->prepare($sql);
            $peticion->execute(array(":valor1"=>$_POST['nombre'],
            						 ":valor2"=>$_POST['telefono'],
            						 ":valor3"=>$_POST['direccion'],
            						 ":valor4"=>$_POST['mapa_inmo'],
            						 ":valor5"=>$_POST['my_maps_inmo'],
                                     ":valor7"=>$_POST['my_maps_mapa'],
                                     ":valor8"=>$_POST['analytics']));                        
			
        }catch (Exception $e){
          
            echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
        }finally{
            
            $base=NULL;
          
        }//FIN CONECTAR BASE DE DATOS.

$retorno=$_POST['retornar'];
header('Location: ' . $retorno);