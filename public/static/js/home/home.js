$(document).on("ready",inicio)
function inicio()
{
	var slider = new PositEPass();	
	iniciarSlider();
}
function iniciarSlider()
{
	
	var sliderHome=$("#owl-demo");
	sliderHome.owlCarousel({      
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,      
 
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
 
  });
	sliderHome.trigger('owl.play',5000);
	      // Custom Navigation Events
	      $(".next").click(function(){
	        sliderHome.trigger('owl.next');
	      })
	      $(".prev").click(function(){
	        sliderHome.trigger('owl.prev');
	      })
}