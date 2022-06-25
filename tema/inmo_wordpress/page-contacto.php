<?php get_header();
global $xml;
global $wpdb;
	$datos_contacto= $wpdb->get_results( "SELECT `nombre`,`correo`,`telefono`,`direccion`, `mapa` FROM `configuracion`" );

 ?>
</header>
	<section class="politicas">
		<div>
			<h2><?php echo $xml->contacto; ?></h2>
		</div>
		<form class="correo_contacto" action="" method="POST">
			<input type="text" name="nombre" class="nombre" placeholder="<?php echo $xml->texto_contacto->nombre; ?>" required>
			<input type="number" name="telefono" class="telefono" placeholder="<?php echo $xml->texto_contacto->telefono; ?>" required>
			<input type="email" name="correo" class="correo" placeholder="<?php echo $xml->texto_contacto->correo; ?>" required>
			<input type="text" name="asunto" class="asunto" placeholder="<?php echo $xml->texto_contacto->asunto; ?>" required>
			<textarea name="mensaje"  placeholder="<?php echo $xml->texto_contacto->mensaje; ?>" class="mensaje" rows="5" required></textarea>
			<input type="submit" class="submit" value="<?php echo $xml->texto_contacto->enviar; ?>">
		</form>
		<div class="informacion_contacto">
			<?php 
				if(!empty($datos_contacto)){
			echo str_replace('\\', '', $datos_contacto[0]->mapa);
			echo '<p>' . $datos_contacto[0]->direccion . '</p>' .
			'<p>' . $datos_contacto[0]->correo . '</p>' .
			'<p>' . $datos_contacto[0]->telefono .'</p>';
		} 
		?>
		</div>

		<div class="fin_contacto"></div>

	</section>
<?php get_footer(); ?>