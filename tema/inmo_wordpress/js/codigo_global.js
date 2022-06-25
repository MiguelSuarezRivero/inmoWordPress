jQuery(document).ready(function($) {
	
//URL
url='http://localhost/Proyectos/InmoWordpress';


//SIMBOLO MONEDA
simbolo_moneda=$('.simbolo_moneda').val();

//COOKIES
$("#aceptar-cookies").click(cerrar_cookies);

if (localStorage.controlcookie>0){    
    $("#cookies").hide();        
}else{
    $("#cookies").removeClass('oculto');
}

function cerrar_cookies() {
    // si la variable no existe se crea (al clicar en Aceptar)
    localStorage.controlcookie = (localStorage.controlcookie || 0); 
   	localStorage.controlcookie++; // incrementamos cuenta de la cookie
    $("#cookies").addClass('cerrar'); // Esconde la política de cookies
}

//IDIOMA
$('.bandera').click(function(event) {
	$.post(url + '/wp-content/themes/inmo_wordpress/gestiona_idioma.php', {idioma: $(this).children('.idioma').val()}, function(data, textStatus, xhr) {
		location.reload();
	});
});

$('.logotipo').click(function(event) {
	$('header .menu').addClass('mostrar_nav');;
});

$('header nav .svg_salir_nav').click(function(event) {
	$('header .menu').removeClass('mostrar_nav');
});

$('#busqueda .logotipo').click(function(event) {
	$('#busqueda #nav').addClass('mostrar_nav');;
});

$('#busqueda #nav .svg_salir_nav').click(function(event) {
	$('#busqueda #nav').removeClass('mostrar_nav');
});


modalidad_seleccionada('section .navegador p:nth-child(2)');
modalidad_seleccionada('section .navegador p:nth-child(3)');
modalidad_seleccionada('section .navegador p:nth-child(4)');

var contador=0;

$('.solapa').click(function(event) {

	if(contador % 2 == 0){
		$('#solapa_abrir').css('left', '-40px');
		$('#solapa_cerrar').css('left', '9px');
		$('.single article .flotante_contacto').css('left', '0px');
		contador++;
	}else{
		$('#solapa_abrir').css('left', '0px');
		$('#solapa_cerrar').css('left', '49px');
	    $('.single article .flotante_contacto').css('left', '-260px');
		contador++;
	}
	
});

//ENVIAR CORREO
	$('.correo_contacto').submit(function(event) {
	var datosModificar={nombre:$(".politicas .nombre").val(),
						telefono:$(".politicas .telefono").val(),
						correo:$(".politicas .correo").val(),
						asunto:$(".politicas .asunto").val(),
						mensaje:$(".politicas .mensaje").val()};

		$.post( url + '/submit/', datosModificar, procesarCorreo);

		return false;
		
	});

	$('.correo_single').submit(function(event) {
	var datosModificar={nombre:$(".flotante_contacto .nombre").val(),
						telefono:$(".flotante_contacto .telefono").val(),
						correo:$(".flotante_contacto .email").val(),
					  	mensaje:$(".flotante_contacto .mensaje").val(),
			     		agente_activo:$(".flotante_contacto .nombre_agente").val()};
	
		$.post( url + '/submit-single/', datosModificar, procesarCorreo);

		return false;
		
	});


function procesarCorreo(respuesta){
	texto_retornado=respuesta.search('enviado');
	
		switch(texto_retornado) {
    case 2:
    	  	$(".politicas .nombre").val('');
    		$(".politicas .telefono").val('');
    		$(".politicas .correo").val('');
    		$(".politicas .asunto").val('');
    		$(".politicas .mensaje").val('');
    		$(".flotante_contacto .nombre").val('');
    		$(".flotante_contacto .email").val('');
    		$(".flotante_contacto .telefono").val('');
			swal(
		  '¡Mensaje recibido!',
		  'Gracias por el interés mostrado',
		  'success'
		);	     
    		   
        break;
 	default:
 			$(".politicas .nombre").val('');
    		$(".politicas .telefono").val('');
    		$(".politicas .correo").val('');
    		$(".politicas .asunto").val('');
    		$(".politicas .mensaje").val('');
    		$(".flotante_contacto .nombre").val('');
    		$(".flotante_contacto .email").val('');
    		$(".flotante_contacto .telefono").val('');
			swal(
		  '¡Ha ocurrido un error!',
		  'Revisa que tu cuenta de correo sea correcta, si el error persiste intentalo más tarde.',
		  'error'
		);
   		    
        break;
   
	} 
	 
}

//CALCULAR HIPOTECA
$('.calcular').click(function(event) {
	var datosHipoteca={	valor:$('.valor').val(),
					  entrada:$('.pago_inicial').val(),
					  interes:$('.interes').val(),
					 duracion:$('.years').val()};

		$.post(url + '/hipoteca/', datosHipoteca, procesarCalculo);
		
	});

function procesarCalculo(Resultado){
	$('.p_resultado').css('display', 'block');
	$('.asterisco').css('display', 'block');
	$('.resultado').html(Resultado);
}

// GESTIONA BUSCADOR

$('#form_filtros').submit(function(event) {
	event.preventDefault();
});

if($('#select_modalidad').val()=='venta'){
	$(".lista_compra").css("display", "inline-block");
	$(".lista_alquiler").css("display", "none");
	$(".contiene_localidad_comprar").css("display", "inline-block");
	$(".contiene_localidad_alquilar").css("display", "none");
}else{
	$(".lista_compra").css("display", "none");
	$(".lista_alquiler").css("display", "inline-block");
	$(".contiene_localidad_comprar").css("display", "none");
	$(".contiene_localidad_alquilar").css("display", "inline-block");
}

$('#select_modalidad').change(function(event) {

	opcion_modalidad=$('#select_modalidad').val();
	
	switch(opcion_modalidad) {
    case 'venta':
    		$(".lista_compra").css("display", "inline-block");
			$(".lista_alquiler").css("display", "none");
			$(".contiene_localidad_comprar").css("display", "inline-block");
			$(".contiene_localidad_alquilar").css("display", "none");    
        break;
   case 'alquiler':
   		    $('.lista_compra').css('display', 'none'); 
   		    $('.lista_alquiler').css('display', 'inline-block');
   		    $(".contiene_localidad_comprar").css("display", "none");
			$(".contiene_localidad_alquilar").css("display", "inline-block");     
        break;
   
} 
	
});

borrar_opcion_index('poblacion_comprar');
borrar_opcion_index('habitaciones_comprar');
borrar_opcion_index('precio_comprar_min');
borrar_opcion_index('precio_comprar_max');
borrar_opcion_index('poblacion_alquilar');
borrar_opcion_index('habitaciones_alquilar');
borrar_opcion_index('precio_alquiler_min');
borrar_opcion_index('precio_alquiler_max');

function borrar_opcion_index(select){
	$('#' + select + '').change(function(event) {
			if($(this).val()=='todos'){
				$(this)[0].selectedIndex = 'Todos';
			}
		});
}


filtro_ajax('cuadro_texto',false);
filtro_ajax('select_modalidad',false);
filtro_ajax('select_localidad_compra',true);
filtro_ajax('select_localidad_alquilar',true);
filtro_ajax('select_tipo',true);
filtro_ajax('select_habitaciones',true);
filtro_ajax('select_precio_compra_min',true);
filtro_ajax('select_precio_compra_max',true);
filtro_ajax('select_precio_alquiler_min',true);
filtro_ajax('select_precio_alquiler_max',true);


function procesarDatos(DatosDevueltos){
	$.get(url + '/wp-content/themes/inmo_wordpress/lang/' + $('#idioma').val() + '.xml', function (xml) {
	    $(xml).find("pagina_buscar").each(function () {
	       var mayor = $(this).find('mayor_precio').text();
	       var menor = $(this).find('menor_precio').text();
		    $('.busqueda').html(DatosDevueltos);
		    $('.mySlides').css('display', 'none');
			$('.elem1').css('display', 'block');
			$('.marcadores .marcador:first-child' ).addClass('marcador_seleccionado');
			if($(".ordenar").val()=='ASC'){
				$('.ordenar_precio span').text(mayor);
			}else{
				$('.ordenar_precio span').text(menor);
			}
		});
	});
}


function filtro_ajax(select,condicion){

	if(condicion){

		$('#' + select + '').change(function(event) {
			if($(this).val()=='todos'){
				$(this)[0].selectedIndex = 'Todos';
			}
		});

	}

	$('#' + select + '').change(function(event) {
		
	var datosModificar={ordenar_by:$(".ordenar").val(),
						texto_busqueda:$("#cuadro_texto").val(),
						modalidad_seleccionada:$("#select_modalidad").val(),
						localidad_seleccionada_compra: $("#select_localidad_compra").val(),
               			localidad_seleccionada_alquilar: $("#select_localidad_alquilar").val(),
						tipo_seleccionada:$("#select_tipo").val(),
						habitaciones_seleccionada:$("#select_habitaciones").val(),
						precio_compra_min:$("#select_precio_compra_min").val(),
						precio_compra_max:$("#select_precio_compra_max").val(),
						precio_alquiler_min:$("#select_precio_alquiler_min").val(),
					   	precio_alquiler_max:$("#select_precio_alquiler_max").val()};

		$.post(url + '/gestor/', datosModificar, procesarDatos);
		
	});
}

$(document).on('click','.ordenar_precio', function(event) {
	if($(".ordenar").val()=='ASC'){
		$('.ordenar').val('DESC');
	}else{
		$('.ordenar').val('ASC');
	}

	var datosModificar={ordenar_by:$(".ordenar").val(),
						texto_busqueda:$("#cuadro_texto").val(),
						modalidad_seleccionada:$("#select_modalidad").val(),
						localidad_seleccionada_compra: $("#select_localidad_compra").val(),
               			localidad_seleccionada_alquilar: $("#select_localidad_alquilar").val(),
						tipo_seleccionada:$("#select_tipo").val(),
						habitaciones_seleccionada:$("#select_habitaciones").val(),
						precio_compra_min:$("#select_precio_compra_min").val(),
						precio_compra_max:$("#select_precio_compra_max").val(),
						precio_alquiler_min:$("#select_precio_alquiler_min").val(),
					   	precio_alquiler_max:$("#select_precio_alquiler_max").val()};

		$.post(url + '/gestor/', datosModificar, procesarDatos);
});

//ELIMINAR ESPACIOS EN BLANCO EN LOS SELECT DE LAS LOCALIDADES
anterior_comprar='';
option_anterior='';
$("#select_localidad_compra").change(function(event) {
	if(anterior_comprar===''){
		texto_original=$("#select_localidad_compra option:selected").text();
		anterior_comprar=texto_original;
		option_anterior=$("#select_localidad_compra option:selected").val();
		texto_cambiado=jQuery.trim($("#select_localidad_compra option:selected").text());
		$("#select_localidad_compra option:selected").text(texto_cambiado);
	}else{
		$("#select_localidad_compra option[value=" + option_anterior + "]").text(texto_original);
		texto_original=$("#select_localidad_compra option:selected").text();
		anterior_comprar=texto_original;
		option_anterior=$("#select_localidad_compra option:selected").val();
		texto_cambiado=jQuery.trim($("#select_localidad_compra option:selected").text());
		$("#select_localidad_compra option:selected").text(texto_cambiado);

	}	
});

anterior_alquilar='';
option_anterior_alquilar='';
$("#select_localidad_alquilar").change(function(event) {
	if(anterior_alquilar===''){
		texto_original_alquilar=$("#select_localidad_alquilar option:selected").text();
		anterior_alquilar=texto_original_alquilar;
		option_anterior_alquilar=$("#select_localidad_alquilar option:selected").val();
		texto_cambiado_alquilar=jQuery.trim($("#select_localidad_alquilar option:selected").text());
		$("#select_localidad_alquilar option:selected").text(texto_cambiado_alquilar);
	}else{
		$("#select_localidad_alquilar option[value=" + option_anterior_alquilar + "]").text(texto_original_alquilar);
		texto_original_alquilar=$("#select_localidad_alquilar option:selected").text();
		anterior_alquilar=texto_original_alquilar;
		option_anterior_alquilar=$("#select_localidad_alquilar option:selected").val();
		texto_cambiado_alquilar=jQuery.trim($("#select_localidad_alquilar option:selected").text());
		$("#select_localidad_alquilar option:selected").text(texto_cambiado_alquilar);

	}	
});


//QUITAR FILTROS
$(document).on('click','.borrar_filtros', function(event) {
	$(".ordenar").val('ASC');
	$("#cuadro_texto").val('');
	$('#select_localidad_compra')[0].selectedIndex = 'Todos';
	$('#select_localidad_alquilar')[0].selectedIndex = 'Todos';
	$('#select_tipo')[0].selectedIndex = 'Todos';
	$('#select_habitaciones')[0].selectedIndex = 'Todos';
	$('#select_precio_compra_min')[0].selectedIndex = 'Todos';
	$('#select_precio_compra_max')[0].selectedIndex = 'Todos';
	$('#select_precio_alquiler_min')[0].selectedIndex = 'Todos';
	$('#select_precio_alquiler_max')[0].selectedIndex = 'Todos';

	var datosModificar={ordenar_by:$(".ordenar").val(),
						texto_busqueda:$("#cuadro_texto").val(),
						modalidad_seleccionada:$("#select_modalidad").val(),
						localidad_seleccionada_compra: $("#select_localidad_compra").val(),
               			localidad_seleccionada_alquilar: $("#select_localidad_alquilar").val(),
						tipo_seleccionada:$("#select_tipo").val(),
						habitaciones_seleccionada:$("#select_habitaciones").val(),
						precio_compra_min:$("#select_precio_compra_min").val(),
						precio_compra_max:$("#select_precio_compra_max").val(),
						precio_alquiler_min:$("#select_precio_alquiler_min").val(),
					   	precio_alquiler_max:$("#select_precio_alquiler_max").val()};

		$.post(url + '/gestor/', datosModificar, procesarDatos);
	
});

//Ponemos a la escucha a los enlaces del paginado
	$(document).on('click','.inactive', function(event) {
	
	var datosModificar={ordenar_by:$(".ordenar").val(),
						texto_busqueda:$("#cuadro_texto").val(),
						modalidad_seleccionada:$("#select_modalidad").val(),
						localidad_seleccionada_compra: $("#select_localidad_compra").val(),
               			localidad_seleccionada_alquilar: $("#select_localidad_alquilar").val(),
						tipo_seleccionada:$("#select_tipo").val(),
						habitaciones_seleccionada:$("#select_habitaciones").val(),
						precio_compra_min:$("#select_precio_compra_min").val(),
						precio_compra_max:$("#select_precio_compra_max").val(),
						precio_alquiler_min:$("#select_precio_alquiler_min").val(),
					   	precio_alquiler_max:$("#select_precio_alquiler_max").val(),
					   	pagina_actual:$(this).text()};

		$.post(url + '/gestor/', datosModificar, procesarDatos);
		
	});

function modalidad_seleccionada(opcion){
	$(opcion).click(function(event) {
	$('section .navegador p:nth-child(2)').removeClass('modalidad_seleccionada');
	$('section .navegador p:nth-child(3)').removeClass('modalidad_seleccionada');
	$('section .navegador p:nth-child(4)').removeClass('modalidad_seleccionada');
	$(this).addClass('modalidad_seleccionada');

	if(opcion=='section .navegador p:nth-child(2)'){
		$('#imagen_fondo').animate({opacity: 0}, 500, "linear", function() {
			$('section .contenedor_fondo picture img').css('opacity', '1');
    		$('section .contenedor_fondo picture img').attr('src', url + '/wp-content/themes/inmo_wordpress/img/fondo1.jpg');
    		$('section .contenedor_fondo picture .media1').attr('srcset', url + '/wp-content/themes/inmo_wordpress/img/fondo1_700.jpg');
    		$('section .contenedor_fondo picture .media2').attr('srcset', url + '/wp-content/themes/inmo_wordpress/img/fondo1_480.jpg');
    		$.get(url + '/wp-content/themes/inmo_wordpress/lang/' + $('#idioma').val() + '.xml', function (xml) {
		    $(xml).find("inmo_wordpress").each(function () {
		       var encuentra = $(this).find('encuentra_comprar').text();
			    $('section .navegador h2').text(encuentra);
				});
			});
    		
 		 });
		$('#input_modalidad').attr('value', 'comprar');
		$('section .navegador form').removeClass('ocultar');
		$('.modalidad_alquilar').addClass('ocultar');
		$('.modalidad_vender').addClass('ocultar');
		$('.modalidad_comprar').removeClass('ocultar');
		$('.modalidad_alquilar').removeClass('mostrar');
		$('.modalidad_comprar').addClass('mostrar');
		$('#input_modalidad').val('venta');
	}else if(opcion=='section .navegador p:nth-child(3)'){
		$('#imagen_fondo').animate({opacity: 0}, 500, "linear", function() {
			$('section .contenedor_fondo picture img').css('opacity', '1');
    		$('section .contenedor_fondo picture img').attr('src', url + '/wp-content/themes/inmo_wordpress/img/fondo2.jpg');
    		$('section .contenedor_fondo picture .media1').attr('srcset', url + '/wp-content/themes/inmo_wordpress/img/fondo2_700.jpg');
    		$('section .contenedor_fondo picture .media2').attr('srcset', url + '/wp-content/themes/inmo_wordpress/img/fondo2_480.jpg');
    		$.get(url + '/wp-content/themes/inmo_wordpress/lang/' + $('#idioma').val() + '.xml', function (xml) {
		    $(xml).find("inmo_wordpress").each(function () {
		       var encuentra = $(this).find('encuentra_alquilar').text();
			    $('section .navegador h2').text(encuentra);
				});
			});
 		 });
		$('#input_modalidad').attr('value', 'alquilar');
		$('section .navegador form').removeClass('ocultar');
		$('.modalidad_comprar').addClass('ocultar');
		$('.modalidad_vender').addClass('ocultar');
		$('.modalidad_alquilar').removeClass('ocultar');
		$('.modalidad_comprar').removeClass('mostrar');
		$('.modalidad_alquilar').addClass('mostrar');
		$('#input_modalidad').val('alquiler');
	}else{
		$('#imagen_fondo').animate({opacity: 0}, 500, "linear", function() {
			$('section .contenedor_fondo picture img').css('opacity', '1');
    		$('section .contenedor_fondo picture img').attr('src', url + '/wp-content/themes/inmo_wordpress/img/fondo3.jpg');
    		$('section .contenedor_fondo picture .media1').attr('srcset', url + '/wp-content/themes/inmo_wordpress/img/fondo3_700.jpg');
    		$('section .contenedor_fondo picture .media2').attr('srcset', url + '/wp-content/themes/inmo_wordpress/img/fondo3_480.jpg');
    		$.get(url + '/wp-content/themes/inmo_wordpress/lang/' + $('#idioma').val() + '.xml', function (xml) {
		    $(xml).find("inmo_wordpress").each(function () {
		       var encuentra = $(this).find('unete').text();
			    $('section .navegador h2').text(encuentra);
				});
			});
 		 });

		$('#input_modalidad').attr('value', 'vender');
		$('.modalidad_vender').removeClass('ocultar');
		$('section .navegador form').addClass('ocultar');
	}
	
});
}

//SLIDERS
$('.mySlides').css('display', 'none');
$('.elem1').css('display', 'block');
$('.marcadores .marcador:first-child' ).addClass('marcador_seleccionado');

//Boton derecha
$(document).on('click','.derecha', function(event) {
  	event.preventDefault();
    if($(this).parent().children('.elem_actual').val()==$(this).parent().children('.num_elem').val()){
       prox_elem=1;
    }else{
       prox_elem=parseInt($(this).parent().children('.elem_actual').val()) + 1;
    }
    $(this).parent().children().children('.mySlides').css('display', 'none');
    $(this).parent().children('.mySlides').css('display', 'none');
    $(this).parent().children().children('.elem' + prox_elem + '').css('display', 'block');
    $(this).parent().children('.elem' + prox_elem + '').css('display', 'block');
    $(this).parent().children('.elem_actual').val(prox_elem);
    $(this).parent().children().children('.marcador').removeClass('marcador_seleccionado');
    $(this).parent().children().children('.marcador:nth-child(' + prox_elem + ')').addClass('marcador_seleccionado');
    
    if($('.carrusel_imagenes').length){
    	if($('.carrusel_imagenes .elem' + $('.elem_actual').val() + '')[0].tagName=='VIDEO'){
			$('.single article .entrada .carrusel_imagenes .marcadores').css('bottom', '38px');
		}else{
			$('.single article .entrada .carrusel_imagenes .marcadores').css('bottom', '10px');
		}
    }

    if($(this).parent().hasClass('imagen')){
    	if ( $(this).siblings('.elem' + prox_elem + '').length ) {
	    	if($(this).siblings('.elem' + prox_elem + '')[0].tagName=='VIDEO'){
				$(this).parent().children('.marcadores').css('bottom', '148px');			
			}
    	}else{			
				$(this).parent().children('.marcadores').css('bottom', '10px');
			}
	}
    
  });
//Boton izquierda
 $(document).on('click','.izquierda', function(event) {
  	event.preventDefault();
    if($(this).parent().children('.elem_actual').val()==1){
       prox_elem=$(this).parent().children('.num_elem').val();
    }else{
       prox_elem=parseInt($(this).parent().children('.elem_actual').val()) - 1;
    }
     $(this).parent().children().children('.mySlides').css('display', 'none');
    $(this).parent().children('.mySlides').css('display', 'none');
    $(this).parent().children().children('.elem' + prox_elem + '').css('display', 'block');
    $(this).parent().children('.elem' + prox_elem + '').css('display', 'block');
    $(this).parent().children('.elem_actual').val(prox_elem);
    $(this).parent().children().children('.marcador').removeClass('marcador_seleccionado');
    $(this).parent().children().children('.marcador:nth-child(' + prox_elem + ')').addClass('marcador_seleccionado');
    
    if($('.carrusel_imagenes').length){
    	if($('.carrusel_imagenes .elem' + $('.elem_actual').val() + '')[0].tagName=='VIDEO'){
			$('.single article .entrada .carrusel_imagenes .marcadores').css('bottom', '38px');
		}else{
			$('.single article .entrada .carrusel_imagenes .marcadores').css('bottom', '10px');
		}
    }

    if($(this).parent().hasClass('imagen')){
    	if ( $(this).siblings('.elem' + prox_elem + '').length ) {
	    	if($(this).siblings('.elem' + prox_elem + '')[0].tagName=='VIDEO'){
				$(this).parent().children('.marcadores').css('bottom', '148px');			
			}
    	}else{			
				$(this).parent().children('.marcadores').css('bottom', '10px');
			}
	}
    
  });
//Marcadores
$(document).on('click','.marcador', function(event) {
	event.preventDefault();
  $(this).parent().parent().children().children('.marcador').removeClass('marcador_seleccionado');
  $(this).addClass('marcador_seleccionado');
  prox_elem=parseInt($(this).index()+1);
   $(this).parent().parent().children().children('.mySlides').css('display', 'none');
   $(this).parent().parent().children('.mySlides').css('display', 'none');
   $(this).parent().parent().children().children('.elem' + prox_elem + '').css('display', 'block');
   $(this).parent().parent().children('.elem' + prox_elem + '').css('display', 'block');
   $(this).parent().parent().children('.elem_actual').val(prox_elem);

  if($('.carrusel_imagenes').length){
    	if($('.carrusel_imagenes .elem' + $('.elem_actual').val() + '')[0].tagName=='VIDEO'){
			$('.single article .entrada .carrusel_imagenes .marcadores').css('bottom', '38px');
		}else{
			$('.single article .entrada .carrusel_imagenes .marcadores').css('bottom', '10px');
		}
    }

    if($(this).parent().parent().hasClass('imagen')){
    	if ( $(this).parent().parent().children('.elem' + prox_elem + '').length ) {
	    	if($(this).parent().parent().children('.elem' + prox_elem + '')[0].tagName=='VIDEO'){
				$(this).parent().parent().children('.marcadores').css('bottom', '148px');			
			}
	    }else{			
				$(this).parent().parent().children('.marcadores').css('bottom', '10px');
			}
		}

});

//ABRIR MAPA
mapa=false;

$('.boton_mostrar_mapa').click(function(event) {
	if(mapa){
		$('.mini_mapa_google').css('left', '-5000px');
		$(this).children('p').text('Abrir Mapa');
		mapa=false;

	}else{
		$('.mini_mapa_google').css('left', 'initial');
		$(this).children('p').text('Ocultar');
		mapa=true;

	}
	
});

//POSICIÓN CONTACTO FLOTANTE
$(window).on('scroll', function(event) {

	if ( $(".flotante_contacto").length ) {

		var posicion_fija = $("footer").offset().top - 415;
		var posicion_flotante= $(".flotante_contacto_guess").offset().top;
	  	var posicion_flotante_movil= $(".flotante_contacto").offset().top;

		if(posicion_flotante >= posicion_fija){
			$(".flotante_contacto").css('position', 'absolute');
			$(".flotante_contacto").css('top', posicion_fija);
		}else{
			$(".flotante_contacto").css('position', 'fixed');
			$(".flotante_contacto").css('top', '109px');
		}

		if(posicion_flotante_movil >= posicion_fija){
			$('.solapa').css('left', '-50px');
		}else{
			$('.solapa').css('left', '-4px');
		}

	}

});


//NOTIFICACIONES
$('.notificaciones span').click(function(event) {
	
	$('.datos_notificacion').css('display', 'block');

	var opciones_seleccionadas='';

	$.get(url + '/wp-content/themes/inmo_wordpress/lang/' + $('#idioma').val() + '.xml', function (xml) {
	    $(xml).find("pagina_buscar").each(function () {
	       var casa = $(this).find('casa').text();
	       var piso = $(this).find('piso').text();
	       var apartamento = $(this).find('apartamento').text();
	       var edificio = $(this).find('edificio').text();
	       var terreno = $(this).find('terreno').text();
	       var chalet = $(this).find('chalet').text();
	       var otros = $(this).find('otros').text();
	       var local = $(this).find('local').text();
	       var garaje = $(this).find('garaje').text();
	       var todos_venta = $(this).find('todos_venta').text();
	       var filtro_venta = $(this).find('filtro_venta').text();
	       var todos_alquiler = $(this).find('todos_alquiler').text();
	       var filtro_alquiler = $(this).find('filtro_alquiler').text();
	       var habitacion = $(this).find('habitacion').text();
	       var habitaciones = $(this).find('habitaciones').text();
	       var desde = $(this).find('desde').text();
	       var hasta = $(this).find('hasta').text();

	if($("#select_modalidad").val()=='venta'){

		if($("#select_localidad_compra").val()=='todos' && $("#select_tipo").val()=='todos' && $("#select_habitaciones").val()=='todos' &&  $("#select_precio_compra_min").val()=='todos' && $("#select_precio_compra_max").val()=='todos' && $("#cuadro_texto").val()==''){
			opciones_seleccionadas+='<p style="text-align:center;margin-bottom: 10px;">' + todos_venta + '</p>';
		}else{
			opciones_seleccionadas+='<p style="text-align:center;margin-bottom: 10px;">' + filtro_venta + '</p>';
			if($("#select_localidad_compra").val()!='todos'){
				opciones_seleccionadas+='<svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54.93 77"><path d="M67.45,44.34c-.14,10.82-4.52,21.51-12.26,30.94A79,79,0,0,1,40.69,88.7c-.44.32-.74.45-1.24.08-11.07-8-20-17.72-24.34-31-2.79-8.48-3.63-17.16-1-25.8,3.29-10.63,10.22-17.71,21.43-19.61C48.33,10.26,59.42,16.63,64.7,28.6A36.62,36.62,0,0,1,67.45,44.34ZM40,54.61A14.18,14.18,0,1,0,25.83,40.34,14.23,14.23,0,0,0,40,54.61Z" transform="translate(-12.53 -12)" style="fill:#fff"/></svg><p class="opciones_seleccionadas">' + jQuery.trim($("#select_localidad_compra option:selected").text()) + '</p><br>';
			}
			if($("#select_tipo").val()!='todos'){
				valor_tipo='';
				switch($("#select_tipo").val()) {
				    case 'casa':
				        valor_tipo=casa;
				        break;
				    case 'chalet':
				       valor_tipo=chalet;
				        break;
				    case 'piso':
				       valor_tipo=piso;
				        break;
				    case 'apartamento':
				       valor_tipo=apartamento;
				        break;
				    case 'edificio':
				       valor_tipo=edificio;
				        break;
				    case 'garaje':
				       valor_tipo=garaje;
				        break;
				    case 'terreno':
				       valor_tipo=terreno;
				        break;
				    case 'local':
				       valor_tipo=local;
				        break;
				    case 'otros':
				       valor_tipo=otros;
				        break;
				}
				opciones_seleccionadas+='<svg  data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 146.45 146.15"><path d="M107.13,80.32c0,8.83,0,17.65,0,26.48,0,6.27-2,8.18-8.43,8.2q-10.49,0-21,0c-6.31,0-8.34-2-8.36-8.38-.06-16,0-32,0-48,0-8.68-1.14-9.81-9.82-9.82-6.49,0-13,0-19.48,0s-8.32,1.77-8.33,8.25c0,16.15,0,32.31,0,48.46,0,7.67-1.79,9.44-9.35,9.44q-10,0-20,0c-6.65,0-8.44-1.82-8.45-8.64q0-26.73,0-53.46c0-3,.24-5.34-4.17-3.42C-13.75,51-19.23,47.17-22,42c-1.81-3.41-.37-6.07,2.11-8.43q32.49-31.07,65-62.12c4-3.79,7.11-3.43,11.67.92Q84.45-1.19,112,25.25q4.33,4.14,8.7,8.25c2.7,2.52,4,5.37,1.95,8.87-3.17,5.5-7.92,8.55-11.85,7-3.77-1.52-3.76.26-3.74,3C107.17,61.67,107.13,71,107.13,80.32Z" transform="translate(22.77 31.13)" style="fill:#fff"/></svg><p class="opciones_seleccionadas" style="text-transform:capitalize;">' + valor_tipo + '</p><br>';
			}
			if($("#select_habitaciones").val()=='1'){
				opciones_seleccionadas+='<svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.19 236.37"><path d="M134.39,229c-39,0-78,.1-117-.13-4.61,0-5.56,1.3-5.31,5.53.37,6.14,0,12.33.15,18.49.08,2.63-.72,3.47-3.34,3.33-5-.27-11.46,1.63-14.55-.84s-1-9.35-1-14.28c-.12-21.66,0-43.32-.08-65A30,30,0,0,1-4.34,164C4.93,142.17,14,120.23,23.26,98.38A21.35,21.35,0,0,0,25,89.71q-.1-28.74,0-57.49c0-8.21,3.2-11.38,11.52-11.38q98,0,196,0c8.54,0,11.63,3.16,11.64,11.8q0,29,0,58a17.93,17.93,0,0,0,1.46,7.23c9.36,22.17,18.62,44.39,28,66.56A26.69,26.69,0,0,1,275.72,175c0,25.66-.12,51.32.08,77,0,4-1.13,5.23-5,4.88-4.44-.4-10.42,1.39-13-.87-3-2.65-.65-8.76-1-13.35-.32-4.44,1.9-10.33-.92-12.89-2.41-2.19-8.21-.76-12.51-.76Q188.88,229,134.39,229Zm0-66.51c37.33,0,74.67-.05,112,.07,4.18,0,5.64-.34,3.63-5-6.93-16-13.52-32.14-20.12-48.27-1-2.43-2.09-3.59-5-3.57-8.6.07-8.6-.1-8.61,8.67,0,1.67.06,3.34,0,5-.33,5.73-3.76,9.47-9.44,9.52q-26.75.22-53.5,0c-6,0-9.4-3.73-9.61-9.81-.12-3.5,0-7,0-10.5,0-1.11.28-2.67-1.38-2.68-5.48,0-11.29-.9-16.29.69-2.15.69-.44,6.75-.73,10.35-.08,1,0,2-.08,3-.42,5.15-3.77,8.86-9,8.91q-27.25.26-54.5,0c-5.41-.05-8.76-3.8-9-9.35-.17-3.49,0-7-.09-10.5,0-1,0-2.23-.57-2.8-2.07-2.12-11.74.16-12.9,2.95-6.7,16.09-13.28,32.24-20.17,48.26-1.81,4.2-1.21,5.15,3.43,5.13C59.76,162.42,97.09,162.49,134.43,162.49ZM88.89,110.16c4.82,0,9.64-.11,14.46,0,2.38.08,3.17-.69,3.13-3.09q-.19-11.47,0-22.94c0-2.45-.87-3.08-3.2-3.05-9.47.11-19,.13-28.42,0-2.63,0-3.45.8-3.4,3.39.13,7.48.17,15,0,22.44-.07,2.8,1,3.36,3.5,3.27C79.57,110,84.23,110.16,88.89,110.16Zm91.55-29c-5,0-10,.08-15,0-2.12,0-3,.66-2.94,2.84.08,7.81.1,15.63,0,23.44,0,2.22.75,2.81,2.87,2.79q14.71-.13,29.42,0c2.32,0,2.72-1,2.7-3-.08-7.65-.1-15.29,0-22.94,0-2.33-.68-3.26-3.12-3.18C189.75,81.28,185.09,81.17,180.43,81.17Z" transform="translate(7.39 -20.83)" style="fill:#fff"/></svg><p class="opciones_seleccionadas">' + $("#select_habitaciones").val() + ' ' + habitacion + '</p><br>';
			}
			if($("#select_habitaciones").val()!='1' && $("#select_habitaciones").val()!='todos'){
				opciones_seleccionadas+='<svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.19 236.37"><path d="M134.39,229c-39,0-78,.1-117-.13-4.61,0-5.56,1.3-5.31,5.53.37,6.14,0,12.33.15,18.49.08,2.63-.72,3.47-3.34,3.33-5-.27-11.46,1.63-14.55-.84s-1-9.35-1-14.28c-.12-21.66,0-43.32-.08-65A30,30,0,0,1-4.34,164C4.93,142.17,14,120.23,23.26,98.38A21.35,21.35,0,0,0,25,89.71q-.1-28.74,0-57.49c0-8.21,3.2-11.38,11.52-11.38q98,0,196,0c8.54,0,11.63,3.16,11.64,11.8q0,29,0,58a17.93,17.93,0,0,0,1.46,7.23c9.36,22.17,18.62,44.39,28,66.56A26.69,26.69,0,0,1,275.72,175c0,25.66-.12,51.32.08,77,0,4-1.13,5.23-5,4.88-4.44-.4-10.42,1.39-13-.87-3-2.65-.65-8.76-1-13.35-.32-4.44,1.9-10.33-.92-12.89-2.41-2.19-8.21-.76-12.51-.76Q188.88,229,134.39,229Zm0-66.51c37.33,0,74.67-.05,112,.07,4.18,0,5.64-.34,3.63-5-6.93-16-13.52-32.14-20.12-48.27-1-2.43-2.09-3.59-5-3.57-8.6.07-8.6-.1-8.61,8.67,0,1.67.06,3.34,0,5-.33,5.73-3.76,9.47-9.44,9.52q-26.75.22-53.5,0c-6,0-9.4-3.73-9.61-9.81-.12-3.5,0-7,0-10.5,0-1.11.28-2.67-1.38-2.68-5.48,0-11.29-.9-16.29.69-2.15.69-.44,6.75-.73,10.35-.08,1,0,2-.08,3-.42,5.15-3.77,8.86-9,8.91q-27.25.26-54.5,0c-5.41-.05-8.76-3.8-9-9.35-.17-3.49,0-7-.09-10.5,0-1,0-2.23-.57-2.8-2.07-2.12-11.74.16-12.9,2.95-6.7,16.09-13.28,32.24-20.17,48.26-1.81,4.2-1.21,5.15,3.43,5.13C59.76,162.42,97.09,162.49,134.43,162.49ZM88.89,110.16c4.82,0,9.64-.11,14.46,0,2.38.08,3.17-.69,3.13-3.09q-.19-11.47,0-22.94c0-2.45-.87-3.08-3.2-3.05-9.47.11-19,.13-28.42,0-2.63,0-3.45.8-3.4,3.39.13,7.48.17,15,0,22.44-.07,2.8,1,3.36,3.5,3.27C79.57,110,84.23,110.16,88.89,110.16Zm91.55-29c-5,0-10,.08-15,0-2.12,0-3,.66-2.94,2.84.08,7.81.1,15.63,0,23.44,0,2.22.75,2.81,2.87,2.79q14.71-.13,29.42,0c2.32,0,2.72-1,2.7-3-.08-7.65-.1-15.29,0-22.94,0-2.33-.68-3.26-3.12-3.18C189.75,81.28,185.09,81.17,180.43,81.17Z" transform="translate(7.39 -20.83)" style="fill:#fff"/></svg><p class="opciones_seleccionadas">' + $("#select_habitaciones").val() + ' ' + habitaciones + '</p><br>';
			}
			if($("#select_precio_compra_min").val()!='todos' && $("#select_precio_compra_max").val()=='todos'){
				opciones_seleccionadas+='<svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 299.2 298.99"><path d="M474,177.87c1.68-19.3,3.57-41.2,5.48-63.1.76-8.63,1.47-17.26,2.39-25.87s6.59-14.28,15.27-15c27.21-2.4,54.43-4.58,81.65-6.92,7.8-.67,15.53-1.68,23.25.91a40.22,40.22,0,0,1,16.09,9.64q74.39,74.43,148.77,148.86c8.31,8.32,8.32,17.5,0,25.83q-53.12,53.27-106.38,106.41c-8.76,8.75-17.94,8.75-26.62.09Q560.44,285.44,487,212.16C478.2,203.37,473.31,193.09,474,177.87Zm146.73,79.64h15.5c14.18,0,14.09,0,13.84-14.37-.06-3.22-1-4.44-4.28-4.36-7.83.18-15.66.06-23.5.06-7.38,0-7.2,0-7.35-7.58-.07-3.58.75-5,4.67-4.84,8,.32,16-.28,24,.23,5.36.34,6.85-1.62,6.2-6.51a27,27,0,0,1,0-6.49c.47-4.26-1-6-5.52-5.74-7.7.36-15.43.1-23.49.1,6.6-12.55,19.4-17.53,33.47-14.2,3.85.91,7.55,5.72,11.3,2.65,3-2.44,4.08-7.11,6.31-10.6s1.22-5.18-2.3-6.81c-23.94-11.05-54.29-6.8-68,24.28-1.85,4.21-4,5-8,4.93-10.92-.22-9.42-1.07-9.48,9.06-.05,9,0,9.15,9,9.45,2.49.08,3.22.84,2.91,3.16a11.94,11.94,0,0,0-.06,4c.95,4.5-.86,6-5.19,5.26-5.05-.89-6.6,1.23-6.46,6.32.34,12.13.09,12.2,12,12.29,2.4,0,3.76.42,4.79,3,10.85,27.4,37.41,38.91,64.73,28.21,9-3.52,9-3.52,4.53-12.2a31.75,31.75,0,0,1-2-4c-1.56-4.54-3.61-5.46-8.44-3.22C643.86,277,628.79,272.36,620.71,257.51Zm-97-115c.26,15.61,11.81,26.9,27.35,26.71a26.53,26.53,0,0,0,26-26.61c-.15-15.4-12.08-27-27.45-26.67A26.16,26.16,0,0,0,523.73,142.46Z" transform="translate(-473.92 -66.17)" style="fill:#fff"/></svg><p class="opciones_seleccionadas"> ' + desde + ' ' + parseInt($("#select_precio_compra_min").val()).toLocaleString('de-DE') + simbolo_moneda + '</p><br>';
			}
			if($("#select_precio_compra_min").val()=='todos' && $("#select_precio_compra_max").val()!='todos'){
				opciones_seleccionadas+='<svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 299.2 298.99"><path d="M474,177.87c1.68-19.3,3.57-41.2,5.48-63.1.76-8.63,1.47-17.26,2.39-25.87s6.59-14.28,15.27-15c27.21-2.4,54.43-4.58,81.65-6.92,7.8-.67,15.53-1.68,23.25.91a40.22,40.22,0,0,1,16.09,9.64q74.39,74.43,148.77,148.86c8.31,8.32,8.32,17.5,0,25.83q-53.12,53.27-106.38,106.41c-8.76,8.75-17.94,8.75-26.62.09Q560.44,285.44,487,212.16C478.2,203.37,473.31,193.09,474,177.87Zm146.73,79.64h15.5c14.18,0,14.09,0,13.84-14.37-.06-3.22-1-4.44-4.28-4.36-7.83.18-15.66.06-23.5.06-7.38,0-7.2,0-7.35-7.58-.07-3.58.75-5,4.67-4.84,8,.32,16-.28,24,.23,5.36.34,6.85-1.62,6.2-6.51a27,27,0,0,1,0-6.49c.47-4.26-1-6-5.52-5.74-7.7.36-15.43.1-23.49.1,6.6-12.55,19.4-17.53,33.47-14.2,3.85.91,7.55,5.72,11.3,2.65,3-2.44,4.08-7.11,6.31-10.6s1.22-5.18-2.3-6.81c-23.94-11.05-54.29-6.8-68,24.28-1.85,4.21-4,5-8,4.93-10.92-.22-9.42-1.07-9.48,9.06-.05,9,0,9.15,9,9.45,2.49.08,3.22.84,2.91,3.16a11.94,11.94,0,0,0-.06,4c.95,4.5-.86,6-5.19,5.26-5.05-.89-6.6,1.23-6.46,6.32.34,12.13.09,12.2,12,12.29,2.4,0,3.76.42,4.79,3,10.85,27.4,37.41,38.91,64.73,28.21,9-3.52,9-3.52,4.53-12.2a31.75,31.75,0,0,1-2-4c-1.56-4.54-3.61-5.46-8.44-3.22C643.86,277,628.79,272.36,620.71,257.51Zm-97-115c.26,15.61,11.81,26.9,27.35,26.71a26.53,26.53,0,0,0,26-26.61c-.15-15.4-12.08-27-27.45-26.67A26.16,26.16,0,0,0,523.73,142.46Z" transform="translate(-473.92 -66.17)" style="fill:#fff"/></svg><p class="opciones_seleccionadas"> ' + hasta + ' ' + parseInt($("#select_precio_compra_max").val()).toLocaleString('de-DE') + simbolo_moneda + '</p><br>';
			}
			if($("#select_precio_compra_min").val()!='todos' && $("#select_precio_compra_max").val()!='todos'){
				opciones_seleccionadas+='<svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 299.2 298.99"><path d="M474,177.87c1.68-19.3,3.57-41.2,5.48-63.1.76-8.63,1.47-17.26,2.39-25.87s6.59-14.28,15.27-15c27.21-2.4,54.43-4.58,81.65-6.92,7.8-.67,15.53-1.68,23.25.91a40.22,40.22,0,0,1,16.09,9.64q74.39,74.43,148.77,148.86c8.31,8.32,8.32,17.5,0,25.83q-53.12,53.27-106.38,106.41c-8.76,8.75-17.94,8.75-26.62.09Q560.44,285.44,487,212.16C478.2,203.37,473.31,193.09,474,177.87Zm146.73,79.64h15.5c14.18,0,14.09,0,13.84-14.37-.06-3.22-1-4.44-4.28-4.36-7.83.18-15.66.06-23.5.06-7.38,0-7.2,0-7.35-7.58-.07-3.58.75-5,4.67-4.84,8,.32,16-.28,24,.23,5.36.34,6.85-1.62,6.2-6.51a27,27,0,0,1,0-6.49c.47-4.26-1-6-5.52-5.74-7.7.36-15.43.1-23.49.1,6.6-12.55,19.4-17.53,33.47-14.2,3.85.91,7.55,5.72,11.3,2.65,3-2.44,4.08-7.11,6.31-10.6s1.22-5.18-2.3-6.81c-23.94-11.05-54.29-6.8-68,24.28-1.85,4.21-4,5-8,4.93-10.92-.22-9.42-1.07-9.48,9.06-.05,9,0,9.15,9,9.45,2.49.08,3.22.84,2.91,3.16a11.94,11.94,0,0,0-.06,4c.95,4.5-.86,6-5.19,5.26-5.05-.89-6.6,1.23-6.46,6.32.34,12.13.09,12.2,12,12.29,2.4,0,3.76.42,4.79,3,10.85,27.4,37.41,38.91,64.73,28.21,9-3.52,9-3.52,4.53-12.2a31.75,31.75,0,0,1-2-4c-1.56-4.54-3.61-5.46-8.44-3.22C643.86,277,628.79,272.36,620.71,257.51Zm-97-115c.26,15.61,11.81,26.9,27.35,26.71a26.53,26.53,0,0,0,26-26.61c-.15-15.4-12.08-27-27.45-26.67A26.16,26.16,0,0,0,523.73,142.46Z" transform="translate(-473.92 -66.17)" style="fill:#fff"/></svg><p class="opciones_seleccionadas"> ' + desde + ' ' + parseInt($("#select_precio_compra_min").val()).toLocaleString('de-DE') + simbolo_moneda + ' ' + hasta + ' ' + parseInt($("#select_precio_compra_max").val()).toLocaleString('de-DE') + simbolo_moneda + '</p><br>';
			}
			if($("#cuadro_texto").val()!=''){
				opciones_seleccionadas+='<svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 315.94 315.13"><path d="M408.31,2.83c-.23,27.92-9.19,52.78-26.15,74.89-.92,1.19-3.82,2.52-1.74,4.37,2.52,2.24,3.8,7,8.45,5.73,9.89-2.64,17.69.28,24.79,7.49,21.15,21.51,42.64,42.68,63.89,64.08a21.74,21.74,0,0,1,3,27.5,22,22,0,0,1-34.55,3.4q-32.68-32.72-65.41-65.39c-6.26-6.23-8-13.59-6.07-22,.61-2.71-3.55-9.71-6.12-10.09-1.54-.22-2.28,1.22-3.27,2a125.43,125.43,0,0,1-51.92,25.37c-64.66,14.61-132.56-29.6-143.11-95.13C159-44,197.15-96.16,255.39-113.21c63-18.43,127.2,17.45,147.12,78.69a126.23,126.23,0,0,1,4.35,17.91A112.38,112.38,0,0,1,408.31,2.83ZM199.5,1.74C199.39,48,234.45,90,288,90.87c48.13.79,88.18-39.76,88.27-88.36A88.16,88.16,0,0,0,287.84-86C239.32-85.92,199.51-46.39,199.5,1.74Z" transform="translate(-168.19 118.05)" style="fill:#fff"/></svg><p class="opciones_seleccionadas" style="text-transform:capitalize;"> ' + $("#cuadro_texto").val() + '</p><br>';
			}
		}
		

	}else{

		if($("#select_localidad_alquilar").val()=='todos' && $("#select_tipo").val()=='todos' && $("#select_habitaciones").val()=='todos' &&  $("#select_precio_alquiler_min").val()=='todos' && $("#select_precio_alquiler_max").val()=='todos' && $("#cuadro_texto").val()==''){
			opciones_seleccionadas+='<p style="text-align:center;margin-bottom: 10px;">' + todos_alquiler + '</p>';
		}else{
			opciones_seleccionadas+='<p style="text-align:center;margin-bottom: 10px;">' + filtro_alquiler + '</p>';
			if($("#select_localidad_alquilar").val()!='todos'){
				opciones_seleccionadas+='<svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54.93 77"><path d="M67.45,44.34c-.14,10.82-4.52,21.51-12.26,30.94A79,79,0,0,1,40.69,88.7c-.44.32-.74.45-1.24.08-11.07-8-20-17.72-24.34-31-2.79-8.48-3.63-17.16-1-25.8,3.29-10.63,10.22-17.71,21.43-19.61C48.33,10.26,59.42,16.63,64.7,28.6A36.62,36.62,0,0,1,67.45,44.34ZM40,54.61A14.18,14.18,0,1,0,25.83,40.34,14.23,14.23,0,0,0,40,54.61Z" transform="translate(-12.53 -12)" style="fill:#fff"/></svg><p class="opciones_seleccionadas">' + jQuery.trim($("#select_localidad_alquilar option:selected").text()) + '</p><br>';
			}
			if($("#select_tipo").val()!='todos'){
				valor_tipo='';
				switch($("#select_tipo").val()) {
				    case 'casa':
				        valor_tipo=casa;
				        break;
				    case 'chalet':
				       valor_tipo=chalet;
				        break;
				    case 'piso':
				       valor_tipo=piso;
				        break;
				    case 'apartamento':
				       valor_tipo=apartamento;
				        break;
				    case 'edificio':
				       valor_tipo=edificio;
				        break;
				    case 'garaje':
				       valor_tipo=garaje;
				        break;
				    case 'terreno':
				       valor_tipo=terreno;
				        break;
				    case 'local':
				       valor_tipo=local;
				        break;
				    case 'otros':
				       valor_tipo=otros;
				        break;
				}
				opciones_seleccionadas+='<svg  data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 146.45 146.15"><path d="M107.13,80.32c0,8.83,0,17.65,0,26.48,0,6.27-2,8.18-8.43,8.2q-10.49,0-21,0c-6.31,0-8.34-2-8.36-8.38-.06-16,0-32,0-48,0-8.68-1.14-9.81-9.82-9.82-6.49,0-13,0-19.48,0s-8.32,1.77-8.33,8.25c0,16.15,0,32.31,0,48.46,0,7.67-1.79,9.44-9.35,9.44q-10,0-20,0c-6.65,0-8.44-1.82-8.45-8.64q0-26.73,0-53.46c0-3,.24-5.34-4.17-3.42C-13.75,51-19.23,47.17-22,42c-1.81-3.41-.37-6.07,2.11-8.43q32.49-31.07,65-62.12c4-3.79,7.11-3.43,11.67.92Q84.45-1.19,112,25.25q4.33,4.14,8.7,8.25c2.7,2.52,4,5.37,1.95,8.87-3.17,5.5-7.92,8.55-11.85,7-3.77-1.52-3.76.26-3.74,3C107.17,61.67,107.13,71,107.13,80.32Z" transform="translate(22.77 31.13)" style="fill:#fff"/></svg><p class="opciones_seleccionadas" style="text-transform:capitalize;">' + valor_tipo + '</p><br>';
			}
			if($("#select_habitaciones").val()=='1'){
				opciones_seleccionadas+='<svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.19 236.37"><path d="M134.39,229c-39,0-78,.1-117-.13-4.61,0-5.56,1.3-5.31,5.53.37,6.14,0,12.33.15,18.49.08,2.63-.72,3.47-3.34,3.33-5-.27-11.46,1.63-14.55-.84s-1-9.35-1-14.28c-.12-21.66,0-43.32-.08-65A30,30,0,0,1-4.34,164C4.93,142.17,14,120.23,23.26,98.38A21.35,21.35,0,0,0,25,89.71q-.1-28.74,0-57.49c0-8.21,3.2-11.38,11.52-11.38q98,0,196,0c8.54,0,11.63,3.16,11.64,11.8q0,29,0,58a17.93,17.93,0,0,0,1.46,7.23c9.36,22.17,18.62,44.39,28,66.56A26.69,26.69,0,0,1,275.72,175c0,25.66-.12,51.32.08,77,0,4-1.13,5.23-5,4.88-4.44-.4-10.42,1.39-13-.87-3-2.65-.65-8.76-1-13.35-.32-4.44,1.9-10.33-.92-12.89-2.41-2.19-8.21-.76-12.51-.76Q188.88,229,134.39,229Zm0-66.51c37.33,0,74.67-.05,112,.07,4.18,0,5.64-.34,3.63-5-6.93-16-13.52-32.14-20.12-48.27-1-2.43-2.09-3.59-5-3.57-8.6.07-8.6-.1-8.61,8.67,0,1.67.06,3.34,0,5-.33,5.73-3.76,9.47-9.44,9.52q-26.75.22-53.5,0c-6,0-9.4-3.73-9.61-9.81-.12-3.5,0-7,0-10.5,0-1.11.28-2.67-1.38-2.68-5.48,0-11.29-.9-16.29.69-2.15.69-.44,6.75-.73,10.35-.08,1,0,2-.08,3-.42,5.15-3.77,8.86-9,8.91q-27.25.26-54.5,0c-5.41-.05-8.76-3.8-9-9.35-.17-3.49,0-7-.09-10.5,0-1,0-2.23-.57-2.8-2.07-2.12-11.74.16-12.9,2.95-6.7,16.09-13.28,32.24-20.17,48.26-1.81,4.2-1.21,5.15,3.43,5.13C59.76,162.42,97.09,162.49,134.43,162.49ZM88.89,110.16c4.82,0,9.64-.11,14.46,0,2.38.08,3.17-.69,3.13-3.09q-.19-11.47,0-22.94c0-2.45-.87-3.08-3.2-3.05-9.47.11-19,.13-28.42,0-2.63,0-3.45.8-3.4,3.39.13,7.48.17,15,0,22.44-.07,2.8,1,3.36,3.5,3.27C79.57,110,84.23,110.16,88.89,110.16Zm91.55-29c-5,0-10,.08-15,0-2.12,0-3,.66-2.94,2.84.08,7.81.1,15.63,0,23.44,0,2.22.75,2.81,2.87,2.79q14.71-.13,29.42,0c2.32,0,2.72-1,2.7-3-.08-7.65-.1-15.29,0-22.94,0-2.33-.68-3.26-3.12-3.18C189.75,81.28,185.09,81.17,180.43,81.17Z" transform="translate(7.39 -20.83)" style="fill:#fff"/></svg><p class="opciones_seleccionadas">' + $("#select_habitaciones").val() + ' ' + habitacion + '</p><br>';
			}
			if($("#select_habitaciones").val()!='1' && $("#select_habitaciones").val()!='todos'){
				opciones_seleccionadas+='<svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.19 236.37"><path d="M134.39,229c-39,0-78,.1-117-.13-4.61,0-5.56,1.3-5.31,5.53.37,6.14,0,12.33.15,18.49.08,2.63-.72,3.47-3.34,3.33-5-.27-11.46,1.63-14.55-.84s-1-9.35-1-14.28c-.12-21.66,0-43.32-.08-65A30,30,0,0,1-4.34,164C4.93,142.17,14,120.23,23.26,98.38A21.35,21.35,0,0,0,25,89.71q-.1-28.74,0-57.49c0-8.21,3.2-11.38,11.52-11.38q98,0,196,0c8.54,0,11.63,3.16,11.64,11.8q0,29,0,58a17.93,17.93,0,0,0,1.46,7.23c9.36,22.17,18.62,44.39,28,66.56A26.69,26.69,0,0,1,275.72,175c0,25.66-.12,51.32.08,77,0,4-1.13,5.23-5,4.88-4.44-.4-10.42,1.39-13-.87-3-2.65-.65-8.76-1-13.35-.32-4.44,1.9-10.33-.92-12.89-2.41-2.19-8.21-.76-12.51-.76Q188.88,229,134.39,229Zm0-66.51c37.33,0,74.67-.05,112,.07,4.18,0,5.64-.34,3.63-5-6.93-16-13.52-32.14-20.12-48.27-1-2.43-2.09-3.59-5-3.57-8.6.07-8.6-.1-8.61,8.67,0,1.67.06,3.34,0,5-.33,5.73-3.76,9.47-9.44,9.52q-26.75.22-53.5,0c-6,0-9.4-3.73-9.61-9.81-.12-3.5,0-7,0-10.5,0-1.11.28-2.67-1.38-2.68-5.48,0-11.29-.9-16.29.69-2.15.69-.44,6.75-.73,10.35-.08,1,0,2-.08,3-.42,5.15-3.77,8.86-9,8.91q-27.25.26-54.5,0c-5.41-.05-8.76-3.8-9-9.35-.17-3.49,0-7-.09-10.5,0-1,0-2.23-.57-2.8-2.07-2.12-11.74.16-12.9,2.95-6.7,16.09-13.28,32.24-20.17,48.26-1.81,4.2-1.21,5.15,3.43,5.13C59.76,162.42,97.09,162.49,134.43,162.49ZM88.89,110.16c4.82,0,9.64-.11,14.46,0,2.38.08,3.17-.69,3.13-3.09q-.19-11.47,0-22.94c0-2.45-.87-3.08-3.2-3.05-9.47.11-19,.13-28.42,0-2.63,0-3.45.8-3.4,3.39.13,7.48.17,15,0,22.44-.07,2.8,1,3.36,3.5,3.27C79.57,110,84.23,110.16,88.89,110.16Zm91.55-29c-5,0-10,.08-15,0-2.12,0-3,.66-2.94,2.84.08,7.81.1,15.63,0,23.44,0,2.22.75,2.81,2.87,2.79q14.71-.13,29.42,0c2.32,0,2.72-1,2.7-3-.08-7.65-.1-15.29,0-22.94,0-2.33-.68-3.26-3.12-3.18C189.75,81.28,185.09,81.17,180.43,81.17Z" transform="translate(7.39 -20.83)" style="fill:#fff"/></svg><p class="opciones_seleccionadas">' + $("#select_habitaciones").val() + ' ' + habitaciones + '</p><br>';
			}
			if($("#select_precio_alquiler_min").val()!='todos' && $("#select_precio_alquiler_max").val()=='todos'){
				opciones_seleccionadas+='<svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 299.2 298.99"><path d="M474,177.87c1.68-19.3,3.57-41.2,5.48-63.1.76-8.63,1.47-17.26,2.39-25.87s6.59-14.28,15.27-15c27.21-2.4,54.43-4.58,81.65-6.92,7.8-.67,15.53-1.68,23.25.91a40.22,40.22,0,0,1,16.09,9.64q74.39,74.43,148.77,148.86c8.31,8.32,8.32,17.5,0,25.83q-53.12,53.27-106.38,106.41c-8.76,8.75-17.94,8.75-26.62.09Q560.44,285.44,487,212.16C478.2,203.37,473.31,193.09,474,177.87Zm146.73,79.64h15.5c14.18,0,14.09,0,13.84-14.37-.06-3.22-1-4.44-4.28-4.36-7.83.18-15.66.06-23.5.06-7.38,0-7.2,0-7.35-7.58-.07-3.58.75-5,4.67-4.84,8,.32,16-.28,24,.23,5.36.34,6.85-1.62,6.2-6.51a27,27,0,0,1,0-6.49c.47-4.26-1-6-5.52-5.74-7.7.36-15.43.1-23.49.1,6.6-12.55,19.4-17.53,33.47-14.2,3.85.91,7.55,5.72,11.3,2.65,3-2.44,4.08-7.11,6.31-10.6s1.22-5.18-2.3-6.81c-23.94-11.05-54.29-6.8-68,24.28-1.85,4.21-4,5-8,4.93-10.92-.22-9.42-1.07-9.48,9.06-.05,9,0,9.15,9,9.45,2.49.08,3.22.84,2.91,3.16a11.94,11.94,0,0,0-.06,4c.95,4.5-.86,6-5.19,5.26-5.05-.89-6.6,1.23-6.46,6.32.34,12.13.09,12.2,12,12.29,2.4,0,3.76.42,4.79,3,10.85,27.4,37.41,38.91,64.73,28.21,9-3.52,9-3.52,4.53-12.2a31.75,31.75,0,0,1-2-4c-1.56-4.54-3.61-5.46-8.44-3.22C643.86,277,628.79,272.36,620.71,257.51Zm-97-115c.26,15.61,11.81,26.9,27.35,26.71a26.53,26.53,0,0,0,26-26.61c-.15-15.4-12.08-27-27.45-26.67A26.16,26.16,0,0,0,523.73,142.46Z" transform="translate(-473.92 -66.17)" style="fill:#fff"/></svg><p class="opciones_seleccionadas"> ' + desde + ' ' + parseInt($("#select_precio_alquiler_min").val()).toLocaleString('de-DE') + simbolo_moneda + '</p><br>';
			}
			if($("#select_precio_alquiler_min").val()=='todos' && $("#select_precio_alquiler_max").val()!='todos'){
				opciones_seleccionadas+='<svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 299.2 298.99"><path d="M474,177.87c1.68-19.3,3.57-41.2,5.48-63.1.76-8.63,1.47-17.26,2.39-25.87s6.59-14.28,15.27-15c27.21-2.4,54.43-4.58,81.65-6.92,7.8-.67,15.53-1.68,23.25.91a40.22,40.22,0,0,1,16.09,9.64q74.39,74.43,148.77,148.86c8.31,8.32,8.32,17.5,0,25.83q-53.12,53.27-106.38,106.41c-8.76,8.75-17.94,8.75-26.62.09Q560.44,285.44,487,212.16C478.2,203.37,473.31,193.09,474,177.87Zm146.73,79.64h15.5c14.18,0,14.09,0,13.84-14.37-.06-3.22-1-4.44-4.28-4.36-7.83.18-15.66.06-23.5.06-7.38,0-7.2,0-7.35-7.58-.07-3.58.75-5,4.67-4.84,8,.32,16-.28,24,.23,5.36.34,6.85-1.62,6.2-6.51a27,27,0,0,1,0-6.49c.47-4.26-1-6-5.52-5.74-7.7.36-15.43.1-23.49.1,6.6-12.55,19.4-17.53,33.47-14.2,3.85.91,7.55,5.72,11.3,2.65,3-2.44,4.08-7.11,6.31-10.6s1.22-5.18-2.3-6.81c-23.94-11.05-54.29-6.8-68,24.28-1.85,4.21-4,5-8,4.93-10.92-.22-9.42-1.07-9.48,9.06-.05,9,0,9.15,9,9.45,2.49.08,3.22.84,2.91,3.16a11.94,11.94,0,0,0-.06,4c.95,4.5-.86,6-5.19,5.26-5.05-.89-6.6,1.23-6.46,6.32.34,12.13.09,12.2,12,12.29,2.4,0,3.76.42,4.79,3,10.85,27.4,37.41,38.91,64.73,28.21,9-3.52,9-3.52,4.53-12.2a31.75,31.75,0,0,1-2-4c-1.56-4.54-3.61-5.46-8.44-3.22C643.86,277,628.79,272.36,620.71,257.51Zm-97-115c.26,15.61,11.81,26.9,27.35,26.71a26.53,26.53,0,0,0,26-26.61c-.15-15.4-12.08-27-27.45-26.67A26.16,26.16,0,0,0,523.73,142.46Z" transform="translate(-473.92 -66.17)" style="fill:#fff"/></svg><p class="opciones_seleccionadas"> ' + hasta + ' ' + parseInt($("#select_precio_alquiler_max").val()).toLocaleString('de-DE') + simbolo_moneda + '</p><br>';
			}
			if($("#select_precio_alquiler_min").val()!='todos' && $("#select_precio_alquiler_max").val()!='todos'){
				opciones_seleccionadas+='<svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 299.2 298.99"><path d="M474,177.87c1.68-19.3,3.57-41.2,5.48-63.1.76-8.63,1.47-17.26,2.39-25.87s6.59-14.28,15.27-15c27.21-2.4,54.43-4.58,81.65-6.92,7.8-.67,15.53-1.68,23.25.91a40.22,40.22,0,0,1,16.09,9.64q74.39,74.43,148.77,148.86c8.31,8.32,8.32,17.5,0,25.83q-53.12,53.27-106.38,106.41c-8.76,8.75-17.94,8.75-26.62.09Q560.44,285.44,487,212.16C478.2,203.37,473.31,193.09,474,177.87Zm146.73,79.64h15.5c14.18,0,14.09,0,13.84-14.37-.06-3.22-1-4.44-4.28-4.36-7.83.18-15.66.06-23.5.06-7.38,0-7.2,0-7.35-7.58-.07-3.58.75-5,4.67-4.84,8,.32,16-.28,24,.23,5.36.34,6.85-1.62,6.2-6.51a27,27,0,0,1,0-6.49c.47-4.26-1-6-5.52-5.74-7.7.36-15.43.1-23.49.1,6.6-12.55,19.4-17.53,33.47-14.2,3.85.91,7.55,5.72,11.3,2.65,3-2.44,4.08-7.11,6.31-10.6s1.22-5.18-2.3-6.81c-23.94-11.05-54.29-6.8-68,24.28-1.85,4.21-4,5-8,4.93-10.92-.22-9.42-1.07-9.48,9.06-.05,9,0,9.15,9,9.45,2.49.08,3.22.84,2.91,3.16a11.94,11.94,0,0,0-.06,4c.95,4.5-.86,6-5.19,5.26-5.05-.89-6.6,1.23-6.46,6.32.34,12.13.09,12.2,12,12.29,2.4,0,3.76.42,4.79,3,10.85,27.4,37.41,38.91,64.73,28.21,9-3.52,9-3.52,4.53-12.2a31.75,31.75,0,0,1-2-4c-1.56-4.54-3.61-5.46-8.44-3.22C643.86,277,628.79,272.36,620.71,257.51Zm-97-115c.26,15.61,11.81,26.9,27.35,26.71a26.53,26.53,0,0,0,26-26.61c-.15-15.4-12.08-27-27.45-26.67A26.16,26.16,0,0,0,523.73,142.46Z" transform="translate(-473.92 -66.17)" style="fill:#fff"/></svg><p class="opciones_seleccionadas"> ' + desde + ' ' + parseInt($("#select_precio_alquiler_min").val()).toLocaleString('de-DE') + simbolo_moneda + ' ' + hasta + ' ' + parseInt($("#select_precio_alquiler_max").val()).toLocaleString('de-DE') + simbolo_moneda + '</p><br>';
			}
			if($("#cuadro_texto").val()!=''){
				opciones_seleccionadas+='<svg data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 315.94 315.13"><path d="M408.31,2.83c-.23,27.92-9.19,52.78-26.15,74.89-.92,1.19-3.82,2.52-1.74,4.37,2.52,2.24,3.8,7,8.45,5.73,9.89-2.64,17.69.28,24.79,7.49,21.15,21.51,42.64,42.68,63.89,64.08a21.74,21.74,0,0,1,3,27.5,22,22,0,0,1-34.55,3.4q-32.68-32.72-65.41-65.39c-6.26-6.23-8-13.59-6.07-22,.61-2.71-3.55-9.71-6.12-10.09-1.54-.22-2.28,1.22-3.27,2a125.43,125.43,0,0,1-51.92,25.37c-64.66,14.61-132.56-29.6-143.11-95.13C159-44,197.15-96.16,255.39-113.21c63-18.43,127.2,17.45,147.12,78.69a126.23,126.23,0,0,1,4.35,17.91A112.38,112.38,0,0,1,408.31,2.83ZM199.5,1.74C199.39,48,234.45,90,288,90.87c48.13.79,88.18-39.76,88.27-88.36A88.16,88.16,0,0,0,287.84-86C239.32-85.92,199.51-46.39,199.5,1.74Z" transform="translate(-168.19 118.05)" style="fill:#fff"/></svg><p class="opciones_seleccionadas" style="text-transform:capitalize;"> ' + $("#cuadro_texto").val() + '</p><br>';
			}
		}
	}

	$('.filtros_notificaciones').html(opciones_seleccionadas);
	 });
	});
});

//Cerrar notificaciones
$('.cerrar_notificaciones').click(function(event) {
	$('.datos_notificacion').css('display', 'none');
});
//Enviar datos notificaciones
$('.datos_notificacion form').submit(function(event) {
	event.preventDefault();
	if($("#select_modalidad").val()=='venta'){
		var datosModificar={correo:$(".cuadro_email").val(),
						texto:$("#cuadro_texto").val(),
						modalidad:$("#select_modalidad").val(),
						localidad_venta: $("#select_localidad_compra option:selected").text(),
						tipo:$("#select_tipo").val(),
						habitaciones:$("#select_habitaciones").val(),
						precio_min:$("#select_precio_compra_min").val(),
						precio_max:$("#select_precio_compra_max").val()};
	}else{
		var datosModificar={correo:$(".cuadro_email").val(),
						texto:$("#cuadro_texto").val(),
						modalidad:$("#select_modalidad").val(),
						localidad_venta: $("#select_localidad_alquilar option:selected").text(),
						tipo:$("#select_tipo").val(),
						habitaciones:$("#select_habitaciones").val(),
						precio_min:$("#select_precio_alquiler_min").val(),
						precio_max:$("#select_precio_alquiler_max").val()};

	}
	

	$.post( url + '/suscriptores/', datosModificar, procesarSuscriptores);
});

function procesarSuscriptores(DatosDevueltos){
	if(DatosDevueltos=='correcto'){
		$('.datos_notificacion').css('display', 'none');
		swal(
		  '¡Suscripto!',
		  'Para darte de baja usa el enlace "dar de baja" en nuestros correos o envíanos un correo con el asunto "Eliminar suscripción"',
		  'success'
		);
	}else{
		$('.datos_notificacion').css('display', 'none');
		swal(
		  '¡Ha ocurrido un error!',
		  'Ha ocurrido un error con la conexión, si el error persiste inténtalo más tarde',
		  'error'
		);

	}	
}

//BOTON VOLVER
$('.single article .barra_titular p').click(function(event) {
	window.location.href = url + '/buscar/';
});

$('.single_blog .barra_titular p').click(function(event) {
	window.location.href = url + '/blog/';
});


//EVENTOS SWIPE
 $(".menu").swipe({
     excludedElements: "a",
   swipeLeft: function() {
    $('header .menu').removeClass('mostrar_nav');  }
  
});

 $(".imagen").swipe({
     excludedElements: "",
   swipeLeft: function() {
    $(this).children('.derecha').click();  }
  
});

 $(".imagen").swipe({
     excludedElements: "",
   swipeRight: function() {
    $(this).children('.izquierda').click();  }
  
});

 $(".carrusel_imagenes").swipe({
     excludedElements: "",
   swipeLeft: function() {
    $(this).children('.derecha').click();  }
  
});

 $(".carrusel_imagenes").swipe({
     excludedElements: "",
   swipeRight: function() {
    $(this).children('.izquierda').click();  }
  
});

 $(".flotante_contacto").swipe({
     excludedElements: "",
   swipeLeft: function() {
    $('#solapa_abrir').css('left', '0px');
		$('#solapa_cerrar').css('left', '49px');
	    $('.single article .flotante_contacto').css('left', '-260px');
		contador++;  }
  
});

});