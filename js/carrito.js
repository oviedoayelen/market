$('.addCarrito').on('change', function(){
    if(this.value){
      $.post('carrito-ajax.php',{productoAdd : this.id, cantidad : this.value});
      $('#carrito').load('carrito-load.php');
    }
});
  
$('.addCarrito').on('keyup', function(){
  if(this.value){
    $.post('carrito-ajax.php',{productoAdd : this.id, cantidad : this.value});
    $('#carrito').load('carrito-load.php');
  }
});

$('.deleteProduct').on('click', function(){
    $.post('carrito-ajax.php',{productoDelete : this.id});
    $('#carrito').load('carrito-load.php');
    $('.carrito-count').load('carrito-ajax.php');
});

$('#thisdiv').load(document.URL +  ' #thisdiv');