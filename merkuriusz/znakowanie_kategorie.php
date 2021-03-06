<?php
	/*
	Template Name: znakowanie_kategorie
	*/
	get_header();
	the_post();
?>

<body>
	
<?php get_template_part( "template/page", "top" ); ?>
<?php get_template_part( "template/menu", "top" ); ?>
	<!-- BANER O NAS-->

	<div class="container-fluid about_us_cover" style='background-image:url(<?php echo get_the_post_thumbnail_url( get_page_by_title( 'Znakowanie' )->ID ) ?>)'>
		<div class="container">
			<div class="col-sm-12 about_us_content">
				<h1>Znakowanie</h1>
				<p><?php the_title(); ?></p>
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
						<img src="<?php echo get_the_post_thumbnail_url( $post_id, 'large' ); ?>" >
						<h2><?php the_title(); ?></h2>
						<p>
							<?php the_content(); ?>
						</p>
					</div>
				</div>
			</div>	
		</div>

 <!-- FOOTER -->

<?php get_footer(); ?>