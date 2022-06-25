<?php

header('access-control-allow-origin: *');

function getRealIP(){

    if (isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
    {
        return $_SERVER["HTTP_X_FORWARDED"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED"]))
    {
        return $_SERVER["HTTP_FORWARDED"];
    }
    else
    {
        return $_SERVER["REMOTE_ADDR"];
    }

}

$servidor=getRealIP();

if($servidor==='185.224.137.59'){
  enviar_correo();
}


function enviar_correo(){

 try{

        $base=new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "","" . DB_USER . "","" . DB_PASSWORD . "");
        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");

        $sql="SELECT * FROM `suscriptores`";
        $peticion=$base->prepare($sql);
        $peticion->execute(array());
        $resultado=$peticion->fetchAll(PDO::FETCH_BOTH);
        $peticion->closeCursor();

        $array_solicitud=$resultado;

            global $wpdb;
            $datos_conexion=$wpdb->get_results("SELECT * FROM `configuracion`");
            foreach ($datos_conexion as $key) {
              $nombre_inmo=$key->nombre;
              $correo=$key->correo;
              $contra=$key->contra_correo;
              $servidor=$key->host;
              $puerto=$key->puerto;
              $smtp_secure=$key->smtp_secure;
              $smtp_auth=$key->smtp_auth;
              $simbolo=$key->simbolo;
            }

            foreach ($array_solicitud as $campo) {

              if(strcasecmp($campo['precio_min'],'todos')==0){
                $campo['precio_min']=0;
              }
              if(strcasecmp($campo['precio_max'],'todos')==0){
                $campo['precio_max']=1000000000;
              }
        
        $args = array(
                  'post_type'  => 'inmueble',
                  'meta_key'   => 'id_precio',
                  'orderby'    => 'meta_value_num',
                  'order'      => 'DESC',
                  'posts_per_page' =>-1,
                  'date_query' => array(
                          'after' => date('Y-m-d H:i:s', strtotime('-24 hours'))
                               ),
                  'tax_query'  => array(
                                      (!strcasecmp($campo['texto'], '')==0) ? array(
                                          'taxonomy' => 'caracteristicas',
                                          'terms' => $campo['texto'],
                                          'field' => 'slug',
                                          'include_children' => true,
                                          'operator' => 'IN'
                                      ) : null,
                                      (strcasecmp($campo['modalidad'], 'venta')==0) ?
                                      (!strcasecmp($campo['localidad_venta'], 'Todos')==0) ? array(
                                          'taxonomy' => 'localidad',
                                          'terms' => $campo['localidad_venta'],
                                          'field' => 'slug',
                                          'include_children' => true,
                                          'operator' => 'IN'
                                      ) : null :null,

                                      (strcasecmp($campo['modalidad'], 'alquiler')==0) ?
                                      (!strcasecmp($campo['localidad_alquiler'], 'Todos')==0) ? array(
                                          'taxonomy' => 'localidad',
                                          'terms' => $campo['localidad_alquiler'],
                                          'field' => 'slug',
                                          'include_children' => true,
                                          'operator' => 'IN'
                                      ) : null :null
                                  ),
              'meta_query' => array(  
                                      (strcasecmp($campo['modalidad'], 'venta')==0) ?
                                      array(
                                        'key' => 'id_precio',
                                        'value'   => array($campo['precio_min'],$campo['precio_max']),
                                        'compare' => 'BETWEEN',
                                        'type' => 'NUMERIC',
                                        'operator' => 'IN'
                                      ) :null,

                                      (strcasecmp($campo['modalidad'], 'alquiler')==0) ?
                                     array(
                                        'key' => 'id_precio',
                                        'value'   => array($campo['precio_min'],$campo['precio_max']),
                                        'compare' => 'BETWEEN',
                                        'type' => 'NUMERIC',
                                        'operator' => 'IN'
                                      ) :null,
                                      
                                      (!strcasecmp($campo['habitaciones'], 'Todos')==0) ?array(
                                          'key' => 'id_habitaciones',
                                          'value'   => (isset($campo['habitaciones'])) ? array($campo['habitaciones'],$campo['habitaciones']) : null
                                          ,
                                          'type' => 'NUMERIC',
                                          'operator' => 'IN'
                                      ) : null ,

                                      (!strcasecmp($campo['tipo'], 'Todos')==0) ?array(
                                          'key' => 'id_tipo',
                                          'value'   => $campo['tipo'],
                                          'operator' => 'IN'
                                      ) : null ,

                                      (array(
                                          'key' => 'id_transaccion',
                                          'value'   => $campo['modalidad'],
                                          'operator' => 'IN'
                                      ) 
                                  )
                            )
            );
         
      $loop = new WP_Query($args);
      $publicaciones=false;
      $body='';
      $criterios='';
      
      if(strcmp($campo['modalidad'],'venta')==0){

        if(strcmp($campo['habitaciones'],'todos')==0 && strcmp($campo['tipo'],'todos')==0 && strcmp($campo['texto'],'')==0 && strcmp($campo['localidad_venta'],'todos')==0 && strcmp($campo['precio_min'],'0')==0 && strcmp($campo['precio_max'],'1000000000')==0){

          $criterios='Todos los inmuebles en venta.';
        
        }else{

          $criterios='Comprar ';

          if(!strcmp($campo['localidad_venta'],'todos')==0){
             $criterios.=' - En ' . $campo['localidad_venta'];
          }

          if(!strcmp($campo['habitaciones'],'todos')==0){
             $criterios.=' - ' . $campo['habitaciones'] . 'Hab. ';
          }

          if(!strcmp($campo['precio_min'],'todos')==0){

            $criterios.=' - Desde  ' . number_format($campo['precio_min'], 0, ',', '.') . $simbolo;
          }

          if(!strcmp($campo['precio_max'],'todos')==0){

            $criterios.=' - Hasta  ' . number_format($campo['precio_max'], 0, ',', '.') . $simbolo;
          }

          if(!strcmp($campo['texto'],'')==0){
            $criterios.=' - Con ' . $campo['texto'];
            
          }
        
      }

    }else{

      if(strcmp($campo['habitaciones'],'todos')==0 && strcmp($campo['tipo'],'todos')==0 && strcmp($campo['texto'],'')==0 && strcmp($campo['localidad_alquiler'],'todos')==0 && strcmp($campo['precio_max'],'1000000000')==0 && strcmp($campo['precio_min'],'0')==0){

          $criterios='Todos los inmuebles en alquiler.';
        
        }else{

          $criterios='Alquilar';

          if(!strcmp($campo['localidad_alquiler'],'todos')==0){
             $criterios.=' - En ' . $campo['localidad_alquiler'];
          }

          if(!strcmp($campo['habitaciones'],'todos')==0){
             $criterios.=' - ' . $campo['habitaciones'] . 'Hab. ';
          }

          if(!strcmp($campo['precio_min'],'todos')==0){

            $criterios.=' - Desde  ' . number_format($campo['precio_min'], 0, ',', '.') . $simbolo;
          }

          if(!strcmp($campo['precio_max'],'todos')==0){

            $criterios.=' - Hasta  ' . number_format($campo['precio_max'], 0, ',', '.') . $simbolo;
          }

          if(!strcmp($campo['texto'],'')==0){
            $criterios.=' - Con ' . $campo['texto'];
            
          }
        
      }
    }

    while ($loop->have_posts() ): $loop->the_post(); 
      
      $meta=get_post_custom( get_the_ID());
     
      if(strcmp($meta['id_estado_inmueble'][0],'disponible')==0){
        $publicaciones=true;
        $imagen_portada='';

        $imagenes = $meta['id_imagenes'][0]; 
        $array_prueba=explode(",", $imagenes);
        $borrado = array_pop($array_prueba);

        if(!empty($array_prueba)){

          foreach ($array_prueba as $key) {
              $url=wp_get_attachment_url( $key, 'thumbnail');
              $info = new SplFileInfo($url);
              $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

              if(strcmp($extension,'jpg')==0 || strcmp($extension,'gif')==0 || strcmp($extension,'jpeg')==0 || strcmp($extension,'png')==0 || strcmp($extension,'bmp')==0){

              $imagen_portada=wp_get_attachment_image( $key, 'medium', "", array( "style"=>"max-width:560px","id" => "bodyImage","mc:label"=>"body_image","mc:edit"=>"body_image"));     
             }
          }
        }

        $precio_actual='';
        $metro_cons='';
        $hab_='';
        $banos_='';

              
            if(!empty($meta['id_precio'][0])){
               $precio_actual= number_format($meta['id_precio'][0], 0, ',', '.') . $simbolo;
            }

        if(!strcmp($meta['id_construido'][0],'')==0){
          $metro_cons=' <p><span>Metros cuadrado: </span>' . number_format($meta['id_construido'][0], 0, ',', '.') . 'm&#178</p>';
        }

        if(!strcmp($meta['id_habitaciones'][0],'')==0){
          $hab_='<p><span>Habitaciones: </span>' . $meta['id_habitaciones'][0] . '</p>';
        }

        if(!strcmp($meta['id_banos'][0],'')==0){          
              $banos_='<p><span>Baños: </span>' . $meta['id_banos'][0] . '</p>';          
        }
        
        $body .= '<tr>
                                          <td class="bodyContent" style="padding-top:0; padding-bottom:0;">
                                            <a href="' . get_permalink() . '">
                                              ' . $imagen_portada . '                                              </a>
                                            </td>                                        
                                        </tr>
                                        <tr>
                                            <td valign="top" class="bodyContent" mc:edit="body_content01">
                                              <a href="' . get_permalink() . '">
                                                  <h2>' . get_the_title() . '</h2>
                                                  <h4>' . strip_tags (get_the_term_list( get_the_ID(), 'localidad', "",", " )) . '</h4>
                                                  <h5>' . $meta['id_tipo'][0] . '</h5><p id="precio">' . $precio_actual . '</p>' . $metro_cons . $hab_ . $banos_ . '    
                                                </a>

                                            </td>

                                        </tr>
                                        <tr><td><div style="border-top: 1px solid #CCCCCC;background-color:white;width:100%;height:20px"></div></td></tr>';
      }

      
                                      
        
    endwhile; 
       
      $body_cabecera='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Suscripción ' . $nombre_inmo . '</title>
        <style type="text/css">
      #outlook a{padding:0;} 
      .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} 
      .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
      body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;}
      table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} 
      img{-ms-interpolation-mode:bicubic;}
      body{margin:0; padding:0;}
      img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
      table{border-collapse:collapse !important;}
      body, #bodyTable, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;}

      #bodyCell{padding:20px;}
      #templateContainer{width:600px;}

      body, #bodyTable{
         background-color:#DEE0E2;
      }
      #bodyCell{
        border-top:4px solid #BBBBBB;
      }
      #templateContainer{
        border:1px solid #BBBBBB;
      }
      h1{
        color:#202020 !important;
        display:block;
        font-family:Helvetica;
        font-size:26px;
        font-style:normal;
        font-weight:bold;
        line-height:100%;
        letter-spacing:normal;
        margin-top:0;
        margin-right:0;
        margin-bottom:10px;
        margin-left:0;
        text-align:left;
      }
      h2{
         color:black !important;
        display:block;
         font-family:Helvetica;
         font-size:20px;
         font-style:normal;
         font-weight:bold;
         line-height:100%;
         letter-spacing:normal;
        margin-top:0;
        margin-right:0;
        margin-bottom:10px;
        margin-left:0;
         text-align:left;
      }
      a {
    text-decoration: none!important;
    color: initial;
}
      h3{
         color:#606060 !important;
        display:block;
         font-family:Helvetica;
         font-size:16px;
         font-style:italic;
         font-weight:normal;
         line-height:100%;
         letter-spacing:normal;
        margin-top:0;
        margin-right:0;
        margin-bottom:10px;
        margin-left:0;
         text-align:left;
      }

            h4{
         color:black !important;
        display:block;
         font-family:Helvetica;
         font-size:14px;
         font-weight:normal;
         line-height:100%;
         letter-spacing:normal;
        margin-top:-3px;
        margin-right:0;
        margin-bottom:10px;
        margin-left:0;
         text-align:left;
      }

      h5{
              color: black !important;
              display: block;
              font-family: Helvetica;
              font-size:15px !important;
            line-height:100% !important;
              font-weight: bold;
              line-height: 100%;
              letter-spacing: normal;
              margin-top: -3px;
              margin-right: 0;
              margin-bottom: 10px;
              margin-left: 0;
              text-align: left;
        }

      #templateBody .bodyContent span{
  font-weight: bold;
}
  
   #templateBody .bodyContent #precio{
  font-weight: bold;
  font-size:16px;
}

      #templatePreheader{
         background-color:#F4F4F4;
         border-bottom:1px solid #CCCCCC;
      }

      
      #templateHeader{
         background-color:#F4F4F4;
         border-top:1px solid #FFFFFF;
         border-bottom:1px solid #CCCCCC;
      }
      .headerContent{
         color:red;
         font-family:Helvetica;
         font-size:20px;
         font-weight:bold;
         line-height:100%;
         padding-top:0;
         padding-right:0;
         padding-bottom:0;
         padding-left:0;
         text-align:left;
         vertical-align:middle;
      }
      .headerContent a:link, .headerContent a:visited,  .headerContent a .yshortcuts {
         color:#EB4102;
         font-weight:normal;
         text-decoration:underline;
      }

      #headerImage{
        height:auto;
        max-width:600px;
      }
      #templateBody{
         background-color:white;
         border-top:1px solid #FFFFFF;
         border-bottom:1px solid #CCCCCC;
      }
      .bodyContent{
         color:#505050;
         font-family:Helvetica;
         font-size:14px;
         line-height:150%;
        padding-top:20px;
        padding-right:20px;
        padding-bottom:20px;
        padding-left:20px;
         text-align:left;
      }

      .bodyContent a:link, .bodyContent a:visited,  .bodyContent a .yshortcuts {
         color:initial;
         font-weight:normal;
         text-decoration:none;
      }

      .bodyContent img{
        display:inline;
        height:auto;
        max-width:560px;
      }

      #templateFooter{
         background-color:#F4F4F4;
         border-top:1px solid #FFFFFF;
      }
      .footerContent{
         color:#808080;
         font-family:Helvetica;
         font-size:10px;
         line-height:150%;
        padding-top:20px;
        padding-right:20px;
        padding-bottom:20px;
        padding-left:20px;
         text-align:left;
      }

      
      .footerContent a:link, .footerContent a:visited,  .footerContent a .yshortcuts, .footerContent a span {
         color:#606060;
         font-weight:normal;
         text-decoration:underline;
      }

            @media only screen and (max-width: 480px){
        body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:none !important;} 
                body{width:100% !important; min-width:100% !important;} 
        #bodyCell{padding:10px !important;}

        
        #templateContainer{
          max-width:600px !important;
           width:100% !important;
        }
        h1{
           font-size:24px !important;
           line-height:100% !important;
        }
        h2{
           font-size:20px !important;
           line-height:100% !important;
        }
        h3{
           font-size:18px !important;
           line-height:100% !important;
        }

        h4{
           font-size:16px !important;
           line-height:100% !important;
        }


        #templatePreheader{display:none !important;} 
        #headerImage{
          height:auto !important;
           max-width:600px !important;
           width:100% !important;
        }
        .headerContent{
           font-size:20px !important;
           line-height:125% !important;
        }
        #bodyImage{
          height:auto !important;
           max-width:560px !important;
           width:100% !important;
        }
        .bodyContent{
        
           line-height:125% !important;
        }

        .footerContent{
           font-size:14px !important;
           line-height:115% !important;
        }

        .footerContent a{display:block !important;}
      }
    </style>
    </head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
      <center>
          <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
              <tr>
                  <td align="center" valign="top" id="bodyCell">
                      <table border="0" cellpadding="0" cellspacing="0" id="templateContainer">
                          <tr>
                              <td align="center" valign="top">
                                  
                                </td>
                            </tr>
                          <tr>
                              <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">
                                        <tr>
                                            <td valign="top" class="headerContent">
                                              <img src="http://venycompra.es/wp-content/themes/Venycompra/img/correo/logo.jpg" style="max-width:600px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                          <tr>
                              <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">
                                        <tr>
                                            <td valign="top" class="bodyContent" mc:edit="body_content00">
                                                <h1>Hay nuevos inmuebles</h1>
                                                <h3>Estos nuevos inmuebles cumplen con tus criterios: ' . $criterios . '</h3>
                                            </td>
                                        </tr>';

        $body_footer='   </table>
                                </td>
                            </tr>
                          <tr>
                              <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter">
                                        <tr>
                                            <td valign="top" class="footerContent" mc:edit="footer_content00">
                                                <a href="">Twitter</a>&nbsp;&nbsp;&nbsp;<a href="">Idealista</a>&nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>
                                     
                                        <tr>
                                            <td valign="top" class="footerContent" style="padding-top:0;" mc:edit="footer_content02">
                                              <a href="http://venycompra.es/baja?correo=' . $campo['correo'] . '">Pulsa aquí si deseas darte de baja de esta suscripción </a>&nbsp;&nbsp;&nbsp;
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>';
        
        

      if($publicaciones){

        require_once 'js/class.phpmailer.php';
        require_once 'js/class.smtp.php';
        require_once 'js/PHPMailerAutoload.php';


        $mail = new PHPMailer;
//           $mail->SMTPOptions = array(
//   'ssl' => array(
//     'verify_peer' => false,
//     'verify_peer_name' => false,
//     'allow_self_signed' => true
//   )
// );
        $mail->IsSMTP(); 
        $mail->SMTPDebug = 2; 
        $mail->SMTPAuth = $smtp_auth;
        $mail->SMTPSecure = $smtp_secure;
        $mail->Host = $servidor;
        $mail->Port = $puerto;
        $mail->Username = $correo;
        $mail->Password = $contra; 

        $mail->CharSet = 'UTF-8';

        $mail->From         = $correo;
        $mail->FromName     = $nombre_inmo;
        $mail->AddAddress($campo['correo'], 'Cliente');
        $mail->IsHTML(true);

        $mail->Subject = 'Nuevos inmuebles cumple tus criterios';  

         $body_correo =  $body_cabecera . $body . $body_footer;
       
        $mail->msgHTML($body_correo); 
        
        $mail->Send();
          
                             
    }

  }
    
    }catch (Exception $e){
          
        echo "Opsss ha ocurrido un error. <br>" . $e->getMessage();
          
    }finally{
            
         $base=NULL;
          
}//FIN CONECTAR BASE DE DATOS.  
}