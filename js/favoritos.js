$('.deleteFavorito').on('click', function(){
    $.post('favoritos-ajax.php',{favoritoDelete : this.id});
    $('.favoritos-drop-down').load('favoritos-drop-down-load.php');
    $('#favoritos').load('favoritos-load.php');
    $('.favoritos-drop-down').load('favoritos-drop-down-load.php');
    $('#favoritos').load('favoritos-load.php');
});