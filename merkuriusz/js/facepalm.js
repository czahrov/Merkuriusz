(function(){
	var root = {};
	root.launcher = function(){
		if( typeof root.page.default === 'function' ) root.page.default();
		var path = window.location.pathname.match(new RegExp('^' + root.bazar.basePath + '(.*)$','i'))[1];
		
		if(path == '/'){		// czy strona główna?
			if( typeof root.page.index === 'function' ) root.page.index();
			
		}
		else{		//podstrona
			// var subpage = path.match(/([\w\-]+)\/$/)[1];
			var subpage = path.match(/([^\/]+)/g).slice( -1 )[0];
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
		// basePath: '/PiotrM/wp_merkuriusz',		// ścieżka do podfolderu ze stroną (np: /adres/do/podfolderu, albo wartość pusta )
		basePath: '',		// ścieżka do podfolderu ze stroną (np: /adres/do/podfolderu, albo wartość pusta )
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
			
			/* popupy katalogów pdf */
			(function( popup, box, close, viewbox, views, katalog_pic, btnOdziez, items ){
				var lock = false;
				var duration = 0.5;
				
				popup
				.on({
					open: function( e, name, img ){
						console.log( [ name, img ] );
						if( lock ) return false;
						lock = true;
						
						katalog_pic
						.attr( 'src', function(){
							try{
								var url = img.match( /[^"]+/g );
								if( url.length < 3 ) throw {
									msg: 'Niewłaściwy adres obrazka',
									reason: url,
									
								};
								
								return url[1];
								
							}
							catch( err ){
								console.error( err );
								
							}
							
						} );
						
						views
						.filter( '[class*="'+ name +'"]' )
						.show()
						.siblings()
						.hide();
						
						new TimelineLite({
							onStart: function(){
								popup.addClass( 'open' );
								
							},
							onComplete: function(){
								box.attr( 'style', '' );
								
								lock = false;
								
							},
							
						})
						.add( 'start', 0 )
						.add(
							TweenLite.fromTo(
								popup,
								duration,
								{
									opacity: 0,
								},
								{
									opacity: 1,
								}
							), 'start'
						)
						.add(
							TweenLite.fromTo(
								box,
								duration,
								{
									y: -200,
									rotationX: -90,
								},
								{
									y: 0,
									rotationX: 0,
								}
							), 'start+=' + duration
						);
						
					},
					close: function( e ){
						if( lock ) return false;
						lock = true;
						
						new TimelineLite({
							onComplete: function(){
								popup.removeClass( 'open' );
								
								box.attr( 'style', '' );
								
								lock = false;
								
							},
							
						})
						.add( 'start', 0 )
						.add(
							TweenLite.to(
								box,
								duration,
								{
									y: -200,
									rotationX: 90,
								}
							), 'start'
						)
						.add(
							TweenLite.to(
								popup,
								duration,
								{
									opacity: 0,
								}
							), 'start+=' + duration
						);
						
					},
					
				});
				
				popup
				.add( close )
				.click( function( e ){ popup.triggerHandler( 'close' ); } );
				
				box.click( function( e ){ e.stopPropagation() } );
				
				btnOdziez.click( function( e ){
					popup.triggerHandler( 'open', [ 'reklamowa', $(this).parents( '.item:first' ).css( 'background-image' ) ] );
					
				} );
				
				items.click( function( e ){
					popup.triggerHandler( 'open', [ $(this).attr( 'item' ), $(this).css( 'background-image' ) ] );
					
				} );
				
				items.find( '.hitbox' ).click( function( e ){
					e.stopPropagation();
					
				} );
				
			})
			( $( '.popup.katalog' ),
			$( '.popup.katalog > .box' ),
			$( '.popup.katalog > .box > .close-fp' ),
			$( '.popup.katalog > .box > .viewbox' ),
			$( '.popup.katalog > .box > .viewbox > .view' ),
			$( '.popup.katalog > .box > .viewbox > .view .pic img' ),
			$( '#home .kafelki .item.odziez .link' ),
			$( '.catalog-slider .catalog-element > .catalog' ) );
			
			/* newsletter */
			(function( panel, form, input, button, status ){
				var unreg = false;
				
				panel
				.on({
					init: function( e ){
						status.hide();
						
					},
					msg: function( e, stat, msg ){
						status
						.removeClass( 'pass info fail' )
						.addClass( stat )
						.children( '.msg' )
						.html( msg );
						
						status.slideDown();
						
					},
					send: function( e ){
						var url = "newsletter?@mode@=@data@";
						
						$.ajax({
							type: 'GET',
							url: url.replace( /@mode@/, unreg===false?( 'add' ):( 'unreglink' ) ).replace( /@data@/, input.val().trim() ),
							success: function( data ){
								try{
									var resp = JSON.parse( data );
									panel.triggerHandler( 'msg', [ resp.status, resp.msg ] );
									
									if( resp.status === 'info' ){
										unreg = true;
										
									}
									else{
										unreg = false;
										
									}
									
								}
								catch( err ){
									console.error( err );
									console.info( data );
									panel.triggerHandler( 'msg', [ 'fail', 'Błąd odpowiedzi serwera.<br>Proszę spróbować ponownie za chwilę.' ] );
									
								}
								
							},
							error: function(){
								panel.triggerHandler( 'msg', [ 'fail', 'Nie udało się nawiązać połączenia z serwerem.<br>Spróbuj ponownie za chwilę.' ] );
								
							},
							
						});
						
					},
					
				});
				
				panel.triggerHandler( 'init' );
				
				button.click( function( e ){
					panel.triggerHandler( 'send' );
					
				} );
				
				status.click( function( e ){
					$(this).slideUp();
					
				} );
				
				input.change( function( e ){
					unreg = false;
					
				} );
				
			})
			( $( '#home > .newsletter' ), 
			$( '#home > .newsletter .form' ), 
			$( '#home > .newsletter .form > .mail' ), 
			$( '#home > .newsletter .form > .send' ), 
			$( '#home > .newsletter .status' ) );
			
			/* popup hint */
			(function( popup, box, close, button ){
				var delay = 20 * 1000;
				var btn_duration = 1;
				var popup_duration = .5;
				var anim;
				
				/* animacja */
				(function(){
					anim = new TimelineLite({
						paused: true,
						onStart: function(){
							if( !this.reversed() ){
								$(popup).addClass( 'open' );
								
							}
							
						},
						onReverseComplete: function(){
							$(popup).removeClass( 'open' );
							
						},
						
					})
					.add( 'start', 0 )
					.add(
						TweenLite.fromTo(
							popup,
							popup_duration,
							{
								opacity: 0,
							},
							{
								opacity: 1,
							}
						), 'start'
					)
					.add(
						TweenLite.fromTo(
							box,
							popup_duration,
							{
								opacity: 0,
								yPercent: -50,
							},
							{
								opacity: 1,
								yPercent: 0,
							}
						), 'start+=' + popup_duration
					);
					
				})();
				
				button
				.on({
					init: function( e ){
						button.triggerHandler( 'hide', true );
						window.setTimeout(function(){
							button.triggerHandler( 'show' );
							
						}, delay);
						
					},
					show: function( e ){
						TweenLite.to(
							$(this),
							btn_duration,
							{
								xPercent: 0,
								x: 0,
								ease: Power2.easeOut,
								onStart: function(){
									$(button).addClass( 'open' );
									
								},
							}
						);
						
					},
					hide: function( e, fast ){
						if( fast === true ){
							TweenLite.set(
								$(this),
								{
									xPercent: 100,
									x: 50,
								}
							);
							
						}
						else{
							TweenLite.to(
								$(this),
								btn_duration,
								{
									xPercent: 100,
									x: 50,
									ease: Power2.easeIn,
								}
							);
							
						}
						
					},
					click: function( e ){
						popup.triggerHandler( 'open' );
						
					},
					
				});
				
				popup
				.on({
					init: function( e ){
						button.triggerHandler( 'init' );
						
					},
					open: function( e ){
						anim.play();
						
					},
					close: function( e ){
						anim.reverse();
						
					},
					click: function( e ){
						popup.triggerHandler( 'close' );
						
					},
					
				});
				
				box.click( function( e ){
					e.stopPropagation();
					
				} );
				
				close.click( function( e ){
					popup.triggerHandler( 'close' );
					
				} );
				
				popup.triggerHandler( 'init' );
				
			})
			( $( '.popup-hint' ), 
			$( '.popup-hint > .box' ), 
			$( '.popup-hint > .box > .btn-close' ), 
			$( '.popup-hint-button' ) );
			
			/* oznaczanie aktywnych pozycji w menu głównym */
			(function( items, sklep ){
				var url = window.location.origin + window.location.pathname.match( /^(.*)\/$/ )[1];
				
				if( /kategoria|produkt/.test( location.pathname ) ){
					sklep
					.addClass( 'active' );
					
				}
				else{
					items
					.filter( '[href="'+ url +'"]' )
					.addClass( 'active' );
					
				}
				
			})
			( $( '#menu > .grid > .box > a' ),
			$( '#sidebar ul.menu > .title' ) );
			
			/* menu toggle */
			(function( grid, toggle ){
				toggle.click(function( e ){
					grid
					.add( toggle )
					.toggleClass( 'open' );
					
				});
				
			})
			( $( '#menu > .grid' ),
			$( '#menu > .grid > .toggle' ) );
			
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
				/* if( !/cat=/.test( window.location.search ) ){
					$( 'ul.menu > .item.vip' )
					.addClass( 'open' )
					.siblings( '.item' )
					.removeClass( 'open' );
					
				} */
				
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
								url: '../koszyk?status',
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
			( $( '#basket' ) );
			
			/* newsletter */
			(function( newsletter, form, input, button ){
				form.submit( function( e ){
					e.preventDefault();
					
				} );
				
			})
			( $( '#home > .newsletter' ), 
			$( '#home > .newsletter form' ), 
			$( '#home > .newsletter form > .mail' ), 
			$( '#home > .newsletter form > .send' ) );
			
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
			(function( slider, paginacja, obrazy ){
				var current = 0;
				var itrv = null;
				var delay = 3.5;
				var duration = 1;
				var num = obrazy.length;
				var lock = false;
				var last;
				
				slider
				.on({
					set: function( e, direction ){
						
						if( direction === 'next' ){
							++current;
							last = current - 1;
							
						}
						else if( direction === 'prev' ){
							--current;
							last = current + 1;
							
						}
						else{
							last = current;
							
						}
						
						if( last < 0 ) last += num;
						
						last %= num;
						
						
						if( current < 0 ) current += num;
						
						current %= num;
						
						// console.log( [ last, current ] );
						
						paginacja
						.eq( current )
						.addClass( 'active' )
						.siblings()
						.removeClass( 'active' );
						
						
						/* obrazy
						.eq( current )
						.addClass( 'active' )
						.siblings()
						.removeClass( 'active' ); */
						
						var TL = new TimelineLite({
							onStart: function(){
								obrazy.eq( current ).css( 'z-index', 2 );
								obrazy.eq( current ).siblings().css( 'z-index', 1 );
								
							},
							onComplete: function(){
								lock = false;
								
							},
							paused: true,
							
						})
						.add( 'start', 0 );
						
						if( direction === 'next' || direction === 'prev' ){
							TweenLite.set(
								obrazy,
								{
									scaleX: 0,
								}
							);
							
							TL
							.add(
								TweenLite.fromTo(
									obrazy.eq( current ),
									duration,
									{
										transformOrigin: direction === 'next'?( 'right' ):( 'left' ),
										scaleX: 0,
										opacity: 1,
										
									},
									{
										scaleX: 1,
										ease: Power2.easeInOut,
										
									}
								), 'start'
							)
							.add(
								TweenLite.fromTo(
									obrazy.eq( last ),
									duration,
									{
										transformOrigin: direction === 'next'?( 'left' ):( 'right' ),
										scaleX: 1,
										opacity: 1,
										
									},
									{
										scaleX: 0,
										ease: Power2.easeInOut,
										
									}
								), 'start'
							);
							
						}
						else if( direction === undefined ){
							TL
							.add(
								TweenLite.to(
									obrazy.not( obrazy.eq( current ) ),
									duration,
									{
										opacity: 0,
									}
								), 'start'
							)
							.add(
								TweenLite.fromTo(
									obrazy.eq( current ),
									duration,
									{
										opacity: 0,
										scaleX: 1,
									},
									{
										opacity: 1,
									}
								), 'start'
							);
							
						}
						
						TL.play();
						
						/* .add(
							TweenLite.fromTo(
								obrazy.filter( '.active' ),
								duration,
								{
									opacity: 0.5,
									
								},
								{
									opacity: 1,
									ease: Power2.easeInOut,
									
								}
							), 'start'
						); */
						
					},
					next: function( e ){
						if( !lock ){
							lock = true;
							slider.triggerHandler( 'set', [ 'next' ] );
						}
						
					},
					prev: function( e ){
						if( !lock ){
							lock = true;
							slider.triggerHandler( 'set', [ 'prev' ] );
						}
						
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
					if( !lock ){
						lock = true;
						var index = $(this).index();
						
						if( index !== current ){
							slider.triggerHandler( 'stop' );
							current = index;
							slider.triggerHandler( 'set' );
							
						}
						
					}
					
				});
				
				
				slider.triggerHandler( 'set' );
				slider.triggerHandler( 'start' );
				
			})
			( $( '#home .top-slider' ), 
			$( '#home .top-slider > .imgs > .pagin > .item' ), 
			$( '#home .top-slider > .imgs > .view > .item' ) );
			
			// POPUPy
			(function(){
				/* $(".pop-up-clothes.clothes").click(function () {
					$(".catalog-popup").fadeIn(300);
				}); */
				
				/* $(".popup > .pop-cross").click(function () {
					$(".cover-popup").fadeOut(300);
				}); */
				
				/* $(".pop-up-clothes.movie").click(function () {
					$(".movie-cover-popup").fadeIn(300);
					
				}); */
				
				/* $(".movie-cover-popup").click(function () {
					$(this).fadeOut(300);
				}); */
				
				/* $(".pop-up-clothes.powerbank").click(function () {
					$(".powerbank-pop-up").fadeIn(300);   
				}); */
				
				/* $(".pop-up-clothes.wystawnicze").click(function () {
					$(".wystawnicze-pop-up").fadeIn(300);
				}); */
				
				/* $(".pop-up-clothes.odziez-reklamowa").click(function () {
					$(".odziez-reklamowa-pop-up").fadeIn(300);
				}); */
				
				/* $(".pop-up-clothes.dlugopisymetalowe").click(function () {
					$(".dlugopisymetalowe-pop-up").fadeIn(300);
				}); */
				
				/* $(".pop-up-clothes.dlugopisyplastikowe").click(function () {
					$(".dlugopisyplastikowe-pop-up").fadeIn(300);
				}); */
				
				/* $(".pop-up-clothes.torby").click(function () {
					$(".torby-pop-up").fadeIn(300);
				}); */
				
			})();
			
			/* menu odzieży reklamowej w popupie */
			(function( panel, proto, items ){
				
				items.each(function(){
					var href = $(this).attr( 'href' );
					var title = $(this).attr( 'item-title' );
					
					proto
					.clone()
					.removeClass( 'hide' )
					.appendTo( panel )
					.children( 'a' )
					.attr( 'href', href )
					.siblings( '.link' )
					.text( title );
					
				});
				
			})
			( $( '.popup.katalog .view.reklamowa .items' ), 
			$( '.popup.katalog .view.reklamowa .items > .item.hide' ),
			$( 'ul.menu > .item[item-title="Odzież reklamowa"] > .sub > .item' ) );
			
			
		},
		kategoria: function(){
			var addon = root.addon;
			var logger = addon.isLogger();
			
			if(logger) console.log('page.index()');
			
			/* breadcrumb */
			(function( breadcrumb ){
				try{
					var parts = [];
					$( 'ul.menu > .item.active, ul.menu > .item.active .item.active' ).each(function(){
						parts.push( $(this).find( '.head:first > .title' ).text().trim() );
						
					});
					// console.log( parts );
					// parts.push( produkt_data.NAME );
					
					breadcrumb.text( parts.join( " | " ) );
					
				}
				catch( err ){
					console.error( err );
					
				}
				
			})
			( $( '#grid > .top > .breadc' ) );
			
			/* menu odzieży reklamowej */
			(function( panel, proto, items ){
				var slug_page;
				
				try{
					slug_page = window.location.search.match( /cat=.+\-(\w+)/ )[1];
					
				}
				catch( err ){
					console.error( err );
					slug_page = '';
					
				}
				
				items.each(function(){
					var href = $(this).attr( 'href' );
					var title = $(this).attr( 'item-title' );
					var slug = $(this).attr( 'item-slug' );
					
					proto
					.clone()
					.removeClass( 'hide' )
					.addClass( slug_page === slug?( 'active' ):( '' ) )
					.attr( 'item-slug', slug  )
					.appendTo( panel )
					.children( 'a' )
					.attr( 'href', href )
					.text( title );
					
				});
				
			})
			( $( '#grid > .odziez_reklamowa' ), 
			$( '#grid > .odziez_reklamowa > .item.hide' ), 
			$( 'ul.menu > .item[item-title="Odzież reklamowa"] > .sub > .item' ) );
			
		},
		produkt: function(){
			var addon = root.addon;
			var logger = addon.isLogger();
			
			if(logger) console.log('page.produkt()');
			
			/* pojedynczy produkt */
			if( $( 'body#single' ).length > 0 ){
				
				/* breadcrumb */
				(function( breadcrumb ){
					try{
						var parts = [];
						$( 'ul.menu > .item.active, ul.menu > .item.active .item.active' ).each(function(){
							parts.push( $(this).find( '.head:first > .title' ).text().trim() );
							
						});
						// console.log( parts );
						parts.push( produkt_data.NAME );
						
						breadcrumb.text( parts.join( " | " ) );
						
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
						click: function( e ){
							window.open( $(this).attr( 'src' ), '_blank' );
							
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
				( $( '#single > .popup.produkt' ), 
				$( '#single > .popup.produkt > .box' ), 
				$( '#single > .popup.produkt > .box > .header > .close' ), 
				$( '#single > .popup.produkt > .box > .img > img' ), 
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
									url: '../kalkulator',
									data: {
										nazwa: produkt_data.NAME,
										num: parseInt( ilosc.val() ),
										mark: typ.val(),
										colors: parseInt( kolory.val() ),
										price: produkt_data.PRICE.BRUTTO,
										
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
											kalkulator.triggerHandler( 'notify', [ 'info', 'Dla tego typu znakowania prowadzimy wycenę indywidualną.<br>Zadzwoń: <span class="bold">000-000-000</span>,<br>skorzystaj z naszego <span class="bold">formularzu kontakowego</span>,<br>albo napisz: <span class="bold">biuro@merkuriusz.pl</span>' ] );
											
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
								price: produkt_data.PRICE.BRUTTO,
								
							}
							
							console.log( myData );
							
							kalkulator.triggerHandler( 'notify', [ 'wait', 'Dodaję do koszyka...' ] );
							
							$.ajax({
								type: 'POST',
								url: '../koszyk',
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
											$( '#basket' ).triggerHandler( 'update' );
											
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
					
					/* sprawdzanie poprawności danych przy każdej zmianie; zmiana danych po wykaniu kalkulacji zamyka widok podglądu, by użytkownik musiał zrobić kalkulację dla aktualnie ustawionych danych*/
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
							/* zmiana ilości kolorów w zależności od wybranego typu znakowania */
							kolory
							.children( 'option:not(:disabled)' )
							.remove();
							var selected = typ.children( 'option:selected' );
							var min = parseInt( selected.attr( 'cmin' ) ) || 1;
							var max = parseInt( selected.attr( 'cmax' ) ) || 1;
							
							for( i = min; i <= max; i++ ){
								$(
									$( '<option></option>' )
									.attr( 'value', i )
									.text( i )
								)
								.appendTo( kolory );
								
							}
							
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
				
				
			}
			
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
										// window.alert( 'za chwile nastąpi przekierowanie' );
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
								console.log( item );
								myData.append( item.name, item.value );
								
							} );
							
							$.each( formOpcje.serializeArray(), function( index, item ){
								console.log( item );
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
			( $( '#grid form.form' ), 
			$( '#grid form.form .field.imie > input' ), 
			$( '#grid form.form .field.tel > input' ), 
			$( '#grid form.form .field.mail > input' ), 
			$( '#grid form.form .field.file > input' ), 
			$( '#grid form.form .field.msg > textarea' ), 
			$( '#grid form.form > .tbottom > .button' ), 
			$( '#grid form.form > .tbottom > .status' ), 
			$( '#grid form.form > .tbottom > .status > .load' ), 
			$( '#grid form.opcje' ) );
			
		},
		oferta: function(){
			var addon = root.addon;
			var logger = addon.isLogger();
			
			if(logger) console.log('page.oferta()');
			
			/* filtrowanie kafelków i popup */
			(function( popup, box, close, popup_title, kafelki, filters, items ){
				var duration = .5;
				var popup_anim;
				
				/* animacja popupu */
				(function(){
					popup_anim = new TimelineLite({
						paused: true,
						onStart: function(){
							popup.addClass( 'open' );
							
						},
						onReverseComplete: function(){
							popup.removeClass( 'open' );
							
						},
						
					})
					.add( 'start', 0 )
					.add(
						TweenLite.fromTo(
							popup,
							duration,
							{
								opacity: 0,
							},
							{
								opacity: 1,
							}
						), 'start'
					)
					.add(
						TweenLite.fromTo(
							box,
							duration,
							{
								opacity: 0,
								yPercent: -100,
							},
							{
								opacity: 1,
								yPercent: 0,
								ease: Power2.easeInOut,
							}
						), 'start+=.3'
					)
					
				})();
				
				popup.on({
					open: function( e, item ){
						var title = $( item ).find( '.title' ).text().trim();
						var img = $( item ).find( '.img' ).attr( 'img' );
						// console.log( item );
						box.css( 'background-image', 'url('+ img +')' );
						popup_title.text( title );
						popup_anim.play();
						
					},
					close: function( e ){
						popup_anim.reverse();
						
					},
					wheel: function( e ){
						e.preventDefault();
						
					},
					
				});
				
				popup
				.add( close )
				.click( function( e ){
					popup.triggerHandler( 'close' );
					
				} );
				
				box.click( function( e ){
					e.stopPropagation();
					
				} );
				
				kafelki.on({
					set: function( e, name ){
						// console.log( name );
						var t = items.filter( '[cats*="'+ name +'"]' );
						// console.log( t );
						// console.log( t.siblings() );
						
						/* t.fadeIn( function(){
							items
							.not( t )
							.fadeOut();
							
						} ); */
						
						new TimelineLite()
						.add( 'start', 0 )
						.add( function(){
							items
							.not( t )
							.fadeOut( 300 );
							
						}, 'start' )
						.add( function(){
							t.fadeIn( 300 );
							
						}, 'start+=0.3' )
						
						
						
					},
					
				});
				
				filters.click(function( e ){
					var cat = $(this).attr( 'cat' );
					kafelki.triggerHandler( 'set', cat );
					$(this).addClass( 'active' ).siblings().removeClass( 'active' );
					
				});
				
				items.click(function( e ){
					popup.triggerHandler( 'open', $(this) );
					
				});
				
			})
			( $( '#oferta > .popup_oferta' ), 
			$( '#oferta > .popup_oferta > .box' ), 
			$( '#oferta > .popup_oferta > .box .btn-close' ), 
			$( '#oferta > .popup_oferta > .box .title' ), 
			$( '#oferta > .box' ), 
			$( '#oferta > .box .filters > .item' ), 
			$( '#oferta > .box  .kafelki > .item' ) );
			
		},
		kontakt: function(){
			var addon = root.addon;
			var logger = addon.isLogger();
			
			if(logger) console.log('page.kontakt()');
			
			/* formularz kontaktowy */
			(function( form, fields, send, info ){
				var test = [
					{
						name: 'subject',
						item: fields.filter( '#subject' ),
						filterName: 'tekst_req'
					},
					{
						name: 'firstname',
						item: fields.filter( '#firstname' ),
						filterName: 'imie'
					},
					{
						name: 'lastname',
						item: fields.filter( '#lastname' ),
						filterName: 'imie'
					},
					{
						name: 'e-mail',
						item: fields.filter( '#e-mail' ),
						filterName: 'mail'
					},
					{
						name: 'phonenumber',
						item: fields.filter( '#phonenumber' ),
						filterName: 'telefon'
					},
					{
						name: 'message',
						item: fields.filter( '#message' ),
						filterName: 'tekst_req'
					},
					
				];
				
				form
				.on({
					info: function( e, status, msg ){
						info
						.slideDown()
						.html( msg );
						
					},
					test: function( e ){
						var verify = addon.form.verify( test );
						
						fields
						.removeClass( 'ok error' );
						
						if( verify.length > 0 ){
							
							$.each( verify, function( index, item ){
								item.addClass( 'error' );
								
							} );
							
							fields.not( '.error' ).addClass( 'ok' );
							
						}
						else if( verify === true ){
							fields
							.addClass( 'ok' );
							
							
						}
						
						return verify;
						
					},
					send: function( e ){
						if( form.triggerHandler( 'test' ) === true ){
							var data = form.serializeArray();
							$.ajax({
								type: 'post',
								url: '../contact-form',
								data: data,
								success: function( data, status, xhr ){
									try{
										var resp = JSON.parse( data );
										console.log( resp );
										
										form.triggerHandler( 'info', [ resp.status, resp.msg ] );
										
										if( resp.status === 'ok' ){
											form.trigger( 'reset' );
											fields.removeClass( 'ok error' );
											
										}
										
									}
									catch( err ){
										console.error( err );
										console.info( data );
										form.triggerHandler( 'info', [ 'fail', 'Błąd komunikacji z serwerem.<br>Spróbuj ponownie za klika minut.' ] );
										
									}
									
								},
								error: function( xhr, status, error ){
									console.error( error );
									form.triggerHandler( 'info', [ 'fail', 'Błąd połączenia z serwerem.<br>Spróbuj ponownie za kilka minut.' ] );
									
								},
								
							});
							
						}
						
					},
					
				});
				
				info.click( function( e ){
					$(this).slideUp();
					
				} );
				
				fields
				.on({
					blur: function( e ){
						form.triggerHandler( 'test' )
						
					},
					click: function( e ){
						$(this).removeClass( 'error' );
						
					},
					
				});
				
				send.click( function(){
					form.triggerHandler( 'send' );
					
				} );
				
			})
			( $( '#contact form.contact-form' ), 
			$( '#contact form.contact-form' ).find( 'input, textarea' ), 
			$( '#contact form.contact-form button.cotact-form-btn' ), 
			$( '#contact form.contact-form .info' ) );
			
		},
		
	}
	
	$(function(){
		root.launcher();
	});
	
})();