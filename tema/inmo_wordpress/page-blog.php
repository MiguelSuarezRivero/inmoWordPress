<?php get_header(); 

	global $xml;

	$args = array(		
		'post_type'   => 'post',
		'post_status' => 'publish',
		'posts_per_page' =>6,
		'paged'                  => get_query_var( 'paged' ),
	);

$query = new WP_Query( $args ); ?>

<section class="blog">
<div class="barra_titulo">
			<h2><?php echo $xml->blog; ?> </h2>
</div>
<div class="cuadrilla">
	<div class="columnas">
<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

?>

<article>
	<div class="entrada_blog">
	<div class="imagen"><?php the_post_thumbnail( 'medium'); ?></div>
	<h3><?php the_title(); ?></h3>
	<p class="publicado"><?php echo $xml->pagina_blog->publicado . ' '; the_author(); echo ' ' . $xml->pagina_blog->el . ' ' . get_the_date(); ?></p>
	<div class="resumen"><?php the_excerpt(); ?></div>
	<a href="<?php the_permalink(); ?>" class="enlace"><?php echo $xml->pagina_blog->leer_mas; ?></a>
	</div>
</article>


<?php endwhile; else : ?>

<?php endif; ?>
 
	<div class="fin_blog"></div>
	
</div>
</div>
	 <?php
if (function_exists("pagination_blog")) {
    		pagination_blog($query->max_num_pages);
} ?>
	</section>
<?php get_footer(); ?>