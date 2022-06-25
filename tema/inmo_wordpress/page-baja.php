<?php

 header('access-control-allow-origin: *');


 try{

        $base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");

        $sql="DELETE FROM `suscriptores` WHERE `correo`=:valor1";
        $peticion=$base->prepare($sql);
        $peticion->execute(array(":valor1"=>$_GET['correo']));
           
        echo 'Has sido de baja de nuestra suscripción.';
    
    }catch (Exception $e){
          
        echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
    }finally{
            
         $base=NULL;
          
}//FIN CONECTAR BASE DE DATOS.  