<?php
	// $podobne = $XMLData[ 'similar' ];
	$words = explode( " ", $item[ 'title' ] );
	$word = implode( " ", array_slice( $words, 0, 2 ) );
	$podobne = $XM->getProducts( 'custom', "WHERE `code` != '{$item[ 'code' ]}' AND `short` != '{$item[ 'short' ]}' AND `title` LIKE '{$word}%'" );
	shuffle( $podobne );
	$podobne = array_slice( $podobne, 0, 24 );
	
	echo "<!--SIMILAR\r\n";
	print_r( $item );
	echo "-->";
	
	if( count( $podobne ) > 0 ):
?>
<div class='podobne flex flex-column'>
	<div class='title bold flex flex-items-center'>
		Produkty podobne
	</div>
	<div class='kafelki flex flex-wrap'>
		<?php
			// shuffle( $podobne );
			// if( count( $podobne ) > 6 ) $podobne = array_slice( $podobne, 0, 6 );
			foreach( $podobne as $item ){
				printf( "<div class='item base1 base2-ms base3-mm base4-ds flex'>
								<div class='wrapper grow flex flex-column'>
									<div class='img bgimg contain' style='background-image:url(%s);'>
										<a href='%s'></a>
									</div>
									<div class='title bold grow'>
										<a href='%s'>
											%s
										</a>
									</div>
									<div class='code'>Kod produktu: <span class='bold'>%s</span></div>
								</div>
							</div>",
					json_decode( $item[ 'photos' ] )[0],
					home_url( "produkt?cat={$_GET['cat']}&code={$item['code']}" ), 
					home_url( "produkt?cat={$_GET['cat']}&code={$item['code']}" ), 
					$item['title'], 
					$item['code'] 
				);
				
			}
		?>
	</div>
	
</div>
<?php
	endif;
?>