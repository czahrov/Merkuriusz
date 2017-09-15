<?php
/*
	Template name: koszyk AJAX
*/

session_start();

if( isAjax() ):
	
	// print_r( $_POST );
	// print_r( $_SERVER );
	
	if( !empty( $_POST ) ):
		// zapisywanie zestawu w koszyku
		$_SESSION[ 'cart' ][ $_POST[ 'zamowienie' ] ] = array(
			'ID' => $_POST[ 'ID' ],
			'name' => $_POST[ 'nazwa' ],
			'dscr' => $_POST[ 'opis' ],
			'num' => $_POST[ 'num' ],
			'colors' => $_POST[ 'colors' ],
			'colorname' => $_POST[ 'colorname' ],
			'mark' => $_POST[ 'mark' ],
			'price' => $_POST[ 'price' ],
			
		);
		
		echo json_encode( array(
			'status' => 'ok',
			'msg' => 'Zestaw dodano do koszyka',
			
		) );
		
	endif;
	
	if( !empty( $_GET ) ):
		if( isset( $_GET[ 'status' ] ) ):
			echo json_encode( cartStatus() );
			
		endif;
		
	endif;
	
else:
	echo "<!--";
	print_r( $_SESSION );
	echo "-->";
	
	if( !empty( $_GET ) ):
		$delID = $_GET[ 'del' ];
		$buyID = $_GET[ 'buy' ];
		
		if( !empty( $delID ) ):
			unset( $_SESSION[ 'cart' ][ $delID ] );
			header( "Location: " . home_url( 'koszyk' ) );
			exit;
			
		elseif( !empty( $buyID ) ):
			
			
		endif;
	
	endif;
?>
<?php get_template_part( "template/page", "top" ); ?>
<body id='cart'>
	<div class='container'>
		<?php get_template_part( "template/menu", "side" ); ?>
		<div id='grid' class='col-md-8'>
			<div class='top flex flex-wrap flex-items-center flex-justify-between'>
				<div class='breadc uppercase base1 base0-mm flex flex-items-center flex-justify-center'></div>
				
			</div>
			<div class='mid flex flex-column'>
				<div class='table base1 flex flex-column'>
					<div class='title bold flex flex-items-center'>
						Podgląd stanu koszyka
					</div>
					<div class='thead bold flex'>
						<div class='base4 flex flex-items-center flex-justify-start'>Produkt</div>
						<div class='base5 flex flex-items-center flex-justify-center'>Ilość</div>
						<div class='base4 grow flex flex-items-center flex-justify-center'>Znakowanie</div>
						<div class='base5 flex flex-items-center flex-justify-center'>Cena</div>
						<div class='base6 flex flex-items-center flex-justify-center'>Zaznacz</div>
						
					</div>
					<form class='tbody opcje'>
						<?php
							if( count( $_SESSION[ 'cart' ] ) > 0 ):
								foreach( $_SESSION[ 'cart' ] as $id => $set ): ?>
						<div class='line flex'>
							<div class='field name base4 flex flex-items-center flex-justify-start'>
								<?php echo $set[ 'name' ]; ?>
							</div>
							<div class='field num base5 flex flex-items-center flex-justify-center'>
								<?php echo $set[ 'num' ]; ?>
							</div>
							<div class='field marking grow base4 flex flex-items-center flex-justify-center'>
								<?php
									if( $set[ 'mark' ][ 'type' ] === 'brak' ){
										echo "Brak";
										
									}
									else{
										printf( "%s, %s, kolory: %s", $set[ 'mark' ][ 'type' ], $set[ 'mark' ][ 'place' ], $set[ 'colors' ] );
										
									}
								?>
							</div>
							<div class='field price base5 flex flex-items-center flex-justify-center'>
								<?php
									if( $set[ 'mark' ][ 'type' ] !== 'brak' ){
										printf( "%.2f zł", (float)$set[ 'num' ] * (float)$set[ 'num' ] + markPrice( $set[ 'mark' ][ 'type' ], $set[ 'num' ] )[ 'total' ] );
										
									}
									else{
										printf( "%.2f zł", $set[ 'num' ] * $set[ 'num' ] );
										
									}
								?>
							</div>
							<div class='field options base6 flex flex-items-center flex-justify-around'>
								<input class='hide' id='<?php echo $id; ?>' type='checkbox' value='<?php echo $id; ?>' name='produkt[]'/>
								<label class='pointer flex flex-items-center flex-justify-center' for='<?php echo $id; ?>'>
									<div class='icon fa fa-check'></div>
									
								</label>
								
							</div>
							
						</div>
						<?php
								endforeach;
							else:
						?>
						<div class='line flex'>
							<div class='field bold grow flex flex-items-center flex-justify-center'>
								Twój koszyk jest pusty
							</div>
							
						</div>
						<?php
							endif;
						?>
						<div class='line options flex flex-justify-between'>
							<div class='title bold flex flex-items-center'>
								Opcje
							</div>
							<div class='buttons base4 flex flex-items-center flex-justify-around'>
								<div class='icon pointer del fa fa-trash'></div>
								<div class='icon pointer buy fa fa-shopping-cart'></div>
								
							</div>
							
						</div>
						
					</form>
					<form class='table'>
						<div class='thead bold flex flex-items-center'>
							Formularz zamówienia
						</div>
						<div class='tbody flex flex-wrap'>
							<div class='field base2 flex'>
								<input class='input base1' type='text' placeholder='Imię i nazwisko' />
								
							</div>
							<div class='field base2 flex'>
								<input class='input base1' type='tel' placeholder='Numer telefonu' />
								
							</div>
							<div class='field base2 flex'>
								<input class='input base1' type='email' placeholder='Adres e-mail' />
								
							</div>
							
						</div>
						
					</form>
					
				</div>
				
			</div>
			
		</div>
		
	</div>

<?php get_template_part( "template/slider", "katalog" ); ?>

<?php get_template_part( "template/reklama360" ); ?>

<?php get_template_part( "template/slider", "partnerzy" ); ?>

<?php get_template_part( "template/newsletter" ); ?>

<?php get_footer(); ?>

<?php endif; ?>