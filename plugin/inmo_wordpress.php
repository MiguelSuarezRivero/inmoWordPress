<?php 
/*
Plugin Name: Inmo WordPress
Plugin URI: http://miguelsuarez.esy.es/
Description: Personaliza las funcionalidades de Inmo WordPress. Habilita/deshabilita los agentes y el blog, configura la moneda, el correo, los mapas y portales y administra los suscriptores.
Author: Miguel Suárez
Version: 1.5
Author URI: http://miguelsuarez.esy.es/
*/

//INSTALA LAS TABLAS NECESARIAS SI NO HAN SIDO INSTALADAS YA

if (is_admin() && !file_exists('../wp-content/plugins/plugin_inmo_wordpress/code/instalado.txt')) {
    require 'code/instalador.php';
}

add_action( 'admin_menu', 'menu_configuracion');
 
function menu_configuracion() {
 
	add_menu_page ( 'Inmo WordPress', 'Inmo WordPress', 'manage_options', 'administra_configuracion', 'configuracion_function','dashicons-admin-generic',5); 

    add_submenu_page ( 'administra_configuracion', 'Agentes', 'Agentes', 'manage_options', 'configuracion_agentes', 'configuracion_agentes_function' );

    add_submenu_page ( 'administra_configuracion', 'Suscriptores', 'Suscriptores', 'manage_options', 'configuracion_suscriptores', 'configuracion_suscriptores_function' );

    add_submenu_page ( 'administra_configuracion', 'Correo', 'Correo', 'manage_options', 'configuracion_correo', 'configuracion_correo_function' );
 
    add_submenu_page ( 'administra_configuracion', 'Ajustes', 'Ajustes', 'manage_options', 'configuracion_ajustes', 'configuracion_ajustes_function');

    add_submenu_page ( 'administra_configuracion', 'Copia de Seguridad', 'Copia de Seguridad', 'manage_options', 'configuracion_copias', 'configuracion_copias_function');
}

function configuracion_function(){

global $wpdb;
$datos_configuracion= $wpdb->get_results( "SELECT * FROM `configuracion`");

$nombre=$direccion=$telefono=$mapa=$my_maps=$my_maps_mapa=$analytics='';

foreach ($datos_configuracion as $key) {
   $nombre=$key->nombre;
   $direccion=$key->direccion;
   $telefono=$key->telefono;
   $mapa=$key->mapa;
   $my_maps=$key->my_maps;
   $my_maps_mapa=$key->my_maps_mapa;
   $analytics=$key->analytics;
}
?>

<input type="hidden" class="ruta" value="<?php echo plugin_dir_url( __FILE__ ) ?>">
<div class="wrap">
    <h1>Configuración</h1>
    <form  method="post"  action="<?php echo plugin_dir_url( __FILE__ ) ?>code/procesar_datos.php">
         <input type="hidden" name="retornar" value="<?php $host_plugin= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"]; echo "http://" . $host_plugin . $url; ?>">
        <table class="form-table">
            <tbody>              
                             
            <tr>
            <th scope="row"><label>Nombre de la inmobiliaria</label></th>
            <td><input type="text" name="nombre" class="regular-text" placeholder="Nombre de la inmobiliaria" value="<?php echo $nombre; ?>" required>
            </td>
            </tr>

            <tr>
            <th scope="row"><label>Dirección</label></th>
            <td><input type="text"  name="direccion" class="regular-text" placeholder="Dirección" value="<?php echo $direccion; ?>" required>
            </td>
            </tr>

            <tr>
            <th scope="row"><label>Teléfono</label></th>
            <td><input type="text" value="<?php echo $telefono; ?>" name="telefono" class="regular-text" placeholder="(+34) 000 000 000" required>
            </td>
            </tr>
                    
            <tr>
            <th scope="row"><label>Mapa contacto</label>
             <p class="description">Mapa que aparece en la página de contacto</p>
            </th>
            <td><textarea name="mapa_inmo"  class="large-text" cols="30" rows="10" placeholder="Pega el Iframe del mapa generado" ><?php echo str_replace('\\', '', $mapa); ?></textarea>
            </td>
            </tr>
           
            <tr>
            <th scope="row"><label>My Google Maps (Enlace)</label>
            <p class="description">Enlace para abrir My Google Maps desde la edición de los inmuebles</p>
            </th>
            
            <td><textarea name="my_maps_inmo"  class="large-text" cols="30" rows="2" placeholder="Pega la URL de tu cuenta" ><?php echo str_replace('\\', '', $my_maps); ?></textarea>
            </td>
            </tr>

            <tr>
            <th scope="row"><label>My Google Maps (Portada Web)</label>
            <p class="description">Mapa de My Google Maps que aparece en la portada de la web</p>
            </th>
            
            <td><textarea name="my_maps_mapa"  class="large-text" cols="30" rows="2" placeholder="Pega el SRC del iframe generado" ><?php echo str_replace('\\', '', $my_maps_mapa); ?></textarea>
            </td>
            </tr>

            <tr>
            <th scope="row"><label>Google Analytics</label>
            <p class="description">Monitoriza las visitas, el tráfico y el comportamiento de los usuarios en web </p>
            </th>
            
            <td><input type="text" name="analytics"  class="regular-text"  placeholder="Pega tu ID de seguimiento aquí" value="<?php echo $analytics; ?>"/>
            </td>
            </tr>
            </tbody>
        </table>

        <input type="submit" name="submit" id="submit" class="button button-primary" value="Guardar cambios">
    </form>   
</div>

<?php	 
}

function configuracion_correo_function(){

    global $wpdb;
$datos_configuracion= $wpdb->get_results( "SELECT * FROM `configuracion`");

$correo=$contra=$puerto=$host=$secure=$auth='';

foreach ($datos_configuracion as $key) {
   $correo=$key->correo;
   $contra=$key->contra_correo;
   $puerto=$key->puerto;
   $host=$key->host;
   $secure=$key->smtp_secure;
   $auth=$key->smtp_auth;
}
?>
<input type="hidden" class="ruta" value="<?php echo plugin_dir_url( __FILE__ ) ?>">
<div class="wrap">
    <style>
.si,.no{
        background: silver;
        display: inline-block;
        border-radius: 30px;
        width: 13px;
        height: 13px;
        margin-top: 13px;
    }

    .error{
        opacity: 0;
    }
</style>
     <h1>Correo</h1>
    <form  method="post" action="<?php echo plugin_dir_url( __FILE__ ) ?>code/procesar_correo.php">
         <input type="hidden" name="retornar" value="<?php $host_plugin= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"]; echo "http://" . $host_plugin . $url; ?>">
        <table class="form-table">
            <tbody>
            <tr>
            <th scope="row"><label>Dirección de correo electrónico</label></th>
            <td><input  type="text" value="<?php echo $correo; ?>" name="correo" class="regular-text correo_inmo" required placeholder="ejemplo@dominio.com">
            </td>
            </tr>
            <tr>
            <th scope="row"><label>Contraseña del correo electrónico</label></th>
            <td><input type="password" name="contra" value="<?php echo $contra; ?>" class="regular-text ltr contra_inmo" required>
            </td>
            </tr>
            <tr>
            <th scope="row"><label>Servidor de correo</label></th>
            <td><input type="text" value="<?php echo $host; ?>" name="servidor" placeholder="mail.example.com" class="regular-text servidor_inmo" required>
            &nbsp;&nbsp;<label><strong>Puerto</strong></label>
            <input type="text" placeholder="2525" value="<?php echo $puerto; ?>" name="puerto" class="small-text puerto_inmo" required>
            &nbsp;&nbsp;<label><strong>SMTP Secure</strong></label>
            <input type="text" placeholder="587" value="<?php echo $secure; ?>" name="secure" class="small-text secure_inmo" required>
            &nbsp;&nbsp;<label><strong>SMTP Auth</strong></label>
            <input type="text" placeholder="true" value="<?php echo $auth; ?>" name="auth" class="small-text auth_inmo" required>
            </td>
            </tr>
            <tr>
            <th scope="row"><input type="button" value="Verificar correo" class="button verificar_correo"></th>
            <td><div class="si"></div>
             <div class="no"></div><p class="description error">texto</p>
            </td>
            </tr>
            </tbody>
        </table>
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Guardar cambios">
    </form>   
</div>

<?php   

}


function add_post_type_agente($name, $args = array()) {
   add_action('init', function() use($name, $args) {

        $args = array_merge(
            array(
                'public' => false,
                  'publicly_queryable' => true,
                 'has_archive' => true,
                'labels' => array(
                    'add_new' => "Añadir nuevo",
                    'add_new_item' => "Añadir nuevo Inmueble",
                    'name' => "Agente",
                    'singular_name' => "Agente",
                    'edit_item' => "Editar Inmueble",
                    'all_items' => "Todos los inmuebles",
                    ),
                'menu_icon' => 'dashicons-admin-home',
                'menu_position' => 2,
                ),
                $args
            );

           register_post_type($name, $args );
   });
}

add_post_type_agente('agente', array(
    'supports' =>array('title','editor')
));

function configuracion_agentes_function(){

    global $wpdb;

$query_agentes= $wpdb->get_results( "SELECT * FROM `agentes`");
$contador=0;
$estado_agentes=$wpdb->get_var( "SELECT `estado_agentes` FROM `configuracion`");
foreach ($query_agentes as $campo) {
    $contador++;
}
      
?>
    <link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/../../plugins/plugin_inmo_wordpress/css/agentes.css">
  <input type="hidden" class="ruta" value="<?php echo plugin_dir_url( __FILE__ ) ?>">
    <div class="wrap">
    <h1>Agentes</h1>
    <table>
      <tbody>

         <tr>
         
            <?php  $agente_checked=($estado_agentes==='true') ?  'checked' : 'nada'; ?>
            <td><input type="checkbox" class="check_agentes" <?php echo $agente_checked; ?>>
          </td>
          <th scope="row"><label>Habilitar página de agentes</label></th>
          </tr>
      </tbody>
    </table>
        <div class="formulario">
      <div class="barra_formulario">
        <p>Agentes (<span class="contador"><?php echo $contador ?></span>)</p>
        <div class="add" title="Añadir agente">+</div>
        <div class="delete_agentes" title="Eliminar agentes seleccionados"></div>    
      </div>
      <div class="barra_informacion_formulario">
        <p class="nombre foto"></p>
        <p class=" nombre">Nombre</p>
      </div>
      <div class="area_datos_agentes">

<?php 
$listado_agentes= $wpdb->get_results( "SELECT * FROM `agentes` ORDER BY `agentes`.`nombre` ASC");

foreach ($listado_agentes as $key) {

    echo '<div class="datos_formulario">
          <input type="checkbox" class="checkbox checkbox_seleccionables">
          <div class="datos_seleccion">
          <input type="hidden" value="' . $key->nombre . '" name="id_agentes" class="id_agentes">
          <p class="datos nombre correo">' . wp_get_attachment_image( $key->foto, 'thumbnail', "", array( "alt"=>$key->nombre)) . '</p>
          <p class="datos nombre modalidad">' . $key->nombre . '</p>
          </div>
          </div>';
}
?>

</div>
</div>
</div>
<?php
}

function configuracion_suscriptores_function(){
global $wpdb;

$simbolo_moneda= $wpdb->get_var( "SELECT `simbolo` FROM `configuracion`" );
$query_suscriptores= $wpdb->get_results( "SELECT * FROM `suscriptores` ORDER BY 'correo'");

$contador=0;
$array_localidades=array();

foreach ($query_suscriptores as $key) {
  $contador++;
  array_push($array_localidades, $key->localidad_venta);
  array_push($array_localidades, $key->localidad_alquiler);
}

$select_localidades= array_unique($array_localidades);
sort($select_localidades);
    
?>
<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/../../plugins/plugin_inmo_wordpress/css/suscriptores.css">
    <input type="hidden" class="ruta" value="<?php echo plugin_dir_url( __FILE__ ) ?>">
    <div class="wrap">
        <h1>Suscriptores</h1>
        <div class="formulario">
            <div class="barra_formulario">
                <p>Suscriptores (<span class="contador"><?php echo $contador ?></span>)</p>
                <div class="delete_suscriptores" title="Eliminar suscriptores seleccionados"></div>
        <div class="filtrar" title="Filtrar suscriptores"></div>    
        <div class="csv" title="Exportar a CSV"></div>          
            </div>
      <div class="barra_filtrar_formulario">
        <div class="filtro_marca">
          <p class="nombre filtro">Modalidad</p>
          <select name="filtro_marca" class="estado_modalidad filtrar_seleccion">
          <option value="Todos">Todas</option>
          <option value="venta">Venta</option>
          <option value="alquiler">Alquiler</option>
        </select>
        </div>
        <div class="filtro_marca">
          <p class="nombre filtro">Localidad</p>
          <select name="filtro_seccion" class="estado_localidad filtrar_seleccion">
          <option value="Todos">Todas</option>
          <?php
            foreach ($select_localidades as $key) {
             echo '<option value="' . $key .'">' . $key .'</option>';
            }
          ?>
        </select>
        </div>
        <div class="filtro_marca">
          <p class="nombre filtro">Tipo</p>
          <select name="filtro_color" class="estado_tipo filtrar_seleccion">
          <option value="Todos">Todos</option>
          <option value="casa">Casa</option>
          <option value="chalet">Chalet</option>
          <option value="piso">Piso</option>
          <option value="apartamento">Apartamento</option>
          <option value="local">Local</option>
          <option value="edificio">Edificio</option>
          <option value="garaje">Garaje</option>
          <option value="terreno">Terreno</option>
          <option value="otros">Otros</option>
        </select>
        </div>
        <div class="filtro_marca">
          <p class="nombre filtro">Habitaciones</p>
          <select name="filtro_talla" class="estado_habitaciones filtrar_seleccion">
          <option value="Todos">Todas</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
        </div>
      </div>
            <div class="barra_informacion_formulario">
                <input type="checkbox" class="checkbox seleccion_checkbox">
                <p class="nombre correo">Correo</p>
                <p class="nombre modalidad">Modalidad</p>       
                <p class="nombre localidad">Localidad</p>   
                <p class="nombre tipo">Tipo</p> 
                <p class="nombre habitaciones">Habitaciones</p> 
                <p class="nombre precio">Precio Min.</p>
        <p class="nombre precio">Precio Max.</p>
                <p class="nombre caracteristicas">Características</p>
            </div>
      <div class="area_datos_suscriptores">
<?php 
$lista_suscriptores= $wpdb->get_results( "SELECT * FROM `suscriptores` ORDER BY `suscriptores`.`correo` ASC"); 

foreach ($lista_suscriptores as $key) {

              if(strcmp($key->precio_min,'todos')==0){
                $precio_minimo='Indiferente';
              }else{
                $precio_minimo=number_format($key->precio_min, 0, ',', '.') . $simbolo_moneda;
              }

              if(strcmp($key->precio_max,'todos')==0){
                $precio_maximo='Indiferente';
              }else{
                $precio_maximo=number_format($key->precio_max, 0, ',', '.') . $simbolo_moneda;
              }

              if(strcmp($key->modalidad, 'venta')==0){

                if(!strcmp($key->precio_min,'todos')==0){
                  echo '<div class="datos_formulario">
                 <input type="checkbox" class="checkbox checkbox_seleccionables">
                 <div class="datos_seleccion">
                 <input type="hidden" value="' . $key->correo . '" name="id_suscriptores[]" class="id_suscriptores">
                 <p class="datos nombre correo">' . $key->correo . '</p>
                 <p class="datos nombre modalidad">' . ucfirst($key->modalidad) . '</p>
                 <p class="datos nombre localidad">' . ucfirst($key->localidad_venta) . '</p>
                 <p class="datos nombre tipo">' . ucfirst($key->tipo) . '</p>
                 <p class="datos nombre habitaciones">' . ucfirst($key->habitaciones) . '</p>
                 <p class="datos nombre precio">' . $precio_minimo . '</p>
                 <p class="datos nombre precio">' . $precio_maximo . '</p>
                 <p class="datos nombre caracteristicas">' . ucfirst($key->texto) . '</p>
               
                 </div>
                 </div>';
                }else{
                  echo '<div class="datos_formulario">
                 <input type="checkbox" class="checkbox checkbox_seleccionables">
                 <div class="datos_seleccion">
                 <input type="hidden" value="' . $key->correo . '" name="id_suscriptores[]" class="id_suscriptores">
                 <p class="datos nombre correo">' . $key->correo . '</p>
                 <p class="datos nombre modalidad">' . ucfirst($key->modalidad) . '</p>
                 <p class="datos nombre localidad">' . ucfirst($key->localidad_venta) . '</p>
                 <p class="datos nombre tipo">' . ucfirst($key->tipo) . '</p>
                 <p class="datos nombre habitaciones">' . ucfirst($key->habitaciones) . '</p>
                 <p class="datos nombre precio">' . $precio_minimo . '</p>
                 <p class="datos nombre precio">' . $precio_maximo . '</p>
                 <p class="datos nombre caracteristicas">' . ucfirst($key->texto) . '</p>
               
                 </div>
                 </div>';

                }                  

              }else{
                echo '<div class="datos_formulario">
                 <input type="checkbox" class="checkbox checkbox_seleccionables">
                 <div class="datos_seleccion">
                 <input type="hidden" value="' . $key->correo . '" name="id_suscriptores[]" class="id_suscriptores">
                 <p class="datos nombre correo">' . $key->correo . '</p>
                 <p class="datos nombre modalidad">' . ucfirst($key->modalidad) . '</p>
                 <p class="datos nombre localidad">' . ucfirst($key->localidad_alquiler) . '</p>
                 <p class="datos nombre tipo">' . ucfirst($key->tipo) . '</p>
                 <p class="datos nombre habitaciones">' . ucfirst($key->habitaciones) . '</p>
                 <p class="datos nombre precio">' . $precio_minimo . '</p>
                 <p class="datos nombre precio">' . $precio_maximo . '</p>
                 <p class="datos nombre caracteristicas">' . ucfirst($key->texto) . '</p>
               
                 </div>
                 </div>';
              }
            }   
?>  
    </div>
</div>
<?php    
}

global $wpdb;
$opciones_wordpress= $wpdb->get_results( "SELECT * FROM `configuracion`");

$blog=$wpdb->get_var( "SELECT `blog` FROM `configuracion`");

$ventas_visibles=$wpdb->get_var( "SELECT `ventas_visibles` FROM `configuracion`");

$oculta_opciones=$wpdb->get_var( "SELECT `ocultar_opciones` FROM `configuracion`");

$idiomas=$wpdb->get_var( "SELECT `idiomas` FROM `configuracion`");

$titulos=$wpdb->get_var( "SELECT `titulos` FROM `configuracion`");

$descripcion_idiomas=$wpdb->get_var( "SELECT `descripcion` FROM `configuracion`");

$caracteristicas=$wpdb->get_var( "SELECT `caracteristicas` FROM `configuracion`");

if($oculta_opciones==='true'){

    add_action('admin_menu', 'my_remove_menu_pages');
 
        function my_remove_menu_pages() {
            global $blog;
            if($blog==='false'){
                remove_menu_page( 'edit.php');
            }
                remove_menu_page( 'index.php' );                 
                remove_menu_page( 'themes.php' );  
                remove_menu_page( 'edit.php?post_type=page' );   
                remove_menu_page( 'edit-comments.php' );
        }
    }else{

        add_action('admin_menu', 'my_remove_menu_pages'); 
        function my_remove_menu_pages() {
            global $blog;
            if($blog==='false'){
                remove_menu_page( 'edit.php');
            }
        }

    }

function configuracion_ajustes_function(){

    global $wpdb, $idiomas, $blog, $ventas_visibles, $oculta_opciones, $titulos, $descripcion_idiomas, $caracteristicas;
    $datos_configuracion= $wpdb->get_results( "SELECT * FROM `configuracion`");

$moneda='';

foreach ($datos_configuracion as $key) {
   $moneda=$key->moneda;
}
?>

<input type="hidden" class="ruta" value="<?php echo plugin_dir_url( __FILE__ ) ?>">
<input type="hidden" class="moneda_seleccionada" value="<?php echo $moneda; ?>">
<div class="wrap">
    <h1>Ajustes</h1>
    <form  method="post" action="<?php echo plugin_dir_url( __FILE__ ) ?>code/procesar_ajustes.php" class="configuracion">
        <input type="hidden" name="retornar" value="<?php $host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"]; echo "http://" . $host . $url; ?>">
        <input type="hidden" name="blog" class="valor_blog" value="<?php echo $blog; ?>">
        <input type="hidden" name="ventas" class="valor_ventas" value="<?php echo $ventas_visibles; ?>">
        <input type="hidden" name="ocultar" class="valor_opciones" value="<?php echo $oculta_opciones; ?>">
        <input type="hidden" name="idiomas" class="valor_idiomas" value="<?php echo $idiomas; ?>">
        <input type="hidden" name="titulos" class="valor_titulos" value="<?php echo $titulos; ?>">
        <input type="hidden" name="descripcion" class="valor_descripcion" value="<?php echo $descripcion_idiomas; ?>">
        <input type="hidden" name="caracteristicas" class="valor_caracteristicas" value="<?php echo $caracteristicas; ?>">
        <table class="form-table">
            <tbody> 
                <tr>
                    <th scope="row">
                    <label>Multidiomas</label>
                    </th>
                   <td>
                        <?php  $idiomas_checked=($idiomas==='true') ?  'checked' : 'nada'; ?>
                        <input type="checkbox" class="check_idiomas" <?php echo $idiomas_checked; ?>>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                    <label>Títulos por idioma</label>
                    <p class="description">Los inmuebles podrán tener un título diferente por cada idioma. </p>
                    </th>
                   <td>
                        <?php $titulos_checked=($titulos==='true') ?  'checked' : 'nada'; 
                              $idiomas_checked_2=($idiomas!=='true') ?  'disabled' : 'nada';?>
                        <input type="checkbox" class="check_titulos" <?php echo $titulos_checked . ' ' . $idiomas_checked_2; ?>>
                    </td>
                </tr>  
                <tr>
                    <th scope="row">
                    <label>Descripción por idioma</label>
                    <p class="description">Los inmuebles y agentes podrán tener una descripción diferente por cada idioma. </p>
                    </th>
                   <td>
                        <?php $descripcion_idiomas_checked=($descripcion_idiomas==='true') ?  'checked' : 'nada'; ?>
                        <input type="checkbox" class="check_descripcion" <?php echo $descripcion_idiomas_checked . ' ' . $idiomas_checked_2; ?>>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                    <label>Características por idioma</label>
                    <p class="description">Añade características por cada cada idioma. </p>
                    </th>
                   <td>
                        <?php $caracteristicas_checked=($caracteristicas==='true') ?  'checked' : 'nada'; ?>
                        <input type="checkbox" class="check_caracteristicas" <?php echo $caracteristicas_checked . ' ' . $idiomas_checked_2; ?>>
                    </td>
                </tr>                           
              <tr>
                    <th scope="row">
                    <label>Moneda</label>
                    </th>
                    <td>
                        <select name="moneda">
                            <option value="€_">Euro (€)</option>
                            <option value="$_">Dólar estadounidense ($)</option>
                            <option value="$_mexicano">Peso mexicano ($)</option>
                            <option value="$_colombiano">Peso colombiano ($)</option>
                            <option value="$_argentino">Peso Argentino ($)</option>
                            <option value="$_chileno">Peso chileno ($)</option>
                            <option value="S/._">Nuevo Sol peruano (S/.)</option>
                            <option value="UYU_">Peso uruguayo (UYU)</option>
                            <option value="VEF_">Bolívar venezolano (VEF)</option>
                            <option value="Bs_">Boliviano (Bs)</option>
                            <option value="RD$_">Peso dominicano (RD$)</option>
                            <option value="Q_">Quetzal de Guatemala (Q)</option>
                            <option value="GY$_">Dolar guyanés (GY$)</option>
                            <option value="L_">Lempira hondureña (L)</option>
                            <option value="C$_">Córdoba nicaragüense (C$)</option>
                            <option value="B_">Balboa panameño (B)</option>
                            <option value="PYG_">Guaraní paraguayo (PYG)</option>
                            <option value="$_surinames">Dólar surinamés ($)</option>                           
                        </select>
                    </td>
                </tr> 
                <tr>
                    <th scope="row">
                    <label>Habilitar Blog</label>
                     <p class="description">Habilita el Blog tanto en el gestor como en los enlaces de la web</p>
                    </th>
                    <td>
                        <?php global $blog; $blog_checked=($blog==='true') ?  'checked' : 'nada'; ?>
                        <input type="checkbox" class="check_blog" <?php echo $blog_checked; ?>>
                    </td>
                </tr>  
                <tr>

                    <tr>
                    <th scope="row">
                    <label>Mostrar inmuebles vendidos/alquilados</label>
                     <p class="description">Muestra los inmuebles vendidos y alquilados en la búsqueda de inmuebles</p>
                    </th>
                    <td>
                        <?php global $ventas_visibles; $ventas_checked=($ventas_visibles==='true') ?  'checked' : 'nada'; ?>
                        <input type="checkbox" class="check_ventas" <?php echo $ventas_checked; ?>>
                    </td>
                </tr>  
                <tr>

                    <th scope="row">
                    <label>Ocultar menús de WordPress</label>
                    <p class="description">Oculta los menús por defecto de WordPress Páginas, Apariencia y Comentarios. Para el correcto funcionamiento de Inmo WordPress se recomienda no modificar estas opciones por lo que se aconseja mantener activada esta casilla</p>
                    </th>
                    <td>
                        <?php global $oculta_opciones; $opciones_checked=($oculta_opciones==='true') ?  'checked' : 'nada'; ?>
                        <input type="checkbox" class="check_ocultar" <?php echo $opciones_checked; ?>>

                    </td>

                </tr>
            </tbody>
        </table>

        <input type="submit" name="submit" id="submit" class="button button-primary" value="Guardar cambios">
    </form>   
</div>

<?php
}

function configuracion_copias_function(){

?>
<div class="wrap">
    <h1>Copia de Seguridad</h1>
     <form  method="post" action="<?php echo plugin_dir_url( __FILE__ ) ?>code/procesar_copia.php" class="configuracion">              
        <p class="description">Crea un respaldo de todos los datos de la base de datos.</p>
        <br>
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Exportar">
    </form>   
</div>

<?php
}

//MODIFICA LOS POST ENTRADA PARA CONVERTIRLOS EN BLOG
global $blog;
if($blog==='true'){
    function elimina_etiquetas_categorias() {
        unregister_taxonomy_for_object_type( 'post_tag', 'post' );
        unregister_taxonomy_for_object_type( 'category', 'post' );

    }
    add_action( 'init', 'elimina_etiquetas_categorias' );

    if ( function_exists( 'add_theme_support' ) )
    add_theme_support( 'post-thumbnails' );

    function modificar_post_label() {
        global $menu;
        global $submenu;
        $menu[5][0] = 'Blog';
        $submenu['edit.php'][5][0] = 'Entradas';
        $submenu['edit.php'][10][0] = 'A&ntilde;adir Entradas';
       
        echo '';
    }
     
     
    function modificar_post_object() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'Entradas';
        $labels->singular_name = 'Entrada';
        $labels->add_new = 'A&ntilde;adir Nueva';
        $labels->add_new_item = 'A&ntilde;adir Nueva Entrada';
        $labels->edit_item = 'Editar Entrada';
        $labels->new_item = 'Nueva Entrada';
        $labels->view_item = 'Ver Entrada';
        $labels->search_items = 'Buscar Entrada';
        $labels->not_found = 'No se han encontrado Entradas';
        $labels->not_found_in_trash = 'No se han encontrado Entradas en la papelera';
        $labels->all_items = 'Todas las Entradas';
        $labels->menu_name = 'Entradas';
        $labels->name_admin_bar = 'Entradas';
    }
     
    add_action( 'admin_menu', 'modificar_post_label' );
    add_action( 'init', 'modificar_post_object' );
}
//CUSTOM POST INMUEBLE

global $wpdb;

$agentes=false;
$query_agentes= $wpdb->get_results( "SELECT * FROM `agentes`");
$nombre_agentes=array();
  
  foreach ($query_agentes as $key) {
    $agentes=true;
    array_push($nombre_agentes, $key->nombre);                  
}

$nombre_immo= $wpdb->get_var( "SELECT `nombre` FROM `configuracion`");
$moneda= $wpdb->get_var( "SELECT `simbolo` FROM `configuracion`");
$mapa= $wpdb->get_var( "SELECT `my_maps` FROM `configuracion`");

function add_post_type($name, $args = array()) {
   add_action('init', function() use($name, $args) {

        $args = array_merge(
            array(
                'public' => true,
                  'publicly_queryable' => true,
                 'has_archive' => true,
                'labels' => array(
                    'add_new' => "Añadir nuevo",
                    'add_new_item' => "Añadir nuevo Inmueble",
                    'name' => "Inmuebles",
                    'singular_name' => "Inmueble",
                    'edit_item' => "Editar Inmueble",
                    'all_items' => "Todos los inmuebles",
                    ),
                'menu_icon' => 'dashicons-admin-home',
                'menu_position' => 1,
                ),
                $args
            );

           register_post_type($name, $args );
   });
}

add_post_type('inmueble', array(
    'supports' =>array('title','editor'),
    'taxonomies' => array()
));



function add_taxonomy($name,$name_menu, $post_type, $args = array() ) {
    add_action('init', function() use($name,$name_menu, $post_type, $args) {
        $args = array_merge(
            array(
                'label' => ucwords($name_menu),
                'hierarchical' => true,
                'public' => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
                ),
                $args
            );
        register_taxonomy($name, $post_type, $args);
            
    });
}

add_taxonomy('localidad','Localidad', 'inmueble');

global $idiomas,$caracteristicas;

if($idiomas==='true' && $caracteristicas==='true'){
  add_taxonomy('caracteristicas_ES','Características Español', 'inmueble');
  add_taxonomy('caracteristicas_EN','Características Inglés', 'inmueble');
  add_taxonomy('caracteristicas_IT','Características Italiano', 'inmueble');
  add_taxonomy('caracteristicas_FR','Características Francés', 'inmueble');
  add_taxonomy('caracteristicas_DE','Características Alemán', 'inmueble');
  add_taxonomy('caracteristicas_SE','Características Sueco', 'inmueble');
}else{
  add_taxonomy('caracteristicas_ES','Características', 'inmueble');
}



add_action('add_meta_boxes', function() {
  global $agentes, $moneda,$idiomas,$descripcion_idiomas,$titulos;
    add_meta_box(
    'jw_precio_info',
    'Precio (' . $moneda . ')',
    'jw_precio_info_cb',
    'inmueble',
    'normal',
    'high'
     );
    add_meta_box(
    'jw_mapa_info',
    'Ubicación en el mapa',
    'jw_mapa_info_cb',
    'inmueble',
    'normal',
    'high'
     );
   add_meta_box( 
  'jw_transaccion_info',
  'Tipo de transacción',
  'jw_transaccion_info_cb',
  'inmueble',
  'normal',
  'high'
  );
    add_meta_box( 
  'jw_certificado_info',
  'Nivel de certificado energético',
  'jw_certificado_info_cb',
  'inmueble',
  'normal',
  'high'
  );
   add_meta_box( 
  'jw_habitaciones_info',
  'Habitaciones',
  'jw_habitaciones_info_cb',
  'inmueble',
  'normal',
  'high'
  );
   add_meta_box( 
  'jw_banos_info',
  'Baños',
  'jw_banos_info_cb',
  'inmueble',
  'normal',
  'high'
  );
   add_meta_box( 
  'jw_referencia_info',
  'Referencia',
  'jw_referencia_info_cb',
  'inmueble',
  'normal',
  'high'
  );
   add_meta_box( 
  'jw_ano_construcion_info',
  'Año de Construción',
  'jw_ano_construcion_info_cb',
  'inmueble',
  'normal',
  'high'
  );
   add_meta_box( 
  'jw_superficie_info',
  'Superficie Útil (m&#178)',
  'jw_superficie_info_cb',
  'inmueble',
  'normal',
  'high'
  );
   add_meta_box( 
  'jw_construido_info',
  'Construido (m&#178)',
  'jw_construido_info_cb',
  'inmueble',
  'normal',
  'high'
  );
  add_meta_box( 
  'jw_tipo_info',
  'Tipo de inmueble',
  'jw_tipo_info_cb',
  'inmueble',
  'normal',
  'high'
  );
  add_meta_box( 
  'jw_estado_info',
  'Estado',
  'jw_estado_info_cb',
  'inmueble',
  'normal',
  'high'
  );
   add_meta_box( 
  'jw_anterior_info',
  'Precio Anterior (' . $moneda . ')',
  'jw_anterior_info_cb',
  'inmueble',
  'normal',
  'high'
  );
    add_meta_box( 
  'jw_flyer_info',
  'Impresos del Inmueble',
  'jw_flyer_info_cb',
  'inmueble',
  'normal',
  'high'
  );
    add_meta_box( 
  'jw_direccion_info',
  'Dirección',
  'jw_direccion_info_cb',
  'inmueble',
  'normal',
  'high'
  );
     add_meta_box( 
  'jw_coordenadas_info',
  'Coordenadas Inmueble',
  'jw_coordenadas_info_cb',
  'inmueble',
  'normal',
  'high'
  );
    add_meta_box( 
  'jw_estado_inmueble_info',
  'Estado del inmueble',
  'jw_estado_inmueble_info_cb',
  'inmueble',
  'normal',
  'high'
  );
  add_meta_box( 
  'prfx_meta',
  'Oportunidad',
  'prfx_meta_callback',
  'inmueble',
  'normal',
  'high'
  );
  add_meta_box( 
  'jw_imagenes_info',
  'Galería del inmueble',
  'jw_imagenes_info_cb',
  'inmueble',
  'normal',
  'high'
  );
  add_meta_box( 
  'jw_notas_info',
  'Notas de interés',
  'jw_notas_info_cb',
  'inmueble',
  'normal',
  'high'
  );
  if($idiomas==='true' && $descripcion_idiomas==='true'){
     add_meta_box( 
    'jw_texto_EN_info',
    'Descripción en Inglés',
    'jw_texto_EN_info_cb',
    'inmueble',
    'normal',
    'high'
    );
    add_meta_box( 
    'jw_texto_FR_info',
    'Descripción en Francés',
    'jw_texto_FR_info_cb',
    'inmueble',
    'normal',
    'high'
    );
    add_meta_box( 
    'jw_texto_DE_info',
    'Descripción en Alemán',
    'jw_texto_DE_info_cb',
    'inmueble',
    'normal',
    'high'
    );
    add_meta_box( 
    'jw_texto_IT_info',
    'Descripción en Italiano',
    'jw_texto_IT_info_cb',
    'inmueble',
    'normal',
    'high'
    );
    add_meta_box( 
    'jw_texto_SE_info',
    'Descripción en Sueco',
    'jw_texto_SE_info_cb',
    'inmueble',
    'normal',
    'high'
    );
  } 
  if($idiomas==='true' && $titulos==='true'){
    add_meta_box( 
    'jw_titulo_EN_info',
    'Título en Inglés',
    'jw_titulo_EN_info_cb',
    'inmueble',
    'normal',
    'high'
    );
    add_meta_box( 
    'jw_titulo_FR_info',
    'Título en Francés',
    'jw_titulo_FR_info_cb',
    'inmueble',
    'normal',
    'high'
    );
    add_meta_box( 
    'jw_titulo_DE_info',
    'Título en Alemán',
    'jw_titulo_DE_info_cb',
    'inmueble',
    'normal',
    'high'
    );
    add_meta_box( 
    'jw_titulo_IT_info',
    'Título en Italiano',
    'jw_titulo_IT_info_cb',
    'inmueble',
    'normal',
    'high'
    );
    add_meta_box( 
    'jw_titulo_SE_info',
    'Título en Sueco',
    'jw_titulo_SE_info_cb',
    'inmueble',
    'normal',
    'high'
    );
  }
  if($agentes){
    add_meta_box( 
  'jw_agentes',
  'Agente Inmobiliario',
  'jw_agente_info_cb',
  'inmueble',
  'normal',
  'high'
  );
  }
});

function jw_texto_EN_info_cb(){
  global $post;
  $texto_EN = get_post_meta($post->ID, 'id_texto_EN' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <textarea name="id_texto_EN" rows="5" cols="50" id="id_texto_EN" class="large-text" placeholder="Descripción del inmueble en inglés, si se deja vacío tomará la descripción en español."><?php echo $texto_EN; ?></textarea>
  <?php  
}

function jw_texto_FR_info_cb(){
  global $post;
  $texto_FR = get_post_meta($post->ID, 'id_texto_FR' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <textarea name="id_texto_FR" rows="5" cols="50" id="id_texto_FR" class="large-text" placeholder="Descripción del inmueble en francés, si se deja vacío tomará la descripción en español."><?php echo $texto_FR; ?></textarea>
  <?php  
}

function jw_texto_DE_info_cb(){
  global $post;
  $texto_DE = get_post_meta($post->ID, 'id_texto_DE' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <textarea name="id_texto_DE" rows="5" cols="50" id="id_texto_DE" class="large-text" placeholder="Descripción del inmueble en alemán, si se deja vacío tomará la descripción en español."><?php echo $texto_DE; ?></textarea>
  <?php  
}

function jw_texto_IT_info_cb(){
  global $post;
  $texto_IT = get_post_meta($post->ID, 'id_texto_IT' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <textarea name="id_texto_IT" rows="5" cols="50" id="id_texto_IT" class="large-text" placeholder="Descripción del inmueble en italiano, si se deja vacío tomará la descripción en español."><?php echo $texto_IT; ?></textarea>
  <?php  
}

function jw_texto_SE_info_cb(){
  global $post;
  $texto_SE = get_post_meta($post->ID, 'id_texto_SE' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <textarea name="id_texto_SE" rows="5" cols="50" id="id_texto_SE" class="large-text" placeholder="Descripción del inmueble en sueco, si se deja vacío tomará la descripción en español."><?php echo $texto_SE; ?></textarea>
  <?php  
}

function jw_titulo_EN_info_cb(){
  global $post;
  $titulo_EN = get_post_meta($post->ID, 'id_titulo_EN' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <input type="text" id="id_titulo_EN" name="id_titulo_EN" class="widefat" value="<?php echo $titulo_EN; ?>" placeholder="Título del inmueble en inglés, si se deja vacío tomará el título en español." />
  <?php
  
}

function jw_titulo_FR_info_cb(){
  global $post;
  $titulo_FR = get_post_meta($post->ID, 'id_titulo_FR' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <input type="text" id="id_titulo_FR" name="id_titulo_FR" class="widefat" value="<?php echo $titulo_FR; ?>" placeholder="Título del inmueble en francés, si se deja vacío tomará el título en español." />
  <?php
  
}

function jw_titulo_DE_info_cb(){
  global $post;
  $titulo_DE = get_post_meta($post->ID, 'id_titulo_DE' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <input type="text" id="id_titulo_DE" name="id_titulo_DE" class="widefat" value="<?php echo $titulo_DE; ?>" placeholder="Título del inmueble en alemán, si se deja vacío tomará el título en español." />
  <?php
  
}

function jw_titulo_IT_info_cb(){
  global $post;
  $titulo_IT = get_post_meta($post->ID, 'id_titulo_IT' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <input type="text" id="id_titulo_IT" name="id_titulo_IT" class="widefat" value="<?php echo $titulo_IT; ?>" placeholder="Título del inmueble en italiano, si se deja vacío tomará el título en español." />
  <?php
  
}

function jw_titulo_SE_info_cb(){
  global $post;
  $titulo_SE = get_post_meta($post->ID, 'id_titulo_SE' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <input type="text" id="id_titulo_SE" name="id_titulo_SE" class="widefat" value="<?php echo $titulo_SE; ?>" placeholder="Título del inmueble en sueco, si se deja vacío tomará el título en español." />
  <?php
  
}

function jw_imagenes_info_cb(){
  global $post;
  $imagenes = get_post_meta($post->ID, 'id_imagenes', true );
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <style>
    .contenedor_imagenes img{
      margin-right: 5px;
    }
    .contenedor_imagenes img{
      margin-right: 5px;
    }
    .borrar_imagen:hover{
      background: #036186!important;
    }
    #boton_borrar{
      display: none;
    }
  </style>
 <input type="hidden" class="ruta" value="<?php echo plugin_dir_url( __FILE__ ) ?>">
 <input type="hidden" class="imagenes" id="id_imagenes" name="id_imagenes" value="<?php echo $imagenes; ?>">

 <input type="button" value="Añadir Media" class="button-primary abrir_media">
 <input type="button" value="Borrar todo" id="boton_borrar" class="button-primary borrar_media">
 <br><br>
 <p class="description">Formatos de imagen y vídeo soportados (jpg, jpeg, png, gif, bmp, mp4)</p>
 <div class="contenedor_imagenes" style="margin-top: 12px">
  <?php
  $array_prueba=explode(",", $imagenes);
  foreach ($array_prueba as $key) {
    $url=wp_get_attachment_url( $key, 'thumbnail');
  $info = new SplFileInfo($url);
  $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

  if(strcmp($extension,'jpg')==0 || strcmp($extension,'gif')==0 || strcmp($extension,'jpeg')==0 || strcmp($extension,'png')==0 || strcmp($extension,'bmp')==0){
      echo '<div style="position:relative;display:inline-block">';
      echo wp_get_attachment_image( $key, 'thumbnail');
      echo ' <input type="hidden" class="id_elemento" value="' . $key . '">';
      echo '<span class="borrar_imagen" style="cursor:pointer;position:absolute;top: 121px;left: 47px;background: #0085ba;width: 56px;border-radius: 27px;height: 20px;color: white;text-align:center">Borrar</span></div>';
  }

  if(strcmp($extension,'mp4')==0){
      echo '<div style="position:relative;display:inline-flex;">';
      echo '<span style="font-size:153px;width:150px;height:150px" class="dashicons dashicons-format-video"></span>';
      echo ' <input type="hidden" class="id_elemento" value="' . $key . '">';
      echo '<span class="borrar_imagen" style="cursor:pointer;position:absolute;top: 121px;left: 47px;background: #0085ba;width: 56px;border-radius: 27px;height: 20px;color: white;text-align:center">Borrar</span></div>';
  }
  }

  ?>
   
 </div>
<?php
}

function jw_agente_info_cb(){
  global $post; 
  global $nombre_agentes;
  global $nombre_immo;
  global $current_user;
  $agente_actual = get_post_meta($post->ID, 'id_agente' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>

  <select name="id_agente" id="id_agente">

    <?php

     wp_get_current_user();

     $agente_logeado=false;

     foreach ($nombre_agentes as $key) {
      if($key===$current_user->display_name){
        $agente_logeado=true;
        $nombre_agente_logeado=$key;
      }
     }

    if($agente_logeado){

       echo '<option value="' . $nombre_agente_logeado . '">' . $nombre_agente_logeado . '</option>';

    }else{

      if(strcmp($agente_actual,$nombre_immo)==0){
          echo ' <option value="' . $nombre_immo . '" selected>' . $nombre_immo . '</option>';
          foreach ($nombre_agentes as $key) {
             echo '<option value="' . $key . '">' . $key . '</option>';
          }
      }else{
          echo ' <option value="' . $nombre_immo . '">' . $nombre_immo . '</option>';
          foreach ($nombre_agentes as $key) {
            if(strcmp($agente_actual,$key)==0){
             echo '<option value="' . $key . '" selected>' . $key . '</option>';
            }else{
             echo '<option value="' . $key . '">' . $key . '</option>';
            }
          }
      }

    }
    
?>
  </select>
  <?php  
}

function jw_coordenadas_info_cb(){
  global $post;
  $latitud = get_post_meta($post->ID, 'id_latitud' , true);
  $longitud = get_post_meta($post->ID, 'id_longitud' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <label>Latitud</label>
  <input type="number" id="id_latitud" name="id_latitud" class="widefat" value="<?php echo $latitud; ?>" placeholder="Introduce la latitud del inmueble"  step="any" />
  <label>Longitud</label>
  <input type="number" id="id_longitud" name="id_longitud" class="widefat" value="<?php echo $longitud; ?>" placeholder="Introduce la longitud del inmueble" step="any" />
  <?php
  
}

function jw_notas_info_cb(){
  global $post;
  $notas = get_post_meta($post->ID, 'id_notas' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <input type="text" id="id_notas" name="id_notas" class="widefat" value="<?php echo $notas; ?>" placeholder="Introduce notas de interés del inmueble" />
  <?php
  
}

function jw_estado_inmueble_info_cb(){
  global $post;
  $estado_inmueble = get_post_meta($post->ID, 'id_estado_inmueble' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');

  if(strcmp($estado_inmueble, 'vendido')==0){
   echo '
    <input type="radio" name="id_estado_inmueble" value="disponible" > Disponible<br>
    <input type="radio" name="id_estado_inmueble" value="vendido" checked> Vendido<br>
    <input type="radio" name="id_estado_inmueble" value="reservado" > Reservado<br>
    <input type="radio" name="id_estado_inmueble" value="alquilado" > Alquilado<br>';
  }else if(strcmp($estado_inmueble, 'reservado')==0){
    echo '<input type="radio" name="id_estado_inmueble" value="disponible" > Disponible<br>
    <input type="radio" name="id_estado_inmueble" value="vendido" > Vendido<br>
    <input type="radio" name="id_estado_inmueble" value="reservado" checked > Reservado<br>
    <input type="radio" name="id_estado_inmueble" value="alquilado" > Alquilado<br>';
  }else if(strcmp($estado_inmueble, 'alquilado')==0){
    echo '<input type="radio" name="id_estado_inmueble" value="disponible" > Disponible<br>
    <input type="radio" name="id_estado_inmueble" value="vendido" > Vendido<br>
    <input type="radio" name="id_estado_inmueble" value="reservado"> Reservado<br>
    <input type="radio" name="id_estado_inmueble" value="alquilado" checked > Alquilado<br>';
  }else{
     echo '<input type="radio" name="id_estado_inmueble" value="disponible" checked> Disponible<br>
    <input type="radio" name="id_estado_inmueble" value="vendido" > Vendido<br>
    <input type="radio" name="id_estado_inmueble" value="reservado"> Reservado<br>
    <input type="radio" name="id_estado_inmueble" value="alquilado"  > Alquilado<br>';
  }
}

function jw_transaccion_info_cb(){
  global $post;
  $transaccion = get_post_meta($post->ID, 'id_transaccion' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');

  if(strcmp($transaccion, 'alquiler')==0){
   echo '<input type="radio" name="id_transaccion" value="venta" > Venta<br>
    <input type="radio" name="id_transaccion" value="alquiler" checked> Alquiler<br>';
  }else{
    echo '<input type="radio" name="id_transaccion" value="venta" checked> Venta<br>
    <input type="radio" name="id_transaccion" value="alquiler"> Alquiler<br>';
  }
}

function jw_estado_info_cb(){
  global $post;
  $estado = get_post_meta($post->ID, 'id_estado' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');

   switch ($estado) {
    case 'Nuevo':
      echo '<input type="radio" name="id_estado" value="Nuevo" checked> Nuevo<br>
         <input type="radio" name="id_estado" value="Reformado" > Reformado<br>
         <input type="radio" name="id_estado" value="A reformar" > A reformar<br>
         <input type="radio" name="id_estado" value="Seminuevo" > Seminuevo<br>
         <input type="radio" name="id_estado" value="Sin estado" > Sin estado<br>';
      break;

    case 'Reformado':
      echo '<input type="radio" name="id_estado" value="Nuevo"> Nuevo<br>
          <input type="radio" name="id_estado" value="Reformado" checked> Reformado<br>
          <input type="radio" name="id_estado" value="A reformar" > A reformar<br>
          <input type="radio" name="id_estado" value="Seminuevo" > Seminuevo<br>
          <input type="radio" name="id_estado" value="Sin estado" > Sin estado<br>';
      break;

     case 'A reformar':
      echo '<input type="radio" name="id_estado" value="Nuevo"> Nuevo<br>
          <input type="radio" name="id_estado" value="Reformado" > Reformado<br>
          <input type="radio" name="id_estado" value="A reformar" checked > A reformar<br>
         <input type="radio" name="id_estado" value="Seminuevo" > Seminuevo<br>
         <input type="radio" name="id_estado" value="Sin estado" > Sin estado<br>';
      break;

     case 'Seminuevo':
      echo '<input type="radio" name="id_estado" value="Nuevo"> Nuevo<br>
          <input type="radio" name="id_estado" value="Reformado" > Reformado<br>
          <input type="radio" name="id_estado" value="A reformar" > A reformar<br>
         <input type="radio" name="id_estado" value="Seminuevo" checked> Seminuevo<br>
         <input type="radio" name="id_estado" value="Sin estado" > Sin estado<br>';
      break;

      case 'Sin estado':
      echo '<input type="radio" name="id_estado" value="Nuevo"> Nuevo<br>
          <input type="radio" name="id_estado" value="Reformado" > Reformado<br>
          <input type="radio" name="id_estado" value="A reformar" > A reformar<br>
         <input type="radio" name="id_estado" value="Seminuevo" > Seminuevo<br>
         <input type="radio" name="id_estado" value="Sin estado" checked> Sin estado<br>';
      break;

    default:
       echo '<input type="radio" name="id_estado" value="Nuevo" checked> Nuevo<br>
         <input type="radio" name="id_estado" value="Reformado" > Reformado<br>
         <input type="radio" name="id_estado" value="A reformar" > A reformar<br>
         <input type="radio" name="id_estado" value="Seminuevo" > Seminuevo<br>
         <input type="radio" name="id_estado" value="Sin estado" > Sin estado<br>';
     break;
  }
}

function jw_certificado_info_cb(){
  global $post;
  $certificado = get_post_meta($post->ID, 'id_certificado' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');

  switch ($certificado) {
    case 'a':
      echo '<input type="radio" name="id_certificado" value="a" checked> A<br>
         <input type="radio" name="id_certificado" value="b"> B<br>
         <input type="radio" name="id_certificado" value="c" > C<br>
         <input type="radio" name="id_certificado" value="d" > D<br>
         <input type="radio" name="id_certificado" value="e" >  E<br>
         <input type="radio" name="id_certificado" value="f" > F<br>
         <input type="radio" name="id_certificado" value="g" > G<br>
         <input type="radio" name="id_certificado" value="1" > En trámite<br>
         <input type="radio" name="id_certificado" value="0" > No tiene<br>';

      break;

    case 'b':
      echo '<input type="radio" name="id_certificado" value="a" > A<br>
         <input type="radio" name="id_certificado" value="b" checked> B<br>
         <input type="radio" name="id_certificado" value="c" > C<br>
         <input type="radio" name="id_certificado" value="d" > D<br>
         <input type="radio" name="id_certificado" value="e" >  E<br>
         <input type="radio" name="id_certificado" value="f" > F<br>
         <input type="radio" name="id_certificado" value="g" > G<br>
         <input type="radio" name="id_certificado" value="1" > En trámite<br>
         <input type="radio" name="id_certificado" value="0" > No tiene<br>';
      break;

    case 'c':
      echo '<input type="radio" name="id_certificado" value="a" > A<br>
         <input type="radio" name="id_certificado" value="b"> B<br>
         <input type="radio" name="id_certificado" value="c" checked > C<br>
         <input type="radio" name="id_certificado" value="d" > D<br>
         <input type="radio" name="id_certificado" value="e" >  E<br>
         <input type="radio" name="id_certificado" value="f" > F<br>
         <input type="radio" name="id_certificado" value="g" > G<br>
         <input type="radio" name="id_certificado" value="1" > En trámite<br>
         <input type="radio" name="id_certificado" value="0" > No tiene<br>';
      break;

    case 'd':
      echo '<input type="radio" name="id_certificado" value="a" > A<br>
         <input type="radio" name="id_certificado" value="b"> B<br>
         <input type="radio" name="id_certificado" value="c"  > C<br>
         <input type="radio" name="id_certificado" value="d" checked > D<br>
         <input type="radio" name="id_certificado" value="e" >  E<br>
         <input type="radio" name="id_certificado" value="f" > F<br>
         <input type="radio" name="id_certificado" value="g" > G<br>
         <input type="radio" name="id_certificado" value="1" > En trámite<br>
         <input type="radio" name="id_certificado" value="0" > No tiene<br>';
      break;

     case 'e':
      echo '<input type="radio" name="id_certificado" value="a" > A<br>
         <input type="radio" name="id_certificado" value="b"> B<br>
         <input type="radio" name="id_certificado" value="c"  > C<br>
         <input type="radio" name="id_certificado" value="d"  > D<br>
         <input type="radio" name="id_certificado" value="e" checked>  E<br>
         <input type="radio" name="id_certificado" value="f" > F<br>
         <input type="radio" name="id_certificado" value="g" > G<br>
         <input type="radio" name="id_certificado" value="1" > En trámite<br>
         <input type="radio" name="id_certificado" value="0" > No tiene<br>';
      break;

     case 'f':
      echo '<input type="radio" name="id_certificado" value="a" > A<br>
         <input type="radio" name="id_certificado" value="b"> B<br>
         <input type="radio" name="id_certificado" value="c"  > C<br>
         <input type="radio" name="id_certificado" value="d"  > D<br>
         <input type="radio" name="id_certificado" value="e" >  E<br>
         <input type="radio" name="id_certificado" value="f" checked> F<br>
         <input type="radio" name="id_certificado" value="g" > G<br>
         <input type="radio" name="id_certificado" value="1" > En trámite<br>
         <input type="radio" name="id_certificado" value="0" > No tiene<br>';
      break;

    case 'g':
      echo '<input type="radio" name="id_certificado" value="a" > A<br>
         <input type="radio" name="id_certificado" value="b"> B<br>
         <input type="radio" name="id_certificado" value="c"  > C<br>
         <input type="radio" name="id_certificado" value="d"  > D<br>
         <input type="radio" name="id_certificado" value="e" >  E<br>
         <input type="radio" name="id_certificado" value="f" > F<br>
         <input type="radio" name="id_certificado" value="g" checked> G<br>
         <input type="radio" name="id_certificado" value="1" > En trámite<br>
         <input type="radio" name="id_certificado" value="0" > No tiene<br>';
      break;

      case '1':
      echo '<input type="radio" name="id_certificado" value="a" > A<br>
         <input type="radio" name="id_certificado" value="b"> B<br>
         <input type="radio" name="id_certificado" value="c"  > C<br>
         <input type="radio" name="id_certificado" value="d"  > D<br>
         <input type="radio" name="id_certificado" value="e" >  E<br>
         <input type="radio" name="id_certificado" value="f" > F<br>
         <input type="radio" name="id_certificado" value="g" > G<br>
         <input type="radio" name="id_certificado" value="1" checked> En trámite<br>
         <input type="radio" name="id_certificado" value="0" > No tiene<br>';
      break;

        case '0':
      echo '<input type="radio" name="id_certificado" value="a" > A<br>
         <input type="radio" name="id_certificado" value="b"> B<br>
         <input type="radio" name="id_certificado" value="c"  > C<br>
         <input type="radio" name="id_certificado" value="d"  > D<br>
         <input type="radio" name="id_certificado" value="e" >  E<br>
         <input type="radio" name="id_certificado" value="f" > F<br>
         <input type="radio" name="id_certificado" value="g" > G<br>
         <input type="radio" name="id_certificado" value="1" > En trámite<br>
         <input type="radio" name="id_certificado" value="0" checked> No tiene<br>';
      break;

      default:
       echo '<input type="radio" name="id_certificado" value="a" > A<br>
         <input type="radio" name="id_certificado" value="b"> B<br>
         <input type="radio" name="id_certificado" value="c"  > C<br>
         <input type="radio" name="id_certificado" value="d"  > D<br>
         <input type="radio" name="id_certificado" value="e" >  E<br>
         <input type="radio" name="id_certificado" value="f" > F<br>
         <input type="radio" name="id_certificado" value="g" > G<br>
         <input type="radio" name="id_certificado" value="1" > En trámite<br>
         <input type="radio" name="id_certificado" value="0" checked> No tiene<br>';
     break;
    
  }

}

function jw_tipo_info_cb(){
  global $post;
  $tipo = get_post_meta($post->ID, 'id_tipo' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');

  switch ($tipo) {
    case 'Casa':
      echo '<input type="radio" name="id_tipo" value="Casa" checked> Casa<br>
         <input type="radio" name="id_tipo" value="Chalet"> Chalet<br>
         <input type="radio" name="id_tipo" value="Piso" > Piso<br>
         <input type="radio" name="id_tipo" value="Apartamento" > Apartamento<br>
         <input type="radio" name="id_tipo" value="Local" > Local<br>
         <input type="radio" name="id_tipo" value="Edificio" >  Edificio<br>
         <input type="radio" name="id_tipo" value="Garaje" >  Garaje<br>
         <input type="radio" name="id_tipo" value="Terreno" >  Terreno<br>
         <input type="radio" name="id_tipo" value="Otros" >  Otros<br>';
      break;

    case 'Chalet':
      echo '<input type="radio" name="id_tipo" value="Casa" > Casa<br>
         <input type="radio" name="id_tipo" value="Chalet" checked> Chalet<br>
         <input type="radio" name="id_tipo" value="Piso" > Piso<br>
         <input type="radio" name="id_tipo" value="Apartamento" > Apartamento<br>
         <input type="radio" name="id_tipo" value="Local" > Local<br>
         <input type="radio" name="id_tipo" value="Edificio" >  Edificio<br>
         <input type="radio" name="id_tipo" value="Garaje" >  Garaje<br>
         <input type="radio" name="id_tipo" value="Terreno" >  Terreno<br>
         <input type="radio" name="id_tipo" value="Otros" >  Otros<br>';
      break;

    case 'Piso':
      echo '<input type="radio" name="id_tipo" value="Casa" > Casa<br>
         <input type="radio" name="id_tipo" value="Chalet" > Chalet<br>
         <input type="radio" name="id_tipo" value="Piso" checked> Piso<br>
         <input type="radio" name="id_tipo" value="Apartamento" > Apartamento<br>
         <input type="radio" name="id_tipo" value="Local" > Local<br>
         <input type="radio" name="id_tipo" value="Edificio" >  Edificio<br>
         <input type="radio" name="id_tipo" value="Garaje" >  Garaje<br>
         <input type="radio" name="id_tipo" value="Terreno" >  Terreno<br>
         <input type="radio" name="id_tipo" value="Otros" >  Otros<br>';
      break;

    case 'Apartamento':
      echo '<input type="radio" name="id_tipo" value="Casa" > Casa<br>
         <input type="radio" name="id_tipo" value="Chalet" > Chalet<br>
         <input type="radio" name="id_tipo" value="Piso" > Piso<br>
         <input type="radio" name="id_tipo" value="Apartamento" checked > Apartamento<br>
         <input type="radio" name="id_tipo" value="Local" > Local<br>
         <input type="radio" name="id_tipo" value="Edificio" >  Edificio<br>
         <input type="radio" name="id_tipo" value="Garaje" >  Garaje<br>
         <input type="radio" name="id_tipo" value="Terreno" >  Terreno<br>
         <input type="radio" name="id_tipo" value="Otros" >  Otros<br>';
      break;

    case 'Local':
      echo '<input type="radio" name="id_tipo" value="Casa" > Casa<br>
         <input type="radio" name="id_tipo" value="Chalet" > Chalet<br>
         <input type="radio" name="id_tipo" value="Piso" > Piso<br>
         <input type="radio" name="id_tipo" value="Apartamento"  > Apartamento<br>
         <input type="radio" name="id_tipo" value="Local" checked > Local<br>
         <input type="radio" name="id_tipo" value="Edificio" >  Edificio<br>
         <input type="radio" name="id_tipo" value="Garaje" >  Garaje<br>
         <input type="radio" name="id_tipo" value="Terreno" >  Terreno<br>
         <input type="radio" name="id_tipo" value="Otros" >  Otros<br>';
      break;


     case 'Terreno':
      echo '<input type="radio" name="id_tipo" value="Casa" > Casa<br>
         <input type="radio" name="id_tipo" value="Chalet" > Chalet<br>
         <input type="radio" name="id_tipo" value="Piso" > Piso<br>
         <input type="radio" name="id_tipo" value="Apartamento"  > Apartamento<br>
         <input type="radio" name="id_tipo" value="Local" > Local<br>
         <input type="radio" name="id_tipo" value="Edificio" >  Edificio<br>
         <input type="radio" name="id_tipo" value="Garaje" >  Garaje<br>
         <input type="radio" name="id_tipo" value="Terreno"  checked>  Terreno<br>
         <input type="radio" name="id_tipo" value="Otros" >  Otros<br>';
      break;

      case 'Edificio':
      echo '<input type="radio" name="id_tipo" value="Casa" > Casa<br>
         <input type="radio" name="id_tipo" value="Chalet" > Chalet<br>
         <input type="radio" name="id_tipo" value="Piso" > Piso<br>
         <input type="radio" name="id_tipo" value="Apartamento"  > Apartamento<br>
         <input type="radio" name="id_tipo" value="Local" > Local<br>
         <input type="radio" name="id_tipo" value="Edificio" checked>  Edificio<br>
         <input type="radio" name="id_tipo" value="Garaje" >  Garaje<br>
         <input type="radio" name="id_tipo" value="Terreno"  >  Terreno<br>
         <input type="radio" name="id_tipo" value="Otros" >  Otros<br>';
      break;

      case 'Garaje':
      echo '<input type="radio" name="id_tipo" value="Casa" > Casa<br>
         <input type="radio" name="id_tipo" value="Chalet" > Chalet<br>
         <input type="radio" name="id_tipo" value="Piso" > Piso<br>
         <input type="radio" name="id_tipo" value="Apartamento"  > Apartamento<br>
         <input type="radio" name="id_tipo" value="Local" > Local<br>
         <input type="radio" name="id_tipo" value="Edificio" >  Edificio<br>
         <input type="radio" name="id_tipo" value="Garaje" checked >  Garaje<br>
         <input type="radio" name="id_tipo" value="Terreno"  >  Terreno<br>
         <input type="radio" name="id_tipo" value="Otros" >  Otros<br>';
      break;

      case 'Otros':
      echo '<input type="radio" name="id_tipo" value="Casa" > Casa<br>
         <input type="radio" name="id_tipo" value="Chalet" > Chalet<br>
         <input type="radio" name="id_tipo" value="Piso" > Piso<br>
         <input type="radio" name="id_tipo" value="Apartamento"  > Apartamento<br>
         <input type="radio" name="id_tipo" value="Local" > Local<br>
         <input type="radio" name="id_tipo" value="Edificio" >  Edificio<br>
         <input type="radio" name="id_tipo" value="Garaje"  >  Garaje<br>
         <input type="radio" name="id_tipo" value="Terreno"  >  Terreno<br>
         <input type="radio" name="id_tipo" value="Otros" checked>  Otros<br>';
      break;

      default:
      echo '<input type="radio" name="id_tipo" value="Casa" checked> Casa<br>
         <input type="radio" name="id_tipo" value="Chalet"> Chalet<br>
         <input type="radio" name="id_tipo" value="Piso" > Piso<br>
         <input type="radio" name="id_tipo" value="Apartamento" > Apartamento<br>
         <input type="radio" name="id_tipo" value="Local" > Local<br>
         <input type="radio" name="id_tipo" value="Edificio" >  Edificio<br>
         <input type="radio" name="id_tipo" value="Garaje" >  Garaje<br>
         <input type="radio" name="id_tipo" value="Terreno" >  Terreno<br>
         <input type="radio" name="id_tipo" value="Otros" >  Otros<br>';
      break;
  }

}

function jw_precio_info_cb(){
    global $post;
    $precio = get_post_meta($post->ID, 'id_precio' , true);
    wp_nonce_field(__FILE__, 'jw_nonce');
    ?>
    <input type="number" id="id_precio" name="id_precio" class="widefat" value="<?php echo $precio; ?>"  placeholder="Introduce el precio del inmueble" />
    <?php
}

function jw_anterior_info_cb(){
  global $post;
  $anterior = get_post_meta($post->ID, 'id_anterior' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <input type="number" id="id_anterior" name="id_anterior" class="widefat" value="<?php echo $anterior; ?>"  placeholder="Precio antes de ser rebajado" />
  <?php
}

function jw_habitaciones_info_cb(){
  global $post;
  $habitaciones = get_post_meta($post->ID, 'id_habitaciones' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <input type="number" id="id_habitaciones" name="id_habitaciones" class="widefat" value="<?php echo $habitaciones; ?>"  placeholder="Introduce el número de habitaciones" />
  <?php
}

function jw_banos_info_cb(){
  global $post;
  $banos = get_post_meta($post->ID, 'id_banos' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <input type="number" id="id_banos" name="id_banos" class="widefat" value="<?php echo $banos; ?>"  placeholder="Introduce el número de baños" />
  <?php
}

function jw_referencia_info_cb(){
  global $post;
  $referencia = get_post_meta($post->ID, 'id_referencia' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <input type="text" id="id_referencia" name="id_referencia" class="widefat" value="<?php echo $referencia; ?>"  placeholder="Número de referencia" />
  <?php
}

function jw_direccion_info_cb(){
  global $post;
  $direccion = get_post_meta($post->ID, 'id_direccion' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <input type="text" id="id_direccion" name="id_direccion" class="widefat" value="<?php echo $direccion; ?>"  placeholder="Dirección del inmueble" />
  <?php
}

function jw_ano_construcion_info_cb(){
  global $post;
  $ano_construcion = get_post_meta($post->ID, 'id_ano_construcion' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <input type="number" id="id_ano_construcion" name="id_ano_construcion" class="widefat" value="<?php echo $ano_construcion; ?>"  placeholder="Año de construción" />
  <?php
}

function jw_construido_info_cb(){
  global $post;
  $construido = get_post_meta($post->ID, 'id_construido' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <input type="number" id="id_construido" name="id_construido" class="widefat" value="<?php echo $construido; ?>"  placeholder="Metros cuadrados construidos" />
  <?php
}

function jw_superficie_info_cb(){
  global $post;
  $superficie = get_post_meta($post->ID, 'id_superficie' , true);
  wp_nonce_field(__FILE__, 'jw_nonce');
  ?>
  <input type="number" id="id_superficie" name="id_superficie" class="widefat" value="<?php echo $superficie; ?>"  placeholder="Superficie Útil en metros cuadrados" />
  <?php
}

add_action('save_post', function(){

    global $post;
  global $agentes;

   if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

   if( $_POST && wp_verify_nonce($_POST['jw_nonce'], __FILE__) ) {



      if( isset($_POST['id_latitud']) ) {
        update_post_meta($post->ID, 'id_latitud', $_POST['id_latitud']);
        update_post_meta($post->ID, 'id_longitud', $_POST['id_longitud']);
      }
                
        if( isset($_POST['id_precio']) ) {
            update_post_meta($post->ID, 'id_precio', $_POST['id_precio']);
        }

      if( isset($_POST['id_anterior']) ) {
        update_post_meta($post->ID, 'id_anterior', $_POST['id_anterior']);
      }

      if( isset($_POST['id_habitaciones']) ) {
        update_post_meta($post->ID, 'id_habitaciones', $_POST['id_habitaciones']);
      }

      if( isset($_POST['id_banos']) ) {
        update_post_meta($post->ID, 'id_banos', $_POST['id_banos']);
      }

      if( isset($_POST['id_direccion']) ) {
        update_post_meta($post->ID, 'id_direccion', $_POST['id_direccion']);
      }

      if( isset($_POST['id_referencia']) ) {
        update_post_meta($post->ID, 'id_referencia', $_POST['id_referencia']);
      }

      if( isset($_POST['id_titulo_EN']) ) {
        update_post_meta($post->ID, 'id_titulo_EN', $_POST['id_titulo_EN']);
      }

      if( isset($_POST['id_texto_EN']) ) {
        update_post_meta($post->ID, 'id_texto_EN', $_POST['id_texto_EN']);
      }

      if( isset($_POST['id_titulo_FR']) ) {
        update_post_meta($post->ID, 'id_titulo_FR', $_POST['id_titulo_FR']);
      }

      if( isset($_POST['id_texto_FR']) ) {
        update_post_meta($post->ID, 'id_texto_FR', $_POST['id_texto_FR']);
      }

      if( isset($_POST['id_titulo_DE']) ) {
        update_post_meta($post->ID, 'id_titulo_DE', $_POST['id_titulo_DE']);
      }

      if( isset($_POST['id_texto_DE']) ) {
        update_post_meta($post->ID, 'id_texto_DE', $_POST['id_texto_DE']);
      }

      if( isset($_POST['id_titulo_IT']) ) {
        update_post_meta($post->ID, 'id_titulo_IT', $_POST['id_titulo_IT']);
      }

      if( isset($_POST['id_texto_IT']) ) {
        update_post_meta($post->ID, 'id_texto_IT', $_POST['id_texto_IT']);
      }

      if( isset($_POST['id_titulo_SE']) ) {
        update_post_meta($post->ID, 'id_titulo_SE', $_POST['id_titulo_SE']);
      }

      if( isset($_POST['id_texto_SE']) ) {
        update_post_meta($post->ID, 'id_texto_SE', $_POST['id_texto_SE']);
      }

      if( isset($_POST['id_notas']) ) {
        update_post_meta($post->ID, 'id_notas', $_POST['id_notas']);
      }

      if( isset($_POST['id_ano_construcion']) ) {
        update_post_meta($post->ID, 'id_ano_construcion', $_POST['id_ano_construcion']);
      }

      if( isset($_POST['id_transaccion']) ) {
        update_post_meta($post->ID, 'id_transaccion', $_POST['id_transaccion']);
      }

      if( isset($_POST['id_estado_inmueble']) ) {
        update_post_meta($post->ID, 'id_estado_inmueble', $_POST['id_estado_inmueble']);
      }

       if( isset($_POST['id_estado']) ) {
        update_post_meta($post->ID, 'id_estado', $_POST['id_estado']);
      }

       if( isset($_POST['id_tipo']) ) {
        update_post_meta($post->ID, 'id_tipo', $_POST['id_tipo']);
      }

      if( isset($_POST['id_certificado']) ) {
        update_post_meta($post->ID, 'id_certificado', $_POST['id_certificado']);
      }

      if( isset($_POST['id_superficie']) ) {
        update_post_meta($post->ID, 'id_superficie', $_POST['id_superficie']);
      }

      if( isset($_POST['id_construido']) ) {
        update_post_meta($post->ID, 'id_construido', $_POST['id_construido']);
      }

      if( isset($_POST['id_imagenes']) ) {
        update_post_meta($post->ID, 'id_imagenes', $_POST['id_imagenes']);
      }
      
      if($agentes){
         if( isset($_POST['id_agente']) ) {
          update_post_meta($post->ID, 'id_agente', $_POST['id_agente']);
        }
      }

    }

});

function jw_mapa_info_cb(){
    global $post;
  global $mapa;
    wp_nonce_field(__FILE__, 'jw_nonce');
    
    ?>
    <a href="<?php echo $mapa; ?>" target="_blank" id="id_mapa" name="id_mapa" class='button-primary'>Abrir Mapa</a>
    <p class="description">Debes estar previamente logeado en tu cuenta Gmail</p>

    <?php

}

function jw_flyer_info_cb(){
  global $post;
  wp_nonce_field(__FILE__, 'jw_nonce');
  
  ?>

  <a href="flyers?post=<?php echo $post->ID;?>" rel="nofollow" target="_blank" class='button-primary'>Imprimir Flyer</a>
  <a href="fichas?post=<?php echo $post->ID;?>" rel="nofollow" target="_blank" class='button-primary'>Imprimir Ficha</a>
  <p class="description">Para una correcta visualización de los impresos utilice Google Chrome, habilite 'gráficos de fondo' y seleccione 'Ninguno' en márgenes</p>
  <?php

}

function prfx_meta_callback( $post ) {
       wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
    $prfx_stored_meta = get_post_meta( $post->ID );
    ?>
    
               <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $prfx_stored_meta['meta-checkbox'] ) ) checked( $prfx_stored_meta['meta-checkbox'][0], 'yes' ); ?> />
            <?php _e( 'Añade la etiqueta \'Oportunidad\' al inmueble','prfx-textdomain' )?>
       
 
    <?php
}

function prfx_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
      // Checks for input and saves
  if( isset( $_POST[ 'meta-checkbox' ] ) ) {
      update_post_meta( $post_id, 'meta-checkbox', 'yes' );
  } else {
      update_post_meta( $post_id, 'meta-checkbox', '' );
  }
    
}

add_action( 'save_post', 'prfx_meta_save' );

add_filter( 'enter_title_here', 'wpsites_entry_title_placeholder_text' );

function wpsites_entry_title_placeholder_text( $input ) {

  if(!empty($_GET['post_type'])){
 
    if ( is_admin() && strcmp($_GET['post_type'], 'inmueble')==0){
           return __( 'Nombre del inmueble ', '$textdomain' );
    }

  }

    return $input;
}


add_filter( 'manage_inmueble_posts_columns', 'set_custom_edit_book_columns' );
add_action( 'manage_inmueble_posts_custom_column' , 'custom_book_column', 10, 3 );

function set_custom_edit_book_columns($columns) {
    global $agentes;
    global $moneda;
    unset( $columns['author'] );
    unset($columns['taxonomy-caracteristicas_ES']);
    unset($columns['taxonomy-caracteristicas_EN']);
    unset($columns['taxonomy-caracteristicas_FR']);
    unset($columns['taxonomy-caracteristicas_IT']);
    unset($columns['taxonomy-caracteristicas_DE']);
    unset($columns['taxonomy-caracteristicas_SE']);
    unset($columns['wpseo-focuskw']);
    $columns['Modalidad'] = __( 'Modalidad', 'your_text_domain' );
    $columns['Precio'] = __( 'Precio (' . $moneda . ')', 'your_text_domain' );
    $columns['Estado'] = __( 'Estado', 'your_text_domain' );
    if($agentes){
      $columns['Agente'] = __( 'Agente', 'your_text_domain' );
    }
    return $columns;
}

function custom_book_column( $column, $post_id ) {

  global $post;
  global $moneda;
  $modalidad = get_post_meta($post->ID, 'id_transaccion' , true);
  $price = get_post_meta($post->ID, 'id_precio' , true); 
  $estado_im = get_post_meta($post->ID, 'id_estado_inmueble' , true);
  $agente_asignado = get_post_meta($post->ID, 'id_agente' , true);
    switch ( $column ) {

          case 'Modalidad' :
              if($modalidad==='venta'){
                echo '<span style="text-align:center;display:inline-block;color:white;width:65px;background:#0073aa;border-radius:3px">Venta</span>';
              }else{
                echo '<span style="text-align:center;display:inline-block;width:65px;color:white;background:#00aa3d;border-radius:3px">Alquiler</span>';
              }
          break;

          case 'Precio' :
          if(!empty($price)){
             echo number_format($price, 0, ',', '.') . $moneda;
          }             
          break;

          case 'Estado' :
              echo ucfirst($estado_im);
          break;

          case 'Agente' :
              echo $agente_asignado;
          break;
    }
}


//LOCALIZA EL SCRIPT NECESARIO.
function js_configuracion($hook){ 
    
     if ($hook == 'inmo-wordpress_page_configuracion_agentes'){
     wp_enqueue_media ();
     wp_enqueue_script( 'uploader',plugins_url( '/js/agentes.js', __FILE__ ));
     } 

     if ($hook == 'inmo-wordpress_page_configuracion_suscriptores'){
     wp_enqueue_media ();
     wp_enqueue_script( 'uploader',plugins_url( '/js/suscriptores.js', __FILE__ ));
     } 

     if ($hook == 'inmo-wordpress_page_configuracion_ajustes'){
     wp_enqueue_media ();
     wp_enqueue_script( 'uploader',plugins_url( '/js/ajustes.js', __FILE__ ));
     } 

     if ($hook == 'inmo-wordpress_page_configuracion_correo'){
     wp_enqueue_media ();
     wp_enqueue_script( 'uploader',plugins_url( '/js/correo.js', __FILE__ ));
     } 

     if ('post.php' === $hook || 'post-edit.php' === $hook || 'post-new.php' === $hook){
     wp_enqueue_media ();
     wp_enqueue_script( 'uploader',plugins_url( '/js/inmueble.js', __FILE__ ), array('jquery'));
     }
    
} 

add_action('admin_enqueue_scripts','js_configuracion');
