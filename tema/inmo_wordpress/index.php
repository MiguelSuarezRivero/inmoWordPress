<?php get_header(); 

$simbolo_moneda= $wpdb->get_var( "SELECT `simbolo` FROM `configuracion`" );	
$my_maps_mapa=$wpdb->get_var("SELECT `my_maps_mapa` FROM `configuracion`");
global $xml;
?>

</header>

	<input type="hidden" class="simbolo_moneda" value="<?php echo $simbolo_moneda; ?>">
	<section>
		<div class="contenedor_fondo">

			<picture>
							  <source class="media2" media="(max-width:480px)" srcset="<?php bloginfo('template_directory'); ?>/img/fondo1_480.jpg">
							  <source class="media1" media="(max-width:700px)" srcset="<?php bloginfo('template_directory'); ?>/img/fondo1_700.jpg">
							  <img id="imagen_fondo" src="<?php bloginfo('template_directory'); ?>/img/fondo1.jpg" alt="Inmo Inmobiliaria">
			</picture>
			<div class="navegador">

				<h2><?php echo $xml->encuentra_comprar; ?></h2>
				<p class="modalidad_seleccionada"><?php echo $xml->comprar; ?></p>
				<p><?php echo $xml->alquilar; ?></p>
				<p><?php echo $xml->vender; ?></p>
				<form action="buscar" method="POST">
					<input id="input_modalidad" type="hidden" name="modalidad_elegida" value="venta">
					<div class="modalidad_comprar mostrar">
						<select name="poblacion_comprar" id="poblacion_comprar">
							<option value="todos"  selected hidden><?php echo $xml->poblacion; ?></option>
							<option value="todos"><?php echo $xml->todas; ?></option>
							<?php include(TEMPLATEPATH.'/page-option_localidad_compra.php'); ?>
						</select>
						<select name="habitaciones_comprar" id="habitaciones_comprar">
							<option value="todos"  selected hidden><?php echo $xml->habitaciones; ?></option>
							<option value="todos"><?php echo $xml->indiferente; ?></option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
						<select name="precio_comprar_min" id="precio_comprar_min">
		  					<option value="todos"  selected hidden><?php echo $xml->precio; ?> Min.</option>
							<option value="todos"><?php echo $xml->indiferente; ?></option>
							<option value="100000">100.000 <?php echo $simbolo_moneda; ?></option>
							<option value="150000">150.000 <?php echo $simbolo_moneda; ?></option>
							<option value="200000">200.000 <?php echo $simbolo_moneda; ?></option>
							<option value="250000">250.000 <?php echo $simbolo_moneda; ?></option>
							<option value="300000">300.000 <?php echo $simbolo_moneda; ?></option>
							<option value="350000">350.000 <?php echo $simbolo_moneda; ?></option>
		  				</select>
						 <select name="precio_comprar_max" id="precio_comprar_max">
							<option value="todos"  selected hidden><?php echo $xml->precio; ?> Max.</option>
							<option value="todos"><?php echo $xml->indiferente; ?></option>
							<option value="150000">150.000 <?php echo $simbolo_moneda; ?></option>
							<option value="200000">200.000 <?php echo $simbolo_moneda; ?></option>
							<option value="250000">250.000 <?php echo $simbolo_moneda; ?></option>
							<option value="300000">300.000 <?php echo $simbolo_moneda; ?></option>
							<option value="350000">350.000 <?php echo $simbolo_moneda; ?></option>
							<option value="400000">400.000 <?php echo $simbolo_moneda; ?></option>
						</select>
					</div>
					<div class="modalidad_alquilar ocultar">
						<select name="poblacion_alquilar" id="poblacion_alquilar">
							<option value="todos"  selected hidden><?php echo $xml->poblacion; ?></option>
							<option value="todos"><?php echo $xml->todas; ?></option>
							<?php include(TEMPLATEPATH.'/page-option_localidad_alquilar.php'); ?>
						</select>
						<select name="habitaciones_alquilar" id="habitaciones_alquilar">
							<option value="todos"  selected hidden><?php echo $xml->habitaciones; ?></option>
							<option value="todos"><?php echo $xml->indiferente; ?></option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
						<select name="precio_alquiler_min" id="precio_alquiler_min">
							<option value="todos"  selected hidden><?php echo $xml->precio; ?> Min.</option>
							<option value="todos"><?php echo $xml->indiferente; ?></option>
							<option value="100">100 <?php echo $simbolo_moneda; ?></option>
							<option value="200">200 <?php echo $simbolo_moneda; ?></option>
							<option value="300">300 <?php echo $simbolo_moneda; ?></option>
							<option value="400">400 <?php echo $simbolo_moneda; ?></option>
							<option value="500">500 <?php echo $simbolo_moneda; ?></option>
							<option value="600">600 <?php echo $simbolo_moneda; ?></option>
						</select>
						<select name="precio_alquiler_max" id="precio_alquiler_max">
							<option value="todos"  selected hidden><?php echo $xml->precio; ?> Max.</option>
							<option value="todos"><?php echo $xml->indiferente; ?></option>
							<option value="200">200 <?php echo $simbolo_moneda; ?></option>
							<option value="300">300 <?php echo $simbolo_moneda; ?></option>
							<option value="400">400 <?php echo $simbolo_moneda; ?></option>
							<option value="500">500 <?php echo $simbolo_moneda; ?></option>
							<option value="600">600 <?php echo $simbolo_moneda; ?></option>
							<option value="700">700 <?php echo $simbolo_moneda; ?></option>
						</select>
					</div>
					<input type="submit" value="<?php echo $xml->buscar; ?>">
				</form>
				<div class="modalidad_vender ocultar">
					<h3><?php echo $xml->descripcion_breve; ?></h3>
					<p><?php echo $xml->descripcion; ?></p>
					<a href="contacto" rel="nofollow"><?php echo $xml->contactar; ?></a>
				</div>
			</div>
			
			
			
		</div>
		<div class="contenedor_accesos">
			<table >
				<tr>
					<td class="td"><p><?php echo $xml->comprar; ?></p></td>
					<td><p><?php echo $xml->alquilar; ?></p></td>
				</tr>
				<tr>
					<td class="td"><a href="buscar?modalidad=venta&tipo=casa" rel="nofollow"><?php echo $xml->venta_casa; ?></a></td>
					<td><a href="buscar?modalidad=alquiler&tipo=casa" rel="nofollow"><?php echo $xml->alquiler_casa; ?></a></td>
				</tr>
				<tr>
					<td class="td"><a href="buscar?modalidad=venta&tipo=piso" rel="nofollow"><?php echo $xml->venta_piso; ?></a></td>
					<td><a href="buscar?modalidad=alquiler&tipo=piso" rel="nofollow"><?php echo $xml->alquiler_piso; ?></a></td>
				</tr>
				<tr>
					<td class="td"><a href="buscar?modalidad=venta&tipo=apartamento" rel="nofollow"><?php echo $xml->venta_apartamento; ?></a></td>
					<td><a href="buscar?modalidad=alquiler&tipo=apartamento" rel="nofollow"><?php echo $xml->alquiler_apartamento; ?></a></td>
				</tr>
				<tr>
					<td class="td"><a href="buscar?modalidad=venta&tipo=local" rel="nofollow"><?php echo $xml->venta_local; ?></a></td>
					<td><a href="buscar?modalidad=alquiler&tipo=local" rel="nofollow"><?php echo $xml->alquiler_local; ?></a></td>
				</tr>
				<tr>
					<td class="td"><a href="buscar?modalidad=venta&tipo=terreno" rel="nofollow"><?php echo $xml->venta_terreno; ?></a></td>
				</tr>
			</table>			
		</div>
		<div class="contenedor_mapa" style="margin-top: 50px;">
			<div id="ocultar"></div>
			<iframe id="mapa" src="<?php echo $my_maps_mapa; ?>" width="100%" height="600"></iframe>

		</div>	
	</section>
<?php get_footer(); ?>