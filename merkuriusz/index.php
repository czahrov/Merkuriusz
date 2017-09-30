<?php get_header(); ?>
<body id='home'>
	<?php get_template_part( "template/page", "top" ); ?>
	<!-- SIDEBAR -->
	<div class="grid flex flex-items-start">
		<?php get_template_part( "template/menu", "side" ); ?>

		<!-- MAIN PICTURES -->
		<div class="kafelki base1 flex flex-wrap">
			<div class='menu base1'>
				<?php get_template_part( "template/menu", 'top'); ?>
			</div>
			<div class='big grow flex'>
				<div class='item grow flex'>
					<?php get_template_part( "template/home-slider-top" ); ?>
					
				</div>
				
			</div>
			<div class='small base3 flex flex-column'>
				<div class='item grow'></div>
				<div class='item grow'></div>
				
			</div>

		</div>
			
	</div>  <!-- END OF CONTAINER SIDEBAR AND PICTURES -->

<!-- kolekcje odziezy reklamowej POP UP-->
	
	<?php get_template_part( "template/kalendarze" ); ?>
	
	<?php get_template_part( "template/slider", "katalog" ); ?>
	
	<?php get_template_part( "template/reklama360" ); ?>

<!--PARTNERS -->

	<?php //get_template_part( "template/slider", "partnerzy" ); ?>
	
	<?php get_template_part( "template/newsletter" ); ?>

<!-- FOOTER -->

<?php get_footer(); ?>