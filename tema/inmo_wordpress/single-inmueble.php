<?php get_header(); 
global $xml;
?>

</header>
<?php
	global $wpdb;
	$simbolo_moneda= $wpdb->get_var( "SELECT `simbolo` FROM `configuracion`" );	
?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

	$meta=get_post_custom( $post->ID); ?>

	<section class="single">

		<article>
			<div class="solapa">
				<svg id="solapa_abrir" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120.02 59.99"><path d="M52.2,20.08c-8.32,0-16.66.24-25-.07A15.71,15.71,0,0,0,11,36.19c.28,9.08,0,18.18.07,27.27C11.11,73.58,17.47,80,27.6,80q24.76,0,49.52,0C87,80,93.57,73.38,93.59,63.53c0-9.16.05-18.32,0-27.48-.05-7.86-4.8-14-12-15.67A20.19,20.19,0,0,0,77,20.09Q64.58,20.06,52.2,20.08Zm-.11,7.5H77.25a8.67,8.67,0,0,1,5.92,1.79c.66.56,1,1,.19,1.84C75.1,39.39,67,47.71,58.62,55.77c-4.45,4.29-8.09,4.21-12.55-.12-8.28-8-16.36-16.31-24.57-24.44-1-1-.62-1.53.25-2.15a9.26,9.26,0,0,1,5.6-1.5C35.6,27.6,43.85,27.58,52.09,27.58Zm.34,44.89h-25a9.48,9.48,0,0,1-5.09-1.1c-1.22-.73-1.28-1.3-.24-2.32q7.46-7.33,14.79-14.8c.91-.93,1.47-.92,2.38,0a51.11,51.11,0,0,0,6.32,5.91c4.56,3.25,8.85,3.28,13.47.08a50,50,0,0,0,6.47-6.05c.67-.66,1.15-1.06,2-.16q7.53,7.71,15.18,15.31c.91.91.53,1.35-.33,1.91a9.27,9.27,0,0,1-5.27,1.23ZM85.9,66.55c-.52-.12-.69-.1-.78-.18-5-5-10-10-15-14.93-1-1-.28-1.44.32-2q7.09-7.12,14.18-14.23c.3-.3.55-.87,1.24-.56ZM18.74,34.36l.52-.19c5.11,5.14,10.2,10.29,15.34,15.39.94.94.33,1.4-.29,2Q27.65,58.23,21,64.92a14.25,14.25,0,0,0-1.48,2.19l-.81-.59Z" transform="translate(26.41 -20)" style="fill:#fff"/><path d="M-11.31,31.24c-3.59,0-7.18-.06-10.77,0s-5.32,2.92-3.75,5.68a3.82,3.82,0,0,0,3.57,1.84q10.77.06,21.55,0c2.51,0,4.25-1.64,4.24-3.78s-1.71-3.7-4.27-3.75C-4.27,31.19-7.79,31.23-11.31,31.24Z" transform="translate(26.41 -20)" style="fill:#fff"/><path d="M-7.77,46.29c-2.32,0-4.65,0-7,0-2.63.07-4.24,1.57-4.18,3.78s1.61,3.59,4.12,3.62q7.07.09,14.14,0c2.62,0,4.26-1.59,4.2-3.77S1.91,46.37-.6,46.3-5.38,46.29-7.77,46.29Z" transform="translate(26.41 -20)" style="fill:#fff"/><path d="M-4.12,61.24c-1.2,0-2.4-.09-3.59,0a3.94,3.94,0,0,0-3.74,3.63,3.83,3.83,0,0,0,3.54,3.79,58.35,58.35,0,0,0,7.81,0A3.74,3.74,0,0,0,3.52,65,3.86,3.86,0,0,0-.32,61.24c-1.26-.09-2.53,0-3.8,0Z" transform="translate(26.41 -20)" style="fill:#fff"/></svg>
				<svg id="solapa_cerrar" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 228.64 157.13"><path d="M-52.25,124.54c0-4.78.23-9.56-.07-14.32-.22-3.54.5-4.84,4.51-4.88A147.39,147.39,0,0,0-4,98.7c35.52-11.4,57.72-35.53,68.08-71a159,159,0,0,0,5-27c.4-3.51-.6-6.19-3.85-7.82C61.89-8.76,59-8,56.5-5.21A122.12,122.12,0,0,1,34.36,14.61C17.16,26.4-2,32.59-22.56,34.77a138.61,138.61,0,0,1-26,.06c-2.82-.23-3.8-1.06-3.74-4,.21-10.43,0-20.86.11-31.29,0-3.11-.68-5.71-3.61-7.29-3.09-1.67-5.78-.75-8.38,1.19q-44.86,33.52-89.72,67c-7.3,5.48-7.26,13.43,0,18.9q44.64,33.5,89.37,66.88c2.66,2,5.35,3.12,8.68,1.39s3.64-4.48,3.62-7.62C-52.29,134.84-52.25,129.69-52.25,124.54Z" transform="translate(159.4 8.67)" style="fill:#fff"/></svg>
				
			</div>

			<div class="flotante_contacto_guess"></div>
			<div class="flotante_contacto">
				<p class="boton_contacto"><?php echo $xml->contactar; ?></p>
				<?php require 'obtener_agentes.php'; 

			echo '<p>' . $nombre_agente_activo . '</br>' . $xml->single_agentes->llamar . ' ' . $telefono_agente_activo . '</br>' . $correo_agente_activo . '</p>';
			?>
				<form action="" class="correo_single" method="POST">
					<input type="hidden" class="nombre_agente" value="<?php echo $nombre_agente_activo; ?>">
					<svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11.23 15.7">
						<path d="M49.51,49.38a6.93,6.93,0,0,0-3.36,1.26,3.28,3.28,0,0,0-.85.94,2.17,2.17,0,0,0-.17,1.87,6.62,6.62,0,0,0,4.19,4.32,4,4,0,0,0,3.3-.28A6.8,6.8,0,0,0,56,53.66a2.42,2.42,0,0,0-.92-3,6.6,6.6,0,0,0-2.94-1.21l-.44-.07a4.87,4.87,0,0,0,1-1.31,6.56,6.56,0,0,0,.81-2.76,2.91,2.91,0,0,0-5.73-.79A4.22,4.22,0,0,0,48,46.9,5.82,5.82,0,0,0,49.51,49.38Z" transform="translate(-45 -42.3)" style="fill:#7c7c7c"/>
					</svg>
					<input type="text" name="nombre" class="nombre" placeholder="<?php echo $xml->texto_contacto->nombre; ?>" required>
					<svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 12.94"><path d="M43.5,47.39a6.65,6.65,0,0,0,1.59,4,16.15,16.15,0,0,0,6.74,5,4,4,0,0,0,2.79.14,3.19,3.19,0,0,0,1.71-1.43,1.21,1.21,0,0,0-.18-1.45,6.2,6.2,0,0,0-1.23-1.1A9.81,9.81,0,0,0,54,51.9a.91.91,0,0,0-1.32.17c-.25.27-.52.52-.77.8a.32.32,0,0,1-.46.07,9.68,9.68,0,0,1-3.88-3.55c-.37-.62-.38-.61.1-1.15a4.93,4.93,0,0,0,.67-1A1.08,1.08,0,0,0,48.28,46,8.87,8.87,0,0,0,45.92,44a.79.79,0,0,0-1,.05,3.78,3.78,0,0,0-1.34,2.28A4.22,4.22,0,0,0,43.5,47.39Z" transform="translate(-43.5 -43.82)" style="fill:#7c7c7c"/></svg>
					<input type="number" name="telefono" class="telefono" placeholder="<?php echo $xml->texto_contacto->telefono; ?>" required>
					<svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.4 8.81"><path d="M50.21,54.81h5.5c.84,0,1.2-.35,1.2-1.19q0-3.21,0-6.42c0-.82-.37-1.19-1.18-1.19h-11c-.82,0-1.18.37-1.18,1.19q0,3.24,0,6.48a1.24,1.24,0,0,0,.17.72.86.86,0,0,0,.68.41h5.86ZM53,50.44l1.12,1,1.3,1.15a.32.32,0,0,1,.06.48.34.34,0,0,1-.51,0l-.12-.1c-.71-.64-1.43-1.27-2.14-1.92-.17-.15-.25-.14-.41,0-.36.36-.74.7-1.12,1a1.34,1.34,0,0,1-1.94,0c-.38-.35-.77-.69-1.14-1.06-.14-.14-.22-.11-.35,0L45.58,53l-.12.1a.36.36,0,0,1-.51,0,.34.34,0,0,1,.08-.5c.74-.66,1.48-1.33,2.23-2,.14-.13.16-.18,0-.32-.72-.65-1.43-1.31-2.14-2a1.62,1.62,0,0,1-.16-.16.3.3,0,0,1,0-.42.31.31,0,0,1,.44,0,1.19,1.19,0,0,1,.16.14l4.07,3.76a.69.69,0,0,0,1.12,0l4.09-3.78a1.09,1.09,0,0,1,.19-.14.28.28,0,0,1,.38.06.3.3,0,0,1,.05.38,1.08,1.08,0,0,1-.19.21Z" transform="translate(-43.5 -46)" style="fill:#7c7c7c"/></svg>
					<input type="email" name="email" class="email" placeholder="<?php echo $xml->texto_contacto->correo; ?>" required>
					<textarea name="mensaje" rows="2" class="mensaje"><?php echo $xml->single_inmueble->interesado . ' '; ?> <?php echo $meta['id_referencia'][0]; ?></textarea>
					<input type="submit" value="<?php echo $xml->contactar; ?>" class="submit">
				</form>
				<p><?php echo $xml->single_agentes->aviso_submit; ?></p>
				
			</div>
			
			<?php
					switch ($meta['id_estado_inmueble'][0]) {
  				case 'vendido':
  					echo '<svg id="marca_vendido" width="400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 83.77 31.61"><defs><style>.\30 f558bbb-aada-44b9-9bbe-6c675b37c7ce1{font-size:24.89px;fill:red;font-family:Montserrat;font-weight:700;}.c03bbfbc-7250-4e1a-b056-a2436aca69c71{fill:#f40000;}</style></defs><text class="0f558bbb-aada-44b9-9bbe-6c675b37c7ce1" transform="translate(6.86 24.32) scale(0.6 1)">VENDIDO</text><path class="c03bbfbc-7250-4e1a-b056-a2436aca69c71" d="M138.4,32.37V53H64.63V32.37H138.4m5-5H59.63V58H143.4V27.37h0Z" transform="translate(-59.63 -27.37)"/></svg>';
  					break;
  				case 'alquilado':
  					echo '<svg id="marca_vendido" width="400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 83.77 31.61"><defs><style>.\30 f558bbb-aada-44b9-9bbe-6c675b37c7ce{font-size:24.89px;fill:red;font-family:Montserrat;font-weight:700;}.c03bbfbc-7250-4e1a-b056-a2436aca69c7{fill:#f40000;}</style></defs><text class="0f558bbb-aada-44b9-9bbe-6c675b37c7ce" transform="translate(6.86 24.32) scale(0.46 1)">ALQUILADO</text><path class="c03bbfbc-7250-4e1a-b056-a2436aca69c7" d="M138.4,32.37V53H64.63V32.37H138.4m5-5H59.63V58H143.4V27.37h0Z" transform="translate(-59.63 -27.37)"/></svg>';
  					break;
  				case 'reservado':
  					echo '<svg id="marca_vendido" width="400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 83.77 31.61"><defs><style>.\30 f558bbb-aada-44b9-9bbe-6c675b37c7ce2{font-size:24.89px;fill:#ff9800;font-family:Montserrat;font-weight:700;}.c03bbfbc-7250-4e1a-b056-a2436aca69c72{fill:#ff9800;}</style></defs><text class="0f558bbb-aada-44b9-9bbe-6c675b37c7ce2" transform="translate(6.86 24.32) scale(0.44 1)">RESERVADO</text><path class="c03bbfbc-7250-4e1a-b056-a2436aca69c72" d="M138.4,32.37V53H64.63V32.37H138.4m5-5H59.63V58H143.4V27.37h0Z" transform="translate(-59.63 -27.37)"/></svg>';
  					break;
				}	?>
				
			<div class="barra_titular">
				<p><svg  data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 343.65 309.67" style="width:19px;height: 12px;"><defs><style>.svg_volver{fill:white;}</style></defs><path class="svg_volver" d="M460.45,129.2c-.88,44.49-18.48,81.32-51.34,111.05a155.32,155.32,0,0,1-135.76,37.42C250.53,273,230.46,262.84,212,249c-4.25-3.2-4.93-6.63-1.37-10.55,4.91-5.42,10.11-10.61,15.42-15.65,3.9-3.69,7.83-1.42,11.31,1,8,5.45,16.23,10.54,25.27,13.94,40.82,15.35,79.36,11.09,115-14.52,22.81-16.4,38.27-38.14,45.06-65.58,12.16-49.11-6.87-101-47.55-129.77C350.5,10.36,322.88,3.33,293,6.31a126.36,126.36,0,0,0-59.75,22c-3.15,2.17-6,2.06-8.56-.44-4.79-4.63-9.61-9.26-14-14.24-3.73-4.22-2.85-7.3,1.7-10.79a145.5,145.5,0,0,1,53.79-26.37c18.63-4.64,37.57-6.86,56.91-4.07,16.9,2.44,33.43,5.95,48.73,13.69,42,21.22,70,54.12,82.79,99.6A154.49,154.49,0,0,1,460.45,129.2Z" transform="translate(-116.81 28.81)"/><path class="svg_volver" d="M243.17,160.39c-17.5,0-35,.19-52.49-.12-4.81-.08-6,1.49-5.75,6,.34,6.82.06,13.66.1,20.49,0,3.34-.45,6.45-4,7.82-3.77,1.45-6.79,0-9.33-2.84l-44.5-50c-2.55-2.86-5.18-5.66-7.63-8.59-3.65-4.36-3.65-9.85.07-14q26-29.36,52.14-58.64c2.3-2.58,4.86-4.77,8.66-3.39,4,1.45,4.66,4.79,4.63,8.52,0,7,.27,14-.11,21-.24,4.35,1.37,5.11,5.34,5.1,34.66-.15,69.33-.09,104-.08,9.2,0,11.08,1.89,11.08,11.13q0,24.5,0,49c0,6.58-2.07,8.71-8.65,8.73C278.83,160.43,261,160.39,243.17,160.39Z" transform="translate(-116.81 28.81)"/></svg><?php echo $xml->single_inmueble->volver; ?></p>	
			</div>
			<div class="entrada">
					<?php 
					
					$imagenes = $meta['id_imagenes'][0];
					if(strcmp($imagenes,'')!==0){
					echo '<div class="carrusel_imagenes">';
					$elemento=1;					 
					$array_prueba=explode(",", $imagenes);
					$borrado = array_pop($array_prueba);
					$num_img=0;

					foreach ($array_prueba as $key) {
						$num_img++;
					}
					
					if($num_img>1){
						
					  foreach ($array_prueba as $key) {
					      $url=wp_get_attachment_url( $key, 'thumbnail');
						  $info = new SplFileInfo($url);
						  $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);
						  $image_alt = get_post_meta( $key, '_wp_attachment_image_alt', true);

						  if(strcmp($extension,'jpg')==0 || strcmp($extension,'gif')==0 || strcmp($extension,'jpeg')==0 || strcmp($extension,'png')==0 || strcmp($extension,'bmp')==0){
						  	
						    echo '<picture>
							  <source media="(max-width:480px)" srcset="' . wp_get_attachment_image_src( $key, 'medium_large')[0] .'">';
							echo wp_get_attachment_image( $key, 'large', "", array( "alt"=>$image_alt,"class" => "mySlides elem" . $elemento));
							echo '</picture>';
							
						 }else{

						      echo '<video class="mySlides  elem' . $elemento . '" width="100%"  controls>
										  <source src="' . $url . '" type="video/mp4">
										  Your browser does not support the video tag.
										  </video>';
						  }

						  $elemento++;
					  }
						?>

					 	  <div class="izquierda">&#10094;</div>
						  <div class="derecha">&#10095;</div>
						  <input type="hidden" class="num_elem" value="<?php echo $elemento-1; ?>">
						  <input type="hidden" class="elem_actual" value="1">
						  <div class="marcadores">
						  	<?php 
						  	foreach ($array_prueba as $key) {
								echo '<span class="marcador" ></span>';								
							}
						  	?>
						     
						  </div>

				<?php	}else{ 
							foreach ($array_prueba as $key) {

							  $url=wp_get_attachment_url( $key, 'thumbnail');
							  $info = new SplFileInfo($url);
							  $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);
							  $image_alt = get_post_meta( $key, '_wp_attachment_image_alt', true);

							  if(strcmp($extension,'jpg')==0 || strcmp($extension,'gif')==0 || strcmp($extension,'jpeg')==0 || strcmp($extension,'png')==0 || strcmp($extension,'bmp')==0){

							      echo '<picture>
							  <source media="(max-width:480px)" srcset="' . wp_get_attachment_image_src( $key, 'medium_large')[0] .'">';							  
							echo wp_get_attachment_image( $key, 'full', "", array( "alt"=>$image_alt,"class" => "mySlides elem" . $elemento));
							echo '</picture>';
							
							 }

							  if(strcmp($extension,'mp4')==0){
							     echo '<video class="mySlides" width="100%"  controls>
											  <source src="' . $url . '" type="video/mp4">
											  Your browser does not support the video tag.
											  </video>';
							  }									
							}
						} 

						if(empty($meta['id_latitud'][0]) || empty($meta['id_longitud'][0])){
									
									?>
								<input type="hidden" value="vacio" class="elemento_vacio">
									<?php
								}else{
									?>
					<div class="boton_mostrar_mapa"><p><?php echo $xml->single_inmueble->abrir_mapa; ?></p></div>
					<div id="map" class="mini_mapa_google ">
						
						<input type="hidden" class="valor_latitud" value="<?php echo $meta['id_latitud'][0] ?>">
						<input type="hidden" class="valor_longitud" value="<?php echo $meta['id_longitud'][0] ?>">
										
						
					</div> <?php		}
						

						echo '</div>';
						
					}

					if(strcmp($imagenes,'')==0){

							

						if(empty($meta['id_latitud'][0]) || empty($meta['id_longitud'][0])){ ?>
									<input type="hidden" value="vacio" class="elemento_vacio">
										
						<?php }else{ ?>
									
							<div class="carrusel_imagenes sin_imagen_carrusel">
								<div id="map" class="mini_mapa_google sin_imagen">
								
									<input type="hidden" class="valor_latitud" value="<?php echo $meta['id_latitud'][0] ?>">
									<input type="hidden" class="valor_longitud" value="<?php echo $meta['id_longitud'][0] ?>">
								</div>
							</div>

						<?php	}	
					} ?>
				<div class="contenedor_datos">
				<div class="contenido_texto_izquierda">
					<p><?php 
					switch ($xml->codigo_lang) {
						case 'ES':
							the_title(); 
							break;
						case 'EN':
							if($meta['id_titulo_EN'][0]==''){
								the_title();
							}else{
								echo $meta['id_titulo_EN'][0];
							}							
							break;
						case 'FR':
							if($meta['id_titulo_FR'][0]==''){
								the_title();
							}else{
								echo $meta['id_titulo_FR'][0];
							}							
							break;
						case 'DE':
							if($meta['id_titulo_DE'][0]==''){
								the_title();
							}else{
								echo $meta['id_titulo_DE'][0];
							}							
							break;
						case 'IT':
							if($meta['id_titulo_IT'][0]==''){
								the_title();
							}else{
								echo $meta['id_titulo_IT'][0];
							}							
							break;
						case 'SE':
							if($meta['id_titulo_SE'][0]==''){
								the_title();
							}else{
								echo $meta['id_titulo_SE'][0];
							}							
							break;
					}
					?></p>
					<h4><?php 
					$nombre_localidad= strip_tags (get_the_term_list( get_the_ID(), 'localidad', "",", " ));
					$slug=str_replace(' ', '-', $nombre_localidad);
					$tag = get_term_by('slug', $slug, 'localidad');
					$tag_padre = get_term_by('id', $tag->parent, 'localidad');
					if(!empty($tag_padre->name)){
						echo $tag_padre->name . ' - ';
					}
					echo strip_tags (get_the_term_list( get_the_ID(), 'localidad', "",", " ));
					?></h4>
					<h6><?php echo $meta['id_direccion'][0]; ?></h6>
					<h5><?php 
						switch($meta['id_tipo'][0]){
							case 'Casa':
							$tipo_traducido=$xml->pagina_buscar->casa;
							break;
							case 'Chalet':
							$tipo_traducido=$xml->pagina_buscar->chalet;
							break;
							case 'Piso':
							$tipo_traducido=$xml->pagina_buscar->piso;
							break;
							case 'Edificio':
							$tipo_traducido=$xml->pagina_buscar->edificio;
							break;
							case 'Terreno':
							$tipo_traducido=$xml->pagina_buscar->terreno;
							break;
							case 'Garaje':
							$tipo_traducido=$xml->pagina_buscar->garaje;
							break;
							case 'Apartamento':
							$tipo_traducido=$xml->pagina_buscar->apartamento;
							break;
							case 'Otros':
							$tipo_traducido=$xml->pagina_buscar->otros;
							break;
							case 'Local':
							$tipo_traducido=$xml->pagina_buscar->local;
							break;
							default:
							$tipo_traducido='';
							break;							
						}
						
					echo $tipo_traducido; ?></h5>
						
				</div>
				<div class="contenido_texto_derecha">
					<p><?php 
					
					if(!empty($meta['id_anterior'][0])){
						 echo '<span>' . number_format($meta['id_anterior'][0], 0, ',', '.') . $simbolo_moneda . '</br></span>';
						} 
					if(!empty($meta['id_precio'][0])){
						 echo number_format($meta['id_precio'][0], 0, ',', '.') . $simbolo_moneda;
						} ?></p>	
				</div>
				<div class="caracteristicas_entrada">
					<?php
						switch ($meta['id_construido'][0]) {
							case '':
								# code...
								break;
														
							default:
						echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.68 31.56"><path d="M34.3,64.15c.06.51-.27,1.34.13,1.69s1.16.09,1.76.1h.35c.52,0,1.27.24,1.51-.11s.08-1.21.1-1.83c0-.26-.15-.26-.35-.27-.42,0-1,.19-1.23-.1s-.07-.78-.06-1.19c0-.23-.08-.32-.31-.32-.53,0-1.06,0-1.59,0-.26,0-.34.1-.33.35C34.31,63,34.3,63.51,34.3,64.15Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M63.94,65.93c.51,0,1,0,1.53,0,.28,0,.37-.09.37-.37,0-1,0-2,0-3.05,0-.3-.07-.44-.39-.41-.16,0-.31,0-.47,0-.43,0-1-.17-1.26.08s-.09.77-.09,1.17-.07.37-.36.37-.93-.18-1.19.07-.09.82-.09,1.24c0,.88,0,.88.9.88Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M36.09,34.52c-.51.06-1.34-.27-1.69.13s-.09,1.15-.1,1.76,0,.94,0,1.41.15.59.56.53a2,2,0,0,1,.24,0c.45,0,1,.13,1.31-.09s.08-.8.11-1.22c0-.21.05-.34.29-.31h.06c.42,0,1.11.19,1.21-.11a6.09,6.09,0,0,0,.08-1.91c0-.23-.21-.18-.36-.18Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M63.94,34.52a14,14,0,0,1-1.41,0c-.5-.05-.6.15-.57.59a9,9,0,0,1,0,1.23c0,.32.11.4.41.4s.94-.19,1.17.09.07.75.06,1.13.07.39.36.38c.51,0,1,0,1.53,0,.25,0,.34-.09.33-.34,0-1,0-2.07,0-3.11,0-.34-.14-.38-.42-.37C64.92,34.53,64.43,34.52,63.94,34.52Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M45.28,63.73c-.67,0-1.33,0-2,0-.28,0-.38.07-.37.36,0,.51,0,1,0,1.52,0,.26.09.33.34.33q2,0,4.06,0c.28,0,.38-.07.37-.36,0-.51,0-1,0-1.52,0-.25-.08-.34-.34-.33C46.65,63.74,46,63.73,45.28,63.73Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M54.84,65.93c.67,0,1.33,0,2,0,.27,0,.39-.06.38-.35,0-.51,0-1,0-1.52,0-.25-.08-.34-.34-.33q-2,0-4.06,0c-.27,0-.39.06-.38.35,0,.49,0,1,0,1.47,0,.3.08.41.4.4C53.51,65.91,54.18,65.93,54.84,65.93Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M45.28,34.52c-.67,0-1.33,0-2,0-.28,0-.38.07-.37.36,0,.51,0,1,0,1.52,0,.26.09.33.34.33q2.06,0,4.12,0c.23,0,.31-.07.31-.3,0-.53,0-1.06,0-1.58,0-.26-.09-.33-.34-.33C46.65,34.53,46,34.52,45.28,34.52Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M54.85,36.72c.67,0,1.33,0,2,0,.28,0,.38-.07.37-.36,0-.51,0-1,0-1.52,0-.26-.09-.33-.34-.33q-2,0-4.06,0c-.28,0-.38.08-.37.36,0,.51,0,1,0,1.52,0,.26.09.33.34.33C53.48,36.71,54.16,36.72,54.85,36.72Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M34.3,55c0,.67,0,1.33,0,2,0,.28.08.38.36.36.51,0,1,0,1.53,0,.27,0,.33-.1.33-.35q0-2,0-4.06c0-.26-.09-.36-.34-.33h-.06c-.59,0-1.34-.18-1.71.1s-.07,1.06-.11,1.63C34.29,54.56,34.3,54.78,34.3,55Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M63.61,55c0,.65,0,1.3,0,1.94,0,.31.09.41.4.4.59,0,1.33.18,1.71-.1s.09-1.06.1-1.62c0-.88,0-1.77,0-2.65,0-.28-.07-.38-.36-.37-.51,0-1,0-1.53,0-.26,0-.33.1-.33.35C63.62,53.65,63.61,54.33,63.61,55Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M34.3,45.46c0,.65,0,1.29,0,1.94,0,.31.06.46.41.44s1,0,1.47,0c.26,0,.34-.08.34-.34q0-2,0-4.06c0-.25-.06-.37-.33-.34h-.12c-.57,0-1.31-.19-1.66.09s-.08,1.06-.11,1.62C34.29,45,34.3,45.24,34.3,45.46Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M63.61,45.5c0,.65,0,1.3,0,1.94,0,.31.1.41.4.4.59,0,1.34.18,1.71-.11s.09-1.06.1-1.63c0-.86,0-1.73,0-2.59,0-.34-.09-.44-.43-.42a12.58,12.58,0,0,1-1.42,0c-.33,0-.39.11-.39.41C63.63,44.16,63.61,44.83,63.61,45.5Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/>
						</svg>
						<p>' . number_format($meta['id_construido'][0], 0, ',', '.') . 'm&#178</p>';
						break;
					}
					?>
						<div class="separador_caracteristicas2"></div>
						<?php 
							switch ($meta['id_habitaciones'][0]) {
								case '':
									# code...
									break;

								default:
									echo '<svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.92 30.8"><path d="M36.3,52.38c0-1,0-1.8,0-2.66a.88.88,0,0,0-.7-1,.87.87,0,0,0-1.1.91c0,.86,0,1.73,0,2.59q0,5.61,0,11.21c0,.15,0,.31,0,.46,0,.68.37,1.1.91,1.09s.88-.43.89-1.12,0-1.34,0-2c0-.36.06-.49.46-.49q13.2,0,26.39,0c.4,0,.48.13.47.49,0,.69,0,1.38,0,2.07S64,65,64.5,65s.92-.42.92-1.09q0-7.07,0-14.15c0-.68-.32-1-.88-1s-.91.35-.92,1.06,0,1.67,0,2.54c-.27-.05-.27-.22-.3-.36q-.73-2.92-1.46-5.84a2.9,2.9,0,0,1-.06-.68q0-5,0-10.06a1,1,0,0,0-.58-1.09.9.9,0,0,0-1.26.9c0,.75,0,1.5,0,2.24,0,.33-.1.41-.42.41H40.37c-.32,0-.44-.07-.42-.4,0-.71,0-1.42,0-2.13s-.34-1.08-.92-1.07-.9.38-.91,1.08c0,2.68,0,5.37,0,8.05a16.56,16.56,0,0,1-.62,5c-.34,1.18-.61,2.37-.91,3.56A.6.6,0,0,1,36.3,52.38ZM50,54.14c4.37,0,8.74,0,13.11,0,.41,0,.57.06.56.52,0,1.48,0,3,0,4.43,0,.35-.06.5-.46.5q-13.2,0-26.4,0c-.41,0-.47-.15-.46-.5,0-1.42,0-2.84,0-4.26,0-.54.09-.7.67-.7C41.29,54.15,45.63,54.14,50,54.14Zm0-1.82c-3.66,0-7.32,0-11,0-.52,0-.58-.12-.45-.6.4-1.46.75-2.93,1.1-4.4a.48.48,0,0,1,.57-.45q9.76,0,19.52,0a.48.48,0,0,1,.57.45c.35,1.47.7,2.94,1.1,4.4.13.49.06.61-.45.6C57.27,52.31,53.62,52.32,50,52.32Zm0-12.67c3.19,0,6.39,0,9.58,0,.38,0,.48.1.47.47,0,1.21,0,2.41,0,3.62,0,1.37,0,1.36-1.37,1.35-.34,0-.49-.07-.46-.44a4.07,4.07,0,0,0,0-.86,2.67,2.67,0,0,0-2.49-2.3c-1.33,0-2.65,0-4,0-.62,0-1.13.52-1.64.56s-1-.56-1.68-.56c-1.33,0-2.66,0-4,0a2.69,2.69,0,0,0-2.53,2.39c0,.39.18.94-.12,1.13s-.82,0-1.24.08-.49-.08-.48-.46c0-1.49,0-3,0-4.48,0-.41.11-.5.51-.5C43.61,39.65,46.76,39.65,49.92,39.65Zm-3.6,5.43H44c-.14,0-.3.06-.37-.16a1.17,1.17,0,0,1,1.12-1.63c1,0,2,0,3,0s1.38.31,1.37,1.41c0,.35-.14.41-.44.4C47.86,45.06,47.09,45.07,46.32,45.07Zm7.34,0H51.23c-.14,0-.3.06-.37-.16A1.17,1.17,0,0,1,52,43.27c1,0,2,0,3,0s1.38.31,1.37,1.41c0,.35-.14.41-.44.4C55.16,45.06,54.41,45.07,53.66,45.07Z" transform="translate(-34.49 -34.2)" style="fill:#474747"/></svg>
						<p>' . $meta['id_habitaciones'][0] . ' ' . $xml->pagina_buscar->hab . '</p>';
									break;
							}
						?>
						<div class="separador_caracteristicas"></div>
						<?php 
						switch ($meta['id_banos'][0]) {
							case '':
								# code...
								break;
							case '1':
								echo '<svg class="bathe" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.69 30.34"><path d="M58.44,64.18c0,1.2,0,1.19,1.19,1.14.29,0,.35-.12.34-.37,0-.78,0-1.57,0-2.35a.56.56,0,0,1,.3-.54,9.44,9.44,0,0,0,4.34-7.43.52.52,0,0,1,.38-.51A2.38,2.38,0,0,0,66.18,53,2.43,2.43,0,0,0,64,49.41H37.66c-.35,0-.52,0-.52-.46,0-3.49,0-7,0-10.47a1.82,1.82,0,1,1,3.63-.24c.07.52.37.82.79.8s.71-.38.71-.92a3.32,3.32,0,0,0-6.63.39q0,5.23,0,10.47a.59.59,0,0,1-.39.67,2.43,2.43,0,0,0,.05,4.48.49.49,0,0,1,.36.48A9.7,9.7,0,0,0,39,61.25c.43.39,1.13.58,1.3,1.14a6.49,6.49,0,0,1,0,1.82c0,1.16,0,1.14,1.17,1.12.32,0,.37-.12.37-.4,0-.62,0-1.24,0-1.93a12.22,12.22,0,0,0,5.2.72q3.22,0,6.45,0A11.66,11.66,0,0,0,58.44,63C58.44,63.45,58.44,63.82,58.44,64.18Zm4.16-9.9c.46,0,.53.11.48.55a8.26,8.26,0,0,1-8,7.35c-3.25.07-6.5.07-9.74,0a8.25,8.25,0,0,1-8.11-7.07c-.14-.83-.14-.83.7-.83H50.18C54.32,54.29,58.46,54.3,62.6,54.28ZM36.71,52.79a3.08,3.08,0,0,1-.63,0A.92.92,0,0,1,36,51a2.1,2.1,0,0,1,.62-.08H63.73c.84,0,1.27.35,1.24,1a.87.87,0,0,1-.81.87,5,5,0,0,1-.58,0H36.71Z" transform="translate(-33.81 -35)" style="fill:#474747"/></svg><p>' . $meta['id_banos'][0] . ' ' . $xml->pagina_buscar->bano . '</p>';
								break;
							
							default:
							echo '<svg class="bathe" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.69 30.34"><path d="M58.44,64.18c0,1.2,0,1.19,1.19,1.14.29,0,.35-.12.34-.37,0-.78,0-1.57,0-2.35a.56.56,0,0,1,.3-.54,9.44,9.44,0,0,0,4.34-7.43.52.52,0,0,1,.38-.51A2.38,2.38,0,0,0,66.18,53,2.43,2.43,0,0,0,64,49.41H37.66c-.35,0-.52,0-.52-.46,0-3.49,0-7,0-10.47a1.82,1.82,0,1,1,3.63-.24c.07.52.37.82.79.8s.71-.38.71-.92a3.32,3.32,0,0,0-6.63.39q0,5.23,0,10.47a.59.59,0,0,1-.39.67,2.43,2.43,0,0,0,.05,4.48.49.49,0,0,1,.36.48A9.7,9.7,0,0,0,39,61.25c.43.39,1.13.58,1.3,1.14a6.49,6.49,0,0,1,0,1.82c0,1.16,0,1.14,1.17,1.12.32,0,.37-.12.37-.4,0-.62,0-1.24,0-1.93a12.22,12.22,0,0,0,5.2.72q3.22,0,6.45,0A11.66,11.66,0,0,0,58.44,63C58.44,63.45,58.44,63.82,58.44,64.18Zm4.16-9.9c.46,0,.53.11.48.55a8.26,8.26,0,0,1-8,7.35c-3.25.07-6.5.07-9.74,0a8.25,8.25,0,0,1-8.11-7.07c-.14-.83-.14-.83.7-.83H50.18C54.32,54.29,58.46,54.3,62.6,54.28ZM36.71,52.79a3.08,3.08,0,0,1-.63,0A.92.92,0,0,1,36,51a2.1,2.1,0,0,1,.62-.08H63.73c.84,0,1.27.35,1.24,1a.87.87,0,0,1-.81.87,5,5,0,0,1-.58,0H36.71Z" transform="translate(-33.81 -35)" style="fill:#474747"/></svg><p>' . $meta['id_banos'][0] . ' ' . $xml->pagina_buscar->banos . '</p>';
								break;
							}
						?>
						<div class="separador_caracteristicas2"></div>
						<div class="certificado">
							<?php switch ($meta['id_certificado'][0]) {
  				case 'a':
  					echo '<img id="certificado" src="' . get_stylesheet_directory_uri()  . '/img/Certificado/a.jpg"><p>' . $xml->pagina_buscar->nivel . ' A</p>';
  					break;
  				case 'b':
  					echo '<img id="certificado" src="' . get_stylesheet_directory_uri()  . '/img/Certificado/b.jpg"><p>' . $xml->pagina_buscar->nivel . ' B</p>';
  					break;
  				case 'c':
  					echo '<img id="certificado" src="' . get_stylesheet_directory_uri()  . '/img/Certificado/c.jpg"><p>' . $xml->pagina_buscar->nivel . ' C</p>';
  					break;
  				case 'd':
  					echo '<img id="certificado" src="' . get_stylesheet_directory_uri()  . '/img/Certificado/d.jpg"><p>' . $xml->pagina_buscar->nivel . ' D</p>';
  					break;
  				case 'f':
  					echo '<img id="certificado" src="' . get_stylesheet_directory_uri()  . '/img/Certificado/f.jpg"><p>' . $xml->pagina_buscar->nivel . ' F</p>';
  					break;
  				case 'e':
  					echo '<img id="certificado" src="' . get_stylesheet_directory_uri()  . '/img/Certificado/e.jpg"><p>' . $xml->pagina_buscar->nivel . ' E</p>';
  					break;
  				case 'g':
  					echo '<img id="certificado" src="' . get_stylesheet_directory_uri()  . '/img/Certificado/g.jpg"><p>' . $xml->pagina_buscar->nivel . ' G</p>';
  					break;
  			}
  		?>
						</div>
				</div>
				<div class="datos">
					<?php 
					if(!strcmp($meta['id_referencia'][0],'')==0){
						echo '<p><span>' . $xml->single_inmueble->referencia . ' </span>' . $meta['id_referencia'][0] . '</p>';
					}
					function empty_content ($str) { 
 				   		return trim (str_replace ('& nbsp;', '', strip_tags ($str))) == ''; 
					}	
					if (!empty_content($post->post_content)){
						echo '<p><span>' . $xml->single_inmueble->descripcion . ' </span></p><div class="content">';
						
					switch ($xml->codigo_lang) {
						case 'ES':
							the_content();
							break;
						case 'EN':
							if($meta['id_texto_EN'][0]==''){
								the_content();
							}else{
								echo $meta['id_texto_EN'][0];
							}							
							break;
						case 'FR':
							if($meta['id_texto_FR'][0]==''){
								the_content();
							}else{
								echo $meta['id_texto_FR'][0];
							}							
							break;
						case 'DE':
							if($meta['id_texto_DE'][0]==''){
								the_content();
							}else{
								echo $meta['id_texto_DE'][0];
							}							
							break;
						case 'IT':
							if($meta['id_texto_IT'][0]==''){
								the_content();
							}else{
								echo $meta['id_texto_IT'][0];
							}							
							break;
						case 'SE':
							if($meta['id_texto_SE'][0]==''){
								the_content();
							}else{
								echo $meta['id_texto_SE'][0];
							}							
							break;
					}

						echo '</div>';
					}				
					?>
					<p class="encabezados"><?php echo $xml->single_inmueble->detalles; ?> </p>	
					<table class="datos_detalles">
						<tr>
							<?php if(!empty($meta['id_ano_construcion'][0])){ 
							echo '<td>
								<p><span>' . $xml->single_inmueble->construccion . ' </span>' . number_format($meta['id_ano_construcion'][0], 0, ',', '.') . '</p></td>';
							} 
							if(strcmp($meta['id_estado'][0],'Sin estado')!==0){ 
							echo '<td><p><span>' . $xml->single_inmueble->estado . ' </span>';
													
						switch($meta['id_estado'][0]){
							case 'Nuevo':
							$estado_traducido=$xml->single_inmueble->nuevo;
							break;
							case 'Reformado':
							$estado_traducido=$xml->single_inmueble->reformado;
							break;
							case 'A reformar':
							$estado_traducido=$xml->single_inmueble->reformar;
							break;
							case 'Seminuevo':
							$estado_traducido=$xml->single_inmueble->seminuevo;
							break;
							default:
							$estado_traducido='';
							break;							
						}
						
					echo $estado_traducido . '</p></td>';
							} ?>
							
						</tr>
						<tr>
							<?php if(!empty($meta['id_superficie'][0])){ 
							echo '<td><p><span>' . $xml->single_inmueble->superficie . ' </span>' . number_format($meta['id_superficie'][0], 0, ',', '.') . 'm&#178;</p></td>';
							} 
							if(!empty($meta['id_construido'][0])){ 
							echo '<td><p><span>' . $xml->single_inmueble->superficie_construido . ' </span>' . number_format($meta['id_construido'][0], 0, ',', '.') . 'm&#178;</p></td>';
							} ?>
						</tr>
						<tr>
							<?php if(!empty($meta['id_habitaciones'][0])){ 
							echo '<td><p><span>' . $xml->habitaciones . ': </span>' . $meta['id_habitaciones'][0] . '</p></td>';
							} 
							if(!empty($meta['id_banos'][0])){ 
							echo '<td><p><span>' . $xml->pagina_buscar->banos . ': </span>' . $meta['id_banos'][0] . '</p></td>';
							} ?>
						</tr>
						<tr>
							<td><p><span><?php echo $xml->pagina_buscar->tipo; ?>: </span><?php 
						
						switch($meta['id_tipo'][0]){
							case 'Casa':
							$tipo_traducido=$xml->pagina_buscar->casa;
							break;
							case 'Chalet':
							$tipo_traducido=$xml->pagina_buscar->chalet;
							break;
							case 'Piso':
							$tipo_traducido=$xml->pagina_buscar->piso;
							break;
							case 'Edificio':
							$tipo_traducido=$xml->pagina_buscar->edificio;
							break;
							case 'Terreno':
							$tipo_traducido=$xml->pagina_buscar->terreno;
							break;
							case 'Garaje':
							$tipo_traducido=$xml->pagina_buscar->garaje;
							break;
							case 'Apartamento':
							$tipo_traducido=$xml->pagina_buscar->apartamento;
							break;
							case 'Otros':
							$tipo_traducido=$xml->pagina_buscar->otros;
							break;
							case 'Local':
							$tipo_traducido=$xml->pagina_buscar->local;
							break;
							default:
							$tipo_traducido='';
							break;							
						}
						
					echo $tipo_traducido; ?></p></td>
							<?php if(strcmp($meta['id_certificado'][0],'0')!==0){
								?>
								<td><p><span><?php echo $xml->single_inmueble->certificado; ?> </span>
								<?php
								if(strcmp($meta['id_certificado'][0],'1')==0){
									echo 'En trámite';
								}else{
									echo $xml->pagina_buscar->nivel . ' ' . strtoupper($meta['id_certificado'][0]);
								} ?>
							</p></td>
							<?php
							}
							?>
						</tr>
						<tr>
							<?php if(!empty($meta['id_precio'][0])){ 
							echo '</td><td><p><span>' . $xml->precio . ': </span>' . number_format($meta['id_precio'][0], 0, ',', '.') . $simbolo_moneda . '</p></td>';
							} 
							if(!empty($meta['id_precio'][0]) && !empty($meta['id_construido'][0])){ 
							echo '<td><p><span>' . $xml->single_inmueble->precio_metro . ' </span>' . number_format($meta['id_precio'][0]/$meta['id_construido'][0], 0, ',', '.') . $simbolo_moneda . '</p></td>';
							} ?>							
						</tr>		
					</table>	
						
					
					
				
					<?php

						global $codigo_idioma;
						$terms = wp_get_object_terms($post->ID, 'caracteristicas_' . $codigo_idioma);
						$contador=0;
						foreach ($terms as $key ) {
							$contador++;
						} 
						if($contador>=1){
							echo '<p class="encabezados">' . $xml->pagina_buscar->caracteristicas . '</p>';
							?>
							<p class="datos_caracteristicas"><?php echo strip_tags (get_the_term_list( get_the_ID(), 'caracteristicas_' . $codigo_idioma, ""," - " ));?></p>
							<?php
						}				

					if(strcmp($meta['id_transaccion'][0], 'venta')==0 && !empty($meta['id_precio'][0])){ ?>
						<p class="encabezados"><?php echo $xml->single_inmueble->mensualidad; ?></p>
						<form action="" method="POST">
						<p><span><?php echo $xml->single_inmueble->valor_inmueble; ?> </span><span><?php if(!empty($meta['id_precio'][0])){
							 echo number_format($meta['id_precio'][0], 0, ',', '.') . $simbolo_moneda;
							} ?></span></p>	
						<table class="estimacion">
							<tr>
								<td><p><span><?php echo $xml->single_inmueble->pago_inicial; ?> (<?php echo $simbolo_moneda; ?>)</span></p></td>
								<td><p><span><?php echo $xml->single_inmueble->interes; ?> (%)</span></p></td>
								<td><p><span><?php echo $xml->single_inmueble->duracion; ?></span></p></td>
							</tr>
							<tr>
								<td><span class="opcion"><?php echo $xml->single_inmueble->pago_inicial; ?> (<?php echo $simbolo_moneda; ?>)</span><input type="number" class="pago_inicial" value="15000" step="100" min="100"></td>
								<td><span class="opcion"><?php echo $xml->single_inmueble->interes; ?> (%)</span><input type="number" class="interes" value="1" step=".01"></td>
								<td><span class="opcion"><?php echo $xml->single_inmueble->duracion; ?></span><input type="number" class="years" value="30" min="1" max="40"></td>
							</tr>
						</table>
						<input type="hidden" name="valor_inmueble" class="valor" value="<?php echo $meta['id_precio'][0]; ?>">
						<input type="button" value="<?php echo $xml->single_inmueble->calcular; ?>" class="calcular">
						<p class="p_resultado"><span><?php echo $xml->single_inmueble->pago_mensualidad; ?> </span><span class="resultado"></span></p>
						<p class="asterisco"><?php echo $xml->single_inmueble->esta_estimacion; ?></p>
						</form>
				<?php	} ?>
				</div>
			</div>
			<?php 
			$permalink = urlencode(get_permalink());
			$titulo=urlencode(get_the_title());
			?>
			<div class="compartir_redes">
				<a href="whatsapp://send?text=<?php echo get_permalink(); ?>" data-action="share/whatsapp/share"><img src="<?php bloginfo('template_directory'); ?>/img/redes/whatsapp.png" alt="Compartir en Whatsapp" style=" width: 30px;
    margin-left: 10px;"></a>
				<a href="http://facebook.com/sharer.php?u=<?php echo $permalink;?>"><img src="<?php bloginfo('template_directory'); ?>/img/redes/facebook.png" alt="Compartir en Facebook" style=" width: 30px;
    margin-left: 10px;"></a>
				<a href="
http://twitter.com/home?status=<?php echo $titulo . '%20';  echo $permalink;?>"><img src="<?php bloginfo('template_directory'); ?>/img/redes/twitter.png" alt="Compartir en Twitter" style=" width: 30px;
    margin-left: 10px;"></a>
<a href="https://plus.google.com/share?url=<?php echo $permalink;?>"><img src="<?php bloginfo('template_directory'); ?>/img/redes/google.png" alt="Compartir en Google Plus" style=" width: 30px;
    margin-left: 10px;"></a>
    </div>
			</div>
		</article>

		<?php endwhile; else: ?>
		<?php endif; ?>
	</section>

<?php get_footer(); ?>	

<script>

//CARGA MAPA
       
        if($('.elemento_vacio').val()=='vacio'){
        	$('.single article .entrada .mini_mapa_google').css('border', 'none');
        	function initMap() {
		       	
        		}
        	
        }else{
        	function initMap() {
		       	latitud=parseFloat($('.valor_latitud').val());
		       	longitud=parseFloat($('.valor_longitud').val());
		        var inmueble = {lat: latitud, lng: longitud};
		        var map = new google.maps.Map(document.getElementById('map'), {
		          zoom: 10,
		          center: inmueble
		        });
		        var marker = new google.maps.Marker({
		          position: inmueble,
		          map: map
		        });
        		}
      }

</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgQOKS5n_Q8MYR0sO42FirRNzZ0OR9xUk&callback=initMap"></script>
