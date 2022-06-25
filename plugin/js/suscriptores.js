jQuery(document).ready(function($) {

	ruta=$('.ruta').val();
	//SELECCIONA TODOS LOS SUSCRIPTORES
	$('.seleccion_checkbox').click(function(event) {

	    if ($(this).is(':checked')) {
	        $('.checkbox_seleccionables').prop('checked', true);
	    } else {
	        $('.checkbox_seleccionables').prop('checked', false);
	    }
	});

	//ELIMINA SUSCRIPTORES
 	$("body").on('click', '.delete_suscriptores', function(event) {
 		
	    $elem=[];
	    $(".checkbox_seleccionables:checked").each(function(index, el) {
	        $elem.push($(this).siblings('.datos_seleccion').children('.id_suscriptores').val());
	    });
	        
	    var datosModificar={correo:$elem};
	    $.post(ruta + '/code/borrar_suscriptor.php', datosModificar, procesarDatos);
	                
    });

    function procesarDatos(DatosDevueltos){
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

    //ABRIR OPCION DE FILTRAR
$('.filtrar').click(function(event) {
	$('.barra_filtrar_formulario').toggleClass('abrir');	
});

//FUNCIONALIDAD A LOS SELECT'S DE FILTRAR
$('.filtrar_seleccion').change(function(event) {
	var datos_enviados={modalidad:$(".estado_modalidad").val(),
						localidad:$(".estado_localidad").val(),
                        tipo:$(".estado_tipo").val(),
                        habitaciones:$(".estado_habitaciones").val()};

	$.post(ruta + '/code/filtrar_suscriptores.php', datos_enviados, procesar_filtro);
});

function procesar_filtro(Datos){
	$('.area_datos_suscriptores').empty();
	$('.area_datos_suscriptores').append(Datos);
	contador=0;
	$('.area_datos_suscriptores .datos_formulario').each(function(index, el) {
		contador++;
	});
	$('.contador').text(contador);
}

//EXPORTAR CSV
$('.csv').click(function(event) {
	document.location.href = ruta + '/code/exportar_excel.php?modalidad=' + $(".estado_modalidad").val() + '&localidad=' + $(".estado_localidad").val() + '&tipo=' + $(".estado_tipo").val() + '&habitaciones=' + $(".estado_habitaciones").val();

});
});