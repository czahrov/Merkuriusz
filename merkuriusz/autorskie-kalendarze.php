<?php
	/*
	Template Name: Autorskie kalendarze
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
				
			</div>
		</div>
	</div>

<!-- kod wywołania menu

			<?php  
wp_nav_menu(array(  
  'menu' => 'Main Navigation', 
  'container_id' => 'cssmenu', 
  'walker' => new CSS_Menu_Maker_Walker()
)); 
?>	
 -->
	
	<div class="informacje">
		<div class="container">
				<div class="col-md-12 text-center">
					<div class="kal_menu">



					<?php echo do_shortcode(get_post_field('post_content', $postid)); ?>

					



					</div>
				</div>
			
		</div>
	</div>

 <!-- FOOTER -->

<?php get_footer(); ?>