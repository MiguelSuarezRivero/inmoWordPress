<?php 

require_once '../../../../wp-config.php';

	try{

			$base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
        	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        	$base->exec("SET CHARACTER SET utf8");
           
            $sql="UPDATE `configuracion` SET `moneda`=:valor1,`simbolo`=:valor2,`blog`=:valor3, `ocultar_opciones`=:valor4,`ventas_visibles`=:valor5,`idiomas`=:valor6,`titulos`=:valor7,`descripcion`=:valor8,`caracteristicas`=:valor9";
            $peticion=$base->prepare($sql);
            $simbolo=explode("_",$_POST['moneda']);
            $peticion->execute(array(":valor1"=>$_POST['moneda'],
            						 ":valor2"=>$simbolo[0],
                                     ":valor3"=>$_POST['blog'],
                                     ":valor4"=>$_POST['ocultar'],
                                     ":valor5"=>$_POST['ventas'],
                                     ":valor6"=>$_POST['idiomas'],
                                     ":valor7"=>$_POST['titulos'],
                                     ":valor8"=>$_POST['descripcion'],
                                     ":valor9"=>$_POST['caracteristicas'] ));                        
			
        }catch (Exception $e){
          
            echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
        }finally{
            
            $base=NULL;
          
        }//FIN CONECTAR BASE DE DATOS.
$retorno=$_POST['retornar'];
header('Location: ' . $retorno);