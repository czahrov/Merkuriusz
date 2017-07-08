<?php get_header(); ?>
<body id='home'>
	<?php get_template_part( "template/page", "top" ); ?>
	<!-- SIDEBAR -->
<div class="container">
	
	<?php get_template_part( "template/menu", "side" ); ?>

	<!-- MAIN PICTURES -->
	<div class="col-md-8 padding-zero">
<!-- SLAJDER -->
	<?php
		$data_slider = array(
			array(
				'title' => 'Lokalizator kluczy',
				'content' => 'Urządzenie współpracuje z aplikacjami na Androida i iOS (iPhone). Wystarczy, że pobierzesz aplikację iTracking dostępną w Sklepie Play lub Apple Store i już możesz zacząć konfigurację swojego lokalizatora.',
				'img' => sprintf( "%s/img/slajder.jpg", get_template_directory_uri() ),
				'link' => array(
					'url' => '#',
					'text' => 'O produkcie',
					
				),
				
			),
			array(
				'title' => 'Lorem ipsum tytuł',
				'content' => 'Lorem ipsum tekst',
				'img' => 'http://placeimg.com/300/300/tech',
				'link' => array(
					'url' => '#',
					'text' => 'lorem ipsum link',
					
				),
				
			),
			array(
				'title' => 'Lorem ipsum inny tytuł',
				'content' => 'Lorem ipsum inny tekst',
				'img' => 'http://placeimg.com/350/350/tech',
				'link' => array(
					'url' => '#',
					'text' => 'lorem ipsum inny link',
					
				),
				
			),
			
		);
	?>
	<div class='top-slider flex'>
		<div class='text base3 grow flex flex-column'>
			<div class='view grow flex'>
				<?php
					foreach( $data_slider as $num => $item ):
				?>
				<div class='item base1 no-shrink flex flex-column<?php if( $num === 0 ) echo " active "; ?>'>
					<div class='title semibold uppercase'>
						<?php echo $item['title']; ?>
					</div>
					<div class='content grow'>
						<?php echo $item['content']; ?>
					</div>
					<a class='button semibold uppercase flex-self-start' href='<?php echo $item['link']['url'] ?>'>
						<?php echo $item['link']['text'] ?>
					</a>
					
				</div>
				<?php endforeach; ?>
			</div>
			<div class='pagin flex'>
				<?php
					foreach( $data_slider as $num => $item ): 
				?>
				<div class='item pointer<?php if( $num === 0 ) echo " active "; ?>'></div>
				<?php endforeach; ?>
				
			</div>
			
		</div>
		<div class='imgs base3 grow fp-hide flex-mm flex-column'>
			<div class='view grow flex'>
				<?php
					foreach( $data_slider as $num => $item ):
				?>
				<div class='item base1 no-shrink bgimg full<?php if( $num === 0 ) echo " active "; ?>' style='background-image: url(<?php echo $item['img']; ?>);'></div>
				<?php endforeach; ?>
			</div>
			
		</div>
		
	</div>

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
		
	<?php get_template_part( "template/slider", "katalog" ); ?>
	
	<?php get_template_part( "template/reklama360" ); ?>

	<!--PARTNERS -->

	<?php get_template_part( "template/slider", "partnerzy" ); ?>
	
	<?php get_template_part( "template/newsletter" ); ?>

 <!-- FOOTER -->

<?php get_footer(); ?>