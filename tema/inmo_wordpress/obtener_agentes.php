<?php 

require_once 'wp-config.php';

try{


        $base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");

        $agentes=false;

        if(isset($meta['id_agente'][0])){

            $sql="SELECT * FROM `agentes` WHERE `agentes`.`nombre` = :valor1";
            $peticion=$base->prepare($sql);
            $peticion->execute(array(":valor1"=>$meta['id_agente'][0]));
            $resultado=$peticion->fetchAll(PDO::FETCH_BOTH);
            $peticion->closeCursor();

            $array_solicitud=$resultado;
            
                foreach ($array_solicitud as $campo) {
                    $agentes=true;
                    $nombre_agente=$campo['nombre'];
                    $correo_agente=$campo['correo'];
                    $telefono_agente=$campo['telefono'];
                }

        }

        $sql="SELECT * FROM `configuracion`";
        $peticion=$base->prepare($sql);
            $peticion->execute(array());
            $resultado=$peticion->fetchAll(PDO::FETCH_BOTH);
            $peticion->closeCursor();
            $array_solicitud=$resultado;

             foreach ($array_solicitud as $campo) {

                $nombre_inmo=$campo['nombre'];
                $correo_inmo=$campo['correo'];
                $telefono_inmo=$campo['telefono'];     
            
            }

    }catch (Exception $e){
          
        echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
    }finally{
            
         $base=NULL;
          
}//FIN CONECTAR BASE DE DATOS.

if($agentes){
               $nombre_agente_activo=$nombre_agente;
               $telefono_agente_activo=$telefono_agente;
               $correo_agente_activo=$correo_agente;

            }else{
               $nombre_agente_activo=$nombre_inmo;
               $telefono_agente_activo=$telefono_inmo;
               $correo_agente_activo=$correo_inmo;
            }

