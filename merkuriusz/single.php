<?php
	/*
	Template Name: single
	*/
	get_header();
	the_post();
?>

<body>
	
	<?php get_template_part( "template/page", "top" ); ?>
	<!-- BANER O NAS-->

	<div class="container-fluid about_us_cover">
		<div class="container">
			<div class="col-sm-12 about_us_content">
				<h1>MERKURIUSZ</h1>
				<p>Dowiedz się więcej o naszej Agencji Reklamowej</p>
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