$(".search-desktop").on("click", function(){
    location.href = "?"+$( "#form-filtros-desktop" ).serialize();
});

$(".search-mobile").on("click", function(){
    location.href = "?"+$( "#form-filtros-mobile" ).serialize();
});

$(".favorito:checked").each(function(){
    var arr = document.getElementsByName(this.id);
    for(var i of arr) {
        i.className = "fas fa-heart";
    }
});

$('.favorito').on('click', function(){
    if(this.checked == true){
        $.post('favoritos-ajax.php', {favoritoAdd : this.value});
        console.log("Add: "+this.value);
        $('.favoritos-drop-down').load('favoritos-drop-down-load.php');
        $('.favoritos-drop-down').load('favoritos-drop-down-load.php');
    }
    else if(this.checked !== true){
        $.post('favoritos-ajax.php', {favoritoDelete : this.value});
        console.log("Delete: "+this.value);
        $('.favoritos-drop-down').load('favoritos-drop-down-load.php');
        $('.favoritos-drop-down').load('favoritos-drop-down-load.php');
    }
    $('.favoritos-drop-down').load('favoritos-drop-down-load.php');
    var arr = document.getElementsByName(this.id);
    for(var i of arr) {
        i.className =  i.className  == "fas fa-heart" ? "far fa-heart" : "fas fa-heart";
    }
});