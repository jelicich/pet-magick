$(document).ready(function(){

	$("body").css("overflow", "hidden");
	$("body").css("padding-right", "17px");
});

$(window).load(function () {
	$("#preloader").fadeOut("slow");
	$("body").css("padding-right", "0");
	$("body").delay(2000).css("overflow", "auto");
});

