<?php get_header(); 
global $xml;
?>

</header>
<?php
	global $wpdb;
	$datos_agente= $wpdb->get_results( "SELECT `nombre`, `foto`,`descripcion`,`descripcion_en`,`descripcion_fr`,`descripcion_de`,`descripcion_it`,`descripcion_se`, `telefono`, `correo` FROM `agentes`");	
	$multidioma=$wpdb->get_var( "SELECT `idiomas` FROM `configuracion`");
	$descripcion=$wpdb->get_var( "SELECT `descripcion` FROM `configuracion`");
?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

	foreach ($datos_agente as $key ) {
    if(strnatcasecmp(get_the_title(),$key->nombre)==0){ ?>

    	<section class="single">

		<article>
			<div class="solapa">
				<svg id="solapa_abrir" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120.02 59.99"><path d="M52.2,20.08c-8.32,0-16.66.24-25-.07A15.71,15.71,0,0,0,11,36.19c.28,9.08,0,18.18.07,27.27C11.11,73.58,17.47,80,27.6,80q24.76,0,49.52,0C87,80,93.57,73.38,93.59,63.53c0-9.16.05-18.32,0-27.48-.05-7.86-4.8-14-12-15.67A20.19,20.19,0,0,0,77,20.09Q64.58,20.06,52.2,20.08Zm-.11,7.5H77.25a8.67,8.67,0,0,1,5.92,1.79c.66.56,1,1,.19,1.84C75.1,39.39,67,47.71,58.62,55.77c-4.45,4.29-8.09,4.21-12.55-.12-8.28-8-16.36-16.31-24.57-24.44-1-1-.62-1.53.25-2.15a9.26,9.26,0,0,1,5.6-1.5C35.6,27.6,43.85,27.58,52.09,27.58Zm.34,44.89h-25a9.48,9.48,0,0,1-5.09-1.1c-1.22-.73-1.28-1.3-.24-2.32q7.46-7.33,14.79-14.8c.91-.93,1.47-.92,2.38,0a51.11,51.11,0,0,0,6.32,5.91c4.56,3.25,8.85,3.28,13.47.08a50,50,0,0,0,6.47-6.05c.67-.66,1.15-1.06,2-.16q7.53,7.71,15.18,15.31c.91.91.53,1.35-.33,1.91a9.27,9.27,0,0,1-5.27,1.23ZM85.9,66.55c-.52-.12-.69-.1-.78-.18-5-5-10-10-15-14.93-1-1-.28-1.44.32-2q7.09-7.12,14.18-14.23c.3-.3.55-.87,1.24-.56ZM18.74,34.36l.52-.19c5.11,5.14,10.2,10.29,15.34,15.39.94.94.33,1.4-.29,2Q27.65,58.23,21,64.92a14.25,14.25,0,0,0-1.48,2.19l-.81-.59Z" transform="translate(26.41 -20)" style="fill:#fff"/><path d="M-11.31,31.24c-3.59,0-7.18-.06-10.77,0s-5.32,2.92-3.75,5.68a3.82,3.82,0,0,0,3.57,1.84q10.77.06,21.55,0c2.51,0,4.25-1.64,4.24-3.78s-1.71-3.7-4.27-3.75C-4.27,31.19-7.79,31.23-11.31,31.24Z" transform="translate(26.41 -20)" style="fill:#fff"/><path d="M-7.77,46.29c-2.32,0-4.65,0-7,0-2.63.07-4.24,1.57-4.18,3.78s1.61,3.59,4.12,3.62q7.07.09,14.14,0c2.62,0,4.26-1.59,4.2-3.77S1.91,46.37-.6,46.3-5.38,46.29-7.77,46.29Z" transform="translate(26.41 -20)" style="fill:#fff"/><path d="M-4.12,61.24c-1.2,0-2.4-.09-3.59,0a3.94,3.94,0,0,0-3.74,3.63,3.83,3.83,0,0,0,3.54,3.79,58.35,58.35,0,0,0,7.81,0A3.74,3.74,0,0,0,3.52,65,3.86,3.86,0,0,0-.32,61.24c-1.26-.09-2.53,0-3.8,0Z" transform="translate(26.41 -20)" style="fill:#fff"/></svg>
				<svg id="solapa_cerrar" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 228.64 157.13"><path d="M-52.25,124.54c0-4.78.23-9.56-.07-14.32-.22-3.54.5-4.84,4.51-4.88A147.39,147.39,0,0,0-4,98.7c35.52-11.4,57.72-35.53,68.08-71a159,159,0,0,0,5-27c.4-3.51-.6-6.19-3.85-7.82C61.89-8.76,59-8,56.5-5.21A122.12,122.12,0,0,1,34.36,14.61C17.16,26.4-2,32.59-22.56,34.77a138.61,138.61,0,0,1-26,.06c-2.82-.23-3.8-1.06-3.74-4,.21-10.43,0-20.86.11-31.29,0-3.11-.68-5.71-3.61-7.29-3.09-1.67-5.78-.75-8.38,1.19q-44.86,33.52-89.72,67c-7.3,5.48-7.26,13.43,0,18.9q44.64,33.5,89.37,66.88c2.66,2,5.35,3.12,8.68,1.39s3.64-4.48,3.62-7.62C-52.29,134.84-52.25,129.69-52.25,124.54Z" transform="translate(159.4 8.67)" style="fill:#fff"/></svg>
				
			</div>

			<div class="flotante_contacto_guess"></div>
			<div class="flotante_contacto">
				<p class="boton_contacto"><?php echo $xml->single_agentes->contactar_con; ?> <br> <?php echo $key->nombre; ?></p>
				<?php 
			echo '<p>' . $key->nombre . '</br>' . $xml->single_agentes->llamar . ' ' . $key->telefono . '</br>' . $key->correo . '</p>';
			?>
				<form class="correo_single" method="POST">
					<input type="hidden" class="nombre_agente" value="<?php echo $key->nombre; ?>">
					<svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11.23 15.7">
						<path d="M49.51,49.38a6.93,6.93,0,0,0-3.36,1.26,3.28,3.28,0,0,0-.85.94,2.17,2.17,0,0,0-.17,1.87,6.62,6.62,0,0,0,4.19,4.32,4,4,0,0,0,3.3-.28A6.8,6.8,0,0,0,56,53.66a2.42,2.42,0,0,0-.92-3,6.6,6.6,0,0,0-2.94-1.21l-.44-.07a4.87,4.87,0,0,0,1-1.31,6.56,6.56,0,0,0,.81-2.76,2.91,2.91,0,0,0-5.73-.79A4.22,4.22,0,0,0,48,46.9,5.82,5.82,0,0,0,49.51,49.38Z" transform="translate(-45 -42.3)" style="fill:#7c7c7c"/>
					</svg>
					<input type="text" name="nombre" class="nombre" placeholder="<?php echo $xml->texto_contacto->nombre; ?>" required>
					<svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 12.94"><path d="M43.5,47.39a6.65,6.65,0,0,0,1.59,4,16.15,16.15,0,0,0,6.74,5,4,4,0,0,0,2.79.14,3.19,3.19,0,0,0,1.71-1.43,1.21,1.21,0,0,0-.18-1.45,6.2,6.2,0,0,0-1.23-1.1A9.81,9.81,0,0,0,54,51.9a.91.91,0,0,0-1.32.17c-.25.27-.52.52-.77.8a.32.32,0,0,1-.46.07,9.68,9.68,0,0,1-3.88-3.55c-.37-.62-.38-.61.1-1.15a4.93,4.93,0,0,0,.67-1A1.08,1.08,0,0,0,48.28,46,8.87,8.87,0,0,0,45.92,44a.79.79,0,0,0-1,.05,3.78,3.78,0,0,0-1.34,2.28A4.22,4.22,0,0,0,43.5,47.39Z" transform="translate(-43.5 -43.82)" style="fill:#7c7c7c"/></svg>
					<input type="number" name="telefono" class="telefono" placeholder="<?php echo $xml->texto_contacto->telefono; ?>" required>
					<svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.4 8.81"><path d="M50.21,54.81h5.5c.84,0,1.2-.35,1.2-1.19q0-3.21,0-6.42c0-.82-.37-1.19-1.18-1.19h-11c-.82,0-1.18.37-1.18,1.19q0,3.24,0,6.48a1.24,1.24,0,0,0,.17.72.86.86,0,0,0,.68.41h5.86ZM53,50.44l1.12,1,1.3,1.15a.32.32,0,0,1,.06.48.34.34,0,0,1-.51,0l-.12-.1c-.71-.64-1.43-1.27-2.14-1.92-.17-.15-.25-.14-.41,0-.36.36-.74.7-1.12,1a1.34,1.34,0,0,1-1.94,0c-.38-.35-.77-.69-1.14-1.06-.14-.14-.22-.11-.35,0L45.58,53l-.12.1a.36.36,0,0,1-.51,0,.34.34,0,0,1,.08-.5c.74-.66,1.48-1.33,2.23-2,.14-.13.16-.18,0-.32-.72-.65-1.43-1.31-2.14-2a1.62,1.62,0,0,1-.16-.16.3.3,0,0,1,0-.42.31.31,0,0,1,.44,0,1.19,1.19,0,0,1,.16.14l4.07,3.76a.69.69,0,0,0,1.12,0l4.09-3.78a1.09,1.09,0,0,1,.19-.14.28.28,0,0,1,.38.06.3.3,0,0,1,.05.38,1.08,1.08,0,0,1-.19.21Z" transform="translate(-43.5 -46)" style="fill:#7c7c7c"/></svg>
					<input type="email" name="email" class="email" placeholder="<?php echo $xml->texto_contacto->correo; ?>" required>
					<textarea name="mensaje" rows="2" class="mensaje" placeholder="<?php echo $xml->texto_contacto->asunto; ?>"></textarea>
					<input type="submit" value="<?php echo $xml->single_agentes->contactar; ?>" class="submit">
				</form>
				<p><?php echo $xml->single_agentes->aviso_submit; ?></p>
				
			</div>
			
			
				
			<div class="barra_titular">
				<h2 class="titulo_agente"><?php echo $xml->single_agentes->agente; ?></h2>
				
			</div>
			<div class="entrada">
				<div class="datos">
					<div class="imagen">
						<?php  echo wp_get_attachment_image( $key->foto, 'medium', "", array( "alt"=>get_the_title(),"class" => "foto_agente_single")); ?>
					</div>
					<div class="nombre">
						<h3><?php the_title(); ?></h3>	
						<h4><?php echo $key->telefono; ?></h4>
						<h5><?php echo $key->correo; ?></h5>
					</div>
					<div class="fin_imagen"></div>
					
					
					<p class="encabezados"><?php echo $xml->single_agentes->perfil; ?></p>

					<?php if($idiomas==='true' && $descripcion==='true'){ 
								if($xml->codigo_lang=='es'){ ?>
									<p style="    line-height: 19px;"><?php echo stripcslashes(nl2br(htmlentities($key->descripcion))); ?></p>
								<?php
								}else{ 
									$texto='descripcion_' . $xml->codigo_lang;
									if($key->$texto==''){ ?>
										<p style="    line-height: 19px;"><?php echo stripcslashes(nl2br(htmlentities($key->descripcion))); ?></p>
									<?php
									}else{ ?>
										<p style="    line-height: 19px;"><?php  echo stripcslashes(nl2br(htmlentities($key->$texto))); ?></p>
										<?php
									}									
								}							

					 }else{ ?>
						 <p style="    line-height: 19px;"><?php echo stripcslashes(nl2br(htmlentities($key->descripcion))); ?></p> 
						<?php
					}
					
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
  $inmuebles_gestionados=false;
while ( $query_contador->have_posts() ) : $query_contador->the_post();
  $inmuebles_gestionados=true;
endwhile;  ?>
	
		<?php if($inmuebles_gestionados){ ?>

		<p class="encabezados"><?php echo $xml->single_agentes->inmuebles_gestionados; ?></p>
					<div class="listado_inmuebles">
					<p class="leyenda_miniaturas_inmueble"><?php echo $xml->single_agentes->inmueble; ?></p>
					<p class="leyenda_miniaturas_precio"><?php echo $xml->single_agentes->precio; ?></p>

		<?php } 

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

  $meta=get_post_custom( $post->ID); 
  $imagenes = $meta['id_imagenes'][0];
  $simbolo_moneda= $wpdb->get_var( "SELECT `simbolo` FROM `configuracion`" );
	 ?>

  <div class="linea"></div>
<div class="inmueble_gestionado">
	<a href="<?php the_permalink(); ?>">
		<div class="miniatura_inmueble">
		<?php  if(strcmp($imagenes,'')!==0){
		$array_prueba=explode(",", $imagenes);
		$borrado = array_pop($array_prueba);
		echo wp_get_attachment_image( $array_prueba[0], 'thumbnail', "", array( "alt"=>get_the_title(),"class" => "foto_miniatura"));
  } ?>
		</div>
		<div class="nombre_miniatura">
			<p style="    margin-bottom: -16px;margin-top: 28px"><?php the_title(); ?></p>
			<p style="font-style: italic;font-weight:500"><?php echo strip_tags (get_the_term_list( get_the_ID(), 'localidad', "",", " ));?></p>
		</div>
		<div class="precio_miniatura">
			<p><?php if(!empty($meta['id_precio'][0])){
						 echo number_format($meta['id_precio'][0], 0, ',', '.') . $simbolo_moneda;
						} ?>							
			</p>	
		</div>
	</a>
</div>

   
   <?php endwhile;
   
              $args_contador_vendidos = array(
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
                    'operator' => 'IN'
                  ) )
    ));

  $query_contador_vendidos = new WP_Query( $args_contador_vendidos );
  $inmuebles_vendidos=false;
  while ( $query_contador_vendidos->have_posts() ) : $query_contador_vendidos->the_post();
  $inmuebles_vendidos=true;
endwhile;
   		if($inmuebles_vendidos){ ?>

   		<p class="encabezados_vendidos"><?php echo $xml->single_agentes->inmuebles_vendidos; ?></p>
					<div class="listado_inmuebles">
					<p class="leyenda_miniaturas_inmueble"><?php echo $xml->single_agentes->inmueble; ?></p>
					<p class="leyenda_miniaturas_precio"><?php echo $xml->single_agentes->precio; ?></p>

   		<?php } 
   		
              $args_contador_vendidos = array(
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
                    'operator' => 'IN'
                  ) )
    ));

  $query_contador_vendidos = new WP_Query( $args_contador_vendidos );

  while ( $query_contador_vendidos->have_posts() ) : $query_contador_vendidos->the_post();

  $meta=get_post_custom( $post->ID); 
  $imagenes = $meta['id_imagenes'][0];
  $simbolo_moneda= $wpdb->get_var( "SELECT `simbolo` FROM `configuracion`" );
	 ?>

  <div class="linea"></div>
<div class="inmueble_gestionado">
	<a href="<?php the_permalink(); ?>">
		<div class="miniatura_inmueble">
		<?php  if(strcmp($imagenes,'')!==0){
		$array_prueba=explode(",", $imagenes);
		$borrado = array_pop($array_prueba);
		echo wp_get_attachment_image( $array_prueba[0], 'thumbnail', "", array( "alt"=>get_the_title(),"class" => "foto_miniatura"));
  } ?>
		</div>
		<div class="nombre_miniatura">
			<p style="    margin-bottom: -16px;margin-top: 28px"><?php the_title(); ?></p>
			<p style="font-style: italic;font-weight:500"><?php echo strip_tags (get_the_term_list( get_the_ID(), 'localidad', "",", " ));?></p>
		</div>
		<div class="precio_miniatura">
			<p><?php if(!empty($meta['id_precio'][0])){
						 echo number_format($meta['id_precio'][0], 0, ',', '.') . $simbolo_moneda;
						} ?>							
			</p>	
		</div>
	</a>
</div>

   
   <?php endwhile;
   ?>
   	</div>
			</div>
			</div>
		</article>
<div class="contenedor_fin_agentes"></div>
		
	</section>
	<?php
        
    }

}
	
	 endwhile; else: 
		endif; 
 get_footer(); ?>	