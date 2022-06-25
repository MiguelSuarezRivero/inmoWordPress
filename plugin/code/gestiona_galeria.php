<?php
require_once('../../../../wp-blog-header.php');

header("HTTP/1.0 200 OK");

foreach ($_POST['imagenes'] as $key) {

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
		echo '<span style="font-size:153px;display:inline-block;width:150px;height:150px;margin-top:6px;margin-right: 5px" class="dashicons dashicons-format-video"></span>';
		echo ' <input type="hidden" class="id_elemento" value="' . $key . '">';
		echo '<span class="borrar_imagen" style="cursor:pointer;position:absolute;top: 121px;left: 47px;background: #0085ba;width: 56px;border-radius: 27px;height: 20px;color: white;text-align:center">Borrar</span></div>';
	}
	
}