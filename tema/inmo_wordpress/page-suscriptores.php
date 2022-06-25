<?php

 try{

        $base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");
        $sql="CREATE TABLE IF NOT EXISTS `suscriptores` ( `correo` VARCHAR(50) NOT NULL ,  `modalidad` VARCHAR(20) NOT NULL ,  `localidad_venta` VARCHAR(100) NOT NULL ,  `localidad_alquiler`  VARCHAR(100) NOT NULL ,  `tipo` VARCHAR(50) NOT NULL ,  `habitaciones` VARCHAR(20) NOT NULL ,  `precio_min` VARCHAR(20) NOT NULL ,  `precio_max` VARCHAR(20) NOT NULL ,  `texto` VARCHAR(100) NOT NULL ) ENGINE = InnoDB";

        $peticion=$base->prepare($sql);
        $peticion->execute(array());

         $sql="INSERT INTO `suscriptores`(`correo`, `modalidad`, `localidad_venta`, `localidad_alquiler`, `tipo`, `habitaciones`, `precio_min`, `precio_max`, `texto`) VALUES (:clave1,:clave2,:clave3,:clave4,:clave5,:clave6,:clave7,:clave8,:clave9)";
        $peticion=$base->prepare($sql);
        $peticion->execute(array(":clave1"=>$_POST['correo'],
                                 ":clave2"=>$_POST['modalidad'],
                                 ":clave3"=>$_POST['localidad_venta'],
                                 ":clave4"=>$_POST['localidad_venta'],
                                 ":clave5"=>$_POST['tipo'],
                                 ":clave6"=>$_POST['habitaciones'],
                                 ":clave7"=>$_POST['precio_min'],
                                 ":clave8"=>$_POST['precio_max'],
                                 ":clave9"=>$_POST['texto']));
 

    }catch (Exception $e){
          
        echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
    }finally{
            
         $base=NULL;

         echo 'correcto';
          
}//FIN CONECTAR BASE DE DATOS.	