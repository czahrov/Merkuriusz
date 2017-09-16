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
			
			// FACEBOOK SLIDER
			(function(){
				$('#face-slider').hover(
					function(){ $('#face-slider').stop().animate({"left": "0"}, 1000); },
					function(){ $('#face-slider').stop().animate({"left": "-302px"}, 1000); }
				);
				
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
				
			})();
			
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
			
			/* slider wystawiennicze */
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
					/*start: function( e ){
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
						
					}, */
					
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
				
				//slider.triggerHandler( 'start' );
				
			})
			( $( '.popup-content > .wystawiennicze-wrapper' ), $( '.popup-content ul.pager > li' ), $( '.popup-content > .wystawiennicze-wrapper' ), $( '.popup-content > .wystawiennicze-wrapper > .inner-catalog-wrapper' ) );
			
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
			
			/* przycisk stanu koszyka */
			(function( basket ){
				var lock = false;
				
				basket.on({
					update: function( e ){
						if( !lock ){
							lock = true;
							$.ajax({
								type: 'GET',
								url: root.bazar.basePath + '/koszyk?status',
								success: function( data ){
									try{
										var resp = JSON.parse( data );
										if( resp.num > 0 ){
											basket.children( '.basket-text' ).text( resp.num + ' szt | ' + resp.price + ' zł' );
											
										}
										else{
											basket.children( '.basket-text' ).text( 'Pusty' );
											
										}
										
									}
									catch( err ){
										console.error( err );
										console.log( data );
										
									}
									
								},
								complete: function(){
									lock = false;
									
								},
								
							})
							
						}
						
					},
					
				});
				
			})
			( $( '.navbar .basket' ) );
			
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
			( $( '#home .top-slider' ), $( '#home .top-slider > .text > .view > .item' ), $( '#home .top-slider > .imgs > .pagin > .item' ), $( '#home .top-slider > .imgs > .view > .item' ) );
			
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
				
				$(".pop-up-clothes.wystawnicze").click(function () {
					$(".wystawnicze-pop-up").fadeIn(300);
				});
				
				$(".pop-up-clothes.odziez-reklamowa").click(function () {
					$(".odziez-reklamowa-pop-up").fadeIn(300);
				});
				
				
				$(".pop-up-clothes.dlugopisymetalowe").click(function () {
					$(".dlugopisymetalowe-pop-up").fadeIn(300);
				});
				
				$(".pop-up-clothes.dlugopisyplastikowe").click(function () {
					$(".dlugopisyplastikowe-pop-up").fadeIn(300);
				});
				
				$(".pop-up-clothes.torby").click(function () {
					$(".torby-pop-up").fadeIn(300);
				});
				
				$(".pop-up-clothes.torby").click(function () {
					$(".torby-pop-up").fadeIn(300);
				});
				
			})();
			
			/* powerbanki */
			(function(){
				$( '.main-picture-powerbank > .over' )
				.attr({
					href: $( 'ul.menu .item[item-slug="power_banki"]' ).attr( 'href' ),
					
				})
				
			})();
			
		},
		kategoria: function(){
			var addon = root.addon;
			var logger = addon.isLogger();
			
			if(logger) console.log('page.index()');
			
			/*
			// breadcrumb
			(function( bread, cat, subcat ){
				if( cat.length !== '' && subcat.length !== '' ){
					
				}
				bread.text( [cat, subcat].join( ' > ' ) );
				
			})
			( $( '#grid .breadc' ), $( 'ul.menu > .item.active' ).attr( 'item-title' ), $( 'ul.menu > .item.active > .sub .item.active' ).attr( 'item-title' ) );
			*/
			
		},
		produkt: function(){
			var addon = root.addon;
			var logger = addon.isLogger();
			
			if(logger) console.log('page.produkt()');
			
			/* breadcrumb */
			(function( breadcrumb ){
				try{
					var parts = [];
					$( 'ul.menu .active' ).each(function(){
						parts.push( $(this).find( '.head:first > .title' ).text() );
						
					});
					parts.push( produkt_data.NAME );
					
					breadcrumb.text( parts.join( " > " ) );
					
				}
				catch( err ){
					console.error( err );
					
				}
				
			})
			( $( '#grid > .top > .breadc' ) );
			
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
			( $( '#grid .pic > .mini' ), 
			$( '#grid .pic > .mini > .view' ), 
			$( '#grid .pic > .mini > .view > .item' ), 
			$( '#grid .pic > .large' ), 
			$( '#grid .pic > .mini > .nav' ) );
			
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
			( $( '#single > .popup' ), 
			$( '#single > .popup > .box' ), 
			$( '#single > .popup > .box > .header > .close' ), 
			$( '#single > .popup > .box > .img > img' ), 
			$( '#grid .pic > .large' ) );
			
			/* kalkulator online */
			(function( kalkulator, ilosc, typ, kolory, statusbar, calculate, summary, total, cartBtn ){
				/* czy wprowadzone dane są poprawne */
				var data_correct = false;
				/* czy klient chce zrobić znakowanie produktu */
				var marking = false;
				/* blokada pociskania przycisku kalkulacji */
				var ajax_lock = false;
				/* blokada pociskania przycisku dodawania do koszyka */
				var cart_lock = false;
				
				kalkulator.on({
					init: function( e ){
						/* funkcja inicjująca ustawienia początkowe */
						summary.hide();
						kolory.parent().hide();
						kalkulator.triggerHandler( 'wynik', [ 'clear' ] );
						kalkulator.triggerHandler( 'notify', [ '', '' ] );
						
					},
					test: function( e ){
						/* funkcja testująca poprawność wprowadzonych danych */
						var t1 = /^\d+$/.test( ilosc.val() );
						var t11 = parseInt( ilosc.val() ) > 0;
						var t2 = typ.val() !== null;
						var t21 = typ.val() == 'brak';
						var t3 = kolory.val() !== null;
						
						if( t1 && t11 ){
							if( t21 || ( t2 && t3 ) ){
								data_correct = true;
								marking = ( t21 || !t2)?( false ):( true );
								calculate.addClass( 'active' );
								
							}
							else{
								data_correct = false;
								calculate.removeClass( 'active' );
								
							}
							
						}
						else{
							data_correct = false;
							calculate.removeClass( 'active' );
							
						}
						
					},
					wynik: function( e, mode ){
						if( mode === 'open' ){
							summary.slideDown();
							
						}
						else if( mode === 'close' ){
							summary.slideUp();
							
						}
						else if( mode === 'clear' ){
							summary.find( '.line.partial:not(.proto)' ).remove();
							
							total.text( '-' );
							
						}
						
					},
					calculate: function( e ){
						if( data_correct && !ajax_lock ){
							ajax_lock = true;
							kalkulator.triggerHandler( 'notify', [ 'wait', 'Obliczam...' ] );
							$.ajax({
								type: 'POST',
								url: root.bazar.basePath + '/kalkulator',
								data: {
									nazwa: produkt_data.NAME,
									num: parseInt( ilosc.val() ),
									mark: typ.val(),
									colors: parseInt( kolory.val() ),
									price: produkt_data.PRICE,
									
								},
								success: function( data, status ){
									if( data.trim() !== 'fail' ){
										try{
											var resp = JSON.parse( data );
											// console.log( resp );
											kalkulator.triggerHandler( 'notify', [ 'ok' ] );
											kalkulator.triggerHandler( 'fill', resp );
											
										}
										catch( err ){
											console.error( err );
											console.log( data );
											kalkulator.triggerHandler( 'notify', [ 'fail', 'Błąd serwera. Proszę spróbować ponownie za chwilę' ] );
											
										}
										
									}
									else{
										kalkulator.triggerHandler( 'notify', [ 'fail', 'Nie można obliczyć ceny. Brak cennika dla wybranego typu znakowania' ] );
										
									}
									
								},
								error: function(){
									kalkulator.triggerHandler( 'notify', [ 'fail', 'Błąd komunikacji z serwerem. Proszę spróbować ponownie za chwilę' ] );
									
								},
								complete: function(){
									ajax_lock = false;
									
								},
								
							});
							
						}
						
					},
					fill: function( e, data ){
						
						kalkulator.triggerHandler( 'wynik', [ 'clear' ] );
						
						var proto = summary.find( '.line.proto' );
						var anchor = summary.find( '.line.total' );
						
						$.each( data.lines, function( index, item ){
							var t = proto.clone().removeClass( 'proto hide' );
							
							t.children( '.field.name' ).text( item.title );
							
							t.children( '.field.formula' ).text( item.formula );
							
							t.children( '.field.sum' ).text( item.total );
							
							anchor.before( t );
							
						} );
						
						total.text( data.total );
						
						kalkulator.triggerHandler( 'wynik', [ 'open' ] );
						
					},
					notify: function( e, status, msg ){
						statusbar.removeClass( 'ok wait fail info' ).addClass( status );
						
						statusbar.children( '.text' ).html( '' ).html( msg );
						
					},
					cart: function( e ){
						if( cart_lock ) return false;
						cart_lock = true;
						var genID = function(){
							return '@' + new Date().getTime();
							
						};
						
						var myData = {
							zamowienie: genID(),
							ID: produkt_data.ID,
							nazwa: produkt_data.NAME,
							opis: produkt_data.DSCR,
							num: parseInt( ilosc.val() ),
							mark: {
								type: typ.val(),
								place: typ.children( 'option:selected' ).attr( 'size' ),
							},
							colors: parseInt( kolory.val() ),
							colorname: produkt_data.COLOR,
							price: produkt_data.PRICE,
							
						}
						
						console.log( myData );
						
						kalkulator.triggerHandler( 'notify', [ 'wait', 'Dodaję do koszyka...' ] );
						
						$.ajax({
							type: 'POST',
							url: root.bazar.basePath + '/koszyk',
							data: myData,
							success: function( data ){
								
								try{
									var resp = JSON.parse( data );
									console.log( resp );
									kalkulator.triggerHandler( 'notify', [ resp.status, resp.msg ] );
									
									if( resp.status === 'ok' ){
										kalkulator.find( '.tcell.dane' ).trigger( 'reset' );
										kalkulator.triggerHandler( 'wynik', [ 'close' ] );
										kalkulator.triggerHandler( 'wynik', [ 'clear' ] );
										$( '.navbar .basket' ).triggerHandler( 'update' );
										
									}
									
								}
								catch( err ){
									console.log( data );
									kalkulator.triggerHandler( 'notify', [ 'fail', 'Błąd odpowiedzi serwera. Spróbuj ponownie za chwilę' ] );
									
								}
								
							},
							error: function(){
								kalkulator.triggerHandler( 'notify', [ 'fail', 'Błąd komunikacji z serwerem. Proszę spróbować ponownie za chwilę' ] );
								
							},
							complete: function(){
								cart_lock = false;
								
							},
							
						});
						
					},
					
				});
				
				kalkulator.triggerHandler( 'init' );
				
				/* sprawdzanie poprawności danych przy każdej zmianie;
				zmiana danych po wykaniu kalkulacji zamyka widok podglądu, by użytkownik musiał zrobić kalkulację dla aktualnie ustawionych danych*/
				ilosc.add( typ ).add( kolory ).change( function( e ){
					kalkulator.triggerHandler( 'wynik', [ 'close' ] );
					kalkulator.triggerHandler( 'notify' );
					kalkulator.triggerHandler( 'test' );
					
				} );
				
				/* ukrywanie pola z kolorami jeśli nie wybrano typu znakowania, albo gdy wybrano opcję bez znakowania */
				typ.change( function( e ){
					if( $(this).val() === 'brak' ){
						kolory.parent().fadeOut();
						
					}
					else{
						kolory.parent().fadeIn();
						
					}
					
				} );
				
				calculate.click( function( e ){
					if( $(this).hasClass( 'active' ) ) kalkulator.triggerHandler( 'calculate' );
					
				} );
				
				cartBtn.click( function( e ){
					kalkulator.triggerHandler( 'cart' );
					
				} );
				
			})
			( $( '.table.kalkulator' ), 
			$( '.table.kalkulator .tcell.dane > .line.ilosc > input' ), 
			$( '.table.kalkulator .tcell.dane > .line.typ > select' ), 
			$( '.table.kalkulator .tcell.dane > .line.kolory > select' ), 
			$( '.table.kalkulator .tcell.dane > .line.button > .status' ), 
			$( '.table.kalkulator .tcell.dane > .line.button > .calc' ), 
			$( '.table.kalkulator .tcell.wynik' ), 
			$( '.table.kalkulator .tcell.wynik > .total  > .sum > span' ), 
			$( '.table.kalkulator .tcell.wynik > .line.cart > div' ) );
			
		},
		koszyk: function(){
			var addon = root.addon;
			var logger = addon.isLogger();
			
			if(logger) console.log('page.koszyk()');
			
			/* formularz zarządzania zestawami */
			(function( form, inputs, labels, delBtn, buyBtn, form2 ){
				/* czy tryb kupowania jest aktywny */
				buyMode = false;
				
				form.on({
					remove: function( e ){
						$.post(
							window.location.origin + window.location.pathname + '?del',
							form.serializeArray(),
							function( data ){
								try{
									var resp = JSON.parse( data );
									console.log( resp );
									if( resp.status === 'ok' ){
										window.alert( 'za chwile nastąpi przekierowanie' );
										window.location.reload();
										
									}
									
								}
								catch( err ){
									console.error( err );
									console.log( data );
									
								}
								
							}
						);
						
					},
					
				});
				
				inputs.change( function(){
					if( form.find( 'input:checkbox:checked' ).length < 1 ){
						form2.triggerHandler( 'hide' );
						buyMode = false;
						
					}
					
				} );
				
				delBtn.click( function( e ){
					form.triggerHandler( 'remove' );
					
				} );
				
				buyBtn.click( function( e ){
					if( buyMode){
						form2.triggerHandler( 'hide' );
						
					}
					else if( !buyMode && form.find( 'input:checkbox:checked' ).length > 0  ){
						form2.triggerHandler( 'show' );
						
					}
					
				} );
				
			})
			( $( 'form.opcje' ), 
			$( 'form.opcje input:checkbox' ), 
			$( 'form.opcje input:checkbox + label' ), 
			$( 'form.opcje .buttons > .del' ), 
			$( 'form.opcje .buttons > .buy' ), 
			$( 'form.form' ) );
			
			/* formularz składania zamówienia */
			(function( form, imie, tel, mail, file, msg, sendBtn, statusBar, loadBar, formOpcje ){
				var lock = false;
				var attachment = false;
				form.add( loadBar ).hide();
				
				form.on({
					show: function( e ){
						form.slideDown();
						
					},
					hide: function( e ){
						form.slideUp();
						form.trigger( 'reset' );
						
					},
					send: function( e ){
						if( lock ) return false;
						lock = true;
						/*
							imie: /^[a-zA-Z \-żźćńółąśęŻŹĆŃÓŁĄŚĘ]+$/,
							nazwa: /^[\w \-żźćńółąśęŻŹĆŃÓŁĄŚĘ]+$/,
							adres: /^[\w \-żźćńółąśęŻŹĆŃÓŁĄŚĘ\.,\d]+$/,
							telefon: /^[\d\+ \(\)]+$/,
							mail: /^[^\d_\.\-][\w\d \.\-!#\$%&'\*\+/=\?^`\{\|\}~]{1,64}@\w+(?:\.\w+)+$/,
							tekst: /^[\w\s \-żźćńółąśęŻŹĆŃÓŁĄŚĘ\[\]\{\}\|\+\?\.,\:;\$\^\*\(\)!#%~/\\]*$/,
							tekst_req: /^[\w\s \-żźćńółąśęŻŹĆŃÓŁĄŚĘ\[\]\{\}\|\+\?\.,\:;\$\^\*\(\)!#%~/\\]+$/,
						*/
						var checkForm = [
							{
								name: 'imie',
								item: imie,
								filterName: 'imie',
								
							},
							{
								name: 'tel',
								item: tel,
								filterName: 'telefon',
								
							},
							{
								name: 'mail',
								item: mail,
								filterName: 'mail',
								
							},
							{
								name: 'msg',
								item: msg,
								filterName: 'tekst',
								
							},
							
						];
						
						/* test walidacji */
						test = addon.form.verify( checkForm );
						if( test === true ){
							/* tworzenie obiektu formularza z danymi i dodawania wartości z pól */
							var myData = new FormData();
							
							$.each( form.serializeArray(), function( index, item ){
								myData.append( item.name, item.value );
								
							} );
							
							$.each( formOpcje.serializeArray(), function( index, item ){
								myData.append( item.name, item.value );
								
							} );
							
							
							if( file.prop( 'files' ).length > 0 ){
								$.each( file.prop( 'files' ), function( index, item ){
									myData.append( 'file', item );
									
								} );
								// myData.append( 'file', file.prop( 'files' )[0] );
								
							}
							
							$.ajax({
								type: 'POST',
								url: window.location.origin + window.location.pathname + '?buy',
								data: myData,
								contentType: false,
								processData: false,
								xhr: function(){
									jqxhr = new XMLHttpRequest;
									
									jqxhr.upload.addEventListener( 'loadstart', function( e ){
										loadBar.fadeIn( 'fast' );
										
									} );
									
									jqxhr.upload.addEventListener( 'progress', function( e ){
										form.triggerHandler( 'upload', [ e.loaded / e.total ] );
										
									} );
									jqxhr.upload.addEventListener( 'loadend', function( e ){
										loadBar.fadeOut( 'slow', function(){
											form.triggerHandler( 'upload', [ 0 ] );
											
										} );
										
									} );
									
									return jqxhr;
								},
								beforeSend: function(){
									form.triggerHandler( 'notify', [ 'wait', 'Wysyłam mail...' ] );
									
								},
								success: function( data ){
									form.triggerHandler( 'notify', [ 'ok', 'Mail wysłany pomyślnie!' ] );
									console.log( data );
									try{
										var resp = JSON.parse( data );
										console.log( resp );
										form.triggerHandler( 'notify', [ resp.status, resp.msg ] );
										
										if( resp.status === 'ok' ){
											window.setTimeout(function(){
												window.location.reload();
												
											}, 3000);
											
										}
										
									}
									catch( err ){
										console.error( err );
										console.warn( data );
										
									}
									
								},
								error: function(){
									
								},
								complete: function(){
									lock = false;
									
								},
								
							});
							
						}
						else{
							// console.log( test );
							$.each( test, function( index, item ){
								item.addClass( 'err' );
								
							} );
							
						}
						
					},
					notify: function( e, status, msg ){
						
						statusBar
						.removeClass( 'ok fail info wait' )
						.addClass( status )
						.children( '.text' )
						.html( msg );
						
					},
					upload: function( e, progress ){
						var str = Math.round( Math.pow( 10, 4 ) * progress ) / 100;
						
						loadBar.children( '.progres' ).text( str );
						TweenLite.to(
							loadBar.children( '.bar' ),
							.3,
							{
								scaleX: progress,
							}
						);
						
					},
					
				});
				
				file
				.change( function( e ){
					var files = $(this).prop( 'files' );
					var title = $(this).next( '.input' ).children( '.title' );
					
					if( files.length > 0 ){
						attachment = true;
						title.text( files[0].name );
						
					}
					else{
						attachment = false;
						title.text( 'Dodaj załącznik' );
						
					}
					
				} )
				.next( '.input' )
				.click( function( e ){
					file.click();
					
				} );
				
				sendBtn.click( function(){
					form.triggerHandler( 'send' );
					
				} );
				
				imie.add( tel ).add( mail ).focus( function(){
					$(this).removeClass( 'err' );
					
				} );
				
			})
			( $( 'form.form' ), 
			$( 'form.form .field.imie > input' ), 
			$( 'form.form .field.tel > input' ), 
			$( 'form.form .field.mail > input' ), 
			$( 'form.form .field.file > input' ), 
			$( 'form.form .field.msg > textarea' ), 
			$( 'form.form > .tbottom > .button' ), 
			$( 'form.form > .tbottom > .status' ), 
			$( 'form.form > .tbottom > .status > .load' ), 
			$( 'form.opcje' ) );
			
		},
		
	}
	
	$(function(){
		root.launcher();
	});
	
})();