jQuery(document).ready(function($) {

	ruta=$('.ruta').val();

//SOLO UN CHECKBOX SELECCIONADO
  $('.checkbox_seleccionables').click(function(event) {
      $('.checkbox_seleccionables').prop('checked', false);
      $(this).prop('checked', true);
  });

	//ELIMINA AGENTES
 	$("body").on('click', '.delete_agentes', function(event) {

     if( $('.checkbox_seleccionables').is(':checked') ) {

        var datosModificar={nombre:$('.checkbox_seleccionables:checked').siblings('.datos_seleccion').children('.id_agentes').val()};

        $.post(ruta + '/code/transferir_agente.php', datosModificar, procesarTransferencia);
      
      }		
     	                
  });

    function procesarTransferencia(DatosDevueltos){
      $('body').append(DatosDevueltos);
    }

    //Cancelar ventana.
    $('body').on('click', '.cancelar_transferir_agente', function(event) {
      event.preventDefault();
     $('.emergente').remove();
     $('.checkbox_seleccionables').prop('checked', false);
    });

    //Aceptar ventana
    $('body').on('click', '.aceptar_transferir_agente', function(event) {
      event.preventDefault();
      if( $('.checkbox_seleccionables').is(':checked') ) {
         var datosModificar={nombre:$('.checkbox_seleccionables:checked').siblings('.datos_seleccion').children('.id_agentes').val(),
                             agente:$('#select_emergente').val()};

      $.post(ruta + '/code/borrar_agente.php', datosModificar, procesarEliminarAgente);
      }
      $('.emergente').remove();
    });

   

    function procesarEliminarAgente(DatosDevueltos){
    	$(".checkbox_seleccionables:checked").each(function(index, el) {
	       	$(this).parent().remove();
	    });
	    $('.seleccion_checkbox').prop('checked', false);
	    contador=0;
		$('.datos_formulario').each(function(index, el) {
		contador++;
		});
		$('.contador').text(contador);
    }


    $('body').on('change', '#select_emergente', function(event) {
      event.preventDefault();
      if($('#select_emergente').val()=='eliminar_inmuebles'){
        $('.advertencia').css('visibility','visible');
      }else{
        $('.advertencia').css('visibility','hidden');
      }
    });


    //AÑADIR AGENTE
    $('.add').click(function(event) {
    	$('.wrap').load(ruta + '/code/agregar_agente.php');
    });

    $("body").on('submit', '.add_agente', function(event) {

      if($('.descripcion_nuevo_en')[0]){
          valor_en=$('.descripcion_nuevo_en').val();
          valor_de=$('.descripcion_nuevo_de').val();
          valor_fr=$('.descripcion_nuevo_fr').val();
          valor_it=$('.descripcion_nuevo_it').val();
          valor_se=$('.descripcion_nuevo_se').val();
      }else{
          valor_en='';
          valor_de='';
          valor_fr='';
          valor_it='';
          valor_se='';
      }

    	var datosModificar={nombre:$('.nombre_nuevo').val(),
    						telefono:$('.telefono_nuevo').val(),
    						correo:$('.correo_nuevo').val(),
    						contra:$('.contra_nuevo').val(),
    						servidor:$('.servidor_nuevo').val(),
    						puerto:$('.puerto_nuevo').val(),
    						secure:$('.secure_nuevo').val(),
    						auth:$('.auth_nuevo').val(),
    						foto:$('.foto_nuevo').val(),
                descripcion:$('.descripcion_nuevo').val(),
                descripcion_en:valor_en,
                descripcion_fr:valor_fr,
                descripcion_de:valor_de,
                descripcion_it:valor_it,
                descripcion_se:valor_se,
                contra_wordpress:$('.contra_wordpress_nuevo').val()};

	    $.post(ruta + '/code/agregar_agente_bbdd.php', datosModificar, procesarAgregarAgente);
	                
    });

    function procesarAgregarAgente(DatosDevueltos){
    }

    //EDITAR AGENTE
  $('.datos_seleccion').click(function(event) {
    nombre=$(this).children('.id_agentes').prop('value');
    nombre=nombre.replace(' ','_');
    nombre=nombre.replace(' ','_');
    nombre=nombre.replace(' ','_');
    $('.wrap').load(ruta + '/code/modificar_agente.php?nombre=' + nombre);
  });

  $("body").on('submit', '.edit_agente', function(event) {
    if($('.descripcion_nuevo_en')[0]){
          valor_en=$('.descripcion_nuevo_en').val();
          valor_de=$('.descripcion_nuevo_de').val();
          valor_fr=$('.descripcion_nuevo_fr').val();
          valor_it=$('.descripcion_nuevo_it').val();
          valor_se=$('.descripcion_nuevo_se').val();
      }else{
          valor_en='';
          valor_de='';
          valor_fr='';
          valor_it='';
          valor_se='';
      }
      var datosModificar={nombre:$('.nombre_nuevo').val(),
                telefono:$('.telefono_nuevo').val(),
                correo:$('.correo_nuevo').val(),
                contra:$('.contra_nuevo').val(),
                servidor:$('.servidor_nuevo').val(),
                puerto:$('.puerto_nuevo').val(),
                secure:$('.secure_nuevo').val(),
                auth:$('.auth_nuevo').val(),
                foto:$('.foto_nuevo').val(),
                descripcion:$('.descripcion_nuevo').val(),
                descripcion_en:$('.descripcion_nuevo_en').val(),
                descripcion_de:$('.descripcion_nuevo_de').val(),
                descripcion_fr:$('.descripcion_nuevo_fr').val(),
                descripcion_it:$('.descripcion_nuevo_it').val(),
                descripcion_se:$('.descripcion_nuevo_se').val(),};

      $.post(ruta + '/code/modificar_agente_bbdd.php', datosModificar, procesarAgregarAgente);
                  
    });

    //AGREGAR FOTO
    var formfield;
    var cargar_imagen;
   $('body').on( "click",'.add_foto', function(e) {
        e.preventDefault();
        cargar_imagen.open();
        return false;
    });

     cargar_imagen = wp.media.frames.file_frame = wp.media({
      title: 'Selecciona la imagen',
      button: {
      text: 'Asignar'
    }, multiple: false 
	});

     cargar_imagen.on('select', function() {
      var attachment = cargar_imagen.state().get('selection').first().toJSON();
      $('.img_foto').attr('src', attachment.url);
      $('.foto_nuevo').attr('value', attachment.id);

    });

    //VERIFICAR DATOS CORREO
    $("body").on('click', '.verificar_correo', function(event) {
      
      var datosModificar={correo:$('.correo_nuevo').val(),
                          password:$('.contra_nuevo').val(),
                          host:$('.servidor_nuevo').val(),
                          puerto:$('.puerto_nuevo').val(),
                          secure:$('.secure_nuevo').val(),
                          auth:$('.auth_nuevo').val()};

      $.post(ruta + 'code/prueba_configuracion.php', datosModificar, procesarPrueba);

      return false;
          
  });

  function procesarPrueba(datos){

    if(datos=='ok'){
      $('.si').css('background', '#7ad03a');
      $('.error').css('opacity', '1');
      $('.error').text('Correcto, revisa la bandeja entrada de ' + $(".correo_nuevo").val() );
    }else{
      $('.no').css('background', '#dc3232');
      $('.error').css('opacity', '1');
      $('.error').text('Mensaje del error: ' + datos);
    }
  }
    
//CHECK AGENTES VISIBLES DESDE LA WEB
$('.check_agentes').change(function(event) {
  if( $(this).prop('checked') ) {
    var datosModificar={estado:'true'};
    $.post(ruta + 'code/estado_agentes.php', datosModificar, procesarEstado);
  }else{
    var datosModificar={estado:'false'};
    $.post(ruta + 'code/estado_agentes.php', datosModificar, procesarEstado);
  }   
});

function procesarEstado(Datos){}

});