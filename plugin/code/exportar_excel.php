<?php 
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=listado_suscriptores.csv");
header("Pragma: no-cache");
header("Expires: 0");

echo "Correo; Modalidad; Localidad; Tipo ; Habitaciones; Precio Min.; Precio Max.; Caracteristicas\n";

$modalidad=$_GET['modalidad'];
$localidad=$_GET['localidad'];
$tipo=$_GET['tipo'];
$habitaciones=$_GET['habitaciones'];

function evaluar_variable(& $nombre){
        if(strcmp($nombre, 'Todos')==0){
                $nombre='%';
        }
}



evaluar_variable($modalidad);
evaluar_variable($localidad);
evaluar_variable($tipo);
evaluar_variable($habitaciones);

require_once '../../../../wp-config.php';

if(strcmp($modalidad,'venta')==0){

        try{
        $base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
                $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $base->exec("SET CHARACTER SET utf8");      
        $sql="SELECT * FROM `suscriptores` WHERE `modalidad` LIKE :clave1 AND `localidad_venta` LIKE :clave2 AND `tipo` LIKE :clave3 AND `habitaciones` LIKE :clave4";
        $peticion=$base->prepare($sql);
        $peticion->execute(array(":clave1"=>$modalidad,
                                                         ":clave2"=>$localidad,
                                                         ":clave3"=>$tipo,
                                                         ":clave4"=>$habitaciones));
        $resultado=$peticion->fetchAll(PDO::FETCH_BOTH);
        $peticion->closeCursor();

        $array_solicitud=$resultado;

            foreach ($array_solicitud as $campo) {
          	
            		if(strcmp($campo['precio_min'],'todos')==0){
                $precio_minimo='Indiferente';
              }else{
                $precio_minimo=number_format($campo['precio_min'], 0, ',', '.');
              }

              if(strcmp($campo['precio_max'],'todos')==0){
                $precio_maximo='Indiferente';
              }else{
                $precio_maximo=number_format($campo['precio_max'], 0, ',', '.');
              }

            			echo $campo['correo'] . ';' . ucfirst($campo['modalidad']) . ';' . ucfirst($campo['localidad_venta']) . ';' . ucfirst($campo['tipo']) . ';' . $campo['habitaciones'] . ';' . $precio_minimo . ';' . $precio_maximo . ';' . ucfirst($campo['texto']) .  "\n";
                }
            	            

    }catch (Exception $e){
          
        echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
    }finally{
            
         $base=NULL;
          
	}//FIN CONECTAR BASE DE DATOS.
}else if(strcmp($modalidad,'%')==0){

        try{
        $base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
                $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $base->exec("SET CHARACTER SET utf8");      
        $sql="SELECT * FROM `suscriptores` WHERE `localidad_venta` LIKE :clave2 AND `localidad_alquiler` LIKE :clave5 AND `tipo` LIKE :clave3 AND `habitaciones` LIKE :clave4";
        $peticion=$base->prepare($sql);
        $peticion->execute(array(
                                                         ":clave2"=>$localidad,
                                                         ":clave3"=>$tipo,
                                                         ":clave4"=>$habitaciones,
                                                         ":clave5"=>$localidad));
        $resultado=$peticion->fetchAll(PDO::FETCH_BOTH);
        $peticion->closeCursor();

        $array_solicitud=$resultado;

            foreach ($array_solicitud as $campo) {

              if(strcmp($campo['precio_min'],'todos')==0){
                $precio_minimo='Indiferente';
              }else{
                $precio_minimo=number_format($campo['precio_min'], 0, ',', '.');
              }

              if(strcmp($campo['precio_max'],'todos')==0){
                $precio_maximo='Indiferente';
              }else{
                $precio_maximo=number_format($campo['precio_max'], 0, ',', '.');
              }

             echo $campo['correo'] . ';' . ucfirst($campo['modalidad']) . ';' . ucfirst($campo['localidad_venta']) . ';' . ucfirst($campo['tipo']) . ';' . $campo['habitaciones'] . ';' . $precio_minimo . ';' . $precio_maximo . ';' . ucfirst($campo['texto']) .  "\n";

            			
                  
            }


    }catch (Exception $e){
          
        echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
    }finally{
            
         $base=NULL;       
}
        
}else{

 	try{
        $base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
                $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $base->exec("SET CHARACTER SET utf8");      
        $sql="SELECT * FROM `suscriptores` WHERE `modalidad` LIKE :clave1 AND `localidad_alquiler` LIKE :clave2 AND `tipo` LIKE :clave3 AND `habitaciones` LIKE :clave4";
        $peticion=$base->prepare($sql);
        $peticion->execute(array(":clave1"=>$modalidad,
                                                         ":clave2"=>$localidad,
                                                         ":clave3"=>$tipo,
                                                         ":clave4"=>$habitaciones));
        $resultado=$peticion->fetchAll(PDO::FETCH_BOTH);
        $peticion->closeCursor();

        $array_solicitud=$resultado;

            foreach ($array_solicitud as $campo) {
              if(strcmp($campo['precio_min'],'todos')==0){
                $precio_minimo='Indiferente';
              }else{
                $precio_minimo=number_format($campo['precio_min'], 0, ',', '.');
              }

              if(strcmp($campo['precio_max'],'todos')==0){
                $precio_maximo='Indiferente';
              }else{
                $precio_maximo=number_format($campo['precio_max'], 0, ',', '.');
              }

             echo $campo['correo'] . ';' . ucfirst($campo['modalidad']) . ';' . ucfirst($campo['localidad_venta']) . ';' . ucfirst($campo['tipo']) . ';' . $campo['habitaciones'] . ';' . $precio_minimo . ';' . $precio_maximo . ';' . ucfirst($campo['texto']) .  "\n";
                  
            }


    }catch (Exception $e){
          
        echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
    }finally{
            
         $base=NULL;       
}
}
