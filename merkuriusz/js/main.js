$(function(){
	// paginacja
	(function( ball ){
		ball
		.click(function( e ){
			$(this)
			.addClass('pager-ball-active')
			.siblings()
			.removeClass('pager-ball-active');
			
		});
		
	})( $('.sidebar-intro > .pager-box > .pager-ball') );
	
	// kategorie
	(function( items ){
		items
		.click(function( e ){
			$(this)
			.toggleClass('open');
			
		});
		
	})( $('.sidebar-navigation li') );
	

	/* POP UP */
	$(document).ready(function () {
     $(".pop-up-clothes.clothes").click(function () {
         $(".catalog-popup").fadeIn(300);
       
     });

     $(".popup > .pop-cross").click(function () {
         $(".cover-popup").fadeOut(300);
     });
	 });

	$(document).ready(function () {
     $(".pop-up-clothes.movie").click(function () {
         $(".movie-cover-popup").fadeIn(300);
       
     });

     $(".movie-cover-popup").click(function () {
         $(this).fadeOut(300);
     });
	 });

	$(document).ready(function () {
     $(".pop-up-clothes.powerbank").click(function () {
         $(".powerbank-pop-up").fadeIn(300);
       
     });

     $(".popup > .pop-cross").click(function () {
         $(".cover-popup").fadeOut(300);
     });
	 });

	$(document).ready(function () {
     $(".pop-up-clothes.wystawnicze").click(function () {
         $(".wystawnicze-pop-up").fadeIn(300);
       
     });

     $(".popup > .pop-cross").click(function () {
         $(".cover-popup").fadeOut(300);
     });
	 });
		$(document).ready(function () {
     $(".pop-up-clothes.odziez-reklamowa").click(function () {
         $(".odziez-reklamowa-pop-up").fadeIn(300);
       
     });

     $(".popup > .pop-cross").click(function () {
         $(".cover-popup").fadeOut(300);
     });
	 });
	 		$(document).ready(function () {
     $(".pop-up-clothes.dlugopisymetalowe").click(function () {
         $(".dlugopisymetalowe-pop-up").fadeIn(300);
       
     });

     $(".popup > .pop-cross").click(function () {
         $(".cover-popup").fadeOut(300);
     });
	 });
	 		$(document).ready(function () {
     $(".pop-up-clothes.dlugopisyplastikowe").click(function () {
         $(".dlugopisyplastikowe-pop-up").fadeIn(300);
       
     });

     $(".popup > .pop-cross").click(function () {
         $(".cover-popup").fadeOut(300);
     });
	 });
	/* FACE SLIDER */

	/*
	$('.sidebar-navigation > ul > li > a')
	.click(function( e ){
		$(this)
		.parent()
		.toggleClass('open')
		
		$(this)
		.siblings('.dropdown-category')
		.slideToggle();
		
		$(this)
		.parent()
		.siblings()
		.children('.dropdown-category')
		.slideUp();
		
	});
	*/
	
});

/* FACE SLIDER */

$(function(){
	$('#face-slider').hover(
		function(){ $('#face-slider').stop().animate({"left": "0"}, 1000); },
		function(){ $('#face-slider').stop().animate({"left": "-302px"}, 1000); }
	);
});

/* SLIDE DOWN */
$(document).ready(function () {

var getPos = function(){
	return $('#about-section1').position().top;
};

$(".down-slider").click(function () {

TweenLite.to(
	window,
	1,
	{
		scrollTo: getPos(),
	}
);
});
});


