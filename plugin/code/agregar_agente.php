<h1>Nuevo agente</h1>
<form action="" method="post" class="add_agente">
<table class="form-table">

<tbody>
<tr>
<th scope="row"><label>Nombre</label></th>
<td><input type="text"  class="regular-text nombre_nuevo" placeholder="Nombre del nuevo agente" required></td>
</tr>

<tr>
<th scope="row"><label>Contraseña Wordpress</label></th>
<td><input type="password"  class="regular-text contra_wordpress_nuevo" placeholder="La contraseña para acceder a WordPress" required></td>
</tr>

<tr>
<th scope="row"><label>Perfil</label></th>
<td><textarea  rows="10" cols="50" class="large-text descripcion_nuevo" placeholder="Perfil del agente"></textarea></td>
</tr>

<?php
	require_once '../../../../wp-config.php';
	global $wpdb;
	$descripcion=$wpdb->get_var( "SELECT `descripcion` FROM `configuracion`");

	if($idiomas==='true' && $descripcion==='true'){ ?>
		
		<tr>
			<th scope="row"><label>Perfil en inglés</label></th>
			<td><textarea  rows="10" cols="50" class="large-text descripcion_nuevo_en" placeholder="Perfil del agente"></textarea></td>
		</tr>
		<tr>
			<th scope="row"><label>Perfil en francés</label></th>
			<td><textarea  rows="10" cols="50" class="large-text descripcion_nuevo_fr" placeholder="Perfil del agente"></textarea></td>
		</tr>
		<tr>
			<th scope="row"><label>Perfil en alemám</label></th>
			<td><textarea  rows="10" cols="50" class="large-text descripcion_nuevo_de" placeholder="Perfil del agente"></textarea></td>
		</tr>
		<tr>
			<th scope="row"><label>Perfil en italiano</label></th>
			<td><textarea  rows="10" cols="50" class="large-text descripcion_nuevo_it" placeholder="Perfil del agente"></textarea></td>
		</tr>
		<tr>
			<th scope="row"><label>Perfil en sueco</label></th>
			<td><textarea  rows="10" cols="50" class="large-text descripcion_nuevo_se" placeholder="Perfil del agente"></textarea></td>
		</tr>

	<?php } ?>


<th scope="row"><input type="button" value="Añadir Foto" class="button add_foto"><p class="description">Tamaño de 1x1</p>
</th>
<td><img src="" alt="" class="img_foto" style="width: 70px;">
<input type="hidden" class="foto_nuevo"></td>
</tr>

<tr>
<th scope="row"><label>Teléfono</label></th>
<td><input type="text"  class="regular-text telefono_nuevo" placeholder="(+34) 000 000 000" required>
</td>
</tr>
<tr>
<th scope="row"><label>Dirección de correo electrónico</label></th>
<td><input  type="email" class="regular-text correo_nuevo" required placeholder="ejemplo@dominio.com">
<p class="description">Esta dirección de correo electrónico será utilizada para recibir los correos de contacto asociado a los inmuebles publicados por el agente.</p>
</td>
</tr>
<tr>
<th scope="row"><label>Contraseña del correo electrónico</label></th>
<td><input type="password" class="regular-text ltr contra_nuevo" required>
</td>
</tr>
<tr>
<th scope="row"><label>Servidor de correo</label></th>
<td><input type="text" placeholder="mail.example.com" class="regular-text servidor_nuevo" required>
&nbsp;&nbsp;<label>Puerto</label>
<input type="text" placeholder="2525" class="small-text puerto_nuevo" required>
&nbsp;&nbsp;<label>SMTP Secure</label>
<input type="text" placeholder="587" class="small-text secure_nuevo" required>
&nbsp;&nbsp;<label>SMTP Auth</label>
<input type="text" placeholder="true" class="small-text auth_nuevo" required>
</td>
</tr>
</tbody></table>
<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Crear agente"></p>
</form>