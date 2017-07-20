<?php
/*
	Template Name: Produkt - single
*/
	get_header();
	
	parse_str( $_SERVER[ 'QUERY_STRING' ], $params );
	$_SESSION = array_merge( $_SESSION, $params );
	
	require_once "XML.php";
	
	$XMLData = $XM->getData();
	
	echo "<!--";
	//print_r( $XMLData['items'] );
	echo "-->";
	
	$item = $XMLData[ 'items' ][0];
	
	/*
	Array
        (
            [ID] => V1647-03
            [NAME] => Długopis
            [DSCR] => Długopis z kolorowym klipem
            [IMG] => Array
                (
                    [0] => http://axpol.com.pl/files/fotob/V1647_03_A.jpg
                    [1] => http://axpol.com.pl/files/foto_add_big/V1647_03_B.jpg
                )

            [CAT] => Array
                (
                    [VOYAGER 2017] => Array
                        (
                        )

                    [materiały piśmiennicze] => Array
                        (
                        )

                    [długopisy plastikowe] => Array
                        (
                        )

                )

            [DIM] => &#216;1,1 x 14 cm
            [MARK] => Array
                (
                    [6x30 (item barrel)] => Array
                        (
                            [0] => T1
                        )

                )

            [INSTOCK] => 0
        )
	*/
	
?>
<body id='single'>
<?php get_template_part( "template/page", "top" ); ?>
<div class='container'>
	<?php get_template_part( "template/menu", "side" ); ?>
	<div id='grid' class='col-md-8'>
		<div class='top flex flex-wrap flex-items-center flex-justify-between'>
			<div class='breadc uppercase base1 base0-mm flex flex-items-center flex-justify-center'></div>
			
		</div>
		<div class='mid flex flex-wrap flex-items-start'>
			<?php do_action( 'single-picture', $item ); ?>
			
			<div class='dane base1 base2-mm flex flex-column'>
				<?php do_action( 'single-dane-main', $item ); ?>
				
				<?php do_action( 'single-dane-specyfikacja', $item ); ?>
				
				<?php do_action( 'single-dane-znakowanie', $item ); ?>
				
				<?php do_action( 'single-dane-multi', $item ); ?>
				
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