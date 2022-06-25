<?php 

require_once '../../../../wp-config.php';

try{

      $base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");

        $sql="SELECT * FROM `agentes` ORDER BY `agentes`.`nombre` ASC";
        $peticion=$base->prepare($sql);
        $peticion->execute(array());
        $resultado=$peticion->fetchAll(PDO::FETCH_BOTH);
        $peticion->closeCursor();

        $array_solicitud=$resultado;
        $agentes_raw=array();
            foreach ($array_solicitud as $campo) {

                array_push($agentes_raw, $campo['nombre']);

            }

        sort($agentes_raw);

        $sql="SELECT * FROM `configuracion`";
        $peticion=$base->prepare($sql);
            $peticion->execute(array());
            $resultado=$peticion->fetchAll(PDO::FETCH_BOTH);
            $peticion->closeCursor();
            $array_solicitud=$resultado;

             foreach ($array_solicitud as $campo) {


                $nombre_immo=$campo['nombre'];
                
            
            }
    }catch (Exception $e){
          
        echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
    }finally{
            
         $base=NULL;
          
}//FIN CONECTAR BASE DE DATOS.


echo '<div class="emergente"> <p class="parrafo1">Seleccione si desea transferir los inmuebles de <strong>' . $_POST['nombre'] . '</strong> a otro agente o eliminarlos.</p>   <p class="parrafo2">Recuerde que la acción de eliminar un agente no se puede deshacer. </p>    <select id="select_emergente">';

echo '<option value="' . $nombre_immo . '">' . $nombre_immo . '</option>';

foreach ($agentes_raw as $key) {
    if(!strcasecmp($key, $_POST['nombre'])==0){
        echo '<option value="' . $key . '">' . $key . '</option>';
    }    
}

echo '<option value="eliminar_inmuebles">Eliminar</option></select><p class="advertencia">* Se eliminarán todos los inmuebles de este agente.</p><input type="button" value="Aceptar" class="aceptar_transferir_agente button-primary">   <input type="button" value="Cancelar" class="cancelar_transferir_agente button-primary"> </div>';