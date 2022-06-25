<?php 

require_once '../../../../wp-config.php';

global $wpdb;
$nuevo_agente= $wpdb->get_results( "SELECT `nombre` FROM `agente`" );
$existe_agente=false;
foreach ($nuevo_agente as $key ) {
    if(strnatcasecmp($_POST['nombre'],$key->nombre)==0){
        $existe_agente=true;
    }
    
}

if($existe_agente==false){

	try{

			$base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
        	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        	$base->exec("SET CHARACTER SET utf8");
            $sql="INSERT INTO `agentes`(`nombre`, `telefono`, `correo`, `contra_correo`, `puerto`, `host`, `smtp_secure`, `smtp_auth`, `foto` , `descripcion`, `descripcion_en`, `descripcion_fr`, `descripcion_de`, `descripcion_it`, `descripcion_se`, `contra_wordpress`) VALUES (:valor1, :valor2, :valor3, :valor4, :valor5, :valor6, :valor7, :valor8, :valor9, :valor10, :valor11, :valor12, :valor13, :valor14, :valor15, :valor16)";
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
                                         ":valor15"=>$_POST['descripcion_se'],
                                         ":valor16"=>$_POST['contra_wordpress']));                        
			
        }catch (Exception $e){
          
            echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
        }finally{
            
            $base=NULL;
          
        }//FIN CONECTAR BASE DE DATOS.



$agentes= $wpdb->get_results( "SELECT `post_title` FROM `wp_posts` WHERE `post_type`='agente'" );
$existe=false;
foreach ($agentes as $key) {
    if(strnatcasecmp($_POST['nombre'],$key->post_title)==0){
        $existe=true;
    }
}

if($existe==false){

    // CREA LA PÁGINA DEL AGENTE
    $my_post = array(
      'post_type'   => 'agente',
      'post_title'    => $_POST['nombre'],
      'post_status'   => 'publish',
      'post_author'   => 1
    );
     
    wp_insert_post( $my_post );

    // CREA EL USUARIO
    $userdata = array(
    'user_login' =>  $_POST['nombre'],
    'user_pass'  =>  $_POST['contra_wordpress'],
    'role' => 'author',
    'display_name' => $_POST['nombre']
    );
 
    $user_id = wp_insert_user( $userdata ) ;
}
}