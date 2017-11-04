<?php
echo "<!--";
echo "items " . count( $XMLData[ 'items' ] );
// print_r( $XMLData[ 'items' ] );
echo "-->";
?>
<body id='kategoria'>
	<?php get_template_part( "template/page", "top" ); ?>
	<div class='grid flex flex-items-start  flex-wrap flex-nowrap-mm'>
		<?php get_template_part( "template/menu", "side" ); ?>
		<div id='grid' class='base1'>
			<?php get_template_part( "template/menu", 'top'); ?>
			<div class='top flex flex-wrap flex-items-center flex-justify-between'>
				<div class='breadc uppercase grow base1 base0-mm flex flex-items-center flex-justify-center flex-justify-start-mm'>
					<div class=''>
					<?php
						printf( "Szukana fraza: <span class='bold'>%s</span>", $_GET[ 'nazwa' ] );
						
					?>
					</div>
					
				</div>
				<div class='switcher grow base1 base0-mm flex flex-wrap flex-items-center flex-justify-between'>
					<div class='page'>
						<?php do_action( 'page_switcher', count( $XMLData['items'] ) ); ?>
						
					</div>
					<div class='num flex flex-items-center flex-justify-center flex-justify-end-mm'>
						<?php do_action( 'num_switcher' ); ?>
					</div>
				</div>
				
			</div>
			<div class='pagin flex flex-items-center'>
				<?php do_action( 'kategoria_pagin_prev', count( $XMLData['items'] ) ); ?>
				<?php do_action( 'kategoria_pagin_next', count( $XMLData['items'] ) ); ?>
			</div>
			<div class='kafelki flex flex-wrap'>
				<?php do_action( 'kafelki_kategoria', $XMLData['items'] ); ?>
			</div>
			<div class='pagin flex flex-items-center'>
				<?php do_action( 'kategoria_pagin_prev', count( $XMLData['items'] ) ); ?>
				<?php do_action( 'kategoria_pagin_next', count( $XMLData['items'] ) ); ?>
			</div>
			<div class='bot flex flex-wrap flex-items-center flex-justify-between'>
				<div class='num base1 base0-mm flex flex-items-center flex-justify-center'>
					<?php do_action( 'number', count( $XMLData['items'] ) ); ?>
				</div>
				<div class='switcher base1 base0-mm flex flex-items-center flex-justify-center'>
					<?php do_action( 'num_switcher' ); ?>
				</div>
			</div>
			
		</div>
		
	</div>

	<?php get_template_part( "template/slider", "katalog" ); ?>

	<?php get_template_part( "template/reklama360" ); ?>

	<?php get_template_part( "template/newsletter" ); ?>

<?php get_footer(); ?>