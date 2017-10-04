<?php get_header(); ?>
<body id='home'>
	<div class='popup flex flex-items-center flex-justify-center'>
			<div class='box grid bg-light flex flex-column'>
				<div class='close-fp pointer bg-blue font-light flex flex-items-center flex-justify-center'>
					<span class='icon fa fa-times'></span>
				</div>
				<div class='viewbox'>
					<div class='view odziez hide-fp flex flex-column'>
						<div class='top bold uppercase'>
							Odzież reklamowa - nadruki na ubraniach
						</div>
						<div class='mid flex flex-items-start'>
							<div class='pic base4 flex flex-column'>
								<div class='img'>
									<img src='<?php echo get_template_directory_uri(); ?>/img/odziez_reklamowa_catalog_img.jpg' />
								</div>
								<div class='text uppercase bold font-blue text-center'>
									Kolekcja 2016
								</div>
								
							</div>
							<div class='items grow flex flex-wrap'>
								<?php
									$data = array(
										array(
											'title' => 'Plecaki',
											'url' => home_url( 'kategoria?cat=gadzety_reklamowe,torby_i_plecaki,torby_i_plecaki-plecaki' ),
										),
										array(
											'title' => 'Sportowe',
											'url' => home_url( 'kategoria?cat=gadzety_reklamowe,torby_i_plecaki,torby_i_plecaki-sportowe' ),
										),
										array(
											'title' => 'Czapki z daszkiem',
											'url' => home_url( 'kategoria?cat=gadzety_reklamowe,tekstylia,tekstylia-czapki_z_daszkiem' ),
										),
										
									);
									
									foreach( $data as $item ):
								?>
								<div class='item base3 bold'>
									<a class='link uppercase bg-gray2 flex flex-items-center flex-justify-center' href='<?php echo $item[ 'url' ]; ?>'>
										<?php echo $item[ 'title' ]; ?>
									</a>
								</div>
								<?php
									endforeach;
								?>
								
							</div>
							
						</div>
						
					</div>
					<div class='view dlugPlast hide-fp flex flex-column'>
						<div class='top bold uppercase'>
							Kolekcja długopisów plastikowych
						</div>
						<div class='mid flex flex-items-start'>
							<div class='pic base4 flex flex-column'>
								<div class='img'>
									<img src='<?php echo get_template_directory_uri(); ?>/img/katalogi/dlugopisy_plastikowe.jpg' />
								</div>
								<div class='text uppercase bold font-blue text-center'></div>
								
							</div>
							<div class='items grow flex flex-wrap'>
								<?php
									$data = array(
										array(
											'class' => 'lecce-pen',
											'url' => 'wp-content/uploads/2017/08/lecce-pen-katalog-z-cenami.pdf',
											'img' => get_template_directory_uri() . '/img/dlugopisy/logo-lecce-pen.png',
											'title' => '',
										),
										array(
											'class' => 'viva-pens',
											'url' => 'wp-content/uploads/2017/08/katalog-VIVA-classic.pdf',
											'img' => get_template_directory_uri() . '/img/dlugopisy/viva_pens.jpg',
											'title' => '',
										),
										array(
											'class' => 'dream-pen',
											'url' => 'wp-content/uploads/2017/08/dream-pen.pdf',
											'img' => '',
											'title' => 'Dream Pen',
										),
										array(
											'class' => 'ritter-pen',
											'url' => 'wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf',
											'img' => get_template_directory_uri() . '/img/dlugopisy/ritter_pen.png',
											'title' => '',
										),
										array(
											'class' => 'bic',
											'url' => '',
											'img' => get_template_directory_uri() . '/img/dlugopisy/bic_logo.png',
											'title' => '',
										),
										
									);
									
									foreach( $data as $item ):
								?>
								<div class='item base3 bold <?php echo $item[ 'class' ]; ?>'>
									<div class='link uppercase bg-center bg-contain bg-norepeat flex flex-items-center flex-justify-center' style='background-image:url( <?php echo $item[ 'img' ] ?> );'>
										<?php echo $item[ 'title' ]; ?>
									</div>
									<a class='hitbox' target='_blank' <?php if( !empty( $item[ 'url' ] ) ) echo "href='{$item[ 'url' ]}'"; ?>></a>
								</div>
								<?php endforeach; ?>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
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
						<div class='link pointer uppercase bold'>
							Zobacz produkty
						</div>
						
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