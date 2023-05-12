$(function() {
    $(document).click(function (event) {
      $('.navbar-collapse').collapse('hide');
    });
  });
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  
  $(".buscar-desktop").on("click", function(){
    var buscar = buscardesktop.value ? "p="+buscardesktop.value : ""; 
    location.href = "productos.php?"+buscar;
  });

  $(".buscar-mobile").on("click", function(){
    var buscar = buscarmobile.value ? "p="+buscarmobile.value : ""; 
    location.href = "productos.php?"+buscar;
  });
  
  $(document).ready(function() {
    $('.favoritos-drop-down').load('favoritos-drop-down-load.php');
    $('.carrito-count').load('carrito-ajax.php');
  });
  