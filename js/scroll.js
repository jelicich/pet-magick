function start_scroll(applyTo){
	$(document).ready(function(){
		(function($){
			$(window).load(function(){
				$("." + applyTo).mCustomScrollbar({
					scrollButtons:{
						enable: false 
					},
					theme:"light-thin"
				});
			});
		})(jQuery);
	});
}



function scroll_again(applyTo){
	$(document).ready(function(){
		(function($){
		//	$(window).load(function(){// para q funque con luego del ajax
				$("." + applyTo).mCustomScrollbar({
					scrollButtons:{
						enable: false 
					},
					theme:"light-thin"
				});
			//});
		})(jQuery);
	});
}