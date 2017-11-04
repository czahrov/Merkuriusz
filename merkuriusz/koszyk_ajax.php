<?php
/*
	Template name: koszyk AJAX
*/

session_start();

if( isAjax() ){
	
	// print_r( $_GET );
	// print_r( $_POST );
	// print_r( $_SERVER[ 'REQUEST_METHOD' ] );
	
	if( !empty( $_POST ) ){
		// zapisywanie zestawu w koszyku
		if( !empty( $_POST[ 'zamowienie' ] ) ){
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
		}
		/* kasowanie zestawów z koszyka */
		elseif( isset( $_GET[ 'del' ] ) ){
			// echo "kasowanie\r\n";
			// print_r( $_POST );
			foreach( $_POST[ 'produkt' ] as $id ){
				unset( $_SESSION[ 'cart' ][ $id ] );
				
			}
			
			echo json_encode( array(
				'status' => 'ok',
				
			) );
		}
		/* składanie zamówienia */
		elseif( isset( $_GET[ 'buy' ] ) ){
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
			
			if( $safe !== false ){
			
				require 'php/PHPMailer/PHPMailerAutoload.php';
				
				$mailer = new PHPMailer;
				$mailer->CharSet = 'utf-8';
				$mailer->Encoding = 'base64';
				$mailer->setLanguage( 'pl' );
				$mailer->setFrom( "noreply@{$_SERVER[ 'HTTP_HOST' ]}", 'Zamówienie online - Merkuriusz' );
				$mailer->addAddress( $safe[ 'mail' ] );
				$mailer->addAttachment( $_FILES[ 'file' ][ 'tmp_name' ], $_FILES[ 'file' ][ 'name' ] );
				$mailer->Subject = sprintf( "%s składa zamówienie", $safe[ 'imie' ] );
				
				$zestawy = "";
				foreach( $_POST[ 'produkt' ] as $num => $id ){
					$set = $_SESSION[ 'cart' ][ $id ];
					$zestawy .= sprintf( "\r\n==== Zestaw nr %s ====\r\nIdentyfikator produktu: %s\r\nNazwa produktu: %s\r\nKolor produktu: %s\r\nIlość sztuk: %s\r\nZnakowanie: %s\r\n====\r\n", 
					$num + 1,
					$set[ 'ID' ],
					$set[ 'name' ],
					$set[ 'colorname' ],
					$set[ 'num' ],
					implode( ", ", $set[ 'mark' ] )
					);
					
				}
				
				$mailer->Body = sprintf( "Składający zamówienie: %s\r\nTelefon kontaktowy: %s\r\nAdres e-mail: %s\r\nZamawia następujące zestawy:%s\r\nWiadomość od zamawiającego:\r\n%s\r\n\r\n---\r\nMail wygenerowany automatycznie na stronie %s", 
				$safe[ 'imie' ],
				$safe[ 'tel' ],
				$safe[ 'mail' ],
				$zestawy,
				$safe[ 'msg' ],
				home_url()
				);
				
				if( $mailer->send() ){
					foreach( $_POST[ 'produkt' ] as $id ){
						unset( $_SESSION[ 'cart' ][ $id ] );
					
					}
					
					echo json_encode( array(
						'status' => 'ok',
						'msg' => 'Mail został wysłany pomyślnie.<br>Za chwilę nastąpi przekierowanie.'
						
					) );
				}
				else{
					echo json_encode( array(
						'status' => 'fail',
						'msg' => 'Wysyłka maila nie powiodła się.<br>Powód: ' . $mailer->ErrorInfo,
						'info' => array(
							'get' => $_GET,
							'post' => $_POST,
							'safe' => $safe,
							
						),
						
					) );
					
				}
				
				
			}
			else{
				echo json_encode( array(
					'status' => 'fail',
					'msg' => 'Formularz zawiera błędy.<br>Sprawdź poprawnośc danych i spróbuj ponownie.'
					
				) );
				
			}
			
		}
		
	}
	
	if( !empty( $_GET ) ){
		/* zwracanie stanu koszyka */
		if( isset( $_GET[ 'status' ] ) ){
			echo json_encode( cartStatus() );
			
		}
		
	}
	
}
else{
	echo "<!--";
	// print_r( $_SESSION );
	echo "-->";
	
	if( !empty( $_GET ) ){
		$delID = $_GET[ 'del' ];
		$buyID = $_GET[ 'buy' ];
		
		if( !empty( $delID ) ){
			unset( $_SESSION[ 'cart' ][ $delID ] );
			header( "Location: " . home_url( 'koszyk' ) );
			exit;
			
		}
		elseif( !empty( $buyID ) ){
			
			
		}
	
	}
	
	get_header();
	get_template_part( 'template/koszyk' );
	get_footer();
	
}

