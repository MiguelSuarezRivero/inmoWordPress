<?php 
require_once '../../../../wp-config.php';
$variable=str_replace('_', ' ', $_GET['nombre']);
	try{

			$base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
        	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        	$base->exec("SET CHARACTER SET utf8");
            $sql="SELECT * FROM `agentes` WHERE `nombre`=:valor1";
            $peticion=$base->prepare($sql);
            $peticion->execute(array(":valor1"=>$variable));
            $resultado=$peticion->fetchAll(PDO::FETCH_BOTH);
	        $peticion->closeCursor();
	        $array_solicitud=$resultado;

            foreach ($array_solicitud as $campo) {

            	$nombre=$campo['nombre'];
            	$telefono=$campo['telefono'];
            	$foto=$campo['foto'];
            	$correo=$campo['correo'];
            	$contra=$campo['contra_correo'];
            	$puerto=$campo['puerto'];
            	$host=$campo['host'];
            	$secure=$campo['smtp_secure'];
            	$auth=$campo['smtp_auth'];
            	$descripcion=$campo['descripcion'];
                $descripcion_en=$campo['descripcion_en'];
                $descripcion_fr=$campo['descripcion_fr'];
                $descripcion_de=$campo['descripcion_de'];
                $descripcion_it=$campo['descripcion_it'];
                $descripcion_se=$campo['descripcion_se'];

            }           
			
        }catch (Exception $e){
          
            echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
        }finally{
            
            $base=NULL;
          
        }//FIN CONECTAR BASE DE DATOS.
?>
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
<h1>Editar agente</h1>
<form action="" method="post" class="edit_agente">
<table class="form-table">

<tbody><tr>
<th scope="row"><label>Nombre</label></th>
<td><p><?php echo $nombre; ?></p><input type="hidden" value="<?php echo $nombre; ?>" class="regular-text nombre_nuevo" ></td>
</tr>

<tr>
<th scope="row"><label>Contraseña Wordpress</label></th>
<td><p class="description">Utilice la pestaña 'Usuarios' para cambiar la contraseña</p</td>
</tr>

<tr>
<th scope="row"><label>Perfil</label></th>
<td><textarea  rows="10" cols="50" class="large-text descripcion_nuevo" placeholder="Perfil del agente"><?php echo $descripcion; ?></textarea></td>
</tr>

<?php
    
    global $wpdb;
    $descripcion=$wpdb->get_var( "SELECT `descripcion` FROM `configuracion`");

    if($idiomas==='true' && $descripcion==='true'){ ?>
        
        <tr>
            <th scope="row"><label>Perfil en inglés</label></th>
            <td><textarea  rows="10" cols="50" class="large-text descripcion_nuevo_en" placeholder="Perfil del agente"><?php echo $descripcion_en; ?></textarea></td>
        </tr>
        <tr>
            <th scope="row"><label>Perfil en francés</label></th>
            <td><textarea  rows="10" cols="50" class="large-text descripcion_nuevo_fr" placeholder="Perfil del agente"><?php echo $descripcion_fr; ?></textarea></td>
        </tr>
        <tr>
            <th scope="row"><label>Perfil en alemám</label></th>
            <td><textarea  rows="10" cols="50" class="large-text descripcion_nuevo_de" placeholder="Perfil del agente"><?php echo $descripcion_de; ?></textarea></td>
        </tr>
        <tr>
            <th scope="row"><label>Perfil en italiano</label></th>
            <td><textarea  rows="10" cols="50" class="large-text descripcion_nuevo_it" placeholder="Perfil del agente"><?php echo $descripcion_it; ?></textarea></td>
        </tr>
        <tr>
            <th scope="row"><label>Perfil en sueco</label></th>
            <td><textarea  rows="10" cols="50" class="large-text descripcion_nuevo_se" placeholder="Perfil del agente"><?php echo $descripcion_se; ?></textarea></td>
        </tr>

    <?php } ?>

<th scope="row"><input type="button" value="Añadir Foto" class="button add_foto"><p class="description">Tamaño de 1x1</p>
</th>
<td><?php echo wp_get_attachment_image( $foto, 'thumbnail'); ?>
<input type="hidden" value="<?php echo $foto; ?>" class="foto_nuevo"></td>
</tr>

<tr>
<th scope="row"><label>Teléfono</label></th>
<td><input type="text"  value="<?php echo $telefono; ?>" class="regular-text telefono_nuevo" placeholder="(+34) 000 000 000" required>
</td>
</tr>
<tr>
<th scope="row"><label>Dirección de correo electrónico</label></th>
<td><input  type="email" value="<?php echo $correo; ?>" class="regular-text correo_nuevo" required placeholder="ejemplo@dominio.com">
<p class="description">Esta dirección de correo electrónico será utilizada para recibir los correos de contacto asociado a los inmuebles publicados por el agente.</p>
</td>
</tr>
<tr>
<th scope="row"><label>Contraseña del correo electrónico</label></th>
<td><input type="password" value="<?php echo $contra; ?>" class="regular-text ltr contra_nuevo" required>
</td>
</tr>
<tr>
<th scope="row"><label>Servidor de correo</label></th>
<td><input type="text" placeholder="mail.example.com" value="<?php echo $host; ?>" class="regular-text servidor_nuevo" required>
&nbsp;&nbsp;<label>Puerto</label>
<input type="text" placeholder="2525" value="<?php echo $puerto; ?>" class="small-text puerto_nuevo" required>
&nbsp;&nbsp;<label>SMTP Secure</label>
<input type="text" placeholder="587" class="small-text secure_nuevo" value="<?php echo $secure; ?>" required>
&nbsp;&nbsp;<label>SMTP Auth</label>
<input type="text" placeholder="true" class="small-text auth_nuevo" value="<?php echo $auth; ?>" required>
</td>
</tr>
<tr>
 <th scope="row"><input type="button" value="Verificar correo" class="button verificar_correo"></th>
<td><div class="si"></div>
<div class="no"></div><p class="description error">texto</p>
</td>
</tr>
</tbody></table>
<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Guardar cambios"></p>
</form>