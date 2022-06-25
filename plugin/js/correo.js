jQuery(document).ready(function($) {

  ruta=$('.ruta').val();
    
    //VERIFICAR DATOS CORREO
    $(".verificar_correo").click(function(event) {

      var datosModificar={correo:$(".correo_inmo").val(),
                          password:$(".contra_inmo").val(),
                            host:$(".servidor_inmo").val(),
                            puerto:$(".puerto_inmo").val(),
                            secure:$(".secure_inmo").val(),
                           auth:$('.auth_inmo').val(),};

      $.post(ruta + '/code/prueba_configuracion.php', datosModificar, procesarPrueba);

      return false;
          
  });

  function procesarPrueba(datos){

    if(datos=='ok'){
      $('.si').css('background', '#7ad03a');
      $('.error').css('opacity', '1');
      $('.error').text('Correcto, revisa la bandeja entrada de ' + $(".correo_inmo").val() );
    }else{
      $('.no').css('background', '#dc3232');
      $('.error').css('opacity', '1');
      $('.error').text('Mensaje del error: ' + datos);
    }
  }
    
});