$('.deleteProduct').on('click', function(){
    console.log(this.id);
    $.post('',{id : this.id});
    $('#product'+this.id).hide();
    window.location.reload();
});
