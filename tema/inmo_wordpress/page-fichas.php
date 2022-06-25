<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Imprimir Informes</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800" rel="stylesheet">
</head>
<body class="ficha">

<?php

$args = array('p'=> $_GET['post'],
            'post_type'=>'inmueble');

$query = new WP_Query( $args );

if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); 

$meta=get_post_custom( $post->ID);
?>
 <h1>FICHA INMUEBLE</h1>
 <table>
 	<tr>
 		<td>Nombre:</td>
 		<td><?php the_title(); ?></td>
 	</tr>
 		<?php if($meta['id_referencia'][0] !==''){ ?>
 		<tr>
 		<td>Referencia:</td>
 		<td><?php echo $meta['id_referencia'][0]; ?></td>
 	</tr>
 	 <?php if($meta['id_tipo'][0] !==''){ ?>
 		<tr>
 		<td>Tipo:</td>
 		<td><?php echo $meta['id_tipo'][0]; ?></td>
 	</tr>
 <?php	} ?>
 <?php	} ?>
 	<tr>
 		<td>Localidad:</td>
 		<td><?php echo get_the_term_list( $_GET['post'], 'localidad'); ?></td>
 	</tr>
 	  <?php if($meta['id_direccion'][0] !==''){ ?>
 		<tr>
 		<td>Dirección:</td>
 		<td><?php echo $meta['id_direccion'][0]; ?></td>
 	</tr>
 <?php	} ?>
 
   <?php if($meta['id_estado'][0] !==''){ ?>
 		<tr>
 		<td>Estado:</td>
 		<td><?php echo $meta['id_estado'][0]; ?></td>
 	</tr>
 <?php	} ?>
 <?php if($meta['id_ano_construcion'][0] !==''){ ?>
 		<tr>
 		<td>Año de construcción:</td>
 		<td><?php echo number_format($meta['id_ano_construcion'][0], 0, ',', '.') ?></td>
 	</tr>
 <?php	} ?>
  <?php if($meta['id_superficie'][0] !==''){ ?>
 		<tr>
 		<td>Superfície útil:</td>
 		<td><?php echo number_format($meta['id_superficie'][0], 0, ',', '.') . 'm&#178'; ?></td>
 	</tr>
 <?php	} ?>
  <?php if($meta['id_construido'][0] !==''){ ?>
 		<tr>
 		<td>Construido:</td>
 		<td><?php echo number_format($meta['id_construido'][0], 0, ',', '.') . 'm&#178'; ?></td>
 	</tr>
 <?php	} ?>
<?php if($meta['id_habitaciones'][0] !==''){ ?>
 		<tr>
 		<td>Habitaciones:</td>
 		<td><?php echo $meta['id_habitaciones'][0]; ?></td>
 	</tr>
 <?php	} ?>
 <?php if($meta['id_banos'][0] !==''){ ?>
 		<tr>
 		<td>Baños:</td>
 		<td><?php echo $meta['id_banos'][0]; ?></td>
 	</tr>
 <?php	} ?>
   		<tr>
 		<td>Características:</td>
 		<td><?php echo get_the_term_list($_GET['post'], 'caracteristicas', ' ', ', ', '' ); ?></td>
 	</tr>
  <?php if($meta['id_certificado'][0] !==''){ ?>
 		<tr>
 		<td>Certificado energético:</td>
 		<td><?php echo ucfirst($meta['id_certificado'][0]); ?></td>
 	</tr>
 <?php	} ?>
   <?php if($meta['id_precio'][0] !==''){ ?>
 		<tr>
 		<td>Precio:</td>
 		<td><?php global $wpdb; $simbolo_moneda= $wpdb->get_var( "SELECT `simbolo` FROM `configuracion`" );
 		echo number_format($meta['id_precio'][0], 0, ',', '.') . $simbolo_moneda; ?></td>
 	</tr>
 <?php	} ?>

 <?php if($meta['id_notas'][0]!==''){ ?>
   <tr>
      <td>Notas de interés:</td>
      <td><?php echo $meta['id_notas'][0]; ?></td>
    </tr>
 <?php } ?>
 </table>

<?php endwhile; else: ?>
<?php endif; ?>


</body>
<link rel="stylesheet" property='stylesheet' href="<?php bloginfo('template_directory'); ?>/css/flyer.css">
</html>
<script>window.print();</script>