$(document).ready(function() {
    var owl = $("#owl-categorias");
    owl.owlCarousel({
        items : 7,
        itemsDesktop : [900,6], 
        itemsDesktopSmall : [800,5], 
        itemsTablet: [600,4], 
        itemsMobile : [440,3], 
    });
    owl.trigger('owl.play',1500);
    $("#owl-categorias").mouseout(function(){
        owl.trigger('owl.play',1500);
    })
    $("#owl-categorias").mouseover(function(){
        owl.trigger('owl.stop');
    })
});

$(document).ready(function() {
    var owl = $("#owl-productos-1");
        owl.owlCarousel({
        items : 4, 
        itemsTablet: [800,3], 
        itemsMobile : [650,2], 
    });
    owl.trigger('owl.play',1500);
    $("#owl-productos-1").mouseout(function(){
        owl.trigger('owl.play',1500);
    })
    $("#owl-productos-1").mouseover(function(){
        owl.trigger('owl.stop');
    })
});

$(document).ready(function() {
    var owl = $("#owl-productos-2");
        owl.owlCarousel({
        items : 4, 
        itemsTablet: [800,3], 
        itemsMobile : [650,2], 
    });
    owl.trigger('owl.play',1500);
    $("#owl-productos-2").mouseout(function(){
        owl.trigger('owl.play',1500);
    })
    $("#owl-productos-2").mouseover(function(){
        owl.trigger('owl.stop');
    })
});
