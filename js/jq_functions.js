//FELX SLIDER
function flexslider(){

	//$(window).load(function() {
	$(function(){ 
	  $('.flexslider').flexslider({
	    animation: "slide",
	    animationLoop: false,
	    itemWidth: 123,
	    itemMargin: 5
	  });
	});
}


// ANCHORS
/*
function anchors(){

	$(document).ready(function(){
			 	 
		$('a[href*=#]').click(function() {
			   
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			    
			     var $target = $(this.hash);
			     $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
			     
			     if ($target.length) {
			      
			       var targetOffset = $target.offset().top;
			       $('html,body')
			       .animate({scrollTop: targetOffset}, 1500);
			       return false;

			    }
			}
		 });
	});
}
*/
//LOGIN REG FORMS
function userForms(){

	$(document).ready(function(){
		$("#link-reg").click(function(){

				$("#reg-form").toggle('slow');
				$("#log-form").hide('slow');
				clickOnBody("reg-form");
					
			});

			$("#link-login").click(function(){

				$("#log-form").toggle('slow');
				$("#reg-form").hide('slow');
				 clickOnBody("log-form");

			});

			function clickOnBody(element){

				$(document).mouseup(function(e)
					{ 
						var container = $("#" + element);

						if( !container.is(e.target) && container.has(e.target).length === 0 ){

								container.hide('slow');
						}
				});
			}
	});
}

//SCROLL
function start_scroll(applyTo){
	//$(document).ready(function(){
		var c = "c=3";
		(function($){
			
			//$(window).load(function(){
				
				$("." + applyTo).mCustomScrollbar({
					
					scrollButtons:{
						enable: false 
					},
					advanced:{
						updateOnContentResize: true
					},
					theme:"light-thin",
					callbacks:{
					    
					    onTotalScroll:function(){
				    		
				    		$.ajax({

				                type: "POST",
				                url: "ajax/profilesModuleByPet.php",
				                data: c,
				                cache: false,

				                success: function(html){
				                	///console.log(html);
				                	$('#ModulesByPet').append(html);
				                }
				            });
					    }
					}
				});
			//});
		})(jQuery);
	//});
}
/*
function scroll_again(applyTo){
	$(document).ready(function(){
		(function($){
		//	$(window).load(function(){// para q funque con luego del ajax
				$("." + applyTo).mCustomScrollbar({
					scrollButtons:{
						enable: false 
					},
					theme:"light-thick"
				});
			//});
		})(jQuery);
	});
}
*/
// PRELOADER
$(document).ready(function(){

	$("body").css("overflow", "hidden");
	$("body").css("padding-right", "17px");
});

$(window).load(function () {
	$("#preloader").fadeOut("slow");
	$("body").css("padding-right", "0");
	$("body").delay(2000).css("overflow", "auto");
});

// TRIANGLES MENU BY PET

