<?php 
require_once '../../../../wp-config.php';
if(strcmp($_POST['agente'],'eliminar_inmuebles')==0){

    //Los inmuebles del agente seleccionado serán eliminados.

    $args = array(
    'post_type'  => 'inmueble',
    'meta_query' => array(  
                            (array(
                                        'key' => 'id_agente',
                                        'value'   => $_POST['nombre'],
                                        'operator' => 'IN'
                                    ) 
                                ),
        ));

         
    $loop = new WP_Query($args);

    while ($loop->have_posts() ): $loop->the_post(); 

           wp_delete_post( get_the_ID(), true);

    endwhile; 

    try{

            $base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
            $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $base->exec("SET CHARACTER SET utf8");
            $sql="DELETE FROM `agentes` WHERE `nombre`=:valor1";
            $peticion=$base->prepare($sql);
            $peticion->execute(array(":valor1"=>$_POST['nombre']));                        
            
        }catch (Exception $e){
          
            echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
        }finally{
            
            $base=NULL;
          
        }//FIN CONECTAR BASE DE DATOS.

}else{

        //Los inmuebles del agente seleccionado serán transferidos a otro agente

         $args = array(
            'post_type'  => 'inmueble',
            'meta_query' => array(  
                                    (array(
                                                'key' => 'id_agente',
                                                'value'   => $_POST['nombre'],
                                                'operator' => 'IN'
                                            ) 
                                        ),
                ));

         
    $loop = new WP_Query($args);

    while ($loop->have_posts() ): $loop->the_post(); 

           update_post_meta( get_the_ID(), 'id_agente', $_POST['agente'] );

    endwhile; 

        try{

            $base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
            $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $base->exec("SET CHARACTER SET utf8");
            $sql="DELETE FROM `agentes` WHERE `nombre`=:valor1";
            $peticion=$base->prepare($sql);
            $peticion->execute(array(":valor1"=>$_POST['nombre']));                        
            
        }catch (Exception $e){
          
            echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
        }finally{
            
            $base=NULL;
          
        }//FIN CONECTAR BASE DE DATOS.

}

global $wpdb;
$agentes= $wpdb->get_results( "SELECT `post_title`,`ID` FROM $wpdb->posts WHERE `post_type`='agente'" );

foreach ($agentes as $key) {
    if($_POST['nombre']===$key->post_title){
        wp_delete_post($key->ID,true);
    }
}

 require_once( ABSPATH.'wp-admin/includes/user.php' );
 $nombre_slug = str_replace(" ", "-",$_POST['nombre']);
 $author= get_user_by('slug',$nombre_slug);
 wp_delete_user($author->ID);