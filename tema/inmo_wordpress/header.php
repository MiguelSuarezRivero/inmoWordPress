<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, user-scalable=yes , initial-scale=1">
	<link rel="icon" href="<?php bloginfo('template_directory'); ?>/img/icono.ico" >
	<style>body{opacity:0;}@media print{*{color:black;background:white;}header{display:none;}footer{display:none;}}</style>
	<?php
	
	global $xml;
    global $codigo_idioma;
	global $wpdb;

	$id_seguimiento=$wpdb->get_var("SELECT `analytics` FROM `configuracion`");

	$idiomas=$wpdb->get_var( "SELECT `idiomas` FROM `configuracion`");

	if(!strcmp($id_seguimiento, '')==0){
		echo '<!-- Global site tag (gtag.js) - Google Analytics -->
			<script async src="https://www.googletagmanager.com/gtag/js?id=' . $id_seguimiento . '"></script>
			<script>
  				window.dataLayer = window.dataLayer || [];
  				function gtag(){dataLayer.push(arguments);}
  				gtag("js", new Date());

  				gtag("config", "' . $id_seguimiento . '");
			</script>';
	}
	?>
<input type="hidden" id="idioma" value="<?php echo $codigo_idioma; ?>">
</head>
<?php wp_head(); 

	if(is_page( 'buscar' ) || is_404()){
		echo '<header id="busqueda">';
	}else if(is_single()){
		echo '<header id="single">';
	}else{
		echo '<header>';
	}


$agentes=$wpdb->get_var( "SELECT `estado_agentes` FROM `configuracion`" );	
$blog=$wpdb->get_var( "SELECT `blog` FROM `configuracion`" );


?>
		<div class="logotipo">
			<svg id="Capa_1" class="svg_logo" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 67.31 53.29"><path d="M61.48,24.39c.3-3.31.59-6.52.88-9.73.23-2.47.45-4.95.7-7.42,0-.4-.07-.55-.46-.53H62l-17.44,0a2.23,2.23,0,0,0-1.44.43Q38,11,32.75,14.83a1.43,1.43,0,0,0-.67,1.47c.18,2.07.27,4.14.47,6.21.07.78-.2.92-.91.91-2.57,0-5.14,0-7.71,0a1.76,1.76,0,0,0-1.31.45q-4.19,3.76-8.44,7.46A1.61,1.61,0,0,0,13.55,33q2.46,13,4.85,26.1c.12.65.31.9,1,.84s1.33,0,2.11,0c-.47-2.87-.92-5.66-1.38-8.46Q18.72,43,17.32,34.61A1.55,1.55,0,0,1,17.87,33c1.77-1.53,3.49-3.12,5.22-4.7a1.64,1.64,0,0,1,1.18-.49c2.61,0,5.22,0,7.82-.07.73,0,.89.27.87.9s.33,1.63,0,2-1.4.16-2.13.17c-2,0-4,0-6,0-.65,0-.85.17-.73.82a25,25,0,0,1,.37,2.86c0,.6.28.73.83.72,2.31,0,4.62,0,6.93,0,1.18,0,1.18,0,1.28,1.12.06.67.08,1.33.17,2s-.1.76-.71.76c-2.27,0-4.55,0-6.82,0-1.06,0-1.07,0-1,1.11.08.85.21,1.69.29,2.54,0,.54.26.73.84.72,2.27,0,4.55,0,6.82-.06.72,0,1,.17,1,.91a12.47,12.47,0,0,0,.14,2.22c.1.67-.13.83-.76.82-2.16,0-4.32,0-6.48,0-.81,0-1,.2-.85,1A15.81,15.81,0,0,1,26.45,51c0,.59.25.74.81.73,2.16,0,4.32,0,6.48,0,.59,0,.87.11.86.76a18.2,18.2,0,0,0,.17,2.44c.09.67-.19.8-.8.79-2,0-4,0-6,0-.65,0-1,.08-.81.84s.24,1.84.33,2.76c.05.52.23.75.83.74,3,0,6,0,9.05,0,.6,0,.74-.19.71-.77Q37.19,42.62,36.38,26c-.14-2.78-.24-5.56-.4-8.33a1.14,1.14,0,0,1,.52-1.11q3.4-2.52,6.77-5.09a1.77,1.77,0,0,1,1.13-.38c4.51,0,9,0,13.53-.08.64,0,.83.16.78.81q-.57,7.49-1.07,15A1.2,1.2,0,0,1,57,27.88a1.81,1.81,0,0,0-.18.13c-1.23.9-2.34,2.14-3.72,2.6s-3,.14-4.55.16c-1.3,0-2.61,0-3.91,0-.55,0-.8.09-.76.72a27.24,27.24,0,0,1,0,2.89c0,.58.16.77.75.76,2,0,4,0,5.92,0,.74,0,1,.19.9.93-.12.95.19,2.2-.31,2.78S49.36,39,48.4,39q-1.84.06-3.69,0c-.57,0-.8.15-.77.75a26.22,26.22,0,0,1,0,2.78c0,.68.17.9.87.88,1.82,0,3.65,0,5.48,0,.7,0,.91.18.83.87a16,16,0,0,0-.06,2.33c0,.55-.2.69-.72.68-1.83,0-3.65.06-5.48,0-.7,0-.91.22-.86.9a18.66,18.66,0,0,1,0,2.67c-.05.74.26.84.9.82,1.71,0,3.43,0,5.14,0,.66,0,.83.2.77.81A23.36,23.36,0,0,0,50.74,55c0,.59-.22.75-.8.74-1.68,0-3.35,0-5,0-.61,0-.86.12-.82.78.06.92,0,1.85,0,2.78,0,.53.08.78.72.77,2.61,0,5.22,0,7.82,0,.66,0,.86-.19.9-.87.43-8,.92-16.07,1.36-24.1a2.67,2.67,0,0,1,1.21-2.29c2-1.43,4-3,6-4.5a2.17,2.17,0,0,1,1.4-.55c4,0,8,0,12.07,0,.79,0,.92.23.79.93q-2,10.87-3.91,21.75c-.54,3-1.06,6-1.62,9-.1.56,0,.68.6.69,2.25.06,2.24.08,2.69-2.15Q77.41,41,80.76,24.27c.14-.72.12-1-.79-1-5.33,0-10.66,0-16,0a2,2,0,0,0-1.33.44A2.52,2.52,0,0,1,61.48,24.39Z" transform="translate(-13.51 -6.71)" style="fill:#fff"/><path d="M49.46,14.18c-1.64,0-3.28,0-4.92,0-.6,0-.76.19-.73.76.05,1,.05,2,0,3,0,.47.12.64.62.64q4.92,0,9.83,0c.46,0,.68-.11.69-.6,0-1.07.07-2.15.16-3.22,0-.56-.24-.59-.67-.58-1.68,0-3.35,0-5,0Z" transform="translate(-13.51 -6.71)" style="fill:#fff"/><path d="M49.33,22.5c-1.52,0-3,0-4.57,0-.76,0-.94.24-.89.93a25.23,25.23,0,0,1,0,2.66c0,.55.1.77.72.76q4.57-.06,9.13,0c.66,0,.82-.24.83-.82,0-1,0-1.92.13-2.88.06-.59-.2-.67-.7-.66-1.56,0-3.12,0-4.68,0Z" transform="translate(-13.51 -6.71)" style="fill:#fff"/><path d="M66.56,39c-1.41,0-2.82,0-4.23,0-.58,0-.75.18-.77.74a21.81,21.81,0,0,1-.3,3c-.12.67.15.71.68.7,2.71,0,5.42,0,8.13,0,.54,0,.81-.13.89-.7.12-1,.28-1.9.45-2.84.12-.61.08-.93-.72-.89-1.37.08-2.75,0-4.12,0Z" transform="translate(-13.51 -6.71)" style="fill:#fff"/><path d="M67.69,30.76c-1.49,0-3,0-4.46,0-.53,0-.8.08-.83.69,0,1-.2,2-.32,3-.06.43,0,.68.53.68q4.51,0,9,0c.44,0,.58-.21.63-.59.16-1,.3-2,.49-3.06.1-.54-.05-.71-.62-.7-1.48,0-3,0-4.46,0Z" transform="translate(-13.51 -6.71)" style="fill:#fff"/><path d="M65.38,47.33c-1.26,0-2.53,0-3.79,0-.58,0-.87.1-.89.76,0,1-.15,2-.26,3,0,.43,0,.67.53.67,2.64,0,5.27,0,7.91,0,.38,0,.64-.05.7-.49.15-1.1.32-2.19.51-3.28.09-.52-.12-.63-.59-.62-1.37,0-2.75,0-4.12,0Z" transform="translate(-13.51 -6.71)" style="fill:#fff"/><path d="M64.35,55.67c-1.23,0-2.46,0-3.69,0-.52,0-.74.15-.78.66-.08,1-.19,2.07-.31,3.1-.05.43.08.59.53.58q3.75,0,7.49,0c.41,0,.61-.14.67-.55.14-1,.29-2.06.49-3.07.13-.65-.16-.73-.71-.72C66.81,55.69,65.58,55.67,64.35,55.67Z" transform="translate(-13.51 -6.71)" style="fill:#fff"/></svg>
			<h1>INMO<br><span>WORDPRESS</span></h1>
		</div>
		<nav class="menu">
			<svg class="svg_salir_nav" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 71.19 68.75"><path d="M54.73,77.9a17.53,17.53,0,0,0-.47,1.76c-.69,4.25-2.64,5.95-6.9,5.95H23.79c-3.53,0-5.54-1.63-6.25-5.11a16,16,0,0,1-.33-3.14q0-24.93,0-49.87A14,14,0,0,1,18,22.92a5.06,5.06,0,0,1,5.25-3.65c8.17.07,16.34,0,24.51,0,3.87,0,5.9,1.8,6.49,5.71.1.68.32,1.34.49,2l.46,0a4.49,4.49,0,0,0,.29-1.09c0-4.73-3-7.77-7.78-7.77h-24c-4.25,0-6.56,1.88-7.37,6.09a21,21,0,0,0-.34,3.9c0,16.12,0,32.25,0,48.37a18.24,18.24,0,0,0,.94,6,6.17,6.17,0,0,0,6.29,4.36c8.3-.05,16.59,0,24.89,0A6.73,6.73,0,0,0,54.73,77.9Z" transform="translate(-16 -18.12)"/><path d="M84.84,52c-16.6,0-32.61,0-48.63,0-.11,0-.21.26-.75,1,5.78,0,11.11,0,16.44,0h32.8c-.66.71-1.08,1.19-1.52,1.64L68.77,69a6.62,6.62,0,0,0-.91.94,2.94,2.94,0,0,0-.24.94,5.89,5.89,0,0,0,1.09-.21c.21-.08.36-.33.54-.51L86.47,53a10.64,10.64,0,0,0,.72-1,15,15,0,0,1-1.92-1.4Q77.43,42.86,69.65,35a5.21,5.21,0,0,0-.94-.9,3.34,3.34,0,0,0-1.08-.21,3,3,0,0,0,.24.94,6.64,6.64,0,0,0,.91.94l14.42,14.4C83.62,50.64,84,51.09,84.84,52Z" transform="translate(-16 -18.12)"/></svg>
			<?php if(!is_home()){ ?>
				<a href="<?php bloginfo('url'); ?>"><?php echo $xml->inicio; ?></a>
			<?php } 
			if($blog==='true'){
				echo '<a href="blog">' . $xml->blog . '</a>';
			}			
			if($agentes==='true'){
				echo '<a href="agentes">' . $xml->agentes . '</a>';
			}
			?>			
			<a href="nosotros"><?php echo $xml->nosotros; ?></a>
			<a href="contacto"><?php echo $xml->contacto; ?></a>
			<?php 

			if($idiomas==='true'){ 	?>

			<div class="banderas">
				<div class="bandera">
					<input type="hidden" class="idioma" value="ES">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150.2 100">
					<style type="text/css">
						.spain0{fill:#FCC322;}
						.spain1{fill:#C6272E;}
					</style>
					<g>
						<path class="spain0" d="M150.1,24.7c0,12.1,0,24.2,0,36.3c0,4.7,0,9.3,0,14c-0.5,0-1,0-1.5,0c-49,0-98,0-147,0c-0.5,0-1,0-1.5,0
							c0-16.8,0-33.5,0-50.3c0.5,0,1,0,1.5,0c49,0,98,0,147,0C149.1,24.7,149.6,24.7,150.1,24.7z"/>
						<path class="spain1" d="M0.1,74.9c0.5,0,1,0,1.5,0c49,0,98,0,147,0c0.5,0,1,0,1.5,0c0,8.1,0,16.1,0.1,24.2c0,0.7-0.2,1-1,0.9
							c-0.3,0-0.5,0-0.8,0c-48.9,0-97.8,0-146.8,0c-1.9,0-1.7,0.2-1.7-1.7C0,90.5,0,82.7,0.1,74.9z"/>
						<path class="spain1" d="M150.1,24.7c-0.5,0-1,0-1.5,0c-49,0-98,0-147,0c-0.5,0-1,0-1.5,0C0,16.8,0,8.8,0,0.9c0-0.6,0.2-1,0.9-0.9
							c0.3,0,0.6,0,0.9,0c48.9,0,97.8,0,146.7,0c2,0,1.7-0.2,1.7,1.8C150.2,9.4,150.2,17.1,150.1,24.7z"/>
					</g>
					</svg>					
				</div>
				<div class="bandera">
					<input type="hidden" class="idioma" value="EN">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150.2 100">
					<style type="text/css">
						.st0{fill:#FDFCFD;}
						.st1{fill:#CE152C;}
						.st2{fill:#00247D;}
						.st3{fill:#05287F;}
					</style>
					<g>
						<path class="st0" d="M0.3,0.1C0.7,0.1,1,0,1.4,0c5.2,0,10.5,0.1,15.7,0.1c0.2,0.2,0.4,0.4,0.6,0.5c14.6,9.8,29.3,19.5,43.9,29.3
							c0.3,0.2,0.5,0.5,1,0.3c0-10,0-20,0-30.1c1.7,0,3.3,0,5,0c0,12.7,0,25.4,0,38.2c0,1.6-0.3,1.9-1.4,1.9c-22,0-44.1,0-66.1,0
							c0-2.2,0-4.4,0-6.6c10.9,0,21.8,0,33,0c-0.4-0.4-0.4-0.5-0.5-0.6C21.7,25.7,10.9,18.5,0.1,11.3c0-1.2,0-2.4,0-3.7
							c0.4,0.2,0.8,0.5,1.2,0.7c12.1,8.1,24.2,16.1,36.3,24.2c0.6,0.4,1.2,0.9,1.9,0.9c3.3,0,6.7,0,10.1,0c-0.3-0.7-0.8-0.8-1.1-1.1
							c-10.3-6.9-20.6-13.8-30.9-20.7C11.8,7.9,6.1,4,0.3,0.1z"/>
						<path class="st0" d="M149.8,0.1c0.6,1,0.1,2.2,0.3,3.2c0,2.7-0.1,5.3-0.1,8c-10.9,7.3-21.8,14.5-32.7,21.8c0,0.1,0.1,0.3,0.1,0.4
							c10.9,0,21.8,0,32.6,0c0,2.2,0,4.4,0,6.6c-22,0-44.1,0-66.1,0c-1.1,0-1.4-0.3-1.4-1.9c0.1-12.7,0-25.4,0-38.2c1.7,0,3.3,0,5,0
							c0,10,0,20.1,0,30.4c0.6-0.3,1-0.6,1.4-0.8c9.4-6.3,18.8-12.5,28.2-18.8c5.3-3.5,10.6-7.1,15.9-10.7c1.9,0,3.7,0,5.6,0
							c-0.5,0.4-0.9,0.7-1.4,1.1C121.7,11.6,106.1,22,90.5,32.4c-0.4,0.3-0.9,0.3-1.1,1.1c3.1,0,6.2,0,9.2,0c1,0,1.9-0.3,2.7-0.9
							c10.5-7.1,21.1-14.1,31.6-21.1C138.6,7.7,144.2,3.9,149.8,0.1z"/>
						<path class="st1" d="M149.8,0.1c-5.6,3.8-11.2,7.6-16.9,11.4c-10.5,7.1-21.1,14.1-31.6,21.1c-0.9,0.6-1.7,0.9-2.7,0.9
							c-3,0-6.1,0-9.2,0c0.2-0.8,0.8-0.8,1.1-1.1c15.6-10.4,31.1-20.8,46.7-31.2c0.5-0.3,0.9-0.7,1.4-1.1c3.4,0,6.7-0.1,10.1-0.1
							C149.1,0,149.5,0.1,149.8,0.1z"/>
						<path class="st1" d="M0.1,7.7C0.1,6.2,0,4.8,0,3.3c0.3-1-0.3-2.2,0.3-3.2C6.1,4,11.8,7.9,17.6,11.7c10.3,6.9,20.6,13.8,30.9,20.7
							c0.4,0.3,0.9,0.3,1.1,1.1c-3.4,0-6.7,0-10.1,0c-0.7,0-1.3-0.5-1.9-0.9C25.5,24.5,13.4,16.5,1.3,8.4C0.9,8.1,0.5,7.9,0.1,7.7z"/>
						<path class="st1" d="M67.6,0.1c5,0,10,0,15,0c0,12.7,0,25.4,0,38.2c0,1.6,0.3,1.9,1.4,1.9c22,0,44.1,0,66.1,0c0,6.7,0,13.4,0,20
							c-22,0-44.1,0-66.1,0c-0.8,0-1.4-0.2-1.4,1.5c0.1,12.8,0,25.7,0.1,38.5c-5,0-10,0-15.1,0c0-12.7,0-25.4,0.1-38.2
							c0-1.6-0.3-1.9-1.4-1.9c-22,0-44.1,0-66.1,0c0-6.7,0-13.4,0-20c22,0,44.1,0,66.1,0c1.1,0,1.4-0.3,1.4-1.9
							C67.5,25.6,67.6,12.8,67.6,0.1z"/>
						<path class="st2" d="M17.1,0.1c4.2,0,8.3-0.1,12.5-0.1c11,0,22,0,32.9,0c0,10,0,20.1,0,30.1c-0.5,0.3-0.7-0.1-1-0.3
							C46.9,20.1,32.3,10.4,17.7,0.6C17.5,0.5,17.3,0.3,17.1,0.1z"/>
						<path class="st3" d="M0.1,33.5c0-7.4,0-14.8,0-22.2c10.8,7.2,21.6,14.4,32.5,21.6c0.1,0.1,0.1,0.2,0.5,0.6
							C21.8,33.5,11,33.5,0.1,33.5z"/>
						<path class="st2" d="M87.6,0.1c12,0,24,0,35.9,0c3.2,0,6.3,0,9.5,0.1c-5.3,3.6-10.6,7.2-15.9,10.7c-9.4,6.3-18.8,12.5-28.2,18.8
							c-0.4,0.3-0.8,0.5-1.4,0.8C87.6,20.2,87.6,10.2,87.6,0.1z"/>
						<path class="st3" d="M150.1,11.3c0,7.4,0,14.8,0,22.2c-10.9,0-21.8,0-32.6,0c0-0.1-0.1-0.3-0.1-0.4
							C128.3,25.8,139.2,18.6,150.1,11.3z"/>
						<path class="st0" d="M82.6,100.1c0-12.8,0-25.7-0.1-38.5c0-1.7,0.7-1.5,1.4-1.5c22,0,44.1,0,66.1,0c0,2.2,0,4.4,0,6.6
							c-10.9,0-21.8,0-33,0c0.4,0.4,0.4,0.5,0.5,0.6c10.8,7.2,21.6,14.4,32.5,21.6c0,1.2,0,2.4,0,3.7c-0.4-0.2-0.8-0.5-1.2-0.7
							c-12.1-8.1-24.2-16.1-36.3-24.2c-0.6-0.4-1.2-0.9-1.9-0.9c-3.3,0-6.7,0-10.1,0c0.3,0.7,0.8,0.8,1.1,1.1
							c10.3,6.9,20.6,13.8,30.9,20.7c5.8,3.9,11.5,7.7,17.2,11.6c-5.6,0-11.2,0-16.8,0c-0.2-0.2-0.4-0.4-0.6-0.5
							c-14.6-9.8-29.3-19.5-43.9-29.3c-0.3-0.2-0.5-0.5-1-0.3c0,10,0,20,0,30C85.9,100.1,84.3,100.1,82.6,100.1z"/>
						<path class="st0" d="M0.1,60.1c22,0,44.1,0,66.1,0c1.1,0,1.4,0.3,1.4,1.9c-0.1,12.7,0,25.4-0.1,38.2c-1.7,0-3.3,0-5,0
							c0-10,0-20.1,0-30.4c-0.6,0.3-1,0.6-1.4,0.8c-9,6-18.1,12-27.1,18.1c-5.7,3.8-11.3,7.6-17,11.4c-1.9,0-3.7,0-5.6,0
							c0.5-0.4,0.9-0.7,1.4-1.1c15.6-10.4,31.1-20.8,46.7-31.2c0.4-0.3,0.9-0.3,1.1-1.1c-3.1,0-6.2,0-9.2,0c-1,0-1.9,0.3-2.7,0.9
							c-10.5,7.1-21.1,14.1-31.6,21.1c-5.6,3.8-11.2,7.6-16.9,11.4C-0.1,100,0,99.6,0,99.2c0-3.4,0-6.9,0-10.3
							C11,81.7,21.9,74.4,32.8,67.2c0-0.1-0.1-0.3-0.1-0.4c-10.9,0-21.8,0-32.6,0C0.1,64.5,0.1,62.3,0.1,60.1z"/>
						<path class="st2" d="M17.1,100.1c5.7-3.8,11.3-7.7,17-11.4c9-6,18.1-12.1,27.1-18.1c0.4-0.3,0.8-0.5,1.4-0.8c0,10.3,0,20.3,0,30.4
							c-12.7,0-25.4,0-38.1,0C22,100.2,19.6,100.1,17.1,100.1z"/>
						<path class="st2" d="M87.6,100.1c0-10,0-20.1,0-30c0.5-0.3,0.7,0.1,1,0.3c14.6,9.8,29.3,19.5,43.9,29.3c0.2,0.1,0.4,0.3,0.6,0.5
							c-4.8,0-9.6,0.1-14.4,0.1C108.3,100.2,97.9,100.1,87.6,100.1z"/>
						<path class="st3" d="M0.1,66.7c10.9,0,21.8,0,32.6,0c0,0.1,0.1,0.3,0.1,0.4C21.9,74.4,11,81.7,0.1,88.9C0.1,81.5,0.1,74.1,0.1,66.7
							z"/>
						<path class="st3" d="M150.1,88.9c-10.8-7.2-21.6-14.4-32.5-21.6c-0.1-0.1-0.1-0.2-0.5-0.6c11.2,0,22.1,0,33,0
							C150.1,74.1,150.1,81.5,150.1,88.9z"/>
						<path class="st1" d="M0.3,100.1c5.6-3.8,11.2-7.6,16.9-11.4c10.5-7.1,21.1-14.1,31.6-21.1c0.9-0.6,1.7-0.9,2.7-0.9c3,0,6.1,0,9.2,0
							c-0.2,0.8-0.7,0.8-1.1,1.1C44.1,78.3,28.5,88.7,12.9,99.1c-0.5,0.3-0.9,0.7-1.4,1.1C7.8,100.1,4,100.1,0.3,100.1z"/>
						<path class="st1" d="M149.8,100.1c-5.7-3.9-11.5-7.8-17.2-11.6c-10.3-6.9-20.6-13.8-30.9-20.7c-0.4-0.3-0.9-0.3-1.1-1.1
							c3.4,0,6.7,0,10.1,0c0.7,0,1.3,0.5,1.9,0.9c12.1,8.1,24.2,16.1,36.3,24.2c0.4,0.3,0.8,0.5,1.2,0.7c0,2.2,0,4.4,0,6.6
							C150.1,99.6,150.2,100,149.8,100.1z"/>
					</g>
					</svg>
				</div>
				<div class="bandera">
					<input type="hidden" class="idioma" value="FR">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.1 14.1">
					<style type="text/css">
						.fr0{fill:#001E95;}
						.fr1{fill:#ED2436;}
						.fr2{fill:#FEFEFE;}
					</style>
					<g>
						<g>
							<path class="fr0" d="M6.8,15.1c-2.1,0-4.2,0-6.3,0c-0.3,0-0.4,0-0.4-0.4c0-4.7,0-9.5,0-14.2c0-0.4,0.1-0.4,0.4-0.4
								c2.1,0,4.2,0,6.3,0c0,0.2,0,0.4,0,0.6c0,4.3,0,8.6,0,12.9C6.8,14.1,6.8,14.6,6.8,15.1z"/>
							<path class="fr1" d="M13.4,0.1c2.1,0,4.2,0,6.3,0c0.3,0,0.4,0,0.4,0.4c0,4.7,0,9.5,0,14.2c0,0.4-0.1,0.4-0.4,0.4
								c-2.1,0-4.2,0-6.3,0c0-0.2,0-0.4,0-0.7c0-4.6,0-9.1,0-13.7C13.4,0.6,13.4,0.3,13.4,0.1z"/>
							<path class="fr2" d="M13.4,0.1c0,0.2,0,0.4,0,0.7c0,4.6,0,9.1,0,13.7c0,0.2,0,0.4,0,0.7c-2.2,0-4.4,0-6.6,0c0-0.5,0-1,0-1.5
								c0-4.3,0-8.6,0-12.9c0-0.2,0-0.4,0-0.6C9,0.1,11.2,0.1,13.4,0.1z"/>
						</g>
					</g>
					</svg>
				</div>
				<div class="bandera">
					<input type="hidden" class="idioma" value="DE">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 14">
					<style type="text/css">
						.de0{fill:#201E1E;}
						.de1{fill:#FE0000;}
						.de2{fill:#F5D006;}
					</style>
					<defs>
					</defs>
					<g>
						<g>
							<path class="de0" d="M0,5c0-1.6,0-3.2,0-4.8C0,0.1,0.1,0,0.2,0c6.6,0,13.2,0,19.7,0C20,0,20,0.1,20,0.2c0,1.6,0,3.2,0,4.8
								c-0.1,0-0.1,0-0.2,0c-6.5,0-13,0-19.6,0C0.2,5,0.1,5,0,5z"/>
							<path class="de1" d="M0,5c0.1,0,0.1,0,0.2,0c6.5,0,13,0,19.6,0C19.9,5,20,5,20,5c0,1.6,0,3.1,0,4.7c-0.1,0-0.1,0-0.2,0
								c-6.5,0-13,0-19.6,0c-0.1,0-0.1,0-0.2,0C0,8.1,0,6.5,0,5z"/>
							<path class="de2" d="M0,9.6c0.1,0,0.1,0,0.2,0c6.5,0,13,0,19.6,0c0.1,0,0.1,0,0.2,0c0,1.4,0,2.8,0,4.3c0,0.1,0,0.1-0.1,0.1
								c-6.6,0-13.2,0-19.7,0C0,14,0,14,0,13.9C0,12.5,0,11.1,0,9.6z"/>
						</g>
					</g>
					</svg>					
				</div>
				<div class="bandera">
					<input type="hidden" class="idioma" value="IT">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.1 14.1">
					<style type="text/css">
						.it0{fill:#FEFEFE;}
						.it1{fill:#009244;}
						.it2{fill:#CE2734;}
					</style>
					<defs>
					</defs>
					<g>
						<g>
							<path class="it0" d="M13.5,14.1c-2.2,0-4.5,0-6.7,0c0-0.2,0-0.4,0-0.6c0-4,0-7.9,0-11.9c0-0.5,0-1,0-1.5c2.2,0,4.5,0,6.7,0
								c0,0.2,0,0.4,0,0.6c0,4.1,0,8.1,0,12.2C13.5,13.3,13.5,13.7,13.5,14.1z"/>
							<path class="it1" d="M6.7,0.1c0,0.5,0,1,0,1.5c0,4,0,7.9,0,11.9c0,0.2,0,0.4,0,0.6c-2.1,0-4.2,0-6.3,0c-0.3,0-0.4,0-0.4-0.4
								c0-4.4,0-8.9,0-13.3c0-0.4,0.1-0.4,0.4-0.4C2.6,0.1,4.6,0.1,6.7,0.1z"/>
							<path class="it2" d="M13.5,14.1c0-0.4,0-0.8,0-1.3c0-4.1,0-8.1,0-12.2c0-0.2,0-0.4,0-0.6c2.1,0,4.2,0,6.3,0c0.3,0,0.3,0.1,0.3,0.3
								c0,4.5,0,8.9,0,13.4c0,0.3-0.1,0.3-0.3,0.3C17.7,14.1,15.6,14.1,13.5,14.1z"/>
						</g>
					</g>
					</svg>					
				</div>
				<div class="bandera">
					<input type="hidden" class="idioma" value="SE">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 14">
					<style type="text/css">
						.se0{fill:#0C5087;}
						.se1{fill:#FDC002;}
					</style>
					<defs>
					</defs>
					<g>
						<rect class="se0" width="20" height="14"/>
						<path class="se1" d="M8.7,14c-0.8,0-1.7,0-2.5,0c0-0.1,0-0.2,0-0.2c0-1.7,0-3.4,0-5.1c0-0.2,0-0.2-0.2-0.2c-1.9,0-3.8,0-5.7,0
							c-0.1,0-0.1,0-0.2,0c0-0.9,0-1.9,0-2.8c0.1,0,0.1,0,0.2,0c1.9,0,3.8,0,5.7,0c0.2,0,0.2-0.1,0.2-0.2c0-1.7,0-3.4,0-5.1
							c0-0.1,0-0.2,0-0.2C7,0,7.9,0,8.7,0c0,1.8,0,3.5,0,5.3c0,0.3,0,0.3,0.3,0.3c3.6,0,7.2,0,10.8,0c0.1,0,0.1,0,0.2,0
							c0,0.9,0,1.9,0,2.8c-0.1,0-0.1,0-0.2,0c-3.6,0-7.1,0-10.7,0c-0.1,0-0.2,0-0.3,0c-0.1,0-0.1,0-0.1,0.1c0,0.1,0,0.1,0,0.2
							C8.7,10.5,8.7,12.3,8.7,14z"/>
					</g>
					</svg>
				</div>
			</div>
			<?php } ?>
		</nav>