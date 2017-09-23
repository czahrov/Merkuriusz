<?php
	$warianty = $XMLData[ 'colors' ];
	if( count( $warianty ) > 0 ):
?>
<div class='warianty flex flex-column'>
	<div class='title bold flex flex-items-center'>
		Produkt w innych wariantach kolorystycznych
	</div>
	<div class='kafelki flex flex-wrap'>
		<?php
			// shuffle( $warianty );
			// if( count( $warianty ) > 6 ) $warianty = array_slice( $warianty, 0, 6 );
			foreach( $warianty as $item ){
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
					$item['IMG'][0], 
					home_url( "produkt?cat={$_GET['cat']}&code={$item['ID']}" ), 
					home_url( "produkt?cat={$_GET['cat']}&code={$item['ID']}" ), 
					$item['NAME'], 
					$item['ID'] 
				);
				
			}
		?>
	</div>
	
</div>
<?php
	endif;
?>