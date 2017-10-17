<?php
	/*
	Template Name: kalendarze
	*/
	get_header();

?>

<body>
	
	<?php get_template_part( "template/page", "top" ); ?>
	<?php get_template_part( "template/menu", "top" ); ?>
	<!-- BANER O NAS-->

	<div class="container-fluid about_us_cover" style="background-image: url('<?php echo wp_get_attachment_image_url( get_post_thumbnail_id( get_post()->ID ), 'full' );?>');">
	<div class="filtr"></div>
		<div class="container">
			<div class="col-sm-12 about_us_content">
				<h1><?php echo get_post()->post_title; ?></h1>
				
			</div>
		</div>
	</div>

<!-- Single US MAIN CONTENT -->

<div class="container-fluid single-page">
	
	<div class="container">

		
		<div class="col-sm-12">

			<div class="kal_mer">

				<h2 class="kal">Kolekcja kalendarzy o Tarnowie</h2>
			
			</div>
		
		</div>
		
	</div>
	
</div>

<div class="container-fluid single-page">
		
		<div class="col-md-12"><!-- col-md-12 -->

			<div class="promo-kal">
				<a class='bg-center bg-cover' href="<?php echo home_url( 'kalendarze/kolekcja-tarnow' ); ?>" style='background-image:url(<?php echo get_template_directory_uri(); ?>/img/kalendarze/kalendarze_tarnow.jpg);'>
			</a>
			</div>
		
		</div><!-- /col-md-12 -->
</div>

<div class="container-fluid single-page">
	
	<div class="container">

		<h2 class="kal"> Merkuriusz - produkcja kalendarzy autorskich</h2>



		<div class="col-md-3"><!-- col-md-3 -->
			<a href="<?php echo home_url( 'kalendarze-biurkowe' ); ?>" class="linkto">
				<div class="portfolio-kalendarz">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/img/kalendarze/biurkowy.png">
						<h5>Kalendarze biurkowe</h5>
				</div>
			</a>
		</div><!-- /col-md-3 -->

		<div class="col-md-3"><!-- col-md-3 -->
			<a href="<?php echo home_url( 'kalendarze-biuwary' ); ?>" class="linkto">
				<div class="portfolio-kalendarz">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/img/kalendarze/biurwary.png">
						<h5>Kalendarze biuwary</h5>
				</div>
			</a>
		</div><!-- /col-md-3 -->

		<div class="col-md-3"><!-- col-md-3 -->
			<a href="<?php echo home_url( '?page_id=415&preview=true' ); ?>" class="linkto">
				<div class="portfolio-kalendarz">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/img/kalendarze/czterodzielne.png">
						<h5>Kalendarze czterodzielne</h5>
				</div>
			</a>
		</div><!-- /col-md-3 -->

		<div class="col-md-3"><!-- col-md-3 -->
			<a href="<?php echo home_url( 'kalendarze-jednodzielne' ); ?>" class="linkto">
				<div class="portfolio-kalendarz">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/img/kalendarze/jednodzielne.png">
						<h5>Kalendarze jednodzielne</h5>
				</div>
			</a>
		</div><!-- /col-md-3 -->

		<div class="col-md-3"><!-- col-md-3 -->
			<a href="<?php echo home_url( 'kalendarze-ksiazkowe' ); ?>" class="linkto">
				<div class="portfolio-kalendarz">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/img/kalendarze/ksiazkowe.png">
						<h5>Kalendarze książkowe</h5>
				</div>
			</a>
		</div><!-- /col-md-3 -->

		<div class="col-md-3"><!-- col-md-3 -->
			<a href="<?php echo home_url( 'kalendarze-listkowe' ); ?>" class="linkto">
				<div class="portfolio-kalendarz">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/img/kalendarze/listkowe.png">
						<h5>Kalendarze listkowe</h5>
				</div>
			</a>
		</div><!-- /col-md-3 -->

		<div class="col-md-3"><!-- col-md-3 -->
			<a href="<?php echo home_url( 'kalendarze-plakatowe' ); ?>" class="linkto">
				<div class="portfolio-kalendarz">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/img/kalendarze/plakatowe.png">
						<h5>Kalendarze plakatowe</h5>
				</div>
			</a>
		</div><!-- /col-md-3 -->

		<div class="col-md-3"><!-- col-md-3 -->
			<a href="<?php echo home_url( 'kalendarze-trojdzielne' ); ?>" class="linkto">
				<div class="portfolio-kalendarz">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/img/kalendarze/trojdzielne.png">
						<h5>Kalendarze trójdzielne</h5>
				</div>
			</a>
		</div><!-- /col-md-3 -->


		<div class="col-md-3"><!-- col-md-3 -->
			<a href="<?php echo home_url( 'kalendarze-wieloplanszowe' ); ?>" class="linkto">
				<div class="portfolio-kalendarz">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/img/kalendarze/wieloplanszowe.png">
						<h5>Kalendarze wieloplanszowe</h5>
				</div>
			</a>
		</div><!-- /col-md-3 -->

		<div class="col-md-3"><!-- col-md-3 -->
			<a href="<?php echo home_url( 'kalendarze-z-zegarem' ); ?>" class="linkto">
				<div class="portfolio-kalendarz">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/img/kalendarze/zegarowe.png">
						<h5>Kalendarze z zegarem</h5>
				</div>
			</a>
		</div><!-- /col-md-3 -->

			<div class="col-md-3"><!-- col-md-3 -->
			<a href="<?php echo home_url( 'galeria-glowek' ); ?>" class="linkto">
				<div class="portfolio-kalendarz">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/img/kalendarze/motyw.png">
						<h5>Galeria główek</h5>
				</div>
			</a>
		</div><!-- /col-md-3 -->

			




		<!-- /kalendarze wszystkie -->





		<div class="col-sm-12">

		<div class="kal_mer">

		<h3 class="kal">Kalendarze 2018 r. - zapraszamy do zapoznania się z katalogami</h3>

		</div>

		</div>


			<div class="col-sm-12 single_content">

			
				<div class="calendar-wrapper">
					<a href="http://www.merkuriusz.ekalendarze.eu/" target="_blank" title="katalogC" class="calendar-img no-shrink" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/kalendarze/C.jpg);"></a>
					<a href="http://www.pieknekalendarze.pl/" target="_blank" title="katalogJ" class="calendar-img no-shrink" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/kalendarze/J.jpg);"></a>
					<a href="http://www.kalendarz.com.pl/" target="_blank" title="katalogA" class="calendar-img no-shrink" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/kalendarze/A.jpg);"></a>
					<a href="http://www.kalendarze.wizja.net/oferta_MERKURIUSZ_index" target="_blank" title="katalogL" class="calendar-img no-shrink" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/kalendarze/L.jpg);"></a>
				</div>
			</div>
		</div>
	</div>

 <!-- FOOTER -->
<?php get_footer(); ?>