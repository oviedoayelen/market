
$('.form-control').on('change',function(){
    $(this).removeClass('is-invalid');
  });
  
  $('.form-control').on('keyup',function(){
    $(this).removeClass('is-invalid');
  });

  $('#provincia').on('change', function(){
    $.post('localidades-ajax.php', {provincia : this.value}, function(result){
        localidad.innerHTML = result;
    });
}); 
