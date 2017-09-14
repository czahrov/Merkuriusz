<?php
	/*
	Template Name: znakowanie
	*/
	get_header();
	the_post();
?>

<body>
	
	<?php get_template_part( "template/page", "top" ); ?>
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
	
		<div class="informacje">
			<div class="container">
				<div class="col-md-4">
					<div class="inf-menu-boczne">
						<?php genSibPage(); ?>
					</div>
				</div>
				<div class="col-md-8">
					<div class="informacje_tresc">
						<h2><?php the_title(); ?></h2>
						<p>
							<?php the_content(); ?>
						</p>
						<div class="container-fluid single-page">

			
						<div class="znakowanie-wrapper flex flex-wrap flex-justify-center flex-justify-start-ml">
							<div class="znakowanie-element base1 base2-ms base3-mm">
								<a href="<?php echo home_url('znakowanie/3d-laser/'); ?>" class="znakowanie-link no-shrink" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/grawer_3d.jpg);">
								</a>
							</div>
							<div class="znakowanie-element base1 base2-ms base3-mm">
								<a href="<?php echo home_url('znakowanie/haft/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/haft.jpg);"></a>
							</div>
								<div class="znakowanie-element base1 base2-ms base3-mm">
								<a href="<?php echo home_url('znakowanie/ceramice-technologi-xp/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/ceramice_technologi_xp.jpg);"></a>
							</div>
								<div class="znakowanie-element base1 base2-ms base3-mm">
								<a href="<?php echo home_url('znakowanie/tampodruk-na-ceramice/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/tampodruk_na_ceramice.jpg);"></a>
							</div>
								<div class="znakowanie-element base1 base2-ms base3-mm">
								<a href="<?php echo home_url('znakowanie/cyfrowy/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/druk_cyfrowy.jpg);"></a>
							</div>
							<div class="znakowanie-element base1 base2-ms base3-mm">
								<a href="<?php echo home_url('znakowanie/epoxy/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/epoxy.jpg);"></a>
							</div>
								<div class="znakowanie-element base1 base2-ms base3-mm">
								<a href="<?php echo home_url('znakowanie/laser/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/grawer.jpg);"></a>
							</div>
							<div class="znakowanie-element base1 base2-ms base3-mm">
									<a href="<?php echo home_url('znakowanie/wytlaczanie/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/wytlaczanie.jpg);"></a>
							</div>
							
							
							<div class="znakowanie-element base1 base2-ms base3-mm">
									<a href="<?php echo home_url('znakowanie/tampodruk/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/tampodruk.jpg);"></a>
							</div>
							<div class="znakowanie-element base1 base2-ms base3-mm">
									<a href="<?php echo home_url('znakowanie/cylindryczny-sitodruk/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/cylindryczny_sitodruk.jpg);"></a>
							</div>
							<div class="znakowanie-element base1 base2-ms base3-mm">
									<a href="<?php echo home_url('znakowanie/sitodruk/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/sitodruk.jpg);"></a>
							</div>
							<div class="znakowanie-element base1 base2-ms base3-mm">
									<a href="<?php echo home_url('znakowanie/sublimacja/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/sublimacja.jpg);"></a>
							</div>
							
							<div class="znakowanie-element base1 base2-ms base3-mm">
									<a href="<?php echo home_url('znakowanie/transfer/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/transfer.jpg);"></a>
							</div>
							<div class="znakowanie-element base1 base2-ms base3-mm">
									<a href="<?php echo home_url('znakowanie/technologii-uv-led/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/uv_led.jpg);"></a>
							</div>
							<div class="znakowanie-element base1 base2-ms base3-mm">
									<a href="<?php echo home_url('znakowanie/vision-film-druk/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/vision_film_druk.jpg);"></a>
							</div>
							<div class="znakowanie-element base1 base2-ms base3-mm">
									<a href="<?php echo home_url('znakowanie/winylowa-naklejka/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/winylowa_naklejka.jpg);"></a>
							</div>
							
							<div class="znakowanie-element base1 base2-ms base3-mm">
									<a href="<?php echo home_url('znakowanie/transfer-na-bialej-powierzchni/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/transfer_na_bialej_powierzchni.jpg);"></a>
							</div>
							<div class="znakowanie-element base1 base2-ms base3-mm">
									<a href="<?php echo home_url('znakowanie/transfer-na-bialej-ceramice/'); ?>" class="znakowanie-link" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/znakowanie/transfer_na_bialej_ceramice.jpg);"></a>
							</div>
							
						</div>

						</div>
					</div>
				</div>
				
			</div>	
		</div>

 <!-- FOOTER -->

<?php get_footer(); ?>