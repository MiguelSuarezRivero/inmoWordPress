<?php get_header(); 
global $xml;
?>

</header>
	<section class="single_blog">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

	$id_entrada=$post->ID;
	 ?>
	<div class="barra_titular">
				<p><svg  data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 343.65 309.67" style="width:19px;height: 12px;"><defs><style>.svg_volver{fill:white;}</style></defs><path class="svg_volver" d="M460.45,129.2c-.88,44.49-18.48,81.32-51.34,111.05a155.32,155.32,0,0,1-135.76,37.42C250.53,273,230.46,262.84,212,249c-4.25-3.2-4.93-6.63-1.37-10.55,4.91-5.42,10.11-10.61,15.42-15.65,3.9-3.69,7.83-1.42,11.31,1,8,5.45,16.23,10.54,25.27,13.94,40.82,15.35,79.36,11.09,115-14.52,22.81-16.4,38.27-38.14,45.06-65.58,12.16-49.11-6.87-101-47.55-129.77C350.5,10.36,322.88,3.33,293,6.31a126.36,126.36,0,0,0-59.75,22c-3.15,2.17-6,2.06-8.56-.44-4.79-4.63-9.61-9.26-14-14.24-3.73-4.22-2.85-7.3,1.7-10.79a145.5,145.5,0,0,1,53.79-26.37c18.63-4.64,37.57-6.86,56.91-4.07,16.9,2.44,33.43,5.95,48.73,13.69,42,21.22,70,54.12,82.79,99.6A154.49,154.49,0,0,1,460.45,129.2Z" transform="translate(-116.81 28.81)"/><path class="svg_volver" d="M243.17,160.39c-17.5,0-35,.19-52.49-.12-4.81-.08-6,1.49-5.75,6,.34,6.82.06,13.66.1,20.49,0,3.34-.45,6.45-4,7.82-3.77,1.45-6.79,0-9.33-2.84l-44.5-50c-2.55-2.86-5.18-5.66-7.63-8.59-3.65-4.36-3.65-9.85.07-14q26-29.36,52.14-58.64c2.3-2.58,4.86-4.77,8.66-3.39,4,1.45,4.66,4.79,4.63,8.52,0,7,.27,14-.11,21-.24,4.35,1.37,5.11,5.34,5.1,34.66-.15,69.33-.09,104-.08,9.2,0,11.08,1.89,11.08,11.13q0,24.5,0,49c0,6.58-2.07,8.71-8.65,8.73C278.83,160.43,261,160.39,243.17,160.39Z" transform="translate(-116.81 28.81)"/></svg><?php echo $xml->single_blog->volver_blog; ?></p>	
			</div>
		<article>				
			
			<div class="entrada">
				<h2><?php the_title(); ?></h2>
				<p class="publicado"><div class="foto_min">
					<?php 
					global $wpdb;
					$lista_agentes=$wpdb->get_results( "SELECT `nombre`, `foto` FROM `agentes`");

					foreach ($lista_agentes as $key) {
						
						if($key->nombre===get_the_author()){
							echo wp_get_attachment_image( $key->foto, 'thumbnail', "", array( "alt"=>get_the_title(),"class" => "foto_autor"));
						}
					}
					?>
					
					</div><?php echo $xml->pagina_blog->publicado . ' '; the_author(); echo ' ' . $xml->pagina_blog->el . ' ' . get_the_date(); ?>
				</p>
					<div class="imagen"><?php the_post_thumbnail( 'medium_large'); ?></div>
					<div class="contenido"><?php the_content(); ?></div>

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

		<aside>
			<p class="post_relacionados"><?php echo $xml->single_blog->post_relacionados; ?></p>
			<?php 
				$loop = new WP_Query(
		 		array(
		 			'post_type'=>'post',
		 			'posts_per_page' => 5,
		 			'post__not_in' => array($id_entrada),
		 			'orderby'=>'rand',
		 			)
	 		);

			if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); 
			?>
			<div class="relacionados">
				<a href="<?php the_permalink(); ?>">
					<div class="imagen_relacionados"><?php the_post_thumbnail( 'thumbnail'); ?></div>
					<p class="titulo"><?php echo get_the_title(); ?></p>
					
				</a>
			</div>
		<?php endwhile; else: ?>
		<?php endif; ?>
		</aside>
		<div class="fin_single_blog"></div>
	</section>

<?php get_footer(); ?>	