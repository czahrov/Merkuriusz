$(function(){
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
	// slider główny na home
	(function( slider, teksty, paginacja, obrazy ){
		var current = 0;
		var itrv = null;
		var delay = 2.5;
		var duration = 1;
		var num = teksty.length;
		
		slider
		.on({
			set: function( e ){
				if( current < 0 ) current += num;
				
				current %= num;
				
				paginacja
				.eq( current )
				.addClass( 'active' )
				.siblings()
				.removeClass( 'active' );
				
				teksty
				.eq( current )
				.addClass( 'active' )
				.siblings()
				.removeClass( 'active' );
				
				
				obrazy
				.eq( current )
				.addClass( 'active' )
				.siblings()
				.removeClass( 'active' );
				
				TweenLite.fromTo(
					obrazy.filter( '.active' ),
					duration,
					{
						opacity: 0,
						
					},
					{
						opacity: 1,
						ease: Power2.easeInOut,
						
					}
				);
				
			},
			next: function( e ){
				current++;
				slider.triggerHandler( 'set' );
				
			},
			prev: function( e ){
				current--;
				slider.triggerHandler( 'set' );
				
			},
			stop: function( e ){
				window.clearInterval( itrv );
				itrv = null;
				
			},
			start: function( e ){
				if( itrv === null ){
					itrv = window.setInterval(function(){
						slider.triggerHandler( 'next' );
						
					},delay * 1000 );
					
				}
				
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
		
		paginacja.click(function( e ){
			slider.triggerHandler( 'stop' );
			current = $(this).index();
			slider.triggerHandler( 'set' );
			
		});
		
		slider.triggerHandler( 'start' );
		
	})
	( $( '#home .top-slider' ), $( '#home .top-slider > .text > .view > .item' ), $( '#home .top-slider > .text > .pagin > .item' ), $( '#home .top-slider > .imgs > .view > .item' ) );
	
	// kategorie
	(function( items ){
		items
		.children( '.head' )
		.click(function( e ){
			$(this)
			.parent()
			.toggleClass( 'open' )
			.siblings()
			.removeClass( 'open') ;
			
		});
		
	})
	( $('ul.menu > li') );
	
	
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
					current = num - inview();
					
				}
				else{
					current %= ( num - inview() + 1 );
					
				}
				
				//console.log( current );
				
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
	( $( '.catalog-slider-wrapper' ), $( '.catalog-slider-wrapper > .catalog-arrow-box' ), $( '.catalog-slider-wrapper > .catalog-container' ), $( '.catalog-slider-wrapper > .catalog-container > .catalog-element' ) );
	
	/* slider partnerów */
	(function( slider, arrows, viewbox, items ){
		var current = 0;
		var delay = 3000;
		var num = items.length;
		var mdown = false;
		var mdata = {};
		var itrv;
		
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
				//var scrollLeft = Math.ceil( viewbox.prop( 'scrollLeft' ) );
				var scrollWidth = Math.floor( viewbox.prop( 'scrollWidth' ) );
				var width = Math.floor( viewbox.width() );
				var max = Math.floor( scrollWidth / ( width * 0.5 ) );
				
				current %= max;
				
				if( current < 0 ){
					current = max - 1;
					
				}
				
				//console.log( [current, max, scrollWidth, width] );
				
				TweenLite.to(
					viewbox,
					1.5,
					{
						scrollTo:{
							x: Math.round( width * 0.5 * current ),
							
						},
						ease: Power2.easeOut,
						
					}
				);
				
			},
			start: function( e ){
				itrv = window.setInterval(function(){
					slider.triggerHandler( 'next' );
					
				},delay);
				
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
			swipeLeft: function(){
				slider.triggerHandler( 'next' );
				
			},
			swipeRight: function(){
				slider.triggerHandler( 'prev' );
				
			},
			
		});
		
		arrows.eq(0).click(function(){
			slider.triggerHandler( 'prev' );
			
		});
		
		arrows.eq(1).click(function(){
			slider.triggerHandler( 'next' );
			
		});
		
		slider.triggerHandler( 'start' );
		
	})
	( $( '.partner-slider' ), $( '.partner-slider > .partner-arrow-box' ), $( '.partner-slider > .partner-wrapper' ), $( '.partner-slider > .partner-wrapper > .partner-icon-box' ) );
	
});