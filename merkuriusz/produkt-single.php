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
	print_r( $XMLData['items'][0] );
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
<script>
	var produkt_data = JSON.parse( '<?php echo json_encode( $item ); ?>' );
</script>
<div class='popup pointer flex flex-items-center flex-justify-center'>
	<div class='box flex flex-column'>
		<div class='header flex no-shrink flex-self-stretch'>
			<div class='title base0 grow flex flex-items-center'>
				<?php echo $item['NAME']; ?>
			</div>
			<div class='close flex flex-items-center flex-justify-center'>
				<span class='icon fa fa-times'></span>
			</div>
			
		</div>
		<div class='loader flex flex-justify-center'>
			<div class='box flex flex-items-center flex-justify-center'>
				<span class='icon fa fa-circle-o-notch fa-spin'></span>
			</div>
			
		</div>
		<div class='img base0 grow shrink flex flex-items-center flex-justify-center'>
			<img/>
		</div>
		
	</div>
	
</div>
<?php get_template_part( "template/page", "top" ); ?>
<div class='container'>
	<?php get_template_part( "template/menu", "side" ); ?>
	<div id='grid' class='col-md-8'>
		<div class='top flex flex-wrap flex-items-center flex-justify-between'>
			<div class='breadc uppercase base1 base0-mm flex flex-items-center flex-justify-center'></div>
			
		</div>
		<div class='mid flex flex-column'>
			<div class='head flex'>
				<?php do_action( 'single-picture', $item ); ?>
				<?php //do_action( 'single-dane-main', $item ); ?>
				<div class='info base2'>
					<div class='title'>
						<?php echo $item[ 'NAME' ]; ?>
					</div>
					<div class='code'>
						<?php printf( "<span class='bold'>Kod produktu:</span> %s", $item[ 'ID' ] ); ?>
					</div>
					<div class='content'>
						<?php echo $item[ 'DSCR' ]; ?>
					</div>
					<div class='price bold flex flex-items-center'>
						<?php printf( "%s zł/szt", $item[ 'PRICE' ] ); ?>
					</div>
					
				</div>
				
			</div>
			<div class='body'>
				<?php //do_action( 'single-dane-specyfikacja', $item ); ?>
				<?php //do_action( 'single-dane-znakowanie', $item ); ?>
				<?php //do_action( 'single-dane-multi', $item ); ?>
				
				<div class='table kalkulator flex flex-column'>
					<div class='thead bold flex flex-items-center'>
						Kalkulator zamówienia
					</div>
					<div class='tbody flex flex-column'>
						<div class='tcell flex flex-items-center'>
							Aby wykonać kalkulację, wypełnij poniższe pola
						</div>
						<div class='tcell dane flex flex-wrap'>
							<div class='line ilosc base1 flex'>
								<div class='name bold base4 flex flex-items-center'>
									Ilość
								</div>
								<input class='value grow' type='text' placeholder='Wpisz ilość, którą chcesz wycenić'/>
								
							</div>
							<div class='line typ base1 flex'>
								<div class='name bold base4 flex flex-items-center'>
									Typ znakowania
								</div>
								<select class='value grow'>
									<option selected disabled value=''>Wybierz metodę znakowania</option>
									<?php
										foreach( $item[ 'MARK' ] as $size => $types ):
											foreach( $types as $type ):
									?>
										<option value='<?php echo $type; ?>'><?php printf( "%s, %s", $type, $size ); ?></option>
									<?php
											endforeach;
										endforeach;
									?>
									
								</select>
								
							</div>
							<div class='line kolory base1 flex'>
								<div class='name bold base4 flex flex-items-center'>
									Ilość kolorów nadruku
								</div>
								<select class='value grow'>
									<option selected disabled value=''>Podaj ilość kolorów nadruku</option>
									<?php for( $i=1; $i<= (int)$item[ 'MARKCOLORS' ]; $i++ ): ?>
									<option><?php echo $i; ?></option>
									<?php endfor; ?>
								</select>
								
							</div>
							<div class='line button grow flex flex-justify-end'>
								<div class='calc pointer bold uppercase flex flex-items-center'>
									Wykonaj kalkulację
								</div>
								
							</div>
							
						</div>
						<div class='tcell wynik flex flex-wrap'>
							<div class='title base1 flex flex-items-center'>
								Wynik Twojej kalkulacji
							</div>
							<div class='line base1 partial product flex'>
								<div class='field name base2 flex flex-items-center'>
									Produkt
								</div>
								<div class='field formula base4 flex flex-items-center flex-justify-center'>
									100 x 3,43 zł
								</div>
								<div class='field sum base4 flex flex-items-center flex-justify-center'>
									343,00 zł
								</div>
								
							</div>
							<div class='line base1 partial marking flex'>
								<div class='field name base2 flex flex-items-center'>
									Znakowanie
								</div>
								<div class='field formula base4 flex flex-items-center flex-justify-center'>
									100 x 0,40 zł
								</div>
								<div class='field sum base4 flex flex-items-center flex-justify-center'>
									40,00 zł
								</div>
								
							</div>
							<div class='line base1 partial prepare flex'>
								<div class='field name base2 flex flex-items-center'>
									Przygotowanie do znakowania
								</div>
								<div class='field formula base4 flex flex-items-center flex-justify-center'>
									1 x 35.00 zł
								</div>
								<div class='field sum base4 flex flex-items-center flex-justify-center'>
									35.00 zł
								</div>
								
							</div>
							<div class='line base1 partial packing flex'>
								<div class='field name base2 flex flex-items-center'>
									Pakoawnie
								</div>
								<div class='field formula base4 flex flex-items-center flex-justify-center'>
									100 x 0.05 zł
								</div>
								<div class='field sum base4 flex flex-items-center flex-justify-center'>
									5.00 zł
								</div>
								
							</div>
							<div class='line base1 partial added flex'>
								<div class='field name base2 flex flex-items-center'>
									Ryczałt
								</div>
								<div class='field formula base4 flex flex-items-center flex-justify-center'>
									1 x 65.00 zł
								</div>
								<div class='field sum base4 flex flex-items-center flex-justify-center'>
									65.00 zł
								</div>
								
							</div>
							<div class='line base1 total flex'>
								<div class='field fake base2'></div>
								<div class='field sum bold base2 flex flex-items-center flex-justify-center'>
									SUMA: <span>488.00 zł</span> + VAT
									
								</div>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
				
				<div class='table specyfikacja flex flex-column'>
					<div class='thead bold flex flex-items-center'>
						Specyfikacja techniczna produktu
					</div>
					<div class='tbody flex flex-wrap'>
						<?php
							$specyfikacja = array(
								'Model' => $item[ 'MODEL' ],
								'Dostępność (szt)' => $item[ 'INSTOCK' ],
								'Marka' => $item[ 'BRAND' ],
								'Kraj pochodzenia' => $item[ 'COUNTRY' ],
								'Rozmiar' => $item[ 'DIM' ],
								'Kolor' => $item[ 'COLOR' ],
								'Znakowanie' => $item[ 'MARKTYPE' ],
								'Wielkość znakowania' => $item[ 'MARKSIZE' ],
								'Materiał' => $item[ 'MATTER' ],
								'Waga' => $item[ 'WEIGHT' ],
								
							);
							
							foreach( $specyfikacja as $name => $value):
						?>
						<div class='tcell base2 flex'>
							<div class='name bold base2 flex flex-items-center'><?php echo $name; ?></div>
							<div class='value base2 flex flex-items-center'><?php echo $value; ?></div>
							
						</div>
						<?php endforeach; ?>
					</div>
					
				</div>
				
				
			</div>
			<div class='dane base1 base2-mm flex flex-column'>
				
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