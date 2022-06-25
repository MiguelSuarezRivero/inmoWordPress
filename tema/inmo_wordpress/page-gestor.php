<?php 

global $xml;

header('access-control-allow-origin: *');

if(isset($_POST['precio_compra_min'])){
	if(strcasecmp($_POST['precio_compra_min'], 'todos')==0){
		$_POST['precio_compra_min']=0;
	}
}else{
	$_POST['precio_compra_min']=0;
}

if(isset($_POST['precio_compra_max'])){
	if(strcasecmp($_POST['precio_compra_max'], 'todos')==0){
		$_POST['precio_compra_max']=1000000000;
	}
}else{
	$_POST['precio_compra_max']=1000000000;
}

if(isset($_POST['precio_alquiler_min'])){
	if(strcasecmp($_POST['precio_alquiler_min'], 'todos')==0){
		$_POST['precio_alquiler_min']=0;
	}
}else{
	$_POST['precio_alquiler_min']=0;
}

if(isset($_POST['precio_alquiler_max'])){
	if(strcasecmp($_POST['precio_alquiler_max'], 'todos')==0){
		$_POST['precio_alquiler_max']=1000000000;
	}
}else{
	$_POST['precio_alquiler_max']=1000000000;
}

$ventas_visibles=$wpdb->get_var( "SELECT `ventas_visibles` FROM `configuracion`");

$numero_post=0;
$args_post = array(
	'post_type'  => 'inmueble',
	'orderby'    => 'date',
	'order'      => $_POST['ordenar_by'],
	'posts_per_page' =>-1,
			'tax_query' => array(	
								(!strcasecmp($_POST['texto_busqueda'], '')==0) ? array(
								        'taxonomy' => 'caracteristicas_' . $xml->codigo_lang,
								        'terms' => $_POST['texto_busqueda'],
								        'field' => 'slug',
								        'include_children' => true,
								        'operator' => 'IN'
								    ) : null,
								(strcasecmp($_POST['modalidad_seleccionada'], 'venta')==0) ?
								    (!strcasecmp($_POST['localidad_seleccionada_compra'], 'Todos')==0) ? array(
								        'taxonomy' => 'localidad',
								        'terms' => $_POST['localidad_seleccionada_compra'],
								        'field' => 'id',
								        'include_children' => true,
								        'operator' => 'IN'
								    ) : null :null,

								    (strcasecmp($_POST['modalidad_seleccionada'], 'alquiler')==0) ?
								    (!strcasecmp($_POST['localidad_seleccionada_alquilar'], 'Todos')==0) ? array(
								        'taxonomy' => 'localidad',
								        'terms' => $_POST['localidad_seleccionada_alquilar'],
								        'field' => 'id',
								        'include_children' => true,
								        'operator' => 'IN'
								    ) : null :null
								),
			'meta_query' => array(	
									(strcasecmp($_POST['modalidad_seleccionada'], 'venta')==0) ?
									array(
										'key' => 'id_precio',
										'value'   => array($_POST['precio_compra_min'],$_POST['precio_compra_max']),
										'compare' => 'BETWEEN',
										'type' => 'NUMERIC',
										'operator' => 'IN'
									) : null,

									(strcasecmp($_POST['modalidad_seleccionada'], 'alquiler')==0) ?
									array(
										'key' => 'id_precio',
										'value'   => array($_POST['precio_alquiler_min'],$_POST['precio_alquiler_max']),
										'compare' => 'BETWEEN',
										'type' => 'NUMERIC',
										'operator' => 'IN'
									) : null,
									
									(!strcasecmp($_POST['habitaciones_seleccionada'], 'Todos')==0) ?array(
										'key' => 'id_habitaciones',
										'value'   => (isset($_POST['habitaciones_seleccionada'])) ? array($_POST['habitaciones_seleccionada'],$_POST['habitaciones_seleccionada']) : null
										,
										'type' => 'NUMERIC',
										'operator' => 'IN'
									) : null ,

									(!strcasecmp($_POST['tipo_seleccionada'], 'Todos')==0) ?array(
										'key' => 'id_tipo',
										'value'   => $_POST['tipo_seleccionada'],
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
										'value'   => $_POST['modalidad_seleccionada'],
										'operator' => 'IN'
									) 
								),
		));
         
      $loop_post = new WP_Query($args_post);

if(isset($_POST['pagina_actual'])){

	 $paged = $_POST['pagina_actual'];
	 $args = array(
	'post_type'  => 'inmueble',
	'meta_key'	 => 'id_precio',
	'orderby'    => 'meta_value_num',
	'order'		 => $_POST['ordenar_by'],
	'posts_per_page' =>get_option( 'posts_per_page' ),
   	'paged'		 => $paged,
	'tax_query'  => array(
									(!strcasecmp($_POST['texto_busqueda'], '')==0) ? array(
								        'taxonomy' => 'caracteristicas_' . $xml->codigo_lang,
								        'terms' => $_POST['texto_busqueda'],
								        'field' => 'slug',
								        'include_children' => true,
								        'operator' => 'IN'
								    ) : null,
									(strcasecmp($_POST['modalidad_seleccionada'], 'venta')==0) ?
								    (!strcasecmp($_POST['localidad_seleccionada_compra'], 'Todos')==0) ? array(
								        'taxonomy' => 'localidad',
								        'terms' => $_POST['localidad_seleccionada_compra'],
								        'field' => 'id',
								        'include_children' => true,
								        'operator' => 'IN'
								    ) : null :null,

								    (strcasecmp($_POST['modalidad_seleccionada'], 'alquiler')==0) ?
								    (!strcasecmp($_POST['localidad_seleccionada_alquilar'], 'Todos')==0) ? array(
								        'taxonomy' => 'localidad',
								        'terms' => $_POST['localidad_seleccionada_alquilar'],
								        'field' => 'id',
								        'include_children' => true,
								        'operator' => 'IN'
								    ) : null :null
								),
			'meta_query' => array(	
									(strcasecmp($_POST['modalidad_seleccionada'], 'venta')==0) ?
									array(
										'key' => 'id_precio',
										'value'   =>  array($_POST['precio_compra_min'],$_POST['precio_compra_max']),
										'compare' => 'BETWEEN',
										'type' => 'NUMERIC',
										'operator' => 'IN'
									):null,

									(strcasecmp($_POST['modalidad_seleccionada'], 'alquiler')==0) ?
									array(
										'key' => 'id_precio',
										'value'   =>  array($_POST['precio_alquiler_min'],$_POST['precio_alquiler_min']),
										'compare' => 'BETWEEN',
										'type' => 'NUMERIC',
										'operator' => 'IN'
									):null,
									
									(!strcasecmp($_POST['habitaciones_seleccionada'], 'Todos')==0) ?array(
										'key' => 'id_habitaciones',
										'value'   => (isset($_POST['habitaciones_seleccionada'])) ? array($_POST['habitaciones_seleccionada'],$_POST['habitaciones_seleccionada']) : null
										,
										'type' => 'NUMERIC',
										'operator' => 'IN'
									) : null ,

									(!strcasecmp($_POST['tipo_seleccionada'], 'Todos')==0) ?array(
										'key' => 'id_tipo',
										'value'   => $_POST['tipo_seleccionada'],
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
										'value'   => $_POST['modalidad_seleccionada'],
										'operator' => 'IN'
									) 
								),
		));

}else{

 $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	 $args = array(
	'post_type'  => 'inmueble',
	'meta_key'	 => 'id_precio',
	'orderby'    => 'meta_value_num',
	'order'		 => $_POST['ordenar_by'],
	'posts_per_page' => get_option( 'posts_per_page' ),
   	'paged' 	 => $paged,
	'tax_query'  => array(	
									(!strcasecmp($_POST['texto_busqueda'], '')==0) ? array(
								        'taxonomy' => 'caracteristicas_' . $xml->codigo_lang,
								        'terms' => $_POST['texto_busqueda'],
								        'field' => 'slug',
								        'include_children' => true,
								        'operator' => 'IN'
								    ) : null,
									(strcasecmp($_POST['modalidad_seleccionada'], 'venta')==0) ?
								    (!strcasecmp($_POST['localidad_seleccionada_compra'], 'Todos')==0) ? array(
								        'taxonomy' => 'localidad',
								        'terms' => $_POST['localidad_seleccionada_compra'],
								        'field' => 'id',
								        'include_children' => true,
								        'operator' => 'IN'
								    ) : null :null,

								    (strcasecmp($_POST['modalidad_seleccionada'], 'alquiler')==0) ?
								    (!strcasecmp($_POST['localidad_seleccionada_alquilar'], 'Todos')==0) ? array(
								        'taxonomy' => 'localidad',
								        'terms' => $_POST['localidad_seleccionada_alquilar'],
								        'field' => 'id',
								        'include_children' => true,
								        'operator' => 'IN'
								    ) : null :null
								),
			'meta_query' => array(	
									(strcasecmp($_POST['modalidad_seleccionada'], 'venta')==0) ?
									array(
										'key' => 'id_precio',
										'value'   => array($_POST['precio_compra_min'],$_POST['precio_compra_max']),
										'compare' => 'BETWEEN',
										'type' => 'NUMERIC',
										'operator' => 'IN'
									) : null,

									(strcasecmp($_POST['modalidad_seleccionada'], 'alquiler')==0) ?
									array(
										'key' => 'id_precio',
										'value'   => array($_POST['precio_alquiler_min'],$_POST['precio_alquiler_max']),
										'compare' => 'BETWEEN',
										'type' => 'NUMERIC',
										'operator' => 'IN'
									) : null,
									
									(!strcasecmp($_POST['habitaciones_seleccionada'], 'Todos')==0) ?array(
										'key' => 'id_habitaciones',
										'value'   => (isset($_POST['habitaciones_seleccionada'])) ? array($_POST['habitaciones_seleccionada'],$_POST['habitaciones_seleccionada']) : null
										,
										'type' => 'NUMERIC',
										'operator' => 'IN'
									) : null ,

									(!strcasecmp($_POST['tipo_seleccionada'], 'Todos')==0) ?array(
										'key' => 'id_tipo',
										'value'   => $_POST['tipo_seleccionada'],
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
										'value'   => $_POST['modalidad_seleccionada'],
										'operator' => 'IN'
									) 
								),
		));
}
         
$loop = new WP_Query($args);

while ($loop_post->have_posts() ): $loop_post->the_post(); 

		$numero_post++;

	endwhile; 

	global $wpdb;
	$simbolo_moneda= $wpdb->get_var( "SELECT `simbolo` FROM `configuracion`" );	?>

	<input type="hidden" class="simbolo_moneda" value="<?php echo $simbolo_moneda; ?>"> 

	<?php

	if(isset($_POST['tipo_seleccionada'])){

		switch ($_POST['tipo_seleccionada']) {
			case 'casa':
				$_POST['tipo_seleccionada']=$xml->pagina_buscar->casa;
				break;
			case 'chalet':
				$_POST['tipo_seleccionada']=$xml->pagina_buscar->chalet;
				break;
			case 'piso':
				$_POST['tipo_seleccionada']=$xml->pagina_buscar->piso;
				break;
			case 'apartamento':
				$_POST['tipo_seleccionada']=$xml->pagina_buscar->apartamento;
				break;
			case 'local':
				$_POST['tipo_seleccionada']=$xml->pagina_buscar->local;
				break;
			case 'edificio':
				$_POST['tipo_seleccionada']=$xml->pagina_buscar->edificio;
				break;
			case 'garaje':
				$_POST['tipo_seleccionada']=$xml->pagina_buscar->garaje;
				break;
			case 'terreno':
				$_POST['tipo_seleccionada']=$xml->pagina_buscar->terreno;
				break;
			case 'otros':
				$_POST['tipo_seleccionada']=$xml->pagina_buscar->otros;
				break;	
			
		}
	}

	if(strcasecmp($_POST['precio_compra_min'],'0')==0){
		$_POST['precio_compra_min']="todos";
	}

	if(strcasecmp($_POST['precio_compra_max'],'1000000000')==0){
		$_POST['precio_compra_max']="todos";
	}

	if(strcasecmp($_POST['precio_alquiler_min'],'0')==0){
		$_POST['precio_alquiler_min']="todos";
	}

	if(strcasecmp($_POST['precio_alquiler_max'],'1000000000')==0){
		$_POST['precio_alquiler_max']="todos";
	}

		if(strcasecmp($_POST['modalidad_seleccionada'], 'venta')==0){

			if(!strcasecmp($_POST['texto_busqueda'], '')==0){
				$texto_p=ucfirst($_POST['texto_busqueda']);
			}else{
				$texto_p='';
			}

			if(!strcasecmp($_POST['localidad_seleccionada_compra'], 'Todos')==0){
				$termino = get_term_by('id',$_POST['localidad_seleccionada_compra'] , 'localidad');
				if(!strcasecmp($_POST['texto_busqueda'], '')==0){
					$localidad_p=' | ' . $termino->name;
				}else{
					$localidad_p=$termino->name;
				}
			}else{
				$localidad_p='';
			}

			if(!strcasecmp($_POST['tipo_seleccionada'], 'Todos')==0){
				if(!strcasecmp($_POST['texto_busqueda'], '')==0 || !strcasecmp($_POST['localidad_seleccionada_compra'], 'Todos')==0){
					$tipo_p=' | ' . ucfirst($_POST['tipo_seleccionada']);
				}else{
					$tipo_p=ucfirst($_POST['tipo_seleccionada']);
				}
			}else{
				$tipo_p='';
			}

			if(!strcasecmp($_POST['habitaciones_seleccionada'], 'Todos')==0){
				if(!strcasecmp($_POST['texto_busqueda'], '')==0 || !strcasecmp($_POST['localidad_seleccionada_compra'], 'Todos')==0 || !strcasecmp($_POST['tipo_seleccionada'], 'Todos')==0){
					$habitaciones_p=' | ' . $_POST['habitaciones_seleccionada'] . ' ' . $xml->pagina_buscar->hab;
				}else{
					$habitaciones_p=$_POST['habitaciones_seleccionada'] . ' ' . $xml->pagina_buscar->hab;
				}
			}else{
				$habitaciones_p='';
			}

			if(!strcasecmp($_POST['precio_compra_min'], 'Todos')==0){
				if(!strcasecmp($_POST['texto_busqueda'], '')==0 || !strcasecmp($_POST['localidad_seleccionada_compra'], 'Todos')==0 || !strcasecmp($_POST['tipo_seleccionada'], 'Todos')==0 || !strcasecmp($_POST['habitaciones_seleccionada'], 'Todos')==0){
					$precio=' | ' . $xml->pagina_buscar->desde . ' ' . number_format($_POST['precio_compra_min'], 0, ',', '.') . $simbolo_moneda;
				}else{
					$precio=' ' . $xml->pagina_buscar->desde . ' ' . number_format($_POST['precio_compra_min'], 0, ',', '.') . $simbolo_moneda;
				}
			}else{
				$precio='';
			}

			if(!strcasecmp($_POST['precio_compra_max'], 'Todos')==0){
				if(!strcasecmp($_POST['texto_busqueda'], '')==0 || !strcasecmp($_POST['localidad_seleccionada_compra'], 'Todos')==0 || !strcasecmp($_POST['tipo_seleccionada'], 'Todos')==0 || !strcasecmp($_POST['habitaciones_seleccionada'], 'Todos')==0 || !strcasecmp($_POST['precio_compra_min'], 'Todos')==0){
					$precio_max=' | ' . $xml->pagina_buscar->hasta . ' ' . number_format($_POST['precio_compra_max'], 0, ',', '.') . $simbolo_moneda;
				}else{
					$precio_max=' ' . $xml->pagina_buscar->hasta . ' ' . number_format($_POST['precio_compra_max'], 0, ',', '.') . $simbolo_moneda;
				}
			}else{
				$precio_max='';
			}
			
			if(!strcasecmp($_POST['texto_busqueda'], '')==0 || !strcasecmp($_POST['localidad_seleccionada_compra'], 'Todos')==0 || !strcasecmp($_POST['tipo_seleccionada'], 'Todos')==0 || !strcasecmp($_POST['habitaciones_seleccionada'], 'Todos')==0 || !strcasecmp($_POST['precio_compra_min'], 'Todos')==0 || !strcasecmp($_POST['precio_compra_max'], 'Todos')==0){
					$boton_borrar='<span class="borrar_filtros">' . $xml->pagina_buscar->quitar_filtros . '</span>';
				}else{
					$boton_borrar='';
				}
		

		}else{

			if(!strcasecmp($_POST['texto_busqueda'], '')==0){
				$texto_p=ucfirst($_POST['texto_busqueda']);
			}else{
				$texto_p='';
			}

			if(!strcasecmp($_POST['localidad_seleccionada_alquilar'], 'Todos')==0){
				$termino = get_term_by('id',$_POST['localidad_seleccionada_alquilar'] , 'localidad');
				if(!strcasecmp($_POST['texto_busqueda'], '')==0){
					$localidad_p=' | ' . $termino->name;
				}else{
					$localidad_p=$termino->name;
				}
			}else{
				$localidad_p='';
			}

			if(!strcasecmp($_POST['tipo_seleccionada'], 'Todos')==0){
				if(!strcasecmp($_POST['texto_busqueda'], '')==0 || !strcasecmp($_POST['localidad_seleccionada_alquilar'], 'Todos')==0){
					$tipo_p=' | ' . ucfirst($_POST['tipo_seleccionada']);
				}else{
					$tipo_p=ucfirst($_POST['tipo_seleccionada']);
				}
			}else{
				$tipo_p='';
			}

			if(!strcasecmp($_POST['habitaciones_seleccionada'], 'Todos')==0){
				if(!strcasecmp($_POST['texto_busqueda'], '')==0 || !strcasecmp($_POST['localidad_seleccionada_alquilar'], 'Todos')==0 || !strcasecmp($_POST['tipo_seleccionada'], 'Todos')==0){
					$habitaciones_p=' | ' . $_POST['habitaciones_seleccionada']. ' ' . $xml->pagina_buscar->hab;
				}else{
					$habitaciones_p=$_POST['habitaciones_seleccionada'] . ' ' . $xml->pagina_buscar->hab;
				}
			}else{
				$habitaciones_p='';
			}

			if(!strcasecmp($_POST['precio_alquiler_min'], 'Todos')==0){
				if(!strcasecmp($_POST['texto_busqueda'], '')==0 || !strcasecmp($_POST['localidad_seleccionada_alquilar'], 'Todos')==0 || !strcasecmp($_POST['tipo_seleccionada'], 'Todos')==0 || !strcasecmp($_POST['habitaciones_seleccionada'], 'Todos')==0){
					$precio=' | ' . $xml->pagina_buscar->desde . ' ' . number_format($_POST['precio_alquiler_min'], 0, ',', '.') . $simbolo_moneda;
				}else{
					$precio=' ' . $xml->pagina_buscar->desde . ' ' . number_format($_POST['precio_alquiler_min'], 0, ',', '.') . $simbolo_moneda;
				}
			}else{
				$precio='';
			}

			if(!strcasecmp($_POST['precio_alquiler_max'], 'Todos')==0){
				if(!strcasecmp($_POST['texto_busqueda'], '')==0 || !strcasecmp($_POST['localidad_seleccionada_alquilar'], 'Todos')==0 || !strcasecmp($_POST['tipo_seleccionada'], 'Todos')==0 || !strcasecmp($_POST['habitaciones_seleccionada'], 'Todos')==0 || !strcasecmp($_POST['precio_alquiler_min'], 'Todos')==0){
					$precio_max=' | ' . $xml->pagina_buscar->hasta . ' ' . number_format($_POST['precio_alquiler_max'], 0, ',', '.') . $simbolo_moneda;
				}else{
					$precio_max=' ' . $xml->pagina_buscar->hasta . ' ' . number_format($_POST['precio_alquiler_max'], 0, ',', '.') . $simbolo_moneda;
				}
			}else{
				$precio_max='';
			}
			
			if(!strcasecmp($_POST['texto_busqueda'], '')==0 || !strcasecmp($_POST['localidad_seleccionada_alquilar'], 'Todos')==0 || !strcasecmp($_POST['tipo_seleccionada'], 'Todos')==0 || !strcasecmp($_POST['habitaciones_seleccionada'], 'Todos')==0 || !strcasecmp($_POST['precio_alquiler_min'], 'Todos')==0 || !strcasecmp($_POST['precio_alquiler_max'], 'Todos')==0){
					$boton_borrar='<span class="borrar_filtros">' . $xml->pagina_buscar->quitar_filtros . '</span>';
				}else{
					$boton_borrar='';
				}

		}

		if(strcmp($numero_post,'1')==0){
			echo '<p class="leyenda">( ' . $numero_post . ' ' . $xml->pagina_buscar->propiedad_encontrada . ' )<br/><br/>' . $texto_p . ' ' . $localidad_p . ' ' . $tipo_p . ' ' . $habitaciones_p . ' ' . $precio . ' ' . $precio_max . ' ' . $boton_borrar . '</p>';
		}else{
			echo '<p class="leyenda">( ' . $numero_post . ' ' . $xml->pagina_buscar->propiedades_encontradas . ' )<br/><br/>' . $texto_p . ' ' . $localidad_p . ' ' . $tipo_p . ' ' . $habitaciones_p . ' ' . $precio . ' ' . $precio_max . ' ' . $boton_borrar . '</p>';
		} 

include(TEMPLATEPATH.'/article_buscar.php'); ?>	