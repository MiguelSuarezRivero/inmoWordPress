<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Imprimir Flyer</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800" rel="stylesheet">
</head>
<body>

<?php

$args = array('p'=> $_GET['post'],
            'post_type'=>'inmueble');

$query = new WP_Query( $args );

if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); 

$meta=get_post_custom( $post->ID);
$imagenes = $meta['id_imagenes'][0];
$array_imagenes=explode(",", $imagenes);
$borrado = array_pop($array_imagenes);
	 	//MUESTRA EL VENDIDO
  			switch ($meta['id_estado_inmueble'][0]) {
          case 'vendido':
            echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 83.77 31.61" style="opacity:0.7;position:absolute;top:300px;transform:rotate(-25deg);z-index:9999;"><defs><style>.\30 f558bbb-aada-44b9-9bbe-6c675b37c7ce{font-size:24.89px;fill:red;font-family:Open Sans;font-weight:700;}.c03bbfbc-7250-4e1a-b056-a2436aca69c7{fill:#f40000;}</style></defs><text class="0f558bbb-aada-44b9-9bbe-6c675b37c7ce" transform="translate(6.86 24.32) scale(0.6 1)">VENDIDO</text><path class="c03bbfbc-7250-4e1a-b056-a2436aca69c7" d="M138.4,32.37V53H64.63V32.37H138.4m5-5H59.63V58H143.4V27.37h0Z" transform="translate(-59.63 -27.37)"/></svg>';
            break;
          case 'alquilado':
           echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 83.77 31.61" style="opacity:0.7;position:absolute;top:300px;transform:rotate(-25deg);z-index:9999;"><defs><style>.\30 f558bbb-aada-44b9-9bbe-6c675b37c7ce{    font-size: 19.89px;fill:red;font-family:Open Sans;font-weight:700;}.c03bbfbc-7250-4e1a-b056-a2436aca69c7{fill:#f40000;}</style></defs><text class="0f558bbb-aada-44b9-9bbe-6c675b37c7ce" transform="translate(6.86 24.32) scale(0.6 1)">ALQUILADO</text><path class="c03bbfbc-7250-4e1a-b056-a2436aca69c7" d="M138.4,32.37V53H64.63V32.37H138.4m5-5H59.63V58H143.4V27.37h0Z" transform="translate(-59.63 -27.37)"/></svg>';

            break;
          case 'reservado':
             echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 83.77 31.61" style="opacity:0.7;position:absolute;top:300px;transform:rotate(-25deg);z-index:9999;"><defs><style>.\30 f558bbb-aada-44b9-9bbe-6c675b37c7ce{    font-size: 19.89px;fill:orange;font-family:Open Sans;font-weight:700;}.c03bbfbc-7250-4e1a-b056-a2436aca69c7{fill:orange;}</style></defs><text class="0f558bbb-aada-44b9-9bbe-6c675b37c7ce" transform="translate(6.86 24.32) scale(0.6 1)">RESERVADO</text><path class="c03bbfbc-7250-4e1a-b056-a2436aca69c7" d="M138.4,32.37V53H64.63V32.37H138.4m5-5H59.63V58H143.4V27.37h0Z" transform="translate(-59.63 -27.37)"/></svg>';
            break;
        }

  		//MUESTRA EL CERTIFICADO

  			switch ($meta['id_certificado'][0]) {
  				case 'a':
  					echo '<img id="certificado" src="' . get_stylesheet_directory_uri()  . '/img/Certificado/a.jpg">';
  					break;
  				case 'b':
  					echo '<img id="certificado" src="' . get_stylesheet_directory_uri()  . '/img/Certificado/b.jpg">';
  					break;
  				case 'c':
  					echo '<img id="certificado" src="' . get_stylesheet_directory_uri()  . '/img/Certificado/c.jpg">';
  					break;
  				case 'd':
  					echo '<img id="certificado" src="' . get_stylesheet_directory_uri()  . '/img/Certificado/d.jpg">';
  					break;
  				case 'f':
  					echo '<img id="certificado" src="' . get_stylesheet_directory_uri()  . '/img/Certificado/f.jpg">';
  					break;
  				case 'e':
  					echo '<img id="certificado" src="' . get_stylesheet_directory_uri()  . '/img/Certificado/e.jpg">';
  					break;
  				case 'g':
  					echo '<img id="certificado" src="' . get_stylesheet_directory_uri()  . '/img/Certificado/g.jpg">';
  					break;
  			}
  		?>

	<div class="contenedor_izq">
		<div class="contenedor_logo">
			
			<svg id="Capa_1" class="logo" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 67.31 53.29"><path d="M61.48,24.39c.3-3.31.59-6.52.88-9.73.23-2.47.45-4.95.7-7.42,0-.4-.07-.55-.46-.53H62l-17.44,0a2.23,2.23,0,0,0-1.44.43Q38,11,32.75,14.83a1.43,1.43,0,0,0-.67,1.47c.18,2.07.27,4.14.47,6.21.07.78-.2.92-.91.91-2.57,0-5.14,0-7.71,0a1.76,1.76,0,0,0-1.31.45q-4.19,3.76-8.44,7.46A1.61,1.61,0,0,0,13.55,33q2.46,13,4.85,26.1c.12.65.31.9,1,.84s1.33,0,2.11,0c-.47-2.87-.92-5.66-1.38-8.46Q18.72,43,17.32,34.61A1.55,1.55,0,0,1,17.87,33c1.77-1.53,3.49-3.12,5.22-4.7a1.64,1.64,0,0,1,1.18-.49c2.61,0,5.22,0,7.82-.07.73,0,.89.27.87.9s.33,1.63,0,2-1.4.16-2.13.17c-2,0-4,0-6,0-.65,0-.85.17-.73.82a25,25,0,0,1,.37,2.86c0,.6.28.73.83.72,2.31,0,4.62,0,6.93,0,1.18,0,1.18,0,1.28,1.12.06.67.08,1.33.17,2s-.1.76-.71.76c-2.27,0-4.55,0-6.82,0-1.06,0-1.07,0-1,1.11.08.85.21,1.69.29,2.54,0,.54.26.73.84.72,2.27,0,4.55,0,6.82-.06.72,0,1,.17,1,.91a12.47,12.47,0,0,0,.14,2.22c.1.67-.13.83-.76.82-2.16,0-4.32,0-6.48,0-.81,0-1,.2-.85,1A15.81,15.81,0,0,1,26.45,51c0,.59.25.74.81.73,2.16,0,4.32,0,6.48,0,.59,0,.87.11.86.76a18.2,18.2,0,0,0,.17,2.44c.09.67-.19.8-.8.79-2,0-4,0-6,0-.65,0-1,.08-.81.84s.24,1.84.33,2.76c.05.52.23.75.83.74,3,0,6,0,9.05,0,.6,0,.74-.19.71-.77Q37.19,42.62,36.38,26c-.14-2.78-.24-5.56-.4-8.33a1.14,1.14,0,0,1,.52-1.11q3.4-2.52,6.77-5.09a1.77,1.77,0,0,1,1.13-.38c4.51,0,9,0,13.53-.08.64,0,.83.16.78.81q-.57,7.49-1.07,15A1.2,1.2,0,0,1,57,27.88a1.81,1.81,0,0,0-.18.13c-1.23.9-2.34,2.14-3.72,2.6s-3,.14-4.55.16c-1.3,0-2.61,0-3.91,0-.55,0-.8.09-.76.72a27.24,27.24,0,0,1,0,2.89c0,.58.16.77.75.76,2,0,4,0,5.92,0,.74,0,1,.19.9.93-.12.95.19,2.2-.31,2.78S49.36,39,48.4,39q-1.84.06-3.69,0c-.57,0-.8.15-.77.75a26.22,26.22,0,0,1,0,2.78c0,.68.17.9.87.88,1.82,0,3.65,0,5.48,0,.7,0,.91.18.83.87a16,16,0,0,0-.06,2.33c0,.55-.2.69-.72.68-1.83,0-3.65.06-5.48,0-.7,0-.91.22-.86.9a18.66,18.66,0,0,1,0,2.67c-.05.74.26.84.9.82,1.71,0,3.43,0,5.14,0,.66,0,.83.2.77.81A23.36,23.36,0,0,0,50.74,55c0,.59-.22.75-.8.74-1.68,0-3.35,0-5,0-.61,0-.86.12-.82.78.06.92,0,1.85,0,2.78,0,.53.08.78.72.77,2.61,0,5.22,0,7.82,0,.66,0,.86-.19.9-.87.43-8,.92-16.07,1.36-24.1a2.67,2.67,0,0,1,1.21-2.29c2-1.43,4-3,6-4.5a2.17,2.17,0,0,1,1.4-.55c4,0,8,0,12.07,0,.79,0,.92.23.79.93q-2,10.87-3.91,21.75c-.54,3-1.06,6-1.62,9-.1.56,0,.68.6.69,2.25.06,2.24.08,2.69-2.15Q77.41,41,80.76,24.27c.14-.72.12-1-.79-1-5.33,0-10.66,0-16,0a2,2,0,0,0-1.33.44A2.52,2.52,0,0,1,61.48,24.39Z" transform="translate(-13.51 -6.71)" style="fill:#fff"/><path d="M49.46,14.18c-1.64,0-3.28,0-4.92,0-.6,0-.76.19-.73.76.05,1,.05,2,0,3,0,.47.12.64.62.64q4.92,0,9.83,0c.46,0,.68-.11.69-.6,0-1.07.07-2.15.16-3.22,0-.56-.24-.59-.67-.58-1.68,0-3.35,0-5,0Z" transform="translate(-13.51 -6.71)" style="fill:#fff"/><path d="M49.33,22.5c-1.52,0-3,0-4.57,0-.76,0-.94.24-.89.93a25.23,25.23,0,0,1,0,2.66c0,.55.1.77.72.76q4.57-.06,9.13,0c.66,0,.82-.24.83-.82,0-1,0-1.92.13-2.88.06-.59-.2-.67-.7-.66-1.56,0-3.12,0-4.68,0Z" transform="translate(-13.51 -6.71)" style="fill:#fff"/><path d="M66.56,39c-1.41,0-2.82,0-4.23,0-.58,0-.75.18-.77.74a21.81,21.81,0,0,1-.3,3c-.12.67.15.71.68.7,2.71,0,5.42,0,8.13,0,.54,0,.81-.13.89-.7.12-1,.28-1.9.45-2.84.12-.61.08-.93-.72-.89-1.37.08-2.75,0-4.12,0Z" transform="translate(-13.51 -6.71)" style="fill:#fff"/><path d="M67.69,30.76c-1.49,0-3,0-4.46,0-.53,0-.8.08-.83.69,0,1-.2,2-.32,3-.06.43,0,.68.53.68q4.51,0,9,0c.44,0,.58-.21.63-.59.16-1,.3-2,.49-3.06.1-.54-.05-.71-.62-.7-1.48,0-3,0-4.46,0Z" transform="translate(-13.51 -6.71)" style="fill:#fff"/><path d="M65.38,47.33c-1.26,0-2.53,0-3.79,0-.58,0-.87.1-.89.76,0,1-.15,2-.26,3,0,.43,0,.67.53.67,2.64,0,5.27,0,7.91,0,.38,0,.64-.05.7-.49.15-1.1.32-2.19.51-3.28.09-.52-.12-.63-.59-.62-1.37,0-2.75,0-4.12,0Z" transform="translate(-13.51 -6.71)" style="fill:#fff"/><path d="M64.35,55.67c-1.23,0-2.46,0-3.69,0-.52,0-.74.15-.78.66-.08,1-.19,2.07-.31,3.1-.05.43.08.59.53.58q3.75,0,7.49,0c.41,0,.61-.14.67-.55.14-1,.29-2.06.49-3.07.13-.65-.16-.73-.71-.72C66.81,55.69,65.58,55.67,64.35,55.67Z" transform="translate(-13.51 -6.71)" style="fill:#fff"/></svg>
      <h1>Inmo</h1>
		</div>
		<div class="contenedor_img_principal">
			<?php echo wp_get_attachment_image( $array_imagenes[0], 'large', "", array( "alt"=>get_the_title(),"witdh" => "100px")); ?>
		</div>
		<div class="contenedor_titulo">
			<p class="grande"><?php the_title(); ?></p>
			<p class="small"><?php echo get_the_term_list( $_GET['post'], 'localidad'); ?></p>
		</div>
		<div class="contenedor_texto">
			<p class="titular">Descripción</p>
			<div class="texto"><?php the_content(); ?></div>
			<p>Referencia: <?php echo $meta['id_referencia'][0]; ?> </p>
		</div>
	</div>
	<div class="contenedor_der">
		<div class="contenedor_img_2">
			<?php echo wp_get_attachment_image( $array_imagenes[1], 'large', "", array( "alt"=>get_the_title(),"witdh" => "100px")); ?>
		</div>
		<div class="contenedor_caracteristicas">
			<p class="titular">Características</p>
			<ul>
				<?php 
				if(!empty($meta['id_habitaciones'][0])){
					echo '<li>' .  $meta['id_habitaciones'][0] . '  Habitaciones</li>';
				}

				if(!empty($meta['id_banos'][0])){
					echo '<li>' .  $meta['id_banos'][0] . '  Baños</li>';
				} 
				/*echo get_the_term_list($_GET['post'], 'caracteristicas', '<li> ', '</li><li>', '</li>' );*/
				 ?>
			</ul>
		</div>
		<div class="contenedor_img_3">
			
				<?php echo wp_get_attachment_image( $array_imagenes[2], 'large', "", array( "alt"=>get_the_title(),"witdh" => "100px")); ?>
			
		</div>
		<div class="contenedor_precio">
			<p class="grande">
			<?php

	  			if(strcmp($meta['id_transaccion'][0], 'venta')==0){

	  				echo 'En venta por';

	  			}else{

	  				echo 'Precio de alquiler';
	  			}
  			?>
			</p>
			<p class="small"> 
				<?php
				$simbolo_moneda= $wpdb->get_var( "SELECT `simbolo` FROM `configuracion`" );
				 if(!empty($meta['id_precio'][0])){
						 echo number_format($meta['id_precio'][0], 0, ',', '.') . $simbolo_moneda;
						} ?></p>
		</div>
    <?php 
    global $wpdb;
    $direccion=$wpdb->get_var("SELECT `direccion` FROM `configuracion`");
    require 'obtener_agentes.php'; 
    ?>
		<div class="contenedor_contacto">
			<p class="contacto">Contacto</p>
			<p class="telefono"><?php echo $nombre_agente_activo; ?></p>
			<p class="telefono"><?php echo $telefono_agente_activo; ?></p>
			<p class="direccion"><span>Dirección: </span><?php echo $direccion; ?></p>
			<p class="correo"><span>Email: </span><?php echo $correo_agente_activo; ?></p>
      <p class="correo"><span><?php echo $_SERVER['HTTP_HOST']; ?></span></p>
		</div>
	</div>

<?php endwhile; else: ?>
<?php endif; ?>


</body>
<link rel="stylesheet" property='stylesheet' href="<?php bloginfo('template_directory'); ?>/css/flyer.css">
</html>
<script>window.print();</script>

