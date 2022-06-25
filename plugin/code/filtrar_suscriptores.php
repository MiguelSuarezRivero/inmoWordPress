<?php 
$modalidad=$_POST['modalidad'];
$localidad=$_POST['localidad'];
$tipo=$_POST['tipo'];
$habitaciones=$_POST['habitaciones'];

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

global $wpdb;
      $simbolo_moneda= $wpdb->get_var( "SELECT `simbolo` FROM `configuracion`" );

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
                $precio_minimo=number_format($campo['precio_min'], 0, ',', '.') . $simbolo_moneda;
              }

              if(strcmp($campo['precio_max'],'todos')==0){
                $precio_maximo='Indiferente';
              }else{
                $precio_maximo=number_format($campo['precio_max'], 0, ',', '.') . $simbolo_moneda;
              }

             echo '<div class="datos_formulario">
                 <input type="checkbox" class="checkbox checkbox_seleccionables">
                 <div class="datos_seleccion">
                 <input type="hidden" value="' . $campo['correo'] . '" name="id_suscriptores[]" class="id_suscriptores">
                 <p class="datos nombre correo">' . $campo['correo'] . '</p>
                 <p class="datos nombre modalidad">' . ucfirst($campo['modalidad']) . '</p>
                 <p class="datos nombre localidad">' . ucfirst($campo['localidad_venta']) . '</p>
                 <p class="datos nombre tipo">' . ucfirst($campo['tipo']) . '</p>
                 <p class="datos nombre habitaciones">' . ucfirst($campo['habitaciones']) . '</p>
                  <p class="datos nombre precio">' . $precio_minimo . '</p>
                 <p class="datos nombre precio">' . $precio_maximo . '</p>
                 <p class="datos nombre caracteristicas">' . ucfirst($campo['texto']) . '</p>
               
                 </div>
                 </div>'; 
                  
            }


    }catch (Exception $e){
          
        echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
    }finally{
            
         $base=NULL;       
}

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
                $precio_minimo=number_format($campo['precio_min'], 0, ',', '.') . $simbolo_moneda;
              }

              if(strcmp($campo['precio_max'],'todos')==0){
                $precio_maximo='Indiferente';
              }else{
                $precio_maximo=number_format($campo['precio_max'], 0, ',', '.') . $simbolo_moneda;
              }
             echo '<div class="datos_formulario">
                 <input type="checkbox" class="checkbox checkbox_seleccionables">
                 <div class="datos_seleccion">
                 <input type="hidden" value="' . $campo['correo'] . '" name="id_suscriptores[]" class="id_suscriptores">
                 <p class="datos nombre correo">' . $campo['correo'] . '</p>
                 <p class="datos nombre modalidad">' . ucfirst($campo['modalidad']) . '</p>
                 <p class="datos nombre localidad">' . ucfirst($campo['localidad_alquiler']) . '</p>
                 <p class="datos nombre tipo">' . ucfirst($campo['tipo']) . '</p>
                 <p class="datos nombre habitaciones">' . ucfirst($campo['habitaciones']) . '</p>
                  <p class="datos nombre precio">' . $precio_minimo . '</p>
                 <p class="datos nombre precio">' . $precio_maximo . '</p>
                 <p class="datos nombre caracteristicas">' . ucfirst($campo['texto']) . '</p>
               
                 </div>
                 </div>'; 
                  
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
                $precio_minimo=number_format($campo['precio_min'], 0, ',', '.') . $simbolo_moneda;
              }

              if(strcmp($campo['precio_max'],'todos')==0){
                $precio_maximo='Indiferente';
              }else{
                $precio_maximo=number_format($campo['precio_max'], 0, ',', '.') . $simbolo_moneda;
              }
             echo '<div class="datos_formulario">
                 <input type="checkbox" class="checkbox checkbox_seleccionables">
                 <div class="datos_seleccion">
                 <input type="hidden" value="' . $campo['correo'] . '" name="id_suscriptores[]" class="id_suscriptores">
                 <p class="datos nombre correo">' . $campo['correo'] . '</p>
                 <p class="datos nombre modalidad">' . ucfirst($campo['modalidad']) . '</p>
                 <p class="datos nombre localidad">' . ucfirst($campo['localidad_alquiler']) . '</p>
                 <p class="datos nombre tipo">' . ucfirst($campo['tipo']) . '</p>
                 <p class="datos nombre habitaciones">' . ucfirst($campo['habitaciones']) . '</p>
                  <p class="datos nombre precio">' . $precio_minimo . '</p>
                 <p class="datos nombre precio">' . $precio_maximo . '</p>
                 <p class="datos nombre caracteristicas">' . ucfirst($campo['texto']) . '</p>
               
                 </div>
                 </div>'; 
                  
            }


    }catch (Exception $e){
          
        echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
    }finally{
            
         $base=NULL;       
}
}


