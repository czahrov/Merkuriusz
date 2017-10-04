<?php
	/*
	Template Name: single
	*/
	get_header();
	the_post();
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
				</p>
			</div>
		</div>
	</div>
<!-- Single US MAIN CONTENT -->

<div class="container-fluid single-page">
		<div class="container">
			<div class="col-sm-12 single_content">
				<p><?php the_content(); ?></p>
			</div>
		</div>
	</div>

 <!-- FOOTER -->
<?php get_footer(); ?>