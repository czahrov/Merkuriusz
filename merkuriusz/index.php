<?php get_header(); ?>
<body id='home'>

	<?php get_template_part( "template/page", "top" ); ?>
	<!-- SIDEBAR -->
	<div class="grid flex flex-column flex-row-mm flex-items-start-mm">
		<?php get_template_part( "template/menu", "side" ); ?>

		<!-- MAIN PICTURES -->
		<div class="kafelki base1 flex flex-column flex-row-ml flex-wrap">
			<div class='menu base1'>
				<?php get_template_part( "template/menu", 'top'); ?>
			</div>
			<div class='big grow flex'>
				<div class='item grow flex'>
					<?php get_template_part( "template/home-slider-top" ); ?>
					
				</div>
				
			</div>
			<div class='small base3 flex flex-column flex-row-mm flex-column-ml'>
				<div class='item base3 grow odziez bgimg full flex flex-items-center flex-justify-center'>
					<div class='box font-light text-center flex flex-column flex-items-center'>
						<div class='title uppercase bold'>
							Odzież reklamowa
						</div>
						<div class='link pointer uppercase bold'>
							Zobacz produkty
						</div>
						
					</div>
					
				</div>
				<div class='item base3 grow powerbank bgimg full flex flex-items-center flex-justify-center'>
					<div class='box font-light text-center flex flex-column flex-items-center'>
						<div class='title uppercase bold'>
							Powerbanki, usb, myszki <br>( tworzymy modele na zamówienie )
						</div>
						<a class='link pointer uppercase bold' href='http://wwwmerkuriuszpl.europeanusbwarehouse.com/' target='_blank'>
							Zobacz produkty
						</a>
						
					</div>
					
				</div>
				
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