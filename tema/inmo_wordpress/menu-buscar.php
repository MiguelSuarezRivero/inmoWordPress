<?php
global $xml;
?>
		<nav id="filtro">
			
			<form action="" id="form_filtros" method="POST">
				<input type="search" name="cuadro_texto" id="cuadro_texto" placeholder="<?php echo $xml->pagina_buscar->caracteristicas; ?>...">
				<input type="hidden" class="ordenar" value="ASC" >
				<div class="linea_separador"></div>
				<?php 

						if(empty($_GET['modalidad'])){

							if(empty($_POST['modalidad_elegida'])){

								$modalidad='venta'; 
								$localidades_comprar='todos';
								$localidades_alquilar='todos';
								$habitaciones='todos';
								$precio_comprar_min='todos';
								$precio_comprar_max='todos';
								$precio_alquiler_min='todos';
								$precio_alquiler_max='todos';
								$tipo='todos';

							}else{

								if(strcasecmp($_POST['modalidad_elegida'], 'venta')==0){
								 $modalidad=$_POST['modalidad_elegida']; 
								 $localidades_comprar=$_POST['poblacion_comprar'];
								 $localidades_alquilar=$_POST['poblacion_alquilar'];
								 $habitaciones=$_POST['habitaciones_comprar'];
								 $precio_comprar_min=$_POST['precio_comprar_min'];
								 $precio_comprar_max=$_POST['precio_comprar_max'];
								 $precio_alquiler_min='todos';
								 $precio_alquiler_max='todos';
								 $tipo='todos';
								}else{
									 $modalidad=$_POST['modalidad_elegida']; 
									 $localidades_comprar=$_POST['poblacion_comprar'];
								 	 $localidades_alquilar=$_POST['poblacion_alquilar'];
									 $habitaciones=$_POST['habitaciones_alquilar'];
									 $precio_comprar_min='todos';
								 	 $precio_comprar_max='todos';
									 $precio_alquiler_min=$_POST['precio_alquiler_min'];
									 $precio_alquiler_max=$_POST['precio_alquiler_max'];
									 $tipo='todos';
								}

							}
							 
						}else{
							 $modalidad=$_GET['modalidad']; 
							 $localidades_comprar='todos';
							 $localidades_alquilar='todos';
							 $habitaciones='todos';
							 $precio_comprar_min='todos';
							 $precio_comprar_max='todos';
							 $precio_alquiler_min='todos';
						     $precio_alquiler_max='todos';
							 $tipo=$_GET['tipo'];

						}

						?>
				<div class="contiene_modalidad">
					<select name="modalidad" id="select_modalidad">
						<?php 
								switch ($modalidad) {
									case 'venta':
										  echo '<option value="venta" selected>' . $xml->comprar . '</option>
												<option value="alquiler">' . $xml->alquilar . '</option>';
										break;
									case 'alquiler':
										  echo '<option value="venta" >' . $xml->comprar . '</option>
												<option value="alquiler" selected>' . $xml->alquilar . '</option>';
										break;
									}
						?>
					</select>
				</div>
				<div class="contiene_localidad contiene_localidad_comprar">
					<select name="localidad" id="select_localidad_compra">
						<option value="todos" selected hidden><?php echo $xml->poblacion; ?></option>
						<option value="todos"><?php echo $xml->indiferente; ?></option>
						<?php include(TEMPLATEPATH.'/page-option_localidad_compra.php');
								if(empty($localidades_comprar)){
									echo '<option value="todos"  selected hidden>' . $xml->poblacion . '</option>';
								}								
						 ?>
						
					</select>
				</div>
				<div class="contiene_localidad contiene_localidad_alquilar">
					<select name="localidad" id="select_localidad_alquilar">
						<option value="todos" selected hidden><?php echo $xml->poblacion; ?></option>
						<option value="todos"><?php echo $xml->indiferente; ?></option>
						<?php include(TEMPLATEPATH.'/page-option_localidad_alquilar.php');
								if(empty($localidades_alquilar)){
									echo '<option value="todos"  selected hidden>' . $xml->poblacion . '</option>';
								}								
						 ?>
						
					</select>
				</div>
				<div class="linea_separador2"></div>
				<div class="contiene_tipo">	
					<select name="tipo" id="select_tipo">

						<?php 
								switch ($tipo) {
									case 'todos':
										  echo '<option value="todos" selected hidden>' . $xml->pagina_buscar->tipo . '</option>
												<option value="todos">' . $xml->indiferente . '</option>
												<option value="casa">' . $xml->pagina_buscar->casa . '</option>
												<option value="chalet">' . $xml->pagina_buscar->chalet . '</option>
												<option value="piso">' . $xml->pagina_buscar->piso . '</option>	
												<option value="apartamento">' . $xml->pagina_buscar->apartamento . '</option>
												<option value="local">' . $xml->pagina_buscar->local . '</option>
												<option value="edificio">' . $xml->pagina_buscar->edificio . '</option>
												<option value="garaje">' . $xml->pagina_buscar->garaje . '</option>
												<option value="terreno">' . $xml->pagina_buscar->terreno . '</option>
												<option value="otros">' . $xml->pagina_buscar->otros . '</option>';
										break;
									case 'casa':
										  echo '<option value="todos" hidden>' . $xml->pagina_buscar->tipo . '</option>
												<option value="todos">' . $xml->indiferente . '</option>
												<option value="casa" selected>' . $xml->pagina_buscar->casa . '</option>
												<option value="chalet">' . $xml->pagina_buscar->chalet . '</option>
												<option value="piso">' . $xml->pagina_buscar->piso . '</option>	
												<option value="apartamento">' . $xml->pagina_buscar->apartamento . '</option>
												<option value="local">' . $xml->pagina_buscar->local . '</option>
												<option value="edificio">' . $xml->pagina_buscar->edificio . '</option>
												<option value="garaje">' . $xml->pagina_buscar->garaje . '</option>
												<option value="terreno">' . $xml->pagina_buscar->terreno . '</option>
												<option value="otros">' . $xml->pagina_buscar->otros . '</option>';
										break;

									case 'chalet':
										  echo '<option value="todos" hidden>' . $xml->pagina_buscar->tipo . '</option>
												<option value="todos">' . $xml->indiferente . '</option>
												<option value="casa">' . $xml->pagina_buscar->casa . '</option>
												<option value="chalet" selected>' . $xml->pagina_buscar->chalet . '</option>
												<option value="piso">' . $xml->pagina_buscar->piso . '</option>	
												<option value="apartamento">' . $xml->pagina_buscar->apartamento . '</option>
												<option value="local">' . $xml->pagina_buscar->local . '</option>
												<option value="edificio">' . $xml->pagina_buscar->edificio . '</option>
												<option value="garaje">' . $xml->pagina_buscar->garaje . '</option>
												<option value="terreno">' . $xml->pagina_buscar->terreno . '</option>
												<option value="otros">' . $xml->pagina_buscar->otros . '</option>';
										break;
									case 'piso':
										  echo '<option value="todos" hidden>' . $xml->pagina_buscar->tipo . '</option>
												<option value="todos">' . $xml->indiferente . '</option>
												<option value="casa">' . $xml->pagina_buscar->casa . '</option>
												<option value="chalet">' . $xml->pagina_buscar->chalet . '</option>
												<option value="piso" selected>' . $xml->pagina_buscar->piso . '</option>	
												<option value="apartamento">' . $xml->pagina_buscar->apartamento . '</option>
												<option value="local">' . $xml->pagina_buscar->local . '</option>
												<option value="edificio">' . $xml->pagina_buscar->edificio . '</option>
												<option value="garaje">' . $xml->pagina_buscar->garaje . '</option>
												<option value="terreno">' . $xml->pagina_buscar->terreno . '</option>
												<option value="otros">' . $xml->pagina_buscar->otros . '</option>';
										break;
									case 'apartamento':
										  echo '<option value="todos" hidden>' . $xml->pagina_buscar->tipo . '</option>
												<option value="todos">' . $xml->indiferente . '</option>
												<option value="casa">' . $xml->pagina_buscar->casa . '</option>
												<option value="chalet">' . $xml->pagina_buscar->chalet . '</option>
												<option value="piso">' . $xml->pagina_buscar->piso . '</option>	
												<option value="apartamento" selected>' . $xml->pagina_buscar->apartamento . '</option>
												<option value="local">' . $xml->pagina_buscar->local . '</option>
												<option value="edificio">' . $xml->pagina_buscar->edificio . '</option>
												<option value="garaje">' . $xml->pagina_buscar->garaje . '</option>
												<option value="terreno">' . $xml->pagina_buscar->terreno . '</option>
												<option value="otros">' . $xml->pagina_buscar->otros . '</option>';
										break;
									case 'local':
										  echo '<option value="todos" hidden>' . $xml->pagina_buscar->tipo . '</option>
												<option value="todos">' . $xml->indiferente . '</option>
												<option value="casa">' . $xml->pagina_buscar->casa . '</option>
												<option value="chalet">' . $xml->pagina_buscar->chalet . '</option>
												<option value="piso">' . $xml->pagina_buscar->piso . '</option>	
												<option value="apartamento">' . $xml->pagina_buscar->apartamento . '</option>
												<option value="local" selected>' . $xml->pagina_buscar->local . '</option>
												<option value="edificio">' . $xml->pagina_buscar->edificio . '</option>
												<option value="garaje">' . $xml->pagina_buscar->garaje . '</option>
												<option value="terreno">' . $xml->pagina_buscar->terreno . '</option>
												<option value="otros">' . $xml->pagina_buscar->otros . '</option>';
										break;
									case 'terreno':
										  echo '<option value="todos" hidden>' . $xml->pagina_buscar->tipo . '</option>
												<option value="todos">' . $xml->indiferente . '</option>
												<option value="casa">' . $xml->pagina_buscar->casa . '</option>
												<option value="chalet">' . $xml->pagina_buscar->chalet . '</option>
												<option value="piso">' . $xml->pagina_buscar->piso . '</option>	
												<option value="apartamento">' . $xml->pagina_buscar->apartamento . '</option>
												<option value="local">' . $xml->pagina_buscar->local . '</option>
												<option value="edificio">' . $xml->pagina_buscar->edificio . '</option>
												<option value="garaje">' . $xml->pagina_buscar->garaje . '</option>
												<option value="terreno" selected>' . $xml->pagina_buscar->terreno . '</option>
												<option value="otros">' . $xml->pagina_buscar->otros . '</option>';
										break;

									case 'edificio':
										  echo '<option value="todos" hidden>' . $xml->pagina_buscar->tipo . '</option>
												<option value="todos">' . $xml->indiferente . '</option>
												<option value="casa">' . $xml->pagina_buscar->casa . '</option>
												<option value="chalet">' . $xml->pagina_buscar->chalet . '</option>
												<option value="piso">' . $xml->pagina_buscar->piso . '</option>	
												<option value="apartamento">' . $xml->pagina_buscar->apartamento . '</option>
												<option value="local">' . $xml->pagina_buscar->local . '</option>
												<option value="edificio" selected>' . $xml->pagina_buscar->edificio . '</option>
												<option value="garaje">' . $xml->pagina_buscar->garaje . '</option>
												<option value="terreno" >' . $xml->pagina_buscar->terreno . '</option>
												<option value="otros">' . $xml->pagina_buscar->otros . '</option>';
										break;

									case 'garaje':
										  echo '<option value="todos" hidden>' . $xml->pagina_buscar->tipo . '</option>
												<option value="todos">' . $xml->indiferente . '</option>
												<option value="casa">' . $xml->pagina_buscar->casa . '</option>
												<option value="chalet">' . $xml->pagina_buscar->chalet . '</option>
												<option value="piso">' . $xml->pagina_buscar->piso . '</option>	
												<option value="apartamento">' . $xml->pagina_buscar->apartamento . '</option>
												<option value="local">' . $xml->pagina_buscar->local . '</option>
												<option value="edificio">' . $xml->pagina_buscar->edificio . '</option>
												<option value="garaje" selected>' . $xml->pagina_buscar->garaje . '</option>
												<option value="terreno">' . $xml->pagina_buscar->terreno . '</option>
												<option value="otros">' . $xml->pagina_buscar->otros . '</option>';
										break;

									case 'otros':
										  echo '<option value="todos" hidden>' . $xml->pagina_buscar->tipo . '</option>
												<option value="todos">' . $xml->indiferente . '</option>
												<option value="casa">' . $xml->pagina_buscar->casa . '</option>
												<option value="chalet">' . $xml->pagina_buscar->chalet . '</option>
												<option value="piso">' . $xml->pagina_buscar->piso . '</option>	
												<option value="apartamento">' . $xml->pagina_buscar->apartamento . '</option>
												<option value="local">' . $xml->pagina_buscar->local . '</option>
												<option value="edificio">' . $xml->pagina_buscar->edificio . '</option>
												<option value="garaje">' . $xml->pagina_buscar->garaje . '</option>
												<option value="terreno">' . $xml->pagina_buscar->terreno . '</option>
												<option value="otros" selected>' . $xml->pagina_buscar->otros . '</option>';
										break;
									
									}
						?>
									
					</select>
				</div>
				<div class="contiene_habitaciones">
					<select name="habitaciones" id="select_habitaciones">
						<?php
									switch ($habitaciones) {
  				case 'todos':
  					echo '<option value="todos"  selected hidden>' . $xml->pagina_buscar->habitaciones . '</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="1">1 ' . $xml->pagina_buscar->habitacion . '</option>
						<option value="2">2 ' . $xml->pagina_buscar->habitaciones . '</option>
						<option value="3">3 ' . $xml->pagina_buscar->habitaciones . '</option>
						<option value="4">4 ' . $xml->pagina_buscar->habitaciones . '</option>';
  					break;
  				case '1':
  					echo '<option value="todos" hidden>' . $xml->pagina_buscar->habitaciones . '</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="1" selected>1 ' . $xml->pagina_buscar->habitacion . '</option>
						<option value="2">2 ' . $xml->pagina_buscar->habitaciones . '</option>
						<option value="3">3 ' . $xml->pagina_buscar->habitaciones . '</option>
						<option value="4">4 ' . $xml->pagina_buscar->habitaciones . '</option>';
  					break;
  				case '2':
  					echo '<option value="todos" hidden>' . $xml->pagina_buscar->habitaciones . '</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="1">1 ' . $xml->pagina_buscar->habitacion . '</option>
						<option value="2" selected>2 ' . $xml->pagina_buscar->habitaciones . '</option>
						<option value="3">3 ' . $xml->pagina_buscar->habitaciones . '</option>
						<option value="4">4 ' . $xml->pagina_buscar->habitaciones . '</option>';
  					break;
  				case '3':
  					echo '<option value="todos" hidden>' . $xml->pagina_buscar->habitaciones . '</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="1">1 ' . $xml->pagina_buscar->habitacion . '</option>
						<option value="2">2 ' . $xml->pagina_buscar->habitaciones . '</option>
						<option value="3" selected>3 ' . $xml->pagina_buscar->habitaciones . '</option>
						<option value="4">4 ' . $xml->pagina_buscar->habitaciones . '</option>';
  					break;
  				case '4':
  					echo '<option value="todos" hidden>' . $xml->pagina_buscar->habitaciones . '</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="1">1 ' . $xml->pagina_buscar->habitacion . '</option>
						<option value="2">2 ' . $xml->pagina_buscar->habitaciones . '</option>
						<option value="3">3 ' . $xml->pagina_buscar->habitaciones . '</option>
						<option value="4" selected>4 ' . $xml->pagina_buscar->habitaciones . '</option>';
  					break;
  				
  			}
  		?>
								
					</select>
				</div>
				<div class="linea_separador3"></div>
				<?php
				global $wpdb;
				$simbolo_moneda= $wpdb->get_var( "SELECT `simbolo` FROM `configuracion`" );	
				?>
				<input type="hidden" class="simbolo_moneda" value="<?php echo $simbolo_moneda; ?>">
				<div class="contiene_precio lista_compra">
									
  					 <select name="precio" id="select_precio_compra_min">
						<?php
									switch ($precio_comprar_min) {
  				case 'todos':
  					echo '<option value="todos"  selected hidden>' . $xml->precio . ' Min.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="100000">100.000 ' . $simbolo_moneda . '</option>
						<option value="150000">150.000 ' . $simbolo_moneda . '</option>
						<option value="200000">200.000 ' . $simbolo_moneda . '</option>
						<option value="250000">250.000 ' . $simbolo_moneda . '</option>
						<option value="300000">300.000 ' . $simbolo_moneda . '</option>
						<option value="350000">350.000 ' . $simbolo_moneda . '</option>';
  					break;
  				case '100000':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Min.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="100000" selected>100.000 ' . $simbolo_moneda . '</option>
						<option value="150000">150.000 ' . $simbolo_moneda . '</option>
						<option value="200000">200.000 ' . $simbolo_moneda . '</option>
						<option value="250000">250.000 ' . $simbolo_moneda . '</option>
						<option value="300000">300.000 ' . $simbolo_moneda . '</option>
						<option value="350000">350.000 ' . $simbolo_moneda . '</option>';
  					break;
  				case '150000':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Min.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="100000" >100.000 ' . $simbolo_moneda . '</option>
						<option value="150000" selected>150.000 ' . $simbolo_moneda . '</option>
						<option value="200000">200.000 ' . $simbolo_moneda . '</option>
						<option value="250000">250.000 ' . $simbolo_moneda . '</option>
						<option value="300000">300.000 ' . $simbolo_moneda . '</option>
						<option value="350000">350.000 ' . $simbolo_moneda . '</option>';
  					break;
  				case '200000':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Min.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="100000" >100.000 ' . $simbolo_moneda . '</option>
						<option value="150000">150.000 ' . $simbolo_moneda . '</option>
						<option value="200000" selected>200.000 ' . $simbolo_moneda . '</option>
						<option value="250000">250.000 ' . $simbolo_moneda . '</option>
						<option value="300000">300.000 ' . $simbolo_moneda . '</option>
						<option value="350000">350.000 ' . $simbolo_moneda . '</option>';
  					break;
  				case '250000':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Min.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="100000" >100.000 ' . $simbolo_moneda . '</option>
						<option value="150000">150.000 ' . $simbolo_moneda . '</option>
						<option value="200000">200.000 ' . $simbolo_moneda . '</option>
						<option value="250000" selected>250.000 ' . $simbolo_moneda . '</option>
						<option value="300000">300.000 ' . $simbolo_moneda . '</option>
						<option value="350000">350.000 ' . $simbolo_moneda . '</option>';
  					break;
  				case '300000':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Min.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="100000" >100.000 ' . $simbolo_moneda . '</option>
						<option value="150000">150.000 ' . $simbolo_moneda . '</option>
						<option value="200000">200.000 ' . $simbolo_moneda . '</option>
						<option value="250000">250.000 ' . $simbolo_moneda . '</option>
						<option value="300000" selected>300.000 ' . $simbolo_moneda . '</option>
						<option value="350000">350.000 ' . $simbolo_moneda . '</option>';
  					break;
  				case '350000':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Min.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="100000" >100.000 ' . $simbolo_moneda . '</option>
						<option value="150000">150.000 ' . $simbolo_moneda . '</option>
						<option value="200000" >200.000 ' . $simbolo_moneda . '</option>
						<option value="250000">250.000 ' . $simbolo_moneda . '</option>
						<option value="300000">300.000 ' . $simbolo_moneda . '</option>
						<option value="350000" selected>350.000 ' . $simbolo_moneda . '</option>';
  					break;
  				
  			}	?>
						
					</select>
				
								
  					 <select name="precio" id="select_precio_compra_max">
						<?php
									switch ($precio_comprar_max) {
  				case 'todos':
  					echo '<option value="todos"  selected hidden>' . $xml->precio . ' Max.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="150000">150.000 ' . $simbolo_moneda . '</option>
						<option value="200000">200.000 ' . $simbolo_moneda . '</option>
						<option value="250000">250.000 ' . $simbolo_moneda . '</option>
						<option value="300000">300.000 ' . $simbolo_moneda . '</option>
						<option value="350000">350.000 ' . $simbolo_moneda . '</option>
						<option value="400000">400.000 ' . $simbolo_moneda . '</option>';
  					break;
  				case '150000':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Max.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="150000" selected>150.000 ' . $simbolo_moneda . '</option>
						<option value="200000">200.000 ' . $simbolo_moneda . '</option>
						<option value="250000">250.000 ' . $simbolo_moneda . '</option>
						<option value="300000">300.000 ' . $simbolo_moneda . '</option>
						<option value="350000">350.000 ' . $simbolo_moneda . '</option>
						<option value="400000">400.000 ' . $simbolo_moneda . '</option>';
  					break;
  				case '200000':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Max.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="150000" >150.000 ' . $simbolo_moneda . '</option>
						<option value="200000" selected>200.000 ' . $simbolo_moneda . '</option>
						<option value="250000">250.000 ' . $simbolo_moneda . '</option>
						<option value="300000">300.000 ' . $simbolo_moneda . '</option>
						<option value="350000">350.000 ' . $simbolo_moneda . '</option>
						<option value="400000">400.000 ' . $simbolo_moneda . '</option>';
  					break;
  				case '250000':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Max.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="150000" >150.000 ' . $simbolo_moneda . '</option>
						<option value="200000">200.000 ' . $simbolo_moneda . '</option>
						<option value="250000" selected>250.000 ' . $simbolo_moneda . '</option>
						<option value="300000">300.000 ' . $simbolo_moneda . '</option>
						<option value="350000">350.000 ' . $simbolo_moneda . '</option>
						<option value="400000">400.000 ' . $simbolo_moneda . '</option>';
  					break;
  				case '300000':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Max.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="150000" >150.000 ' . $simbolo_moneda . '</option>
						<option value="200000">200.000 ' . $simbolo_moneda . '</option>
						<option value="250000">250.000 ' . $simbolo_moneda . '</option>
						<option value="300000" selected>300.000 ' . $simbolo_moneda . '</option>
						<option value="350000">350.000 ' . $simbolo_moneda . '</option>
						<option value="400000">400.000 ' . $simbolo_moneda . '</option>';
  					break;
  				case '350000':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Max.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="150000" >150.000 ' . $simbolo_moneda . '</option>
						<option value="200000">200.000 ' . $simbolo_moneda . '</option>
						<option value="250000">250.000 ' . $simbolo_moneda . '</option>
						<option value="300000">300.000 ' . $simbolo_moneda . '</option>
						<option value="350000" selected>350.000 ' . $simbolo_moneda . '</option>
						<option value="400000">400.000 ' . $simbolo_moneda . '</option>';
  					break;
  				case '400000':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Max.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="150000" >150.000 ' . $simbolo_moneda . '</option>
						<option value="200000">200.000 ' . $simbolo_moneda . '</option>
						<option value="250000">250.000 ' . $simbolo_moneda . '</option>
						<option value="300000">300.000 ' . $simbolo_moneda . '</option>
						<option value="350000">350.000 ' . $simbolo_moneda . '</option>
						<option value="400000" selected>400.000 ' . $simbolo_moneda . '</option>';
  					break;
  				
  			}	?>
						
					</select>
				
				</div>
				</div>
				
				<div class="linea_separador3"></div>
				<div class="contiene_precio lista_alquiler">
					<select name="precio" id="select_precio_alquiler_min">
							<?php
									switch ($precio_alquiler_min) {
  				case 'todos':
  					echo '<option value="todos"  selected hidden>' . $xml->precio . ' Min.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="100">100 ' . $simbolo_moneda . '</option>
						<option value="200">200 ' . $simbolo_moneda . '</option>
						<option value="300">300 ' . $simbolo_moneda . '</option>
						<option value="400">400 ' . $simbolo_moneda . '</option>
						<option value="500">500 ' . $simbolo_moneda . '</option>
						<option value="600">600 ' . $simbolo_moneda . '</option>';
  					break;
  				case '100':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Min.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="100" selected>100 ' . $simbolo_moneda . '</option>
						<option value="200">200 ' . $simbolo_moneda . '</option>
						<option value="300">300 ' . $simbolo_moneda . '</option>
						<option value="400">400 ' . $simbolo_moneda . '</option>
						<option value="500">500 ' . $simbolo_moneda . '</option>
						<option value="600">600 ' . $simbolo_moneda . '</option>';
  					break;
  				case '200':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Min.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="100">100 ' . $simbolo_moneda . '</option>
						<option value="200" selected>200 ' . $simbolo_moneda . '</option>
						<option value="300">300 ' . $simbolo_moneda . '</option>
						<option value="400">400 ' . $simbolo_moneda . '</option>
						<option value="500">500 ' . $simbolo_moneda . '</option>
						<option value="600">600 ' . $simbolo_moneda . '</option>';
  					break;
  				case '300':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Min.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="100">100 ' . $simbolo_moneda . '</option>
						<option value="200">200 ' . $simbolo_moneda . '</option>
						<option value="300" selected>300 ' . $simbolo_moneda . '</option>
						<option value="400">400 ' . $simbolo_moneda . '</option>
						<option value="500">500 ' . $simbolo_moneda . '</option>
						<option value="600">600 ' . $simbolo_moneda . '</option>';
  					break;
  				case '400':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Min.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="100">100 ' . $simbolo_moneda . '</option>
						<option value="200">200 ' . $simbolo_moneda . '</option>
						<option value="300">300 ' . $simbolo_moneda . '</option>
						<option value="400" selected>400 ' . $simbolo_moneda . '</option>
						<option value="500">500 ' . $simbolo_moneda . '</option>
						<option value="600">600 ' . $simbolo_moneda . '</option>';
  					break;
  				case '500':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Min.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="100">100 ' . $simbolo_moneda . '</option>
						<option value="200">200 ' . $simbolo_moneda . '</option>
						<option value="300">300 ' . $simbolo_moneda . '</option>
						<option value="400">400 ' . $simbolo_moneda . '</option>
						<option value="500" selected>500 ' . $simbolo_moneda . '</option>
						<option value="600">600 ' . $simbolo_moneda . '</option>';
  					break;
  				case '600':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Min.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="100" >100 ' . $simbolo_moneda . '</option>
						<option value="200">200 ' . $simbolo_moneda . '</option>
						<option value="300">300 ' . $simbolo_moneda . '</option>
						<option value="400">400 ' . $simbolo_moneda . '</option>
						<option value="500">500 ' . $simbolo_moneda . '</option>
						<option value="600" selected>600 ' . $simbolo_moneda . '</option>';
  					break;
  				
  			}	?>
						
					</select>
				
								
  					 <select name="precio" id="select_precio_alquiler_max">
						<?php
									switch ($precio_alquiler_max) {
  				case 'todos':
  					echo '<option value="todos"  selected hidden>' . $xml->precio . ' Max.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="200">200 ' . $simbolo_moneda . '</option>
						<option value="300">300 ' . $simbolo_moneda . '</option>
						<option value="400">400 ' . $simbolo_moneda . '</option>
						<option value="500">500 ' . $simbolo_moneda . '</option>
						<option value="600">600 ' . $simbolo_moneda . '</option>
						<option value="700">700' . $simbolo_moneda . '</option>';
  					break;
  				case '200':
  					echo '<option value="todos" hidden>' . $xml->precio . ' Max.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="200" selected>200 ' . $simbolo_moneda . '</option>
						<option value="300">300 ' . $simbolo_moneda . '</option>
						<option value="400">400 ' . $simbolo_moneda . '</option>
						<option value="500">500 ' . $simbolo_moneda . '</option>
						<option value="600">600 ' . $simbolo_moneda . '</option>
						<option value="700">700' . $simbolo_moneda . '</option>';
  					break;
  				case '300':
  					echo '<option value="todos"  hidden>' . $xml->precio . ' Max.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="200">200 ' . $simbolo_moneda . '</option>
						<option value="300" selected>300 ' . $simbolo_moneda . '</option>
						<option value="400">400 ' . $simbolo_moneda . '</option>
						<option value="500">500 ' . $simbolo_moneda . '</option>
						<option value="600">600 ' . $simbolo_moneda . '</option>
						<option value="700">700' . $simbolo_moneda . '</option>';
  					break;
  				case '400':
  					echo '<option value="todos"  hidden>' . $xml->precio . ' Max.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="200">200 ' . $simbolo_moneda . '</option>
						<option value="300">300 ' . $simbolo_moneda . '</option>
						<option value="400" selected>400 ' . $simbolo_moneda . '</option>
						<option value="500">500 ' . $simbolo_moneda . '</option>
						<option value="600">600 ' . $simbolo_moneda . '</option>
						<option value="700">700' . $simbolo_moneda . '</option>';
  					break;
  				case '500':
  					echo '<option value="todos"  hidden>' . $xml->precio . ' Max.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="200">200 ' . $simbolo_moneda . '</option>
						<option value="300">300 ' . $simbolo_moneda . '</option>
						<option value="400">400 ' . $simbolo_moneda . '</option>
						<option value="500" selected>500 ' . $simbolo_moneda . '</option>
						<option value="600">600 ' . $simbolo_moneda . '</option>
						<option value="700">700' . $simbolo_moneda . '</option>';
  					break;
  				case '600':
  					echo '<option value="todos"  hidden>' . $xml->precio . ' Max.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="200">200 ' . $simbolo_moneda . '</option>
						<option value="300">300 ' . $simbolo_moneda . '</option>
						<option value="400">400 ' . $simbolo_moneda . '</option>
						<option value="500">500 ' . $simbolo_moneda . '</option>
						<option value="600" selected>600 ' . $simbolo_moneda . '</option>
						<option value="700">700' . $simbolo_moneda . '</option>';
  					break;
  				case '700':
  					echo '<option value="todos"   hidden>' . $xml->precio . ' Max.</option>
						<option value="todos">' . $xml->indiferente . '</option>
						<option value="200">200 ' . $simbolo_moneda . '</option>
						<option value="300">300 ' . $simbolo_moneda . '</option>
						<option value="400">400 ' . $simbolo_moneda . '</option>
						<option value="500">500 ' . $simbolo_moneda . '</option>
						<option value="600">600 ' . $simbolo_moneda . '</option>
						<option value="700" selected>700' . $simbolo_moneda . '</option>';
  					break;
  				
  			}	?>						
					</select>				
				</div>			
			</form>			
		</nav>
		<p class="notificaciones"><span><svg  data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 287.05 217.51"><path d="M64.5-75.17c34.49,0,69,.36,103.48-.13,20.78-.29,34.64,13.54,38.52,27.9A48.9,48.9,0,0,1,208-34.54q0,68.24,0,136.47c0,24.12-15.89,40.17-40,40.2q-103.48.14-207,0c-24.14,0-40-16.09-40-40.22,0-45.49.07-91-.06-136.47,0-13.34,4.56-24.23,14.91-32.82A31.69,31.69,0,0,1-44-74.89c19.66-.33,39.32-.23,59-.27Q39.75-75.2,64.5-75.17ZM-53.86-30.52c0,44.93,0,88.59,0,132.25C-53.85,112.18-49,117-38.62,117h206c10.74,0,15.51-4.76,15.51-15.51q0-63.74,0-127.48c0-1.2.67-2.61-.74-3.8-1.18.92-2.36,1.81-3.5,2.74q-46,37.65-92,75.29-22,18-43.91.17Q7.59,19.85-27.34-8.86C-35.92-15.88-44.51-22.88-53.86-30.52Zm16.39-19.34C-5.12-23.32,26.4,2.53,57.91,28.39c6.06,5,7.13,5,13.2,0Q117-9.33,163-47c.92-.76,1.8-1.58,3.25-2.84Z" transform="translate(79.04 75.3)" style="fill:#474747"/></svg><?php echo $xml->pagina_buscar->guardar_busqueda; ?></p>
		<div class="datos_notificacion">
			<form action="" method="POST">
				<div class="menu_izquierda">
					<p class="titulo"><?php echo $xml->pagina_buscar->notificaciones; ?></p>
					<p class="subtitulo"><?php echo $xml->pagina_buscar->recibir_aviso; ?></p>
					<div class="linea"></div>
					<div class="filtros_notificaciones"></div>
				</div>
				<div class="menu_derecha">
					<div class="cerrar_notificaciones"><svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 230.57 230.67"><path d="M58.74-65.82c63.67.25,115.53,52.26,115,116.14-.51,65.51-54.86,116.19-118.65,114.49-59.87-1.59-112-50.26-111.91-115.58C-56.74-14.47-4.65-66.07,58.74-65.82Zm0,18.84C5.45-47.13-37.65-4.1-37.93,49.49c-.28,52.84,43,96.29,96.09,96.49,52.54.2,96.61-43.3,96.75-95.5C155.06-3.33,112.1-46.84,58.69-47Z" transform="translate(56.79 65.83)" style="fill: #3f51b5"/><path d="M20.94,96.87c-4-.38-7.13-2.18-8.84-5.76-2-4.13-.66-7.74,2.45-10.85,9.31-9.3,18.55-18.68,28-27.86,2.22-2.16,2.54-3.36.11-5.71-9.23-8.91-18.21-18.07-27.27-27.15-5.13-5.15-5.54-9.91-1.28-14.37s9.26-4,14.34,1.1c9.09,9,18.22,18.07,27.17,27.25,2.15,2.2,3.35,2.58,5.71.13,8.9-9.23,18.07-18.22,27.15-27.27,5.17-5.16,9.92-5.57,14.36-1.31s3.95,9.3-1.08,14.35c-8.93,9-17.81,18-26.91,26.81-2.54,2.45-3,3.74-.14,6.45,9.17,8.73,18,17.81,26.93,26.78,5.15,5.16,5.56,10,1.29,14.35s-9.3,3.94-14.35-1.09c-9.09-9.05-18.22-18.06-27.17-27.26-2.18-2.24-3.38-2.5-5.71-.09-8.91,9.22-18.12,18.17-27.12,27.3A13.46,13.46,0,0,1,20.94,96.87Z" transform="translate(56.79 65.83)" style="fill: #3f51b5"/></svg></div>
					<p class="titulo"><?php echo $xml->pagina_buscar->donde; ?></p>
					
					<input type="email" placeholder="<?php echo $xml->pagina_buscar->ejemplo; ?>" class="cuadro_email" required>
					<input type="submit" value="<?php echo $xml->pagina_buscar->guardar; ?>" class="guardar_notificaciones">
					<p class="politica"><?php echo $xml->pagina_buscar->nuestra_politica; ?></p>
				</div>
				
			</form>
		</div>
	</header>