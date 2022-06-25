<?php 
global $xml;

		if (function_exists("pagination")) {
    		pagination($loop->max_num_pages);
		}
		
		if(!strcmp($numero_post,'1')==0 && !strcmp($numero_post,'0')==0){ 
			echo '<span class="ordenar_precio">
			<svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23.44 35.97"><path d="M61.39,48c-1.53,1.49-3.06,3-4.61,4.45-.3.29-.54.86-1,.69s-.25-.77-.25-1.17c0-3,0-6,0-9.05,0-1.75-.07-1.82-1.88-1.83-.26,0-.53,0-.79,0-1.07-.1-1.5.36-1.49,1.44,0,3.23,0,6.47,0,9.71,0,.31.2.77-.25.91s-.52-.26-.73-.47l-4.21-4.16c-.21-.21-.43-.55-.75-.45s-.21.59-.28.91c0,0,0,.09,0,.13a6.8,6.8,0,0,0,2.76,7,43.87,43.87,0,0,1,4.52,4.4,1.21,1.21,0,0,0,2,0c2.15-2.13,4.32-4.24,6.49-6.34a2.29,2.29,0,0,0,.81-1.72c0-1.43,0-2.86,0-4.29Z" transform="translate(-38.3 -25.05)" style="fill:#fff"/><path d="M38.92,38.35c1.51-1.64,3-3.29,4.54-4.92.22-.23.43-.67.83-.49s.22.62.22.94c0,3.15,0,6.3-.06,9.44,0,1.26.41,1.81,1.67,1.66a4.48,4.48,0,0,1,.53,0c1.91,0,2,0,2-1.87,0-3,0-5.95.06-8.92,0-.41-.23-1,.19-1.21s.72.36,1,.64c1.36,1.31,2.68,2.65,4,4,.21.21.43.54.76.43s.24-.52.24-.81c0-1.09,0-2.19,0-3.28A2.5,2.5,0,0,0,54.14,32c-2.22-2.18-4.45-4.36-6.65-6.55a1.11,1.11,0,0,0-1.81,0Q42.35,28.79,39,32a1.85,1.85,0,0,0-.66,1.24c0,1.55,0,3.11,0,4.66Z" transform="translate(-38.3 -25.05)" style="fill:#fff"/></svg>
		<span>' . $xml->pagina_buscar->mayor_precio . '</span></span>';
		}
		 

if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();

	$meta=get_post_custom( $post->ID);  ?> 
		<article>
			<a href="<?php the_permalink(); ?>">

			<div class="contenedor">
				<?php 
						if(strcmp($meta['meta-checkbox'][0], 'yes')==0){
			echo '<div class="cartel_destacado"><svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 75.99 72.3"><path d="M72.29,80.69c-1.32-7.48-2.43-14.28-3.77-21A4.28,4.28,0,0,1,70,55.1c4.71-4.33,9.3-8.81,13.9-13.25,1.06-1,2.43-2,1.77-3.81-.58-1.59-2.16-1.59-3.48-1.78-6.21-.89-12.42-1.9-18.66-2.47a5.06,5.06,0,0,1-4.7-3.44c-2.55-5.57-5.29-11.06-8-16.58-.64-1.32-1.07-3-2.95-3s-2.35,1.58-3,2.92c-2.73,5.63-5.52,11.23-8.13,16.91a4.82,4.82,0,0,1-4.47,3.19c-6.12.6-12.2,1.51-18.29,2.41-1.52.23-3.49,0-4.06,2.08s1.15,2.9,2.27,4c4.5,4.38,9,8.76,13.61,13a4,4,0,0,1,1.4,4.23c-1.23,6.27-2.24,12.59-3.36,18.88-.26,1.46-1.08,3,.47,4.16s3.12,0,4.53-.72c5.3-2.85,10.66-5.58,15.82-8.66,2.38-1.42,4.14-1.24,6.44.11,5.4,3.16,11,6.07,16.5,9C70.63,83.77,72.43,82.8,72.29,80.69Z" transform="translate(-9.9 -10.73)" style="fill:#fff"/></svg>&nbsp;' . $xml->pagina_buscar->oportunidad . '</div>';
						}
				
					switch ($meta['id_estado_inmueble'][0]) {
  				case 'vendido':
  					echo '<svg id="marca_vendido" width="400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 83.77 31.61"><defs><style>.\30 f558bbb-aada-44b9-9bbe-6c675b37c7ce1{font-size:23px;fill:red;font-family:Montserrat;font-weight:700;}.c03bbfbc-7250-4e1a-b056-a2436aca69c71{fill:#f40000;}</style></defs><text class="0f558bbb-aada-44b9-9bbe-6c675b37c7ce1" transform="translate(6.86 24.32) scale(0.6 1)">VENDIDO</text><path class="c03bbfbc-7250-4e1a-b056-a2436aca69c71" d="M138.4,32.37V53H64.63V32.37H138.4m5-5H59.63V58H143.4V27.37h0Z" transform="translate(-59.63 -27.37)"/></svg>';
  					break;
  				case 'alquilado':
  					echo '<svg id="marca_vendido" width="400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 83.77 31.61"><defs><style>.\30 f558bbb-aada-44b9-9bbe-6c675b37c7ce{font-size:24px;fill:red;font-family:Montserrat;font-weight:700;}.c03bbfbc-7250-4e1a-b056-a2436aca69c7{fill:#f40000;}</style></defs><text class="0f558bbb-aada-44b9-9bbe-6c675b37c7ce" transform="translate(6.86 24.32) scale(0.46 1)">ALQUILADO</text><path class="c03bbfbc-7250-4e1a-b056-a2436aca69c7" d="M138.4,32.37V53H64.63V32.37H138.4m5-5H59.63V58H143.4V27.37h0Z" transform="translate(-59.63 -27.37)"/></svg>';
  					break;
  				case 'reservado':
  					echo '<svg id="marca_vendido" width="400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 83.77 31.61"><defs><style>.\30 f558bbb-aada-44b9-9bbe-6c675b37c7ce2{font-size:24.2px;fill:#ff9800;font-family:Montserrat;font-weight:700;}.c03bbfbc-7250-4e1a-b056-a2436aca69c72{fill:#ff9800;}</style></defs><text class="0f558bbb-aada-44b9-9bbe-6c675b37c7ce2" transform="translate(6.86 24.32) scale(0.44 1)">RESERVADO</text><path class="c03bbfbc-7250-4e1a-b056-a2436aca69c72" d="M138.4,32.37V53H64.63V32.37H138.4m5-5H59.63V58H143.4V27.37h0Z" transform="translate(-59.63 -27.37)"/></svg>';
  					break;
				}	

				switch ($meta['id_transaccion'][0]) {
					  				case 'venta':
					  					echo '<span class="cartel_transaccion">' . $xml->pagina_buscar->venta . ' </span>';
					  					break;
					  				case 'alquiler':
					  					echo '<span class="cartel_transaccion">' . $xml->pagina_buscar->alquiler . '</span>';
					  					break;				  				
					  			}
				?>
				<div class="imagen">
					<?php 
					$elemento=1;
					$imagenes = $meta['id_imagenes'][0]; 
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

							echo wp_get_attachment_image( $key, 'medium_large', "", array( "alt"=>$image_alt,"class" => "mySlides elem" . $elemento));			
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

							echo wp_get_attachment_image( $key, 'medium', "", array( "alt"=>$image_alt,"class" => "mySlides elem" . $elemento));
													
							 }

							  if(strcmp($extension,'mp4')==0){
							     echo '<video class="mySlides" width="100%"  controls>
											  <source src="' . $url . '" type="video/mp4">
											  Your browser does not support the video tag.
											  </video>';
							  }									
							}
						} 
						?>
					  
					</div>
				<div class="texto_izquierda">
					<h3><?php 
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
					?></h3>
					<h5><?php 
					$nombre_localidad= strip_tags (get_the_term_list( get_the_ID(), 'localidad', "",", " ));
					$slug=str_replace(' ', '-', $nombre_localidad);
					$tag = get_term_by('slug', $slug, 'localidad');
					$tag_padre = get_term_by('id', $tag->parent, 'localidad');
					if(!empty($tag_padre->name)){
						echo $tag_padre->name . ' - ';
					}
					echo strip_tags (get_the_term_list( get_the_ID(), 'localidad', "",", " ));
					?>
					</h5>
					<h6><?php 
						
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
						
					echo $tipo_traducido; ?></h6>
				</div>
				<div class="texto_derecha">
					<h4>
						<?php 
						if(!empty($meta['id_anterior'][0])){
							echo '<span>' . number_format($meta['id_anterior'][0], 0, ',', '.') . $simbolo_moneda . '</br></span>';
						} 
							
						if(!empty($meta['id_precio'][0])){
							 echo number_format($meta['id_precio'][0], 0, ',', '.') . $simbolo_moneda;
						}
						?>
							
					</h4>
					<p title="Precio del metro cuadrado"><?php
						if(!empty($meta['id_precio'][0]) && !empty($meta['id_construido'][0])){
							$precio_metro=$meta['id_precio'][0]/$meta['id_construido'][0];
							echo number_format($precio_metro, 0, ',', '.') . $simbolo_moneda . '/m&#178;';
						} ?>
					</p>					
				</div>	
				<div class="caracteristicas_entrada">
					<?php
						switch ($meta['id_construido'][0]) {
							case '':
								# code...
								break;
														
							default:
									echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.68 31.56"><path d="M34.3,64.15c.06.51-.27,1.34.13,1.69s1.16.09,1.76.1h.35c.52,0,1.27.24,1.51-.11s.08-1.21.1-1.83c0-.26-.15-.26-.35-.27-.42,0-1,.19-1.23-.1s-.07-.78-.06-1.19c0-.23-.08-.32-.31-.32-.53,0-1.06,0-1.59,0-.26,0-.34.1-.33.35C34.31,63,34.3,63.51,34.3,64.15Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M63.94,65.93c.51,0,1,0,1.53,0,.28,0,.37-.09.37-.37,0-1,0-2,0-3.05,0-.3-.07-.44-.39-.41-.16,0-.31,0-.47,0-.43,0-1-.17-1.26.08s-.09.77-.09,1.17-.07.37-.36.37-.93-.18-1.19.07-.09.82-.09,1.24c0,.88,0,.88.9.88Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M36.09,34.52c-.51.06-1.34-.27-1.69.13s-.09,1.15-.1,1.76,0,.94,0,1.41.15.59.56.53a2,2,0,0,1,.24,0c.45,0,1,.13,1.31-.09s.08-.8.11-1.22c0-.21.05-.34.29-.31h.06c.42,0,1.11.19,1.21-.11a6.09,6.09,0,0,0,.08-1.91c0-.23-.21-.18-.36-.18Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M63.94,34.52a14,14,0,0,1-1.41,0c-.5-.05-.6.15-.57.59a9,9,0,0,1,0,1.23c0,.32.11.4.41.4s.94-.19,1.17.09.07.75.06,1.13.07.39.36.38c.51,0,1,0,1.53,0,.25,0,.34-.09.33-.34,0-1,0-2.07,0-3.11,0-.34-.14-.38-.42-.37C64.92,34.53,64.43,34.52,63.94,34.52Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M45.28,63.73c-.67,0-1.33,0-2,0-.28,0-.38.07-.37.36,0,.51,0,1,0,1.52,0,.26.09.33.34.33q2,0,4.06,0c.28,0,.38-.07.37-.36,0-.51,0-1,0-1.52,0-.25-.08-.34-.34-.33C46.65,63.74,46,63.73,45.28,63.73Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M54.84,65.93c.67,0,1.33,0,2,0,.27,0,.39-.06.38-.35,0-.51,0-1,0-1.52,0-.25-.08-.34-.34-.33q-2,0-4.06,0c-.27,0-.39.06-.38.35,0,.49,0,1,0,1.47,0,.3.08.41.4.4C53.51,65.91,54.18,65.93,54.84,65.93Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M45.28,34.52c-.67,0-1.33,0-2,0-.28,0-.38.07-.37.36,0,.51,0,1,0,1.52,0,.26.09.33.34.33q2.06,0,4.12,0c.23,0,.31-.07.31-.3,0-.53,0-1.06,0-1.58,0-.26-.09-.33-.34-.33C46.65,34.53,46,34.52,45.28,34.52Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M54.85,36.72c.67,0,1.33,0,2,0,.28,0,.38-.07.37-.36,0-.51,0-1,0-1.52,0-.26-.09-.33-.34-.33q-2,0-4.06,0c-.28,0-.38.08-.37.36,0,.51,0,1,0,1.52,0,.26.09.33.34.33C53.48,36.71,54.16,36.72,54.85,36.72Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M34.3,55c0,.67,0,1.33,0,2,0,.28.08.38.36.36.51,0,1,0,1.53,0,.27,0,.33-.1.33-.35q0-2,0-4.06c0-.26-.09-.36-.34-.33h-.06c-.59,0-1.34-.18-1.71.1s-.07,1.06-.11,1.63C34.29,54.56,34.3,54.78,34.3,55Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M63.61,55c0,.65,0,1.3,0,1.94,0,.31.09.41.4.4.59,0,1.33.18,1.71-.1s.09-1.06.1-1.62c0-.88,0-1.77,0-2.65,0-.28-.07-.38-.36-.37-.51,0-1,0-1.53,0-.26,0-.33.1-.33.35C63.62,53.65,63.61,54.33,63.61,55Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M34.3,45.46c0,.65,0,1.29,0,1.94,0,.31.06.46.41.44s1,0,1.47,0c.26,0,.34-.08.34-.34q0-2,0-4.06c0-.25-.06-.37-.33-.34h-.12c-.57,0-1.31-.19-1.66.09s-.08,1.06-.11,1.62C34.29,45,34.3,45.24,34.3,45.46Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/><path d="M63.61,45.5c0,.65,0,1.3,0,1.94,0,.31.1.41.4.4.59,0,1.34.18,1.71-.11s.09-1.06.1-1.63c0-.86,0-1.73,0-2.59,0-.34-.09-.44-.43-.42a12.58,12.58,0,0,1-1.42,0c-.33,0-.39.11-.39.41C63.63,44.16,63.61,44.83,63.61,45.5Z" transform="translate(-34.22 -34.44)" style="fill:#474747"/>
						</svg><p>' . number_format($meta['id_construido'][0], 0, ',', '.') . 'm&#178</p>';
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
									echo '<svg  id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.92 30.8"><path d="M36.3,52.38c0-1,0-1.8,0-2.66a.88.88,0,0,0-.7-1,.87.87,0,0,0-1.1.91c0,.86,0,1.73,0,2.59q0,5.61,0,11.21c0,.15,0,.31,0,.46,0,.68.37,1.1.91,1.09s.88-.43.89-1.12,0-1.34,0-2c0-.36.06-.49.46-.49q13.2,0,26.39,0c.4,0,.48.13.47.49,0,.69,0,1.38,0,2.07S64,65,64.5,65s.92-.42.92-1.09q0-7.07,0-14.15c0-.68-.32-1-.88-1s-.91.35-.92,1.06,0,1.67,0,2.54c-.27-.05-.27-.22-.3-.36q-.73-2.92-1.46-5.84a2.9,2.9,0,0,1-.06-.68q0-5,0-10.06a1,1,0,0,0-.58-1.09.9.9,0,0,0-1.26.9c0,.75,0,1.5,0,2.24,0,.33-.1.41-.42.41H40.37c-.32,0-.44-.07-.42-.4,0-.71,0-1.42,0-2.13s-.34-1.08-.92-1.07-.9.38-.91,1.08c0,2.68,0,5.37,0,8.05a16.56,16.56,0,0,1-.62,5c-.34,1.18-.61,2.37-.91,3.56A.6.6,0,0,1,36.3,52.38ZM50,54.14c4.37,0,8.74,0,13.11,0,.41,0,.57.06.56.52,0,1.48,0,3,0,4.43,0,.35-.06.5-.46.5q-13.2,0-26.4,0c-.41,0-.47-.15-.46-.5,0-1.42,0-2.84,0-4.26,0-.54.09-.7.67-.7C41.29,54.15,45.63,54.14,50,54.14Zm0-1.82c-3.66,0-7.32,0-11,0-.52,0-.58-.12-.45-.6.4-1.46.75-2.93,1.1-4.4a.48.48,0,0,1,.57-.45q9.76,0,19.52,0a.48.48,0,0,1,.57.45c.35,1.47.7,2.94,1.1,4.4.13.49.06.61-.45.6C57.27,52.31,53.62,52.32,50,52.32Zm0-12.67c3.19,0,6.39,0,9.58,0,.38,0,.48.1.47.47,0,1.21,0,2.41,0,3.62,0,1.37,0,1.36-1.37,1.35-.34,0-.49-.07-.46-.44a4.07,4.07,0,0,0,0-.86,2.67,2.67,0,0,0-2.49-2.3c-1.33,0-2.65,0-4,0-.62,0-1.13.52-1.64.56s-1-.56-1.68-.56c-1.33,0-2.66,0-4,0a2.69,2.69,0,0,0-2.53,2.39c0,.39.18.94-.12,1.13s-.82,0-1.24.08-.49-.08-.48-.46c0-1.49,0-3,0-4.48,0-.41.11-.5.51-.5C43.61,39.65,46.76,39.65,49.92,39.65Zm-3.6,5.43H44c-.14,0-.3.06-.37-.16a1.17,1.17,0,0,1,1.12-1.63c1,0,2,0,3,0s1.38.31,1.37,1.41c0,.35-.14.41-.44.4C47.86,45.06,47.09,45.07,46.32,45.07Zm7.34,0H51.23c-.14,0-.3.06-.37-.16A1.17,1.17,0,0,1,52,43.27c1,0,2,0,3,0s1.38.31,1.37,1.41c0,.35-.14.41-.44.4C55.16,45.06,54.41,45.07,53.66,45.07Z" transform="translate(-34.49 -34.2)" style="fill:#474747"/></svg><p>' . $meta['id_habitaciones'][0] . ' ' . $xml->pagina_buscar->hab . '</p>';
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
								echo '<svg id="Capa_1" class="bathe" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.69 30.34"><path d="M58.44,64.18c0,1.2,0,1.19,1.19,1.14.29,0,.35-.12.34-.37,0-.78,0-1.57,0-2.35a.56.56,0,0,1,.3-.54,9.44,9.44,0,0,0,4.34-7.43.52.52,0,0,1,.38-.51A2.38,2.38,0,0,0,66.18,53,2.43,2.43,0,0,0,64,49.41H37.66c-.35,0-.52,0-.52-.46,0-3.49,0-7,0-10.47a1.82,1.82,0,1,1,3.63-.24c.07.52.37.82.79.8s.71-.38.71-.92a3.32,3.32,0,0,0-6.63.39q0,5.23,0,10.47a.59.59,0,0,1-.39.67,2.43,2.43,0,0,0,.05,4.48.49.49,0,0,1,.36.48A9.7,9.7,0,0,0,39,61.25c.43.39,1.13.58,1.3,1.14a6.49,6.49,0,0,1,0,1.82c0,1.16,0,1.14,1.17,1.12.32,0,.37-.12.37-.4,0-.62,0-1.24,0-1.93a12.22,12.22,0,0,0,5.2.72q3.22,0,6.45,0A11.66,11.66,0,0,0,58.44,63C58.44,63.45,58.44,63.82,58.44,64.18Zm4.16-9.9c.46,0,.53.11.48.55a8.26,8.26,0,0,1-8,7.35c-3.25.07-6.5.07-9.74,0a8.25,8.25,0,0,1-8.11-7.07c-.14-.83-.14-.83.7-.83H50.18C54.32,54.29,58.46,54.3,62.6,54.28ZM36.71,52.79a3.08,3.08,0,0,1-.63,0A.92.92,0,0,1,36,51a2.1,2.1,0,0,1,.62-.08H63.73c.84,0,1.27.35,1.24,1a.87.87,0,0,1-.81.87,5,5,0,0,1-.58,0H36.71Z" transform="translate(-33.81 -35)" style="fill:#474747"/></svg><p>' . $meta['id_banos'][0] . ' ' . $xml->pagina_buscar->bano . '</p>';
								break;
							
							default:
								echo '<svg id="Capa_1" class="bathe" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.69 30.34"><path d="M58.44,64.18c0,1.2,0,1.19,1.19,1.14.29,0,.35-.12.34-.37,0-.78,0-1.57,0-2.35a.56.56,0,0,1,.3-.54,9.44,9.44,0,0,0,4.34-7.43.52.52,0,0,1,.38-.51A2.38,2.38,0,0,0,66.18,53,2.43,2.43,0,0,0,64,49.41H37.66c-.35,0-.52,0-.52-.46,0-3.49,0-7,0-10.47a1.82,1.82,0,1,1,3.63-.24c.07.52.37.82.79.8s.71-.38.71-.92a3.32,3.32,0,0,0-6.63.39q0,5.23,0,10.47a.59.59,0,0,1-.39.67,2.43,2.43,0,0,0,.05,4.48.49.49,0,0,1,.36.48A9.7,9.7,0,0,0,39,61.25c.43.39,1.13.58,1.3,1.14a6.49,6.49,0,0,1,0,1.82c0,1.16,0,1.14,1.17,1.12.32,0,.37-.12.37-.4,0-.62,0-1.24,0-1.93a12.22,12.22,0,0,0,5.2.72q3.22,0,6.45,0A11.66,11.66,0,0,0,58.44,63C58.44,63.45,58.44,63.82,58.44,64.18Zm4.16-9.9c.46,0,.53.11.48.55a8.26,8.26,0,0,1-8,7.35c-3.25.07-6.5.07-9.74,0a8.25,8.25,0,0,1-8.11-7.07c-.14-.83-.14-.83.7-.83H50.18C54.32,54.29,58.46,54.3,62.6,54.28ZM36.71,52.79a3.08,3.08,0,0,1-.63,0A.92.92,0,0,1,36,51a2.1,2.1,0,0,1,.62-.08H63.73c.84,0,1.27.35,1.24,1a.87.87,0,0,1-.81.87,5,5,0,0,1-.58,0H36.71Z" transform="translate(-33.81 -35)" style="fill:#474747"/></svg><p>' . $meta['id_banos'][0]. ' ' . $xml->pagina_buscar->banos . '</p>';
								break;
						}
						?>
												
						<div class="separador_caracteristicas2"></div>
						<div class="certificado">
							<?php
									switch ($meta['id_certificado'][0]) {
				case 'a':
  					echo '<img  src="' . get_stylesheet_directory_uri()  . '/img/Certificado/a.jpg" title="Certificado Energético A"><p>' . $xml->pagina_buscar->nivel . ' A</p>';
  					break;
  				case 'b':
  					echo '<img  src="' . get_stylesheet_directory_uri()  . '/img/Certificado/b.jpg" title="Certificado Energético B"><p>' . $xml->pagina_buscar->nivel . ' B</p>';
  					break;
  				case 'c':
  					echo '<img  src="' . get_stylesheet_directory_uri()  . '/img/Certificado/c.jpg" title="Certificado Energético C"><p>' . $xml->pagina_buscar->nivel . ' C</p>';
  					break;
  				case 'd':
  					echo '<img  src="' . get_stylesheet_directory_uri()  . '/img/Certificado/d.jpg" title="Certificado Energético D"><p>' . $xml->pagina_buscar->nivel . ' D</p>';
  					break;
  				case 'f':
  					echo '<img  src="' . get_stylesheet_directory_uri()  . '/img/Certificado/f.jpg" title="Certificado Energético F"><p>' . $xml->pagina_buscar->nivel . ' F</p>';
  					break;
  				case 'e':
  					echo '<img  src="' . get_stylesheet_directory_uri()  . '/img/Certificado/e.jpg" title="Certificado Energético E"><p>' . $xml->pagina_buscar->nivel . ' E</p>';
  					break;
  				case 'g':
  					echo '<img  src="' . get_stylesheet_directory_uri()  . '/img/Certificado/g.jpg" title="Certificado Energético G"><p>' . $xml->pagina_buscar->nivel . ' G</p>';
  					break;
  			}
  		?>
							

							</div>
				</div>			
			</div>	
			</a>
		</article>

<?php endwhile; else : ?>
	<article>
		<div class="contenedor" style="opacity: 0;"></div>
	</article>
<?php endif; 
if (function_exists("pagination_bottom")) {
    		pagination_bottom($loop->max_num_pages);
} ?>