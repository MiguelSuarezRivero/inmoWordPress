jQuery(document).ready(function($){
    url = $('.ruta').val();

    var cargar_imagen;
    $('.abrir_media').on( "click", function(e) {
        e.preventDefault();
        cargar_imagen.open();
        return false;
    });

    cargar_imagen = wp.media.frames.file_frame = wp.media({
      title: 'Selecciona las imagenes y vídeos',
      button: {
      text: 'Asignar'
    }, multiple: true });

       cargar_imagen.on('select', function() {
      var attachment = cargar_imagen.state().get('selection').map( 

                function( attachment ) {

                    attachment.toJSON();
                    return attachment;

            });
var i;
var array_imagenes=[];
var array_ids=[];
      for ( i = 0; i< attachment.length; i++) {
        array_imagenes.push(attachment[i].attributes.id);
        array_ids.push(attachment[i].attributes.id);
        }
         array_ids.push($("#id_imagenes").val()); 
         $("#id_imagenes").val(array_ids);
        var datosModificar={imagenes:array_imagenes};
        
        $('#boton_borrar').css('display', 'inline-block');

        $.post( url + 'code/gestiona_galeria.php', datosModificar, procesarDatos);
    });

function procesarDatos(DatosDevueltos){
    $('.contenedor_imagenes').prepend(DatosDevueltos);
}

if($('#id_imagenes').val()!=''){
    $('#boton_borrar').css('display', 'inline-block');
}

$('#boton_borrar').click(function(event) {
    $("#id_imagenes").prop('value', '');
    $('.contenedor_imagenes').empty();
});

$('body').on('click', '.borrar_imagen', function(event) {
    id_borrar= $(this).siblings('.id_elemento').val();
    $(this).parent().remove();
    elem_act=$("#id_imagenes").val();
    elem_final=elem_act.replace( id_borrar + ',','');
    $("#id_imagenes").prop('value', elem_final);
});

});