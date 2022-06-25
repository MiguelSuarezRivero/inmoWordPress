jQuery(document).ready(function($) {

  ruta=$('.ruta').val();

//MOSTRAR MONEDA GUARDADA
    $('option').each(function(index, el) {
      if($(this).val() == $('.moneda_seleccionada').val()){
        $(this).prop('selected', true);
      }
    });

//CHECK BLOG
$('.check_blog').change(function(event) {
  if( $(this).prop('checked') ) {
    $('.valor_blog').prop('value', 'true');
  }else{
    $('.valor_blog').prop('value', 'false');
  }   
});

//CHECK VENTAS
$('.check_ventas').change(function(event) {
  if( $(this).prop('checked') ) {
    $('.valor_ventas').prop('value', 'true');
  }else{
    $('.valor_ventas').prop('value', 'false');
  }   
});

//CHECK OCULTAR OPCIONES
$('.check_ocultar').change(function(event) {
  if( $(this).prop('checked') ) {
    $('.valor_opciones').prop('value', 'true');
  }else{
    $('.valor_opciones').prop('value', 'false');
  }   
});

//CHECK MULTIIDIOMA
$('.check_idiomas').change(function(event) {
  if( $(this).prop('checked') ) {
    $('.valor_idiomas').prop('value', 'true');
    $('.check_titulos').prop('disabled', false);
    $('.check_descripcion').prop('disabled', false);
    $('.check_caracteristicas').prop('disabled', false);
  }else{
    $('.valor_idiomas').prop('value', 'false');
    $('.check_titulos').prop('disabled', true);
    $('.check_descripcion').prop('disabled', true);
    $('.check_caracteristicas').prop('disabled', true);
  }   
});

//CHECK TITULOS
$('.check_titulos').change(function(event) {
  if( $(this).prop('checked') ) {
    $('.valor_titulos').prop('value', 'true');
  }else{
    $('.valor_titulos').prop('value', 'false');
  }   
});

//CHECK DESCRIPCION
$('.check_descripcion').change(function(event) {
  if( $(this).prop('checked') ) {
    $('.valor_descripcion').prop('value', 'true');
  }else{
    $('.valor_descripcion').prop('value', 'false');
  }   
});

//CHECK TITULOS
$('.check_caracteristicas').change(function(event) {
  if( $(this).prop('checked') ) {
    $('.valor_caracteristicas').prop('value', 'true');
  }else{
    $('.valor_caracteristicas').prop('value', 'false');
  }   
});
    
});