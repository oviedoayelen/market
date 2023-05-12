$(document).ready(function(){
    $.post('compra-set.php', {envio : $('input:radio[name=entrega]:checked').val()}, function(result) {
        var content = JSON.parse(result);
        console.log(result);
        console.log($('input:radio[name=entrega]:checked').val());
        if(content.envio==1){
            $('#precio_envio').html("<span class='text-success'>Gratis!</span>");
        }else if(content.envio){
            $('#precio_envio').html(content.envio);
        }
        $('#precio_compra').html(content.total);
    });
});

$('input[type=radio][name=entrega]').change(function() {
        if(this.value == 2){
        $('#formDireccion').show();
    }
    else{     
        $('#formDireccion').hide();
    }
    $.post('compra-set.php', {envio : this.value}, function(result) {
        var content = JSON.parse(result);
        if(content.envio==1){
            $('#precio_envio').html("<span class='text-success'>Gratis!</span>");
        }else if(content.envio){
            $('#precio_envio').html(content.envio);
        }
        $('#precio_compra').html(content.total);
    });
});

$('#formDireccion').hide();
$("input[type=radio][name=entrega]:checked").each(function(){
    if(this.value == 2){
        $('#formDireccion').show();
    }
    else{     
        $('#formDireccion').hide();
    }
});

$('#formTarjeta').hide();
$("input[type=radio][name=pago]:checked").each(function(){
    if (this.value == 1) {
        $('#formTarjeta').show();
    }    
    else{
        $('#formTarjeta').hide();
    }
});

$('input[type=radio][name=pago]').change(function() {
    if (this.value == 1) {
        $('#formTarjeta').show();
    }
    else{
        $('#formTarjeta').hide();
    }
});