//FELX SLIDER
function flexslider(){

	//$("#pet-album").on("ready", $(function(){
		$(function(){ 
		  $('.flexslider').flexslider({
		    animation: true,
		    animationLoop: true,
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

								container.find("input[type=password]").val("");
								container.find("input[type=text]").val("");
								if($("#passAlert")){
									$("#passAlert").remove();
						    	}
								$("#forgotContent").hide();
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
						//updateOnContentResize: true,
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
						updateOnContentResize: true
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

function video(){

	function runVideo(videoSrc, imgSrc){

          $("#jquery_jplayer_1").jPlayer({
              
               ready: function () {
               
                $(this).jPlayer("setMedia", {
                 
                  m4v: videoSrc,
                  ogg: videoSrc,
                  webm: videoSrc

                }).jPlayer('play');

               }, ended: function() {
			    	
			    	$(this).jPlayer("setMedia", {
                 
	                  m4v: videoSrc,
	                  ogg: videoSrc,
	                  webm: videoSrc,
	                  poster: imgSrc

	                }).jPlayer();
			  },

               swfPath: "js",
               supplied: "m4v, ogg, webm"
          });
      }// end runVideo

       
       $(".petVideo").click(function(e){
      
            e.preventDefault();
            
            var thumb = $(this).find('img').attr('src');
            var videos  = $(this).attr("href");
           // $("#jquery_jplayer_1").jPlayer("setMedia", {m4v: video}, {poster: thumb}).jPlayer("play");
            $(".modalWindows").fadeIn();

               $("#close").click(function(){ 
                   
                    $(".modalWindows").hide(); 
                    $("#jquery_jplayer_1").jPlayer('destroy');
                    
               });

            runVideo(videos, thumb);

            return false;
       });
} 



/*
function show_img(module){

	var close = 'img/close.png';
    var img = $('.link-img');

    $(module).find(img).click(function(e){

          e.preventDefault();

         var ruta = this.href;
		 var img = '<img class="imggr" src="' + ruta + '"/>';

		$('body').append("<div class='modaljq'><div class='modalwr'>"+ img + "<img src='"+ close +"' width='22' height='22' class='delnod'/></div></div>");
		$('.modaljq').css("overflow", "auto");
		$('html, body').css("overflow", "hidden");
		$("body").css("padding-right", "17px");
		$('.modaljq').hide();
		$('.modaljq').fadeIn();
		
		$('.delnod').click(function(){

			$('.modaljq').fadeOut(300, function()
				{
					$('.modaljq').remove();
					$('html, body').css("overflow", "auto");
					$("body").css("padding-right", "0");
				});
			
		});

	});

}
*/

function show_img(anchor){

	var close = 'img/close.png';
    //var img = $('.link-img');

    $(anchor).click(function(e){
    		//console.log(this.href);
          e.preventDefault();
          var caption = $(this).find('img').attr('alt');
          console.log($(this));
         //var ruta = this.href;
		 var img = '<img class="imggr" src="' + $(this).attr('href') + '"/>';
		if(caption != undefined)
        {
        	$('body').append("<div class='modaljq'><div class='modalwr'><div class='imggr-cont'>"+ img + "</div><img src='"+ close +"' width='22' height='22' class='delnod'/>"+"<div class='cap-cont'><p>"+ caption + "</p></div>"+"</div></div>");	
		}	
		else
		{
			$('body').append("<div class='modaljq'><div class='modalwr'><div class='imggr-cont'>"+ img + "</div><img src='"+ close +"' width='22' height='22' class='delnod'/></div></div>");
		}
		$('.modaljq').css("overflow", "auto");
		$('html, body').css("overflow", "hidden");
		$("body").css("padding-right", "17px");
		$('.modaljq').hide();
		$('.modaljq').fadeIn();
		
		$('.delnod').click(function(){

			$('.modaljq').fadeOut(300, function()
				{
					$('.modaljq').remove();
					$('html, body').css("overflow", "auto");
					$("body").css("padding-right", "0");
				});
			
		});

	});
}

function show_img_up(module){

	var close = 'img/close.png';
    var img = $('.link-img');

    $(module).find(img).click(function(e){

		e.preventDefault();
        var ruta = this.href;
		var img = '<img class="imggr" src="' + ruta + '"/>';
		var caption = $(this).find('img').attr('alt');
		

	/* $.ajax({

                type: "POST",
                url: "ajax/getCaptionForImg.php",
                data: 'ruta=' + ruta,
                cache: false,
	*/
       //         success: function(data){
                	//alert(data);
                	if(caption != undefined)
                	{
                		$('body').append("<div class='modaljq'><div class='modalwr'><div class='imggr-cont'>"+ img +"</div><img src='"+ close +"' width='22' height='22' class='delnod'/>"+"<div class='cap-cont'><p>"+ caption + "</p></div>"+"</div></div>");	
                		var wi = $('.imggr').width();
                		
                		//$('.cap-cont').css('width',wi+'px');
                	}	
                	else
                	{
                		$('body').append("<div class='modaljq'><div class='modalwr'><div class='imggr-cont'>"+ img +"</div><img src='"+ close +"' width='22' height='22' class='delnod'/></div></div>");
                	}
                		
					$('.modaljq').css("overflow", "auto");
					$('html, body').css("overflow", "hidden");
					$("body").css("padding-right", "17px");
					$('.modaljq').hide();
					$('.modaljq').fadeIn();
					
					$('.delnod').click(function(){

						$('.modaljq').fadeOut(300, function()
							{
								$('.modaljq').remove();
								$('html, body').css("overflow", "auto");
								$("body").css("padding-right", "0");
							});
						
					});
                //}
        //});
	});
}

// ========================= PASSWORD FUNCTIONS
function cleanAlerts(){

	if($("#passAlert")){

			$("#passAlert").remove();
	}
	
	setTimeout(function(){ $("#passAlert").remove(); }, 5000);
}

function updatePassword(id){

		$("#update").click(function(){

			var password = $("#password").val();
		    var newPassword = $("#newPassword").val();

		    if(password == '' || newPassword == ''){

		    	
			    	$("#password").val("");
			    	$("#newPassword").val("");


		    	cleanAlerts();

		    	$("#admin-pass").append("<div id='passAlert' class='alert alert-danger'>Complete both fields</div>");
		  
		    }else{

			    	$("#password").val("");
			    	$("#newPassword").val("");

			    $.ajax({
		            type: "POST",
		            url: "ajax/updatePassword.php",
		            data: {
		            		user_id: id, 
						    password: password, 
						    newPassword: newPassword 
						  }

		    	}).done(function(data){

		    		cleanAlerts();
		    		
		    		//if($("#passAlert")){
		    			
		    		//	$("#passAlert").remove();
		    		//}

		    		$("#admin-pass").append(data);
		    		
		    		
				});
			 }

			 //setTimeout(function(){ $("#passAlert").remove(); }, 3000);
		});
}

function forgotPassword(){

	$("#forgotPassword").click(function(){

		$("#forgotContent").toggle(300);

		$('#submitEmail').on("click", function(){
			
		    var email = $("#forgotEmail").val();

			if(email == ''){

					cleanAlerts();

					$("#forgotContent").append("<div id='passAlert' class='alert alert-danger'>Enter an email</div>");

			 }else{

		    	$.ajax({

			            type: "POST",
			            url: "ajax/forgotPassword.php",
			            data: { user_email: email }

		    	}).done(function(data){

			    		cleanAlerts();

			    		$("#forgotContent").append(data);

		    	});
			 }
		});
	});
}