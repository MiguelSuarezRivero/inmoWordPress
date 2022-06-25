<?php get_header(); 
global $xml;
?>
<body>
<?php include(TEMPLATEPATH.'/menu-buscar.php'); ?>

	<section class="busqueda">

	<p class="leyenda">Página no encontrada</p>
		<article>
			
			<div class="contenedor">
					<svg id="marca_vendido" width="400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 83.77 31.61"><defs><style>.\30 f558bbb-aada-44b9-9bbe-6c675b37c7ce{font-size:23.89px;fill:red;font-family:Montserrat;font-weight:700;}.c03bbfbc-7250-4e1a-b056-a2436aca69c7{fill:#f40000;}</style></defs><text class="0f558bbb-aada-44b9-9bbe-6c675b37c7ce" transform="translate(6.86 24.32) scale(0.6 1)">404 PAGE</text><path class="c03bbfbc-7250-4e1a-b056-a2436aca69c7" d="M138.4,32.37V53H64.63V32.37H138.4m5-5H59.63V58H143.4V27.37h0Z" transform="translate(-59.63 -27.37)"/></svg>

  				<div class="imagen">

					<img  src="<?php bloginfo('template_directory'); ?>/img/404.jpeg">
				</div>
				<div class="texto_izquierda">
					<h3>404 Page</h3>
					<h5>No ha sido posible encontrar la página</h5>
					<h6></h6>
				</div>
				<div class="texto_derecha">
					<h4><span> </br></span></h4>
					<p>	</p>					
				</div>				
			</div>	
		
		</article>
	</section>
<?php get_footer(); ?>