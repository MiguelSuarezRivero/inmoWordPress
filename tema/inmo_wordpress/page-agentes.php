<?php get_header(); 
global $xml;
?>
</header>
<section class="agentes">
		<div class="div">
			<h2><?php echo $xml->agentes; ?></h2>
		</div>
		
<?php 
global $wpdb;
$datos_agente= $wpdb->get_results( "SELECT `nombre`, `foto`,`telefono`,`correo` FROM `agentes`");

$args=array('post_type'=>'agente','order'=>'ASC','orderby'=>'name','posts_per_page' =>-1);

$query = new WP_Query( $args );

 while ( $query->have_posts() ) : $query->the_post();
foreach ($datos_agente as $key ) {
  $inmuebles=0;
  $inmuebles2=0;
    if(strnatcasecmp(get_the_title(),$key->nombre)==0){ 
      
   ?>
      <div class="recuadro_agentes">
        <a href="<?php the_permalink(); ?>">
          <div class="imagen"><?php  echo wp_get_attachment_image( $key->foto, 'medium', "", array( "alt"=>get_the_title(),"class" => "foto_agente")); ?>
          </div>
          <div class="datos_agente">
            <p class="nombre"><?php echo $key->nombre; ?></p>
            <p class="telefono"><?php echo $key->telefono; ?></p>
            <p class="correo"><?php echo $key->correo; ?></p>
            <p class="contador_inmuebles">
              <?php 
              $args_contador = array(
            'post_type'  => 'inmueble',
            'posts_per_page' =>-1,
            'meta_query' => array(  
                  
                  (array(
                    'key' => 'id_agente',
                    'value'   => $key->nombre,
                    'operator' => 'IN'
                  ) 
                ),
                  (array(
                    'key' => 'id_estado_inmueble',
                    'value'   => 'vendido',
                    'compare' => 'NOT LIKE'
                  ) ),
                  (array(
                    'key' => 'id_estado_inmueble',
                    'value'   => 'alquilado',
                    'compare' => 'NOT LIKE'
                  ) )
    ));

  $query_contador = new WP_Query( $args_contador );

  while ( $query_contador->have_posts() ) : $query_contador->the_post();

  $inmuebles++;
   
   endwhile;
              if($inmuebles==1){
              echo $inmuebles . ' ' . $xml->texto_agentes->inmueble;
            }else{
              echo $inmuebles . ' ' . $xml->texto_agentes->inmuebles;
            } ?>
              
            </p>
             <p class="contador_inmuebles">
              <?php 
              $args_contador2 = array(
            'post_type'  => 'inmueble',
            'posts_per_page' =>-1,
            'meta_query' => array(  
                  
                  (array(
                    'key' => 'id_agente',
                    'value'   => $key->nombre,
                    'operator' => 'IN'
                  )),
                  (array(
                    'key' => 'id_estado_inmueble',
                    'value'   => 'vendido',
                    'operator' => 'IN'
                  )  
                ),
    ));

  $query_contador2 = new WP_Query( $args_contador2 );

  while ( $query_contador2->have_posts() ) : $query_contador2->the_post();

  $inmuebles2++;
   
   endwhile;

              if($inmuebles2!=0){
                if($inmuebles2==1){
                  echo $inmuebles2 . ' ' . $xml->texto_agentes->venta;
                }else{
                  echo $inmuebles2 .  ' ' . $xml->texto_agentes->ventas;
                }
              }
               ?>
              
            </p>
          </div>         
        </a>        
      </div>
<?php
}
}

 endwhile;?>

</section>
<?php get_footer(); ?>