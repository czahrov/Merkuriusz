<?php
	/*
	Template Name: oferta
	*/
	get_header();
	$oferty = genOfertyData();
?>

<body id='oferta'>
	
	<?php get_template_part( "template/page", "top" ); ?>
	<?php get_template_part( "template/menu", "top" ); ?>
	<!-- BANER O NAS-->

	<div class="container-fluid about_us_cover" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_post()->ID, 'full' ); ?>');">
		<div class="filtr"></div>
		<div class="container">
			<div class="col-sm-12 about_us_content">
				<h1><?php echo get_post()->post_title; ?></h1>
				
			</div>
		</div>
	</div>
	<div class='box grid'>
		<div class='head flex flex-wrap'>
			<div class='title uppercase bold base1'>
				Realizujemy
			</div>
			<div class='filters flex flex-items-center flex-wrap'>
				<?php
					/* Wypisywanie filtrów ( podkategorii ) */
					foreach( $oferty as $name => $oferta ):
				?>
				<div class='item uppercase bold pointer <?php if( $name === 'Wszystkie' ) echo " active " ?>' cat='<?php echo $name ?>'>
					<?php echo $name; ?>
				</div>
				<?php endforeach; ?>
			</div>
			
		</div>
		<div class='kafelki flex flex-wrap'>
			<?php
				/* Generowanie kafelków */
				foreach( $oferty[ 'Wszystkie' ] as $oferta ):
				$thumb = empty( $oferta[ 'thumb' ] )?( $oferta[ 'img_alt' ] ):( $oferta[ 'thumb' ] );
				$img = empty( $oferta[ 'img' ] )?( $oferta[ 'img_alt' ] ):( $oferta[ 'img' ] );
			?>
			<div class='item pointer base5' cats='<?php echo implode( " ", $oferta[ 'cats' ] ); ?>''>
				<div class='box'>
					<div class='img bg-cover bg-center' style='background-image:url(<?php echo $thumb; ?>);' img='<?php echo $img; ?>'></div>
					<div class='title flex flex-items-center semibold'>
						<?php echo $oferta[ 'title' ]; ?>
					</div>
					
				</div>
				
			</div>
			<?php endforeach; ?>
			
		</div>
		
	</div>
	<div class='popup_oferta flex flex-items-center flex-justify-center'>
		<div class='box grid bg-contain bg-norepeat bg-center bg-top'>
			<div class='top flex flex-justify-end'>
				<div class='title font-light flex flex-items-center'>
					Temporary title
				</div>
				<div class='btn-close pointer bg-blue2 font-light fa fa-times flex flex-items-center flex-justify-center'></div>
				
			</div>
			
		</div>
		
	</div>
	
<?php get_footer(); ?>