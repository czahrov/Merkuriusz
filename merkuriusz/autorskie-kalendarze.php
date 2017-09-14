<?php
	/*
	Template Name: Autorskie kalendarze
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
				<div class="col-md-12 text-center">
					<div class="kal_menu">
			<?php  
wp_nav_menu(array(  
  'menu' => 'Main Navigation', 
  'container_id' => 'cssmenu', 
  'walker' => new CSS_Menu_Maker_Walker()
)); 
?>	


</div>
				</div>
				<div class="col-md-7">









			</div>	<!-- col-md-8 -->
		</div>

 <!-- FOOTER -->

<?php get_footer(); ?>