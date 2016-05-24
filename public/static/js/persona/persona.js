$(document).on("ready",inicio)
function inicio()
{
	
	iniciarCarruseles();
	desplazamientoAplanesIndividuales();
	desplazamientoAplanesFamiliaeres();
	
}
function desplazamientoAplanesIndividuales()
{
	
    $('.bg-celeste-woman').click(function(){
    $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top
    }, 500);
    return false;
	});
}
function desplazamientoAplanesFamiliaeres()
{

    $('.gota-persona-familia').click(function(){
    $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top
    }, 500);
    return false;
	});
}
function iniciarCarruseles()
{
	var planIndividual = $("#plan-individual");

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
	   var planFamiliar = $("#plan-familiar");

	      planFamiliar.owlCarousel({

	      items : 3, //10 items above 1000px browser width
	      itemsDesktop : [1100,2], //5 items between 1000px and 901px
	      itemsDesktopSmall : [900,2], // 3 items betweem 900px and 601px
	      itemsTablet: [700,1], //2 items between 600 and 0;
	      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
	      
	      });
	      planFamiliar.trigger('owl.play',5000);
	      // Custom Navigation Events
	      $(".next2").click(function(){
	        planFamiliar.trigger('owl.next');
	      })
	      $(".prev2").click(function(){
	        planFamiliar.trigger('owl.prev');
	      }) 



	var recargaIndividual = $("#recarga-individual");

	      recargaIndividual.owlCarousel({

	      items : 3, //10 items above 1000px browser width
	      itemsDesktop : [1100,2], //5 items between 1000px and 901px
	      itemsDesktopSmall : [900,2], // 3 items betweem 900px and 601px
	      itemsTablet: [700,1], //2 items between 600 and 0;
	      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
	      
	      });
	      recargaIndividual.trigger('owl.play',5000);
	      // Custom Navigation Events
	      $(".nextRecargaInd").click(function(){
	        recargaIndividual.trigger('owl.next');
	      })
	      $(".prevRecargaInd").click(function(){
	        recargaIndividual.trigger('owl.prev');
	      })
	   var recargaFamiliar = $("#recarga-familiar");

	      recargaFamiliar.owlCarousel({

	      items : 3, //10 items above 1000px browser width
	      itemsDesktop : [1100,2], //5 items between 1000px and 901px
	      itemsDesktopSmall : [900,2], // 3 items betweem 900px and 601px
	      itemsTablet: [700,1], //2 items between 600 and 0;
	      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
	      
	      });
	      recargaFamiliar.trigger('owl.play',5000);
	      // Custom Navigation Events
	      $(".nextRecargaFam").click(function(){
	        recargaFamiliar.trigger('owl.next');
	      })
	      $(".prevRecargaFam").click(function(){
	        recargaFamiliar.trigger('owl.prev');
	      })   
}
