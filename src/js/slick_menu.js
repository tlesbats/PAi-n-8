$('.slider_responsive').slick({
        dots: true,
        infinite: false,
        speed: 500,
        slidesToShow: 6,
        slidesToScroll: 4,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        }, {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
    });
  
    
	
$( "#tabs" ).tabs();

$(function() {
    $( "#accordion" ).accordion({
      heightStyle: "content"
    }); 
    
  }); 
$(document).ready(function  () {
		$("#ToggleSwitchSample").toggleSwitch();
	});
$( "#selectmenu" ).selectmenu({
change: function( click, ui ) {newgraph(this);}
});