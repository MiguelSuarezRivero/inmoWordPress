<?php
get_header(); 

global $xml;

include(TEMPLATEPATH.'/menu-buscar.php'); 
?>

	<section class="busqueda">

<?php 
if(strcasecmp($precio_comprar_min,'todos')==0){
	$precio_comprar_min=0;
}
if(strcasecmp($precio_comprar_max,'todos')==0){
	$precio_comprar_max=1000000000;
}
if(strcasecmp($precio_alquiler_min,'todos')==0){
	$precio_alquiler_min=0;
}
if(strcasecmp($precio_alquiler_max,'todos')==0){
	$precio_alquiler_max=1000000000;
}

$ventas_visibles=$wpdb->get_var( "SELECT `ventas_visibles` FROM `configuracion`");

$numero_post=0;
$args_post = array(
	'post_type'  => 'inmueble',
	'orderby'    => 'meta_value_num',
	 'posts_per_page' =>-1,
			'order'      => 'ASC',
			'tax_query' => array( (strcasecmp($modalidad, 'venta')==0) ?
								    (!strcasecmp($localidades_comprar, 'Todos')==0) ? array(
								        'taxonomy' => 'localidad',
								        'terms' => $localidades_comprar,
								        'field' => 'id',
								        'include_children' => true,
								        'operator' => 'IN'
								    ) : null :null,

								    (strcasecmp($modalidad, 'alquiler')==0) ?
								    (!strcasecmp($localidades_alquilar, 'Todos')==0) ? array(
								        'taxonomy' => 'localidad',
								        'terms' => $localidades_alquilar,
								        'field' => 'id',
								        'include_children' => true,
								        'operator' => 'IN'
								    ) : null :null
								),
			'meta_query' => array(	
									(strcasecmp($modalidad, 'venta')==0) ?
									array(
										'key' => 'id_precio',
										'value'   => array($precio_comprar_min,$precio_comprar_max),
										'compare' => 'BETWEEN',
										'type' => 'NUMERIC',
										'operator' => 'IN'
									) : null,

									(strcasecmp($modalidad, 'alquiler')==0) ?
									array(
										'key' => 'id_precio',
										'value'   => array($precio_alquiler_min,$precio_alquiler_max),
										'compare' => 'BETWEEN',
										'type' => 'NUMERIC',
										'operator' => 'IN'
									) : null,

									(!strcasecmp($habitaciones, 'todos')==0) ?array(
										'key' => 'id_habitaciones',
										'value'   => (isset($habitaciones)) ? array($habitaciones,$habitaciones) : null
										,
										'type' => 'NUMERIC',
										'operator' => 'IN'
									) : null ,

									(!strcasecmp($tipo, 'todos')==0) ?array(
										'key' => 'id_tipo',
										'value'   => $tipo,
										'operator' => 'IN'
									) : null ,

									($ventas_visibles==='false') ?array(
										'key' => 'id_estado_inmueble',
										'value'   => 'vendido',
										'compare' => 'NOT LIKE'
									) : null ,

									($ventas_visibles==='false') ?array(
										'key' => 'id_estado_inmueble',
										'value'   => 'alquilado',
										'compare' => 'NOT LIKE'
									) : null ,

									(array(
										'key' => 'id_transaccion',
										'value'   => $modalidad,
										'operator' => 'IN'
									) 
								),
		));
         
      $loop_post = new WP_Query($args_post);

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
 $args = array(
	'post_type'  => 'inmueble',
	'meta_key'			=> 'id_precio',
	'orderby'    => 'meta_value_num',
	'order'				=> 'ASC',
	'posts_per_page' => get_option( 'posts_per_page' ),
   	'paged' => $paged,
	'tax_query' => array( (strcasecmp($modalidad, 'venta')==0) ?
								    (!strcasecmp($localidades_comprar, 'Todos')==0) ? array(
								        'taxonomy' => 'localidad',
								        'terms' => $localidades_comprar,
								        'field' => 'id',
								        'include_children' => true,
								        'operator' => 'IN'
								    ) : null :null,

								    (strcasecmp($modalidad, 'alquiler')==0) ?
								    (!strcasecmp($localidades_alquilar, 'Todos')==0) ? array(
								        'taxonomy' => 'localidad',
								        'terms' => $localidades_alquilar,
								        'field' => 'id',
								        'include_children' => true,
								        'operator' => 'IN'
								    ) : null :null
								),
			'meta_query' => array(	
									(strcasecmp($modalidad, 'venta')==0) ?
									array(
										'key' => 'id_precio',
										'value'   =>  array($precio_comprar_min,$precio_comprar_max),
										'compare' => 'BETWEEN',
										'type' => 'NUMERIC',
										'operator' => 'IN'
									):null,

									(strcasecmp($modalidad, 'alquiler')==0) ?
									array(
										'key' => 'id_precio',
										'value'   =>  array($precio_alquiler_min,$precio_alquiler_max),
										'compare' => 'BETWEEN',
										'type' => 'NUMERIC',
										'operator' => 'IN'
									):null,

									(!strcasecmp($habitaciones, 'todos')==0) ?array(
										'key' => 'id_habitaciones',
										'value'   => (isset($habitaciones)) ? array($habitaciones,$habitaciones) : null
										,
										'type' => 'NUMERIC',
										'operator' => 'IN'
									) : null ,

									(!strcasecmp($tipo, 'todos')==0) ?array(
										'key' => 'id_tipo',
										'value'   => $tipo,
										'operator' => 'IN'
									) : null ,

									($ventas_visibles==='false') ?array(
										'key' => 'id_estado_inmueble',
										'value'   => 'vendido',
										'compare' => 'NOT LIKE'
									) : null ,

									($ventas_visibles==='false') ?array(
										'key' => 'id_estado_inmueble',
										'value'   => 'alquilado',
										'compare' => 'NOT LIKE'
									) : null ,

									(array(
										'key' => 'id_transaccion',
										'value'   => $modalidad,
										'operator' => 'IN'
									) 
								),
		));
         
      $loop = new WP_Query($args); 

      while ($loop_post->have_posts() ): $loop_post->the_post(); 

		$numero_post++;

	endwhile; 

		global $wpdb;
	
	    $simbolo_moneda= $wpdb->get_var( "SELECT `simbolo` FROM `configuracion`" );
	    ?>
	    <input type="hidden" class="simbolo_moneda" value="<?php echo $simbolo_moneda; ?>"> 
	    <?php

	    switch ($tipo) {
			case 'casa':
				$tipo=$xml->pagina_buscar->casa;
				break;
			case 'chalet':
				$tipo=$xml->pagina_buscar->chalet;
				break;
			case 'piso':
				$tipo=$xml->pagina_buscar->piso;
				break;
			case 'apartamento':
				$tipo=$xml->pagina_buscar->apartamento;
				break;
			case 'local':
				$tipo=$xml->pagina_buscar->local;
				break;
			case 'edificio':
				$tipo=$xml->pagina_buscar->edificio;
				break;
			case 'garaje':
				$tipo=$xml->pagina_buscar->garaje;
				break;
			case 'terreno':
				$tipo=$xml->pagina_buscar->terreno;
				break;
			case 'otros':
				$tipo=$xml->pagina_buscar->otros;
				break;	
			
		}


		if(strcasecmp($modalidad, 'venta')==0){

			if(!strcasecmp($localidades_comprar, 'Todos')==0){
					$termino = get_term_by('id',$localidades_comprar , 'localidad');
					$localidad_p=$termino->name;
			}else{
					$localidad_p='';
			}
			

			if(!strcasecmp($tipo, 'Todos')==0){
				if(!strcasecmp($localidades_comprar, 'Todos')==0){
					$tipo_p=' | ' . ucfirst($tipo);
				}else{
					$tipo_p=ucfirst($tipo);
				}
			}else{
				$tipo_p='';
			}

			if(!strcasecmp($habitaciones, 'Todos')==0){
				if(!strcasecmp($localidades_comprar, 'Todos')==0 || !strcasecmp($tipo, 'Todos')==0){
					$habitaciones_p=' | ' . $habitaciones . ' ' . $xml->pagina_buscar->hab . ' ';
				}else{
					$habitaciones_p=$habitaciones . ' ' . $xml->pagina_buscar->hab;
				}
			}else{
				$habitaciones_p='';
			}

			if(!strcasecmp($precio_comprar_min, '0')==0){
				if(!strcasecmp($localidades_comprar, 'Todos')==0 || !strcasecmp($tipo, 'Todos')==0 || !strcasecmp($habitaciones, 'Todos')==0){
					$precio=' | ' . $xml->pagina_buscar->desde . ' ' . number_format($precio_comprar_min, 0, ',', '.') . $simbolo_moneda;
				}else{
					$precio=' '. $xml->pagina_buscar->desde . ' ' . number_format($precio_comprar_min, 0, ',', '.') . $simbolo_moneda;
				}
			}else{
				$precio='';
			}

			if(!strcasecmp($precio_comprar_max, '1000000000')==0){
				if(!strcasecmp($localidades_comprar, 'Todos')==0 || !strcasecmp($tipo, 'Todos')==0 || !strcasecmp($habitaciones, 'Todos')==0 || !strcasecmp($precio_comprar_min, '0')==0){
					$precio_max=' | ' . $xml->pagina_buscar->hasta . ' ' . number_format($precio_comprar_max, 0, ',', '.') . $simbolo_moneda;
				}else{
					$precio_max=' '. $xml->pagina_buscar->hasta . ' ' . number_format($precio_comprar_max, 0, ',', '.') . $simbolo_moneda;
				}
			}else{
				$precio_max='';
			}
			
			if(!strcasecmp($localidades_comprar, 'Todos')==0 || !strcasecmp($tipo, 'Todos')==0 || !strcasecmp($habitaciones, 'Todos')==0 || !strcasecmp($precio_comprar_min, '0')==0 || !strcasecmp($precio_comprar_max, '1000000000')==0){
					$boton_borrar='<span class="borrar_filtros">' . $xml->pagina_buscar->quitar_filtros . '</span>';
				}else{
					$boton_borrar='';
				}
		

		}else{

			if(!strcasecmp($localidades_alquilar, 'Todos')==0){
					$termino = get_term_by('id',$localidades_alquilar , 'localidad');
					$localidad_p=$termino->name;
			}else{
					$localidad_p='';
			}
			

			if(!strcasecmp($tipo, 'Todos')==0){
				if(!strcasecmp($localidades_alquilar, 'Todos')==0){
					$tipo_p=' | ' . ucfirst($tipo);
				}else{
					$tipo_p=ucfirst($tipo);
				}
			}else{
				$tipo_p='';
			}

			if(!strcasecmp($habitaciones, 'Todos')==0){
				if(!strcasecmp($localidades_alquilar, 'Todos')==0 || !strcasecmp($tipo, 'Todos')==0){
					$habitaciones_p=' | ' . $habitaciones . ' ' . $xml->pagina_buscar->hab . ' ';
				}else{
					$habitaciones_p=$habitaciones . ' ' . $xml->pagina_buscar->hab;
				}
			}else{
				$habitaciones_p='';
			}

			if(!strcasecmp($precio_alquiler_min, '0')==0){
				if(!strcasecmp($localidades_alquilar, 'Todos')==0 || !strcasecmp($tipo, 'Todos')==0 || !strcasecmp($habitaciones, 'Todos')==0){
					$precio=' | ' . $xml->pagina_buscar->desde . ' ' . number_format($precio_alquiler_min, 0, ',', '.') . $simbolo_moneda;
				}else{
					$precio=' ' . $xml->pagina_buscar->desde . ' ' . number_format($precio_alquiler_min, 0, ',', '.') . $simbolo_moneda;
				}
			}else{
				$precio='';
			}

			if(!strcasecmp($precio_alquiler_max, '1000000000')==0){
				if(!strcasecmp($localidades_comprar, 'Todos')==0 || !strcasecmp($tipo, 'Todos')==0 || !strcasecmp($habitaciones, 'Todos')==0 || !strcasecmp($precio_alquiler_min, '0')==0){
					$precio_max=' | ' . $xml->pagina_buscar->hasta . ' ' . number_format($precio_alquiler_max, 0, ',', '.') . $simbolo_moneda;
				}else{
					$precio_max=' ' . $xml->pagina_buscar->hasta . ' ' . number_format($precio_alquiler_max, 0, ',', '.') . $simbolo_moneda;
				}
			}else{
				$precio_max='';
			}
			
			if(!strcasecmp($localidades_alquilar, 'Todos')==0 || !strcasecmp($tipo, 'Todos')==0 || !strcasecmp($habitaciones, 'Todos')==0 || !strcasecmp($precio_alquiler_min, '0')==0 || !strcasecmp($precio_alquiler_max, '1000000000')==0){
					$boton_borrar='<span class="borrar_filtros">' . $xml->pagina_buscar->quitar_filtros . '</span>';
				}else{
					$boton_borrar='';
				}

		}


		if(strcmp($numero_post,'1')==0){
			echo '<p class="leyenda">( ' . $numero_post . ' ' . $xml->pagina_buscar->propiedad_encontrada . ' )<br/><br/>' . $localidad_p . ' ' . $tipo_p . ' ' . $habitaciones_p . ' ' . $precio . ' ' . $precio_max . ' ' . $boton_borrar . '</p>';
		}else{
			echo '<p class="leyenda">( ' . $numero_post . ' ' . $xml->pagina_buscar->propiedades_encontradas . ' )<br/><br/>' . $localidad_p . ' ' . $tipo_p . ' ' . $habitaciones_p . ' ' . $precio . ' ' . $precio_max . ' ' . $boton_borrar . '</p>';
		}  

      include(TEMPLATEPATH.'/article_buscar.php'); ?>
	
	</section>
<?php get_footer(); ?>