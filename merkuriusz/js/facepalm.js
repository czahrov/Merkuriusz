(function(){
	var root = {};
	root.launcher = function(){
		if( typeof root.page.default === 'function' ) root.page.default();
		var path = window.location.pathname.match(new RegExp('^' + root.bazar.basePath + '(.*)$','i'))[1];
		
		if(path == '/'){		// czy strona główna?
			if( typeof root.page.index === 'function' ) root.page.index();
			
		}
		else{		//podstrona
			var subpage = path.match(/([\w\-]+)\/$/)[1];
			var t = subpage.replace(/\-/g,'_');
			if(typeof subpage === 'string' && subpage.length){
				if(typeof root.page[t] === 'function'){
					root.page[t]();
					
				}
				else if( typeof root.page.alternate === 'function' ) root.page.alternate();
				
			}
			
		}
		
	},
	root.bazar = {
		basePath: '/PiotrM/wp_merkuriusz',		// ścieżka do podfolderu ze stroną (np: /adres/do/podfolderu, albo wartość pusta )
		logger: /logger/i.test(window.location.hash),		// czy wyświetlać komunikaty o wywoływaniu funkcji
		mobile: /mobile/i.test(window.location.hash) || undefined,		// czy aktualnie używane urządzenie jest urządzeniem mobilnym
		
	},
	root.addon = {
		isLogger: function(){
			return root.bazar.logger || false;
		},
		isMobile: function(){
			var bazar = root.bazar;
			var logger = bazar.logger || false;
			if(logger) console.log('isMobile()');
			if(typeof bazar.mobile === 'undefined'){
				bazar.mobile = /Mobile|Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
				
			}
			
			return bazar.mobile;
			
		},
		youtube: function(arg){
			/*
				arg = {
					ID*			// ID filmu video na YT
					iframe*		// element jQuery albo selektor iframe do odtwarzania filmu
					autoplay	// automatyczne odtwarzanie filmu [1/0]
					loop		// zapętlanie filmu [1/0]
					controls	// kontrolki filmu [1/0]
					beforePlay	// funkcja wywoływana przed rozpoczęciem odtwarzania filmu
					onClose		// funkcja wywoływana przy zamykaniu filmu
					
				}
			*/
			
			try{
				var logger = root.bazar.logger || false;
				
				if(typeof arg.ID !== 'string') throw 'Niepoprawny ID filmu';
				if(!$(arg.iframe).length) throw 'iframe nie istnieje';
				arg.autoplay = arg.autoplay || 0;
				arg.loop = arg.loop || 0;
				arg.controls = arg.controls || 1;
				arg.beforePlay = arg.beforePlay || function(){};
				arg.onClose = arg.onClose || function(){};
				
				var ret = {
					el: arg.iframe,
					url: "https://www.youtube.com/embed/"+ arg.ID +"?controls="+ arg.controls +"&autoplay="+ arg.autoplay +"&loop="+ arg.loop,
					open: function(){
						arg.beforePlay(this.el);
						$(this.el).attr({
							src: this.url,
							
						});
						
					},
					close: function(){
						arg.onClose(this.el);
						$(this.el).attr({
							src: '',
							
						});
						
					}
					
					
				};
				
				return ret;
				
			}
			catch(err){
				if(logger) console.error(err);
				
			}
			finally{
				
			}
			
		},
		form:{
			filters:{
				imie: /^[a-zA-Z \-żźćńółąśęŻŹĆŃÓŁĄŚĘ]+$/,
				nazwa: /^[\w \-żźćńółąśęŻŹĆŃÓŁĄŚĘ]+$/,
				adres: /^[\w \-żźćńółąśęŻŹĆŃÓŁĄŚĘ\.,\d]+$/,
				telefon: /^[\d\+ \(\)]+$/,
				mail: /^[^\d_\.\-][\w\d \.\-!#\$%&'\*\+/=\?^`\{\|\}~]{1,64}@\w+(?:\.\w+)+$/,
				tekst: /^[\w\s \-żźćńółąśęŻŹĆŃÓŁĄŚĘ\[\]\{\}\|\+\?\.,\:;\$\^\*\(\)!#%~/\\]*$/,
				tekst_req: /^[\w\s \-żźćńółąśęŻŹĆŃÓŁĄŚĘ\[\]\{\}\|\+\?\.,\:;\$\^\*\(\)!#%~/\\]+$/,
			},
			verify: function(arg){		// arg = tablica obiektów {name, item, filterName}
				var logger = root.addon.isLogger();
				if(logger) console.log('form.verify()');
				var self = this;
				if(typeof arg === 'object' && typeof arg.length === 'number'){
					var errors = [];
					for(i in arg){
						var value = $(arg[i].item).val();
						if(typeof arg[i] === 'object' && typeof value !== 'undefined' && typeof arg[i].filterName === 'string' && typeof arg[i].name === 'string' && typeof self.filters[arg[i].filterName] !== 'undefined'){
							if(!self.filters[arg[i].filterName].test(value)){
								errors.push(arg[i].item);
							}
							
						}
						else return false;
						
					}
					
					if(errors.length){
						return errors;
						
					}
					else return true;
					
				}
				
				return false;
				
			},
		},
		
	},
	root.page = {
		default: function(){
			var addon = root.addon;
			var logger = addon.isLogger();
			
			if(logger){
				window.facepalm = root;
				console.log('page.default()');
			}
			
			// SLIDE DOWN
			(function(){
				var getPos = function(){
					return $('#about-section1').position().top;
				};

				$(".down-slider").click(function () {
					TweenLite.to(
						window,
						1,
						{
							scrollTo:{
								y: getPos(),
							},
							
						}
					);

				});				
			})();
			
			// FACE SLIDER
			(function(){
				$('#face-slider').hover(
					function(){ $('#face-slider').stop().animate({"left": "0"}, 1000); },
					function(){ $('#face-slider').stop().animate({"left": "-302px"}, 1000); }
				);
				
			})();
			
			// POPUPy
			(function(){
				$(".pop-up-clothes.clothes").click(function () {
					$(".catalog-popup").fadeIn(300);
				});
				
				$(".popup > .pop-cross").click(function () {
					$(".cover-popup").fadeOut(300);
				});
				
				$(".pop-up-clothes.movie").click(function () {
					$(".movie-cover-popup").fadeIn(300);
					
				});
				
				$(".movie-cover-popup").click(function () {
					$(this).fadeOut(300);
				});
				
				$(".pop-up-clothes.powerbank").click(function () {
					$(".powerbank-pop-up").fadeIn(300);   
				});

				$(".popup > .pop-cross").click(function () {
					$(".cover-popup").fadeOut(300);
				});
				
				$(".pop-up-clothes.wystawnicze").click(function () {
					$(".wystawnicze-pop-up").fadeIn(300);
				});

				$(".popup > .pop-cross").click(function () {
					$(".cover-popup").fadeOut(300);
				});
				
				$(".pop-up-clothes.odziez-reklamowa").click(function () {
					$(".odziez-reklamowa-pop-up").fadeIn(300);
				});
				
				$(".popup > .pop-cross").click(function () {
					$(".cover-popup").fadeOut(300);
				});
				
				$(".pop-up-clothes.dlugopisymetalowe").click(function () {
					$(".dlugopisymetalowe-pop-up").fadeIn(300);
				});

				$(".popup > .pop-cross").click(function () {
					$(".cover-popup").fadeOut(300);
				});
				
				$(".pop-up-clothes.dlugopisyplastikowe").click(function () {
					$(".dlugopisyplastikowe-pop-up").fadeIn(300);
				});
				
				$(".popup > .pop-cross").click(function () {
					$(".cover-popup").fadeOut(300);
				});
				
			})();
			
			// rozwijanie kategorii oznaczonej jako active
			(function( item ){
				item
				.addClass( 'open' )
				.siblings()
				.removeClass( 'open' );
				
			})
			( $('ul.menu > .item.active') );
			
			// kategorie - zwijanie i rozwijanie
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
			
			/* domyślne rozwijanie kategorii VIP */
			(function(){
				if( !/cat=/.test( window.location.search ) ){
					$( 'ul.menu > .item.vip' )
					.addClass( 'open' )
					.siblings( '.item' )
					.removeClass( 'open' );
					
				}
				
			})
			();
			
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
								ease: Power2.easeInOut,
								
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
			
			
		},
		alternate: function(){
			var addon = root.addon;
			var logger = addon.isLogger();
			
			if(logger) console.log('page.alternate()');
			
		},
		index: function(){
			var addon = root.addon;
			var logger = addon.isLogger();
			
			if(logger) console.log('page.index()');
			
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
			
			
			
		},
		kategoria: function(){
			var addon = root.addon;
			var logger = addon.isLogger();
			
			if(logger) console.log('page.index()');
			
			// breadcrumb
			(function( bread, cat, subcat ){
				if( cat.length !== '' && subcat.length !== '' ){
					
				}
				bread.text( [cat, subcat].join( ' > ' ) );
				
			})
			( $( '#grid .breadc' ), $( 'ul.menu > .item.active' ).attr( 'item-title' ), $( 'ul.menu > .item.active > .sub .item.active' ).attr( 'item-title' ) );
			
		},
		produkt: function(){
			var addon = root.addon;
			var logger = addon.isLogger();
			
			if(logger) console.log('page.produkt()');
			
			/* przełączanie zakładek - pakowanie / inne */
			(function( pak, pak_btn, inne, inne_btn ){
				pak_btn.click(function( e ){
					$(this)
					.addClass( 'active' )
					.siblings()
					.removeClass( 'active' );
					
					pak
					.removeClass( 'fp-hide' )
					.siblings( '.box' )
					.addClass( 'fp-hide' );
					
				});
				
				inne_btn.click(function( e ){
					$(this)
					.addClass( 'active' )
					.siblings()
					.removeClass( 'active' );
					
					inne
					.removeClass( 'fp-hide' )
					.siblings( '.box' )
					.addClass( 'fp-hide' );
					
				});
				
			})
			( $( '.multi.seg > .pakowanie' ), $( '.multi.seg > .flex > .pakowanie' ), $( '.multi.seg > .inne' ), $( '.multi.seg > .flex > .inne' ) );
			
			// breadcrumb
			(function( bread, cat, subcat, name ){
				if( cat.length !== '' && subcat.length !== '' ){
					
				}
				bread.text( [cat, subcat, name].join( ' > ' ) );
				
			})
			( $( '#grid .breadc' ), $( 'ul.menu > .item.active' ).attr( 'item-title' ), $( 'ul.menu > .item.active > .sub .item.active' ).attr( 'item-title' ), $( '.main.seg .line.name > .val' ).text() );
			
			/* obsługa miniaturek produktu */
			(function( slider, view, img, large, nav ){
				var current = 0;
				
				var posX = function(){
					return current * img.first().outerWidth( true );
					
				}
				
				slider
				.on({
					set: function( e ){
						if( current < 0 ){
							current = ( img.length - 3 );
						}
						
						current %= ( img.length - 2 );
						
						TweenLite.to(
							view,
							.5,
							{
								scrollTo:{
									x: posX(),
									
								},
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
					
				})
				.swipe({
					swipeLeft: function( e ){
						slider.triggerHandler( 'next' );
						
					},
					swipeRight: function( e ){
						slider.triggerHandler( 'prev' );
						
					},
					
				});
				
				nav.click(function( e ){
					if( $(this).hasClass( 'next' ) ){
						slider.triggerHandler( 'next' );
						
					}
					else{
						slider.triggerHandler( 'prev' );
						
					}
					
				});
				
				img.click(function( e ){
					var img = $(this).css( 'backgroundImage' );
					large.css({
						backgroundImage: img,
						
					});
					
				});
				
			})
			( $( '#grid .pic > .mini' ), $( '#grid .pic > .mini > .view' ), $( '#grid .pic > .mini > .view > .item' ), $( '#grid .pic > .large' ), $( '#grid .pic > .mini > .nav' ) );
			
			/* zakładki znakowanie / kalkulator */
			(function( tabs, boxes ){
				tabs.eq(0).click(function( e ){
					$(this)
					.addClass( 'active' )
					.siblings()
					.removeClass( 'active' );
					
					boxes
					.filter('.znakowanie')
					.addClass( 'active' )
					.siblings( '.box' )
					.removeClass( 'active' );
					
				});
				
				tabs.eq(1).click(function( e ){
					$(this)
					.addClass( 'active' )
					.siblings()
					.removeClass( 'active' );
					
					boxes
					.filter('.kalkulator')
					.addClass( 'active' )
					.siblings( '.box' )
					.removeClass( 'active' );
					
				});
				
				
			})
			( $( '.dane > .marking > .tabs > .title' ), $( '.dane > .marking > .box' ) );
			
			/* znakowanie */
			(function( warianty, znakowanie, kalkulator, cena ){
				kalkulator
				.on({
					test: function( e ){
						if( warianty.filter( '.selected' ).length > 0 ){
							kalkulator
							.children( '.empty' )
							.hide()
							.siblings( '.order' )
							.show();
							
						}
						else{
							kalkulator
							.children( '.order' )
							.hide()
							.siblings( '.empty' )
							.show();
							
						}
						
					},
					calc: function( e ){
						cena.text( 'Obliczam...' );
						var data = {
							num: kalkulator.find( 'input.user' ).val(),
							order: {
								
							},
							
						};
						
						warianty.filter( '.selected' ).each(function(){
							var type = $(this).attr( 'mark-type' )
							var place = $(this).attr( 'mark-place' )
							var size = $(this).attr( 'mark-size' )
							
							if( typeof data.order[ type ] === 'undefined' ) data.order[ type ] = {};
							data.order[ type ][ place ] = {};
							if( typeof data.order[ type ][ place ][ size ] === 'undefined' ) data.order[ type ][ place ][ size ] = true;
							
						});
						
						
						$.ajax({
							type: "POST",
							url: '../kalkulator',
							data: data,
							success: function( data, status, xhr ){
								//console.log( data );
								var t = data.match( /\[res:(.+)\]/ )[1];
								//console.log({ t:t });
								cena.text( t );
								
							},
							
						});
						
					},
					
				});
				
				warianty.click(function( e ){
					if( $(this).hasClass( 'selected' ) ){
						$(this).removeClass( 'selected' );
						
					}
					else{
						$(this)
						.addClass( 'selected' )
						.siblings( '.custom-checkbox.selected[mark-place="'+ $(this).attr( 'mark-place' ) +'"]' )
						.removeClass( 'selected' );
						
					}
					
					kalkulator.triggerHandler( 'test' );
					
					
				});
				
				kalkulator.children( '.order' ).hide();
				
				kalkulator.find( 'input.user' ).blur(function( e ){
					kalkulator.triggerHandler( 'calc' );
					
				});
				
			})
			( $( '.dane > .marking > .znakowanie .custom-checkbox' ), $( '.dane > .marking > .znakowanie' ), $( '.dane > .marking > .kalkulator' ), $( '.dane > .marking > .kalkulator > .order > .price > .ajax' ) );
			
			/* popup produktu */
			(function( popup, view, close, img, large ){
				popup
				.on({
					open: function( e ){
						popup
						.addClass( 'open' );
						
					},
					close: function( e ){
						popup
						.removeClass( 'open ready' );
						
						img
						.attr({
							src: '',
							
						});
						
					},
					img: function( e, url ){
						var match = url.match(/\("(.+)"\)/);
						img.attr({
							src: match[1],
							
						});
						
					},
					ready: function( e ){
						popup
						.addClass( 'ready' );
						
					},
					
				});
				
				img
				.on({
					load: function( e ){
						popup.triggerHandler( 'ready' );
						
					},
					
				});
				
				large
				.click(function( e ){
					popup.triggerHandler( 'open' );
					popup.triggerHandler( 'img', [ large.css( 'background-image' ) ] );
					
				});
				
				close
				.add( popup )
				.click(function( e ){
					popup.triggerHandler( 'close' );
					
				});
				
				view
				.click(function( e ){
					e.stopPropagation();
					
				});
				
			})
			( $( '#single > .popup' ), $( '#single > .popup > .box' ), $( '#single > .popup > .box > .header > .close' ), $( '#single > .popup > .box > .img > img' ), $( '#grid > .mid > .pic > .large' ) );
			
		},
		
	}
	
	$(function(){
		root.launcher();
	});
	
})();