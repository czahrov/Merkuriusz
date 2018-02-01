<?php
	/*
	Template Name: o_nas
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

<!-- ABOUT US MAIN CONTENT -->

<div class="container-fluid about-section-bg">
	<div class="about-section">
		<div class="col-md-12 about-content-box">
			<h2><span class="about-us-one">KOMPLEKSOWA OBSŁUGA W ZAKRESIE REKLAMY</span> MERKURIUSZ
			</h2>
			<?php echo apply_filters( 'the_content', get_post_meta( get_post()->ID, 'obsluga',  true ) ); ?>
		</div>
		<a><div class="about-arrow-btn down-slider"><i class="fa fa-angle-down" aria-hidden="true"></i></div></a>
	</div>
</div> <!-- END CONTAINER FLUID -->

<div class="container-fluid">
	<div id="about-section1" class="about-section">
		<div class="col-md-12 about-content-box" id="section_about_2">
			<h2><span class="about-us-one">KIM</span> JESTEŚMY?
			</h2>
			<?php echo apply_filters( 'the_content', get_post_meta( get_post()->ID, 'kim',  true ) ); ?>
		</div>
		
	</div>
</div> <!-- END CONTAINER FLUID -->

<div class="container-fluid about-section-bg">
	<div class="about-section">
		<div class="col-md-12 about-content-box" id="section_about_3">
			<h2><span class="about-us-one">Z KIM</span> WSPÓŁPRACUJEMY?
			</h2>
			<?php echo apply_filters( 'the_content', get_post_meta( get_post()->ID, 'wspolpraca',  true ) ); ?>
		</div>
	</div>
</div> <!-- END CONTAINER FLUID -->

<!--END OF PARTNERS -->
<div class="container-fluid">
	<div class="about-section">
		<div class="col-md-12 about-content-box">
			<h2><span class="about-us-one">DOKĄD</span> DĄŻYMY?
			<?php echo apply_filters( 'the_content', get_post_meta( get_post()->ID, 'dokad',  true ) ); ?>
		</div>
		
	</div>
</div> <!-- END CONTAINER FLUID -->


<div class="container-fluid about-section-bg">
	<div class="about-section">
		<div class="col-md-12 about-content-box " id="section_about_5">
			<?php echo apply_filters( 'the_content', get_post_meta( get_post()->ID, 'dbamy',  true ) ); ?>
			<a href="<?php echo home_url('oferta'); ?>" class="btn about-us-btn">ZOBACZ NASZĄ OFERTĘ</a>
		</div>
		
	</div>
</div> <!-- END CONTAINER FLUID -->

<div class="white-space-70"></div>

<!-- NEWSLETTER -->
<?php get_template_part( 'template/newsletter' ); ?>


 <!-- FOOTER -->
	
<?php get_footer(); ?>