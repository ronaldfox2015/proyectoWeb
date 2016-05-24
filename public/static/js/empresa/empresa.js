$(document).on("ready",inicio)
function inicio()
{
  //var slider = new PositEPass();
  desplazamientoPlanPrepago();
  desplazamientoPlanPostpago();
  inicializarSlider();
}
function desplazamientoPlanPrepago()
{
  $('.gota-epas-empresa-prepago').click(function(){
    $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top
    }, 500);
    return false;
  });
}
function desplazamientoPlanPostpago()
{
  $('.gota-epas-empresa-postpago').click(function(){
      $('html, body').animate({
          scrollTop: $( $.attr(this, 'href') ).offset().top
      }, 500);
      return false;
    });
}
function inicializarSlider()
{
  var planIndividual = $("#plan-pre-pago");

        planIndividual.owlCarousel({

        items : 3, //10 items above 1000px browser width
        itemsDesktop : [1100,2], //5 items between 1000px and 901px
        itemsDesktopSmall : [900,2], // 3 items betweem 900px and 601px
        itemsTablet: [700,1], //2 items between 600 and 0;
        itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
        
        });
        planIndividual.trigger('owl.play',5000);
        // Custom Navigation Events
        $(".next").click(function(){
          planIndividual.trigger('owl.next');
        })
        $(".prev").click(function(){
          planIndividual.trigger('owl.prev');
        })

    var planPostPago = $("#plan-post-pago");

        planPostPago.owlCarousel({

        items : 3, //10 items above 1000px browser width
        itemsDesktop : [1100,2], //5 items between 1000px and 901px
        itemsDesktopSmall : [900,2], // 3 items betweem 900px and 601px
        itemsTablet: [700,1], //2 items between 600 and 0;
        itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
        
        });
        planPostPago.trigger('owl.play',5000);
        // Custom Navigation Events
        $(".next-post").click(function(){
          planPostPago.trigger('owl.next');
        })
        $(".prev-post").click(function(){
          planPostPago.trigger('owl.prev');
        });
        
    var recargaPostPago = $("#recarga-post-pago");

        recargaPostPago.owlCarousel({

        items : 3, //10 items above 1000px browser width
        itemsDesktop : [1100,2], //5 items between 1000px and 901px
        itemsDesktopSmall : [900,2], // 3 items betweem 900px and 601px
        itemsTablet: [700,1], //2 items between 600 and 0;
        itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
        
        });
        recargaPostPago.trigger('owl.play',5000);
        // Custom Navigation Events
        $(".nextRecarga").click(function(){
          recargaPostPago.trigger('owl.next');
        })
        $(".prevRecarga").click(function(){
          recargaPostPago.trigger('owl.prev');
        })


        
}