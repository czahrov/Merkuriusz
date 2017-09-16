<?php
/*
	Template name: koszyk AJAX
*/

session_start();

if( isAjax() ):
	
	// print_r( $_GET );
	// print_r( $_POST );
	// print_r( $_SERVER[ 'REQUEST_METHOD' ] );
	
	if( !empty( $_POST ) ):
		// zapisywanie zestawu w koszyku
		if( !empty( $_POST[ 'zamowienie' ] ) ):
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
		/* kasowanie zestawów z koszyka */
		elseif( isset( $_GET[ 'del' ] ) ):
			// echo "kasowanie\r\n";
			// print_r( $_POST );
			foreach( $_POST[ 'produkt' ] as $id ):
				unset( $_SESSION[ 'cart' ][ $id ] );
				
			endforeach;
			
			echo json_encode( array(
				'status' => 'ok',
				
			) );
		/* składanie zamówienia */
		elseif( isset( $_GET[ 'buy' ] ) ):
			// echo "kupowanie\r\n";
			// print_r( $_POST );
			// print_r( $_FILES );
			
			/* filtry */
			$filters = array(
				'imie' => array(
					'filter' => FILTER_SANITIZE_STRING,
				),
				'tel' =>array(
					'filter' => FILTER_VALIDATE_REGEXP,
					'options' => array(
						'regexp' => "/^[\d \(\)\-\+]{6,}$/",
					),
				),
				
				'mail' =>array(
					'filter' => FILTER_VALIDATE_EMAIL,
				),
				
				'msg' =>array(
					'filter' => FILTER_SANITIZE_STRING,
				),
				
			);
			
			/* filtrowanie danych */
			$safe = filter_input_array( INPUT_POST, $filters );
			
			if( $safe !== false ):
			
				require 'php/PHPMailer/PHPMailerAutoload.php';
				
				$mailer = new PHPMailer;
				$mailer->CharSet = 'utf-8';
				$mailer->Encoding = 'base64';
				$mailer->setLanguage( 'pl' );
				$mailer->setFrom( 'noreply@poligon.scepter.pl', 'Zamówienie online - Merkuriusz' );
				$mailer->addAddress( $safe[ 'mail' ] );
				$mailer->addAttachment( $_FILES[ 'file' ][ 'tmp_name' ], $_FILES[ 'file' ][ 'name' ] );
				$mailer->Subject = sprintf( "%s składa zamówienie", $safe[ 'imie' ] );
				
				$zestawy = "";
				foreach( $_POST[ 'produkt' ] as $num => $id ):
					$set = $_SESSION[ 'cart' ][ $id ];
					$zestawy .= sprintf( "\r\n==== Zestaw nr %s ====\r\nIdentyfikator produktu: %s\r\nNazwa produktu: %s\r\nKolor produktu: %s\r\nIlość sztuk: %s\r\nZnakowanie: %s\r\n====\r\n", 
					$num + 1,
					$set[ 'ID' ],
					$set[ 'name' ],
					$set[ 'colorname' ],
					$set[ 'num' ],
					implode( ", ", $set[ 'mark' ] )
					);
					
				endforeach;
				
				$mailer->Body = sprintf( "Składający zamówienie: %s\r\nTelefon kontaktowy: %s\r\nAdres e-mail: %s\r\nZamawia następujące zestawy:%s\r\Wiadomość od zamawiającego:\r\n%s\r\n\r\n---\r\nMail wygenerowany automatycznie na stronie %s", 
				$safe[ 'imie' ],
				$safe[ 'tel' ],
				$safe[ 'mail' ],
				$zestawy,
				$safe[ 'msg' ],
				home_url()
				);
				
				if( $mailer->send() ):
					foreach( $_POST[ 'produkt' ] as $id ):
						unset( $_SESSION[ 'cart' ][ $id ] );
					
					endforeach;
					
					echo json_encode( array(
						'status' => 'ok',
						'msg' => 'Mail został wysłany pomyślnie.<br>Za chwilę nastąpi przekierowanie.'
						
					) );
					
				else:
					echo json_encode( array(
						'status' => 'fail',
						'msg' => 'Wysyłka maila nie powiodła się.<br>Powód: ' . $mailer->ErrorInfo,
						
					) );
					
				endif;
				
				
			else:
				echo json_encode( array(
					'status' => 'fail',
					'msg' => 'Formularz zawiera błędy.<br>Sprawdź poprawnośc danych i spróbuj ponownie.'
					
				) );
				
			endif;
			
		endif;
		
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
				<div class='table flex flex-column'>
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
					<form class='table form'>
						<div class='thead bold flex flex-items-center'>
							Formularz zamówienia
						</div>
						<div class='tbody flex flex-wrap'>
							<div class='field imie base2 flex'>
								<input class='input base1' type='text' name='imie' placeholder='Imię i nazwisko' />
								
							</div>
							<div class='field tel base2 flex'>
								<input class='input base1' type='tel' name='tel' placeholder='Numer telefonu' />
								
							</div>
							<div class='field mail base2 flex'>
								<input class='input base1' type='email' name='mail' placeholder='Adres e-mail' />
								
							</div>
							<div class='field file base2 flex'>
								<input class='hide' type='file' name='file'/>
								<div class='input base1 pointer flex flex-items-center flex-justify-between'>
									<div class='title'>
										Dodaj załącznik
									</div>
									<div class='icon fa fa-upload'></div>
									
								</div>
								
							</div>
							<div class='field msg base1 flex'>
								<textarea class='input grow' name='msg' placeholder='Treść wiadomości'></textarea>
								
							</div>
							
						</div>
						<div class='tbottom flex flex-items-center flex-justify-between'>
							<div class='status grow flex flex-items-center'>
								<div class='icon'>
									<div class='ok fa fa-check-circle'></div>
									<div class='fail fa fa-times-circle'></div>
									<div class='info fa fa-info-circle'></div>
									<div class='wait fa fa-circle-o-notch fa-spin'></div>
									
								</div>
								<div class='text grow'></div>
								<div class='load base1 flex flex-wrap flex-items-center'>
									<div class='progres bold'></div>
									<div class='bar grow'></div>
									
								</div>
								
							</div>
							<div class='button send pointer flex flex-items-center flex-justify-center'>
								Wyślij
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