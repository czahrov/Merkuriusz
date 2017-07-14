<?php
/*
	Template Name: Produkt - kategoria
*/
	get_header();
	
	parse_str( $_SERVER[ 'QUERY_STRING' ], $params );
	$_SESSION = array_merge( $_SESSION, $params );
	
?>
<body id='kategoria'>
<?php get_template_part( "template/page", "top" ); ?>
<div class='container'>
	<?php get_template_part( "template/menu", "side" ); ?>
	<div id='grid' class='col-md-8'>
		<div class='top flex flex-wrap flex-items-center flex-justify-between'>
			<div class='breadc uppercase base1 base0-mm flex flex-items-center flex-justify-center'></div>
			<div class='switcher base1 base0-mm flex flex-items-center flex-justify-center'>
				<?php do_action( 'num_switcher' ); ?>
			</div>
			
		</div>
		<div class='pagin flex flex-items-center'>
			<?php do_action( 'kategoria_pagin_prev' ); ?>
			<?php do_action( 'kategoria_pagin_next' ); ?>
		</div>
		<div class='kafelki flex flex-wrap'>
			<?php do_action( 'kafelki_kategoria' ); ?>
		</div>
		<div class='pagin flex flex-items-center'>
			<?php do_action( 'kategoria_pagin_prev' ); ?>
			<?php do_action( 'kategoria_pagin_next' ); ?>
		</div>
		<div class='bot flex flex-wrap flex-items-center flex-justify-between'>
			<div class='num base1 base0-mm flex flex-items-center flex-justify-center'>
				<?php do_action( 'number' ); ?>
			</div>
			<div class='switcher base1 base0-mm flex flex-items-center flex-justify-center'>
				<?php do_action( 'num_switcher' ); ?>
			</div>
		</div>
		
	</div>
</div>

<?php get_template_part( "template/slider", "katalog" ); ?>

<?php get_template_part( "template/reklama360" ); ?>

<?php get_template_part( "template/slider", "partnerzy" ); ?>

<?php get_template_part( "template/newsletter" ); ?>

<?php
	get_footer();
?>