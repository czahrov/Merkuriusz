<?php
	get_header();
?>
<body id='home'>
	
	<div class="intro-bar">
		<div class="inner-intro-bar container">
			<div class="col-md-6 intro-item1">Merkuriusz - Techniki nadruków Tarnów</div>
			<div class="col-md-6 intro-item2">Masz pytania? Chętnie na nie odpowiemy <span class="big-text">14 662 33 64</span></div>
		</div>
	</div>

	<div class="container">

		<div class="col-md-5">
			<div class="logo">
				<a href="index.html">
					<img src="<?php echo get_template_directory_uri(); ?>/img/logo_merkuriusz.png" class="logo-src" alt="merkuriusz logo">
				</a>
			</div>
		</div>
		<div class="col-md-7">
			<form class="input-group" id="searchform" method="get" action="<?php echo home_url(); ?>">
                <input type="text" name="s" id="s" size="15" placeholder="Wpisz nazwę lub kod produktu" class="form-control search_input">
		  
		  <?php wp_dropdown_categories( 'show_option_none=Select' ); ?> 
		  
		  <!--
					<select class="form-control depart_input">
				  <option>Wszystkie działy</option>
				  <option>2</option>
				  <option>3</option>
				  <option>4</option>
				  <option>5</option>
				</select>  -->
                <span class="input-group-btn">
                 <button class="btn btn-default" type="submit" value="Search"><i class="fa fa-search"></i></button>
                </span>
             </form>
		</div>
	</div>

	
	
<!-- NAVIGATION -->
	<div class="background-theme"></div>
		<?php get_template_part("template/menu"); ?>
		

		<!-- SIDEBAR AND MAIN PICTURES -->
		
		
		
		<!-- SIDEBAR -->
		<div class="container">
			<div class="col-md-4" id='sidebar'>
				

		<!-- SIDEBAR NAVIGATION -->
				<div class="sidebar-navigation background-white">
				<ul class='menu'>
					<li class='item flex flex-column'>
						<div class='head flex flex-items-center'>
							<div class='title uppercase bold'>
								gadżety reklamowe
							</div>
							<span class='icon fa fa-angle-right'></span>
						</div>
						<ul class='sub flex flex-column'>
						<?php
							$reklamowe = array(
								'Materiały Piśmiennicze' => array(
									'img' => 'pisemnicze.png',
									
								),
								'Biuro' => array(
									'img' => 'biuro.png',
									
								),
								'Torby, plecaki' => array(
									'img' => 'torby.png',
									
								),
								'Parasole i peleryny' => array(
									'img' => 'parasole.png',
									
								),
								'Do picia' => array(
									'img' => 'do_picia.png',
									
								),
								'Narzędzia' => array(
									'img' => 'narzedzia.png',
									
								),
								'Dom' => array(
									'img' => 'dom.png',
									
								),
								'Uroda' => array(
									'img' => 'uroda.png',
									
								),
								'Rozrywka i szkoła' => array(
									'img' => 'szkola.png',
									
								),
								'Eco gadżet' => array(
									'img' => 'eco.png',
									
								),
								'Medyczne' => array(
									'img' => 'medyczne.png',
									
								),
								'Transport' => array(
									'img' => 'transport.png',
									
								),
								'Tekstylia' => array(
									'img' => 'tekstylia.png',
									
								),
								'Świąteczne' => array(
									'img' => 'swiateczne.png',
									
								),
								'Opakowania upominkowe' => array(
									'img' => 'upominkowe.png',
									
								),
								
							);
							
							foreach( $reklamowe as $name => $item ):
						?>
							<li class='item flex'>
								<div class='head grow flex flex-items-center'>
									<img class='pikto' src='<?php echo get_template_directory_uri(); ?>/img/piktogramy/<?php echo $item['img']; ?>'>
									<div class='title'>
										<?php echo $name; ?>
									</div>
									<span class='icon fa fa-angle-double-right'></span>
								</div>
								
							</li>
						<?php endforeach; ?>
							
						</ul>
						
					</li>
					<li class='item fofcio flex flex-column'>
						<div class='head flex flex-items-center'>
							<div class='title uppercase bold'>
								fofcio promo toys
							</div>
							<span class='icon fa fa-angle-right'></span>
						</div>
					</li>
					<li class='item elektronika flex flex-column'>
						<div class='head flex flex-items-center'>
							<div class='title uppercase bold'>
								elektronika
							</div>
							<span class='icon fa fa-angle-right'></span>
						</div>
					</li>
					<li class='item vip open flex flex-column'>
						<div class='head flex flex-items-center flex-justify-between'>
							<div class='title uppercase bold'>
								kolekcja vip
							</div>
							<span class='icon fa fa-angle-right'></span>
						</div>
						<ul class='sub flex flex-column'>
						<?php
							$vip = array(
								'collection' => array(
									'title' => 'vip collection',
									
								),
								'skóra' => array(
									'title' => 'vip skóra',
									
								),
								'viktronix' => array(
									'title' => 'viktronix',
									
								),
								'vine' => array(
									'title' => 'vine club',
									
								),
								'piśmiennicze' => array(
									'title' => 'vip piśmiennicze',
									
								),
								'parker' => array(
									'pikto' => 'feather.png',
									'logo' => 'Parker_logo.png',
									
								),
								'waterman' => array(
									'pikto' => 'pen3.png',
									'logo' => 'waterman_logo.png',
									
								),
								'ferraghini' => array(
									'pikto' => 'wallet.png',
									'logo' => 'ferraghini.png',
									
								),
								'marktwain' => array(
									'pikto' => 'pen1.png',
									'logo' => 'marktwain.svg',
									
								),
								'schwarzwolf' => array(
									'logo' => 'schwarzwolf.png',
									
								),
								'ungaro' => array(
									'pikto' => 'U.png',
									'logo' => 'ungaro.png',
									
								),
								'herlitz' => array(
									'pikto' => 'suitcase.png',
									'logo' => 'Herlitz_logo.svg',
									
								),
								'pelikan' => array(
									'pikto' => 'inkwell.png',
									'logo' => 'pelikan-logo.png',
									
								),
								'diplomat' => array(
									'pikto' => 'pen2.png',
									'logo' => 'diplomat.svg',
									
								),
								'cofee' => array(
									'pikto' => 'cap.png',
									'logo' => 'coFee.svg',
									
								),
								
							);
							
							foreach( $vip as $item ):
						?>
							<li class='item flex'>
								<div class='head grow flex flex-items-center'>
									<?php if( !empty( $item['pikto'] ) ): ?>
									<img class='pikto' src='<?php printf( "%s/img/ikony/%s", get_template_directory_uri(), $item['pikto'] ); ?>'>
									<?php endif; ?>
									<?php if( !empty( $item['title'] ) ): ?>
									<div class='title bold uppercase'>
										<?php echo $item['title']; ?>
									</div>
									<?php elseif( !empty( $item['logo'] ) ): ?>
									<div class='logotyp flex grow bgimg contain flex-self-stretch' style='background-image: url(<?php printf( "%s/img/logotypy/%s", get_template_directory_uri(), $item['logo']  ); ?>);'></div>
									<?php endif; ?>
									<span class='icon fa fa-angle-double-right'></span>
								</div>
								
							</li>
						<?php endforeach; ?>
							
						</ul>
						
					</li>
					
				</ul>
				
			</div>
			
		</div>


		<!-- MAIN PICTURES -->
		
		<div class="col-md-8 padding-zero">
			
<!-- SLAJDER -->
			<div class="sidebar-intro background-white col-md-6">
				<h2>Lokalizator<br>kluczy</h2>
				<p>Urządzenie współpracuje z aplikacjami na Androida i iOS(iPhone). Wystarczy, że pobierzesz aplikację iTracking dostępną w Sklepie Play lub Apple Store i już możesz zacząć konfigurację swojego lokalizatora</p>
				<a class="btn side-btn">O produkcie
				</a>
				<div class="pager-box ">
					<div class="pager-ball pager-ball-active"></div>
					<div class="pager-ball"></div>
					<div class="pager-ball"></div>
				</div>
			</div>
			<div class="col-md-6 home-top-right">
				<div class="slider"></div>
			</div>
			<div class="clearfix"></div>


			<!-- first line pictures -->
			<div class="col-md-6">
				<div class="main-picture">
					<div class="main-picture-content">
						<div class="main-picture-title">Zakres naszych usług</div>
						<a class="btn main-picture-btn">Czytaj więcej</a>
					</div>
				</div>

				<div class="white-space-30"></div>
			</div>

			<div class="col-md-6">
				<div class="main-picture main-picture-video">
					<div class="main-picture-content">
						<div class="main-picture-title">Film o naszej firmie</div>
						<i class="fa fa-play-circle fa-3x movie-icon pop-up-clothes movie" aria-hidden="true"></i>
					</div>
				</div>
				<div class="white-space-30"></div>
			</div>

			<!-- second line pictures -->
			<div class="col-md-6">
				<div class="main-picture main-picture-powerbank">
					<div class="main-picture-content">
						<div class="main-picture-title">Power banki</div>
						<a class="btn main-picture-btn pop-up-clothes powerbank">Zobacz produkty</a>
					</div>
				</div>
				<div class="white-space-30"></div>
			</div>
			<div class="col-md-6">
				<div class="main-picture main-picture-odziezreklamowa">
					<div class="main-picture-content">
						<div class="main-picture-title">Odzież reklamowa</div>
						<a class="btn main-picture-btn pop-up-clothes clothes">Zobacz produkty</a>
					</div>
				</div>
				<div class="white-space-30"></div>
			</div>
		</div>
	</div>  <!-- END OF CONTAINER SIDEBAR AND PICTURES -->


<!-- POP UPY -->
	<div class="cover-popup catalog-popup">
		<div class="popup">
			<div class="pop-cross"><i class="fa fa-times" aria-hidden="true"></i></div>
			<h2 class="popup-title">Odzież reklamowa - nadruki na ubraniach</h2>
			<div class="popup-content">

			<div class="catalog-img ">

			<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/img/odziez_reklamowa_catalog_img.jpg">
			<h2 class="pop-catalog-title">Kolekcja 2016</h2>
			</div>
			<div class="popup-links">
			<div class="popup-href">

				<div class="single-href">

				<a href="#">Torby</a>

				</div>

			</div>

			<div class="popup-href">

				<div class="single-href">

				<a href="#">Odzież sportowa</a>

				</div>

			</div>

			<div class="popup-href">

				<div class="single-href">

				<a href="#">Odzież biznesowa</a>

				</div>

			</div>

			<div class="popup-href">

				<div class="single-href">

				<a href="#">Czapki i akcesoria</a>

				</div>

			</div>




			<div class="popup-href">

				<div class="single-href">

				<a href="#">Polary</a>

				</div>

			</div>

			<div class="popup-href">

				<div class="single-href">

				<a href="#">Kurtki</a>

				</div>

			</div>

			<div class="popup-href">

				<div class="single-href">

				<a href="#">Odzież dziecięca</a>

				</div>

			</div>

			<div class="popup-href">

				<div class="single-href">

				<a href="#">Odzież gastronomiczna</a>

				</div>

			</div>


			<div class="popup-href">

				<div class="single-href">

				<a href="#">Koszulki polo</a>

				</div>

			</div>

			<div class="popup-href">

				<div class="single-href">

				<a href="#">Ręczniki</a>

				</div>

			</div>

			</div>
			</div>
		</div>
	</div>


	<!-- POP UP MOVIE -->

	<div class="movie-cover-popup">

			<iframe class="movie-content" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" type="text/html" src="https://www.youtube.com/embed/MVKByvu7zo8?autoplay=0&fs=1&iv_load_policy=3&showinfo=1&rel=1&cc_load_policy=0&start=0&end=0&origin=https://youtubeembedcode.com"><div><small><a href="http://youtubeembedcode.com/pl/">youtube filmy na stronie</a></small></div><div><small><a href="https://disclaimergenerator.net/">personalized</a></small></div></iframe>
			
	</div>


	<!-- POWER BANKI POP UP-->

	<div class="cover-popup powerbank-pop-up">
		<div class="popup">
			<div class="pop-cross"><i class="fa fa-times" aria-hidden="true"></i></div>
			<h2 class="popup-title">Power Banki</h2>
			<div class="popup-content">


			</div>
		</div>
	</div>
	
	<!-- Wystawnicze POP UP-->

	<div class="cover-popup wystawnicze-pop-up">
		<div class="popup">
			<div class="pop-cross"><i class="fa fa-times" aria-hidden="true"></i></div>
			<h2 class="popup-title">Systemy wystawnicze</h2>
			<div class="popup-content popup-catalog-content">
			
				<div class="catalog-wrapper">
					<div class="inner-catalog-wrapper">
						<div class="inner-catalog-img" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/katalogi/Katalog_Easy_Stand_Roll_up.jpg)"></div>
						<div class="inner-catalog-cont">
							<div class="inner-catalog-title">Katalog easy stand</div>
							<div class="inner-catalog-text">Coś o katalogu</div>
							<a class="btn inner_catalog_btn">pokaż pdf</a></div>
					</div>
					
					<div class="inner-catalog-wrapper">
						<div class="inner-catalog-img" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/katalogi/Katalog_Easy_Stand.jpg"></div>
						<div class="inner-catalog-cont">
							<div class="inner-catalog-title">Katalog easy stand</div>
							<div class="inner-catalog-text">Coś o katalogu</div>
							<a class="btn inner_catalog_btn">pokaż pdf</a></div>
					</div>
					
		
				
				</div>
					<div class="col-xs-12">
						<ul class="pager">
						  <li><a href="#"><i class="fa fa-long-arrow-left fa-2x" aria-hidden="true"></i></a></li>
						  <li><a href="#"><i class="fa fa-long-arrow-right fa-2x" aria-hidden="true"></i></a></li>
						</ul>
					</div>
			</div>
		</div>
	</div>
	
		<!-- kolekcje odziezy reklamowej POP UP-->

	<div class="cover-popup odziez-reklamowa-pop-up">
		<div class="popup">
			<div class="pop-cross"><i class="fa fa-times" aria-hidden="true"></i></div>
			<h2 class="popup-title">Kolekcje odzieży reklamowej</h2>
			<div class="popup-content">
				<div class="sliderpop-container row">
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element"><img class="sliderpop-image" src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/jhk.svg"></div></a>
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element"><img class="sliderpop-image" src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/logo_adler.svg"></div></a>
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element"><img class="sliderpop-image" src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/alex_fox.svg"></div></a>
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element"><img class="sliderpop-image" src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/roly.jpg"></div></a>
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element"><img class="sliderpop-image" src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/promo_stars.jpg"></div></a>
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element"></div></a>
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element"></div></a>
					
				</div>
			</div>
		</div>
	</div>
	<!-- kolekcje długopisów plastikowych POP UP-->

	<div class="cover-popup dlugopisyplastikowe-pop-up">
		<div class="popup">
			<div class="pop-cross"><i class="fa fa-times" aria-hidden="true"></i></div>
			<h2 class="popup-title">Kolekcja długopisów plastikowych</h2>
			<div class="popup-content">
				<div class="sliderpop-container row">
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element"><img class="sliderpop-image" src="<?php echo get_template_directory_uri(); ?>/img/dlugopisy/logo-lecce-pen.png"></div></a>
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element"><img class="sliderpop-image" src="<?php echo get_template_directory_uri(); ?>/img/dlugopisy/viva_pens.jpg"></div></a>
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element">Dream Pen</div></a>
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element"><img class="sliderpop-image" src="<?php echo get_template_directory_uri(); ?>/img/dlugopisy/ritter_pen.png"></div></a>
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element"><img class="sliderpop-image" src="<?php echo get_template_directory_uri(); ?>/img/dlugopisy/bic_logo.png"></div></a>
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element"></div></a>
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element"></div></a>
					
				</div>
			</div>
		</div>
	</div>
	
	<!-- kolekcje długopisów metlowych POP UP-->

	<div class="cover-popup dlugopisymetalowe-pop-up">
		<div class="popup">
			<div class="pop-cross"><i class="fa fa-times" aria-hidden="true"></i></div>
			<h2 class="popup-title">Kolekcja długopisów metalowych</h2>
			<div class="popup-content">
				<div class="sliderpop-container row">
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element">Millenium</div></a>
					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank"><div class="sliderpop-element"><img class="sliderpop-image" src="<?php echo get_template_directory_uri(); ?>/img/dlugopisy/viva_pens.jpg"></div></a>
					
				</div>
			</div>
		</div>
	</div>
<!-- CATALOG SLIDER -->
	<div class="container">
	<div class="col-md-12">
		<div class="catalog-slider">
			<h2 class="section-title">Zobacz katalogi Pdf produktów</h2>
			<div class="catalog-slider-wrapper">

					<div class="catalog-arrow-box"><i class="fa fa-angle-left fa-2x arrow-position" aria-hidden="true"></i></div>
		
				<div class="catalog-container">
					
					
					<div class="catalog-element">
						<div class="catalog catalog1">
							<div class="catalog-cover pop-up-clothes dlugopisyplastikowe">
								<div class="cat-cover-text">ZOBACZ KATALOGI (pdf)</div>
							</div>
						</div>
						<div class="catalog_signature">Kolekcje długopisów plastikowych</div>
					</div>
					<div class="catalog-element">
						<div class="catalog catalog2">
							<div class="catalog-cover pop-up-clothes dlugopisymetalowe">
								<div class="cat-cover-text">ZOBACZ KATALOGI (pdf)</div>
							</div>
						</div>
						<div class="catalog_signature">Kolekcje długopisów metalowych</div>
					</div>
					
					<div class="catalog-element">
						<div class="catalog catalog3">
							<div class="catalog-cover pop-up-clothes odziez-reklamowa">
								<div class="cat-cover-text">ZOBACZ KATALOGI (pdf)</div>
							</div>
						</div>
						<div class="catalog_signature">Kolekcje odzieży reklamowej</div>
					</div>
					
					<div class="catalog-element">
						<div class="catalog catalog4">
							<div class="catalog-cover">
								<div class="cat-cover-text">ZOBACZ KATALOGI (pdf)</div>
							</div>
						</div>
						<div class="catalog_signature">Katalog1</div>
					</div>
					<div class="catalog-element">
						<div class="catalog catalog5">
							<div class="catalog-cover">
								<div class="cat-cover-text">ZOBACZ KATALOGI (pdf)</div>
							</div>
						</div>
						<div class="catalog_signature">Katalog2</div>
					</div>
					<div class="catalog-element">
						<div class="catalog catalog6">
							<div class="catalog-cover">
								<div class="cat-cover-text">ZOBACZ KATALOGI (pdf)</div>
							</div>
						</div>
						<div class="catalog_signature">Katalog3</div>
					</div>
					<div class="catalog-element">
						<div class="catalog catalog7">
							<div class="catalog-cover">
								<div class="cat-cover-text">ZOBACZ KATALOGI (pdf)</div>
							</div>
						</div>
						<div class="catalog_signature">katalog4</div>
					</div>
					<div class="catalog-element">
						<div class="catalog catalog8">
							<div class="catalog-cover">
								<div class="cat-cover-text">ZOBACZ KATALOGI (pdf)</div>
							</div>
						</div>
						<div class="catalog_signature">katalog5</div>
					</div>
					<div class="catalog-element">
						<div class="catalog catalog9">
							<div class="catalog-cover">
								<div class="cat-cover-text">ZOBACZ KATALOGI (pdf)</div>
							</div>
						</div>
						<div class="catalog_signature">katalog6</div>
					</div>
				</div>

				<div class="catalog-arrow-box catalog-right"><i class="fa fa-angle-right fa-2x arrow-position" aria-hidden="true"></i></div>
		
			</div>
			
		</div>
	</div>
	</div> <!-- CONTAINER END -->

	<div class="container">
		<h2 class="section-title">Reklama 360 stopni</h2>
		<div class="col-md-3 col-sm-6 advert_element">
			<div class="advert_content">
				<div class="advert_icon_holder">
					<div class="advert_icon_rollup"></div>
				</div>
				<div class="advert_title">Systemy Wystawiennicze</div>
				<div class="advert_text">Projektujemy, drukujemy oraz składamy roll-upy, ścianki wystawiennicze</div>
				<div class="text-center">
				<a class="btn advert_btn pop-up-clothes wystawnicze">czytaj więcej <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
			</div>
		</div>

		<div class="col-md-3 col-sm-6 advert_element">
			<div class="advert_content">
				<div class="advert_icon_holder">
					<div class="advert_icon_adv"></div>
				</div>
				<div class="advert_title">Reklama Wizualna</div>
				<div class="advert_text">Projektujemy banery, szyldy, naklejki samoprzylepne, papierowe, folie wypukłe, magnesy</div>
				<div class="text-center">
				<a class="btn advert_btn">czytaj więcej <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
			</div>
		</div>

		<div class="col-md-3 col-sm-6 advert_element">
			<div class="advert_content">
				<div class="advert_icon_holder">
					<div class="advert_icon_print"></div>
				</div>
				<div class="advert_title">Techniki nadruków</div>
				<div class="advert_text">oferujemy druk wielkoformatowy, offsetowy, cyfrowy, UV</div>
				<div class="text-center">
				<a class="btn advert_btn">czytaj więcej <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
			</div>
		</div>

		<div class="col-md-3 col-sm-6 advert_element">
			<div class="advert_content">
				<div class="advert_icon_holder">
					<div class="advert_icon_gad"></div>
				</div>
				<div class="advert_title">Gadżety Reklamowe</div>
				<div class="advert_text">Na zamówienie produkujemy gadżety reklamowe oraz eventowe</div>
				<div class="text-center">
				<a class="btn advert_btn">czytaj więcej <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
			</div>
		</div>
	</div>


	<!--PARTNERS -->

	<div class="container">
		<div class="col-md-12">
			<h2 class="section-title">Partnerzy</h2>
			<div class="col-md-12 partner-container partner-slider" style="padding: 0;">
				<div class="partner-arrow-box partner-left">
				<i class="fa fa-angle-left fa-2x arrow-position" aria-hidden="true"></i>
				</div>


				<div class="partner-wrapper">
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/bc.svg" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/sols.svg" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/sg.svg" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/fruit.png" class="partner-icon"></div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/logo_adler.svg" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/alex_fox.svg" class="partner-icon"></div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/jhk.svg" class="partner-icon" >
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/macma.svg" class="partner-icon" >
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/happy_gifts.png" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/waterman.svg" class="partner-icon" >
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/Parker-logo-new-and-original.png" class="partner-icon">
					</div>

					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/nina_rici.svg" class="partner-icon" >
					</div>
					
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/diplomat.svg" class="partner-icon" >
					</div>
				
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/blue_collection.svg" class="partner-icon" >
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/royal_design.svg" class="partner-icon">
					</div>
					
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/cool.svg" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/easy_gifts.svg" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/tops.svg" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/voyager-XD.png" class="partner-icon"></div>
				</div>


				<div class="partner-arrow-box partner-right"><i class="fa fa-angle-right fa-2x arrow-position" aria-hidden="true"></i></div>

			</div>
		
		</div>
	</div>
	<div style="margin-bottom: 55px;"></div>

	<div class="container-fluid newsletter">
		<h2 class="section-title" id="newsletter-title">Zapisz się do naszego Newslettera</h2>
		<div class="col-md-8 col-md-offset-2">
		<form>
			<div class="form-row">
				<input class="form-control input-newsletter" type="email" name="e-mail" id="e-mail" placeholder="wpisz swój adres e-mail">
				<button type="submit" class="btn btn-newsletter">Zapisz się!</button>
			</div>
		</form>

		<div class="newsletter-text">Zapisując się do naszego newslettera będziesz informowany na bieżąco o najnowszych produktach na naszej stronie. W każdej chwili możesz się z niego wypisać</div>
		<div class="white-space-50"></div>
		</div>
	</div>


 <!-- FOOTER -->

<?php get_footer(); ?>