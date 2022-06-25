<?php 

try{

        $base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");
        $sql="CREATE TABLE IF NOT EXISTS `agentes` ( `nombre` VARCHAR(100) NOT NULL ,  `telefono` VARCHAR(20) NOT NULL ,  `correo` VARCHAR(100) NOT NULL ,  `contra_correo`  VARCHAR(100) NOT NULL ,  `puerto` INT(5) NOT NULL ,  `host` VARCHAR(30) NOT NULL ,  `smtp_secure` VARCHAR(10) NOT NULL ,  `smtp_auth` VARCHAR(10) NOT NULL, `foto` VARCHAR(100) NOT NULL, `descripcion` VARCHAR(2000) NOT NULL, `descripcion_en` VARCHAR(2000) NOT NULL, `descripcion_fr` VARCHAR(2000) NOT NULL, `descripcion_de` VARCHAR(2000) NOT NULL, `descripcion_it` VARCHAR(2000) NOT NULL, `descripcion_se` VARCHAR(2000) NOT NULL, `contra_wordpress`  VARCHAR(100) NOT NULL) ENGINE = InnoDB";

        $peticion=$base->prepare($sql);
        $peticion->execute(array());

        
        $sql="CREATE TABLE IF NOT EXISTS `configuracion` ( `nombre` VARCHAR(100) NOT NULL ,`direccion` VARCHAR(200) NOT NULL ,  `telefono` VARCHAR(20) NOT NULL ,  `correo` VARCHAR(100) NOT NULL ,  `contra_correo`  VARCHAR(100) NOT NULL ,  `puerto` INT(5) NOT NULL ,  `host` VARCHAR(30) NOT NULL ,  `smtp_secure` VARCHAR(10) NOT NULL ,  `smtp_auth` VARCHAR(10) NOT NULL, `moneda` VARCHAR(20) NOT NULL, `simbolo` VARCHAR(5) NOT NULL, `mapa` VARCHAR(1000) NOT NULL, `my_maps` VARCHAR(1000) NOT NULL, `my_maps_mapa` VARCHAR(1000) NOT NULL, `analytics` VARCHAR(20) NOT NULL, `estado_agentes`  VARCHAR(5) NOT NULL, `blog`  VARCHAR(5) NOT NULL, `ocultar_opciones`  VARCHAR(5) NOT NULL, `ventas_visibles` VARCHAR(5) NOT NULL, `idiomas` VARCHAR(5) NOT NULL, `titulos` VARCHAR(5) NOT NULL, `descripcion` VARCHAR(5) NOT NULL, `caracteristicas` VARCHAR(5) NOT NULL) ENGINE = InnoDB";

        $peticion=$base->prepare($sql);       
        $peticion->execute(array()); 

        $sql="INSERT INTO `configuracion` (`estado_agentes`, `blog`,`ocultar_opciones`,`ventas_visibles`,`idiomas`,`titulos`,`descripcion`,`caracteristicas`) SELECT 'false', 'false','false','false','false','false','false','false' WHERE NOT EXISTS (SELECT * FROM `configuracion`)";
        $peticion=$base->prepare($sql);
        $peticion->execute(array()); 

        $sql="CREATE TABLE IF NOT EXISTS `suscriptores` ( `correo` VARCHAR(50) NOT NULL ,  `modalidad` VARCHAR(20) NOT NULL ,  `localidad_venta` VARCHAR(100) NOT NULL ,  `localidad_alquiler`  VARCHAR(100) NOT NULL ,  `tipo` VARCHAR(50) NOT NULL ,  `habitaciones` VARCHAR(20) NOT NULL ,  `precio_min` VARCHAR(20) NOT NULL ,  `precio_max` VARCHAR(20) NOT NULL ,  `texto` VARCHAR(100) NOT NULL ) ENGINE = InnoDB";

        $peticion=$base->prepare($sql);
        $peticion->execute(array());

       
    }catch (Exception $e){
          
        echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
    }finally{
            
         $base=NULL;
} 

$archivo_instalado = fopen('../wp-content/plugins/plugin_inmo_wordpress/code/instalado.txt', "w+"); 
fwrite($archivo_instalado,"Las tablas han sido creadas correctamente, en caso de reinstalación borre este archivo."); 
fclose($archivo_instalado);