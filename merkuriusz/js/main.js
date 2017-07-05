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


$(function(){
	/* slider katalogu pdf'ów */
	(function( slider, arrows, viewbox, items ){
		var current = 0;
		var itrv;
		var num = items.length;
		var inview = function(){
			return Math.round( $( viewbox ).width() / item_width() );
		};
		var item_width = function(){
			return items.first().outerWidth(true);
			
		}
		
		slider
		.on({
			next: function( e ){
				current++;
				slider.triggerHandler( 'set' );
				
			},
			prev: function( e ){
				current--;
				slider.triggerHandler( 'set' );
				
			},
			set: function( e ){
				if( current < 0 ){
					current = num - inview() + 1;
					
				}
				else{
					current %= ( num - inview() + 1 );
					
				}
				
				TweenLite.to(
					viewbox,
					1,
					{
						scrollTo:{
							x: item_width() * current,
							
						},
						
					}
				);
				
			},
			start: function( e ){
				itrv = window.setInterval(function(){
					slider
					.triggerHandler( 'next' );
					
				},2500);
		
			},
			stop: function( e ){
				window.clearInterval( itrv );
				
			},
			mouseenter: function( e ){
				slider.triggerHandler( 'stop' );
				
			},
			mouseleave: function( e ){
				slider.triggerHandler( 'start' );
				
			},
			
		})
		.swipe({
			swipeLeft: function( e ){
				slider.triggerHandler( 'next' );
				
			},
			swipeRight: function( e ){
				slider.triggerHandler( 'prev' );
				
			},
			
		});
		
		arrows.eq(0).click(function( e ){
			slider.triggerHandler( 'prev' );
			
		});
		
		arrows.eq(1).click(function( e ){
			slider.triggerHandler( 'next' );
			
		});
		
		slider.triggerHandler( 'start' );
		
	})
	( $( '#home .catalog-slider-wrapper' ), $( '#home .catalog-slider-wrapper > .catalog-arrow-box' ), $( '#home .catalog-slider-wrapper > .catalog-container' ), $( '#home .catalog-slider-wrapper > .catalog-container > .catalog-element' ) );
	
	
});