//FELX SLIDER
function flexslider(){

	//$("#pet-album").on("ready", $(function(){
		$(function(){ 
		  $('.flexslider').flexslider({
		    animation: false,
		    animationLoop: false,
		    itemWidth: 80,
		    itemMargin: 5
		  });
		});
	//});
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

function start_scroll(applyTo, direction){
	//$(document).ready(function(){
		
		(function($){
			
			//$(window).load(function(){
				
				$("." + applyTo).mCustomScrollbar({
					
					scrollButtons:{
						enable: false 
					},
					advanced:{
						updateOnContentResize: true,
						horizontalSrcoll: direction
					},
					theme:"light-thin",
					callbacks:{
					    
					    onTotalScroll:function(){
				    		
				    		console.log(this[0].id);// debe imprimir el id del div q tiene la clase "scroll bla bla"

				    		if(this[0].id == "profiles"){
					    		
					    		var c = "c=3";

					    		$.ajax({

					                type: "POST",
					                url: "ajax/profilesModuleByPet.php",
					                data: c,
					                cache: false,

					                success: function(html){
					                	$('#ModulesByPet').append(html);
					                }
					            });

					        }
				        }
					}
				});

			//});
		})(jQuery);
	//});
}



function start_scroll_profile(applyTo, direction){
	//$(document).ready(function(){
		
		(function($){
			
			//$(window).load(function(){
				
				$("#" + applyTo).mCustomScrollbar({
					
					
					scrollButtons:{
						enable: false 
					},
					advanced:{
						updateOnContentResize: true,
						 //autoExpandHorizontalScroll: direction
						
					},
					theme:"light-thin",
					horizontalScroll: direction,
					callbacks:{
					    
					    onTotalScroll:function(){
				    		
				    		console.log(this[0].id);// debe imprimir el id del div q tiene la clase "scroll bla bla"

				    		if(applyTo == "news"){

					        	// aca tenemos q ejecutar las consultas
					        	console.log("scrolleaste user news");

					        }else if(applyTo == "albumModule"){

					        	// aca tenemos q ejecutar las consultas
					        	console.log("scrolleaste user album");
					        }
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

function video(){
	function runVideo(videoSrc, imgSrc){

          $("#jquery_jplayer_1").jPlayer({
              
               ready: function () {
               
                $(this).jPlayer("setMedia", {
                 
                  m4v: videoSrc,
                  ogg: videoSrc,// ver q onda esto de los diferentes formatos
                  webm: videoSrc// ver q onda esto de los diferentes formatos
                  //poster: imgSrc

                }).jPlayer('play');
               },

               swfPath: "js",
               supplied: "m4v, ogg, webm"
          });
      }// end runVideo

       
       $(".petVideo").click(function(e){
        alert
            e.preventDefault();
            
            var thumb = $(this).find('img').attr('src');
            var video  = $(this).attr("href");
           // $("#jquery_jplayer_1").jPlayer("setMedia", {m4v: video}, {poster: thumb}).jPlayer("play");
            $(".modalWindows").show(300);

               $("#close").click(function(){ 
                   
                    $(".modalWindows").hide(300); 
                    $("#jquery_jplayer_1").jPlayer('destroy');
                    
               });

            runVideo(video, thumb);

            return false;
       });

} 