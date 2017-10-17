<?php
	/*
	Template Name: Autorskie single
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

<!-- Single US MAIN CONTENT -->
	
		<div class="informacje">
			<div class="container">
				<div class="col-md-4">
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
				<div class="col-md-8">

				
				<div class="apla">


					<?php echo do_shortcode(get_post_field('post_content', $postid));
 ?>

					

				</div>

<!-- Promo calendar

				<div class="promo-kal">

				<img src="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/09/kalendarze-tarnow.jpg" class="img-responsive">

					<h2 class="kal">Kolekcja kalendarzy "Miasto Tarnów"</h2>

					<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/autorskie-kalendarze-merkuriusz" class="ad_btn_kal">zobacz kolekcję</a>

				</div>
-->


			</div>	<!-- col-md-8 -->
		</div>

 <!-- FOOTER -->

<?php get_footer(); ?>