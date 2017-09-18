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
	// print_r( $XMLData['items'][0] );
	// print_r( $_SESSION );
	echo "-->";
	
	$item = $XMLData[ 'items' ][0];
	
	/*
	<!--Array
(
    [ID] => V1298-03
    [NAME] => Długopis
    [DSCR] => Długopis z czarnym gumowym przyciskiem
    [IMG] => Array
        (
            [0] => http://axpol.com.pl/files/fotob/V1298_03_A.jpg
            [1] => http://axpol.com.pl/files/foto_add_big/V1298_03_Z.jpg
            [2] => http://axpol.com.pl/files/foto_add_big/V1298_1.jpg
            [3] => http://axpol.com.pl/files/foto_add_big/V1298_A.jpg
            [4] => http://axpol.com.pl/files/foto_add_big/V1298_B.jpg
        )

    [CAT] => Array
        (
            [materiały piśmiennicze] => Array
                (
                )

            [materiały piśmiennicze-długopisy metalowe] => Array
                (
                )

        )

    [DIM] => &#216;1,2 x 14,2 cm
    [MARK] => Array
        (
            [6x55 (item barrel)] => Array
                (
                    [0] => T3
                    [1] => L0
                )

        )

    [INSTOCK] => 0
    [MATTER] => metal, EVA
    [COLOR] => czarny
    [COUNTRY] => CN
    [MARKSIZE] => 6x55 (item barrel)
    [MARKTYPE] => T3, L0
    [MARKCOLORS] => 1
    [PRICE] => 2.45
    [MODEL] => brak danych
    [WEIGHT] => 11 g
    [BRAND] => brak danych
)
-->
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
					<div class='instock'>
						<?php printf( "Stan magazynowy: <span class='bold'>%s sztuk</span>", $item[ 'INSTOCK' ] ); ?>
					</div>
					<div class='code'>
						<?php printf( "<span class='bold'>Kod produktu:</span> %s", $item[ 'ID' ] ); ?>
					</div>
					<div class='content'>
						<?php echo $item[ 'DSCR' ]; ?>
					</div>
					<div class='price bold flex flex-wrap flex-items-center'>
						<?php
							printf( "%.2f zł/szt brutto%s", 
								$item[ 'PRICE' ][ 'BRUTTO' ],
								$item[ 'PRICE' ][ 'NETTO' ] !== null?( sprintf( "<span class='netto base1 regulat'>(%.2f zł netto)</span>", $item[ 'PRICE' ][ 'NETTO' ] ) ):( "" )
							);
						?>
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
						<form class='tcell dane flex flex-wrap'>
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
									<option value='brak'>Bez znakowania</option>
									<?php
										foreach( $item[ 'MARK' ] as $size => $types ){
											foreach( $types as $type ){
											$mark_data = markTypes( $type );
												printf( "<option value='%s' size='%s' cmin='%s' cmax='%s'>%s, %s</option>",
													$type,
													$size,
													$mark_data[ 'colors' ][ 'min' ],
													$mark_data[ 'colors' ][ 'max' ],
													$type,
													$size
												);
												
											}
										}
									?>
									
								</select>
								
							</div>
							<div class='line kolory base1 flex'>
								<div class='name bold base4 flex flex-items-center'>
									Ilość kolorów nadruku
								</div>
								<select class='value grow'>
									<option selected disabled value=''>Podaj ilość kolorów nadruku</option>
									
								</select>
								
							</div>
							<div class='line button grow flex flex-justify-end'>
								<div class='status grow flex flex-items-center flex-justify-start'>
									<div class='icon wait fa fa-circle-o-notch fa-spin'></div>
									<div class='icon ok fa fa-check-circle'></div>
									<div class='icon fail fa fa-times-circle'></div>
									<div class='icon info fa fa-info-circle'></div>
									<div class='text'></div>
									
								</div>
								<div class='calc pointer bold uppercase no-shrink flex flex-items-center'>
									Wykonaj kalkulację
								</div>
								
							</div>
							
						</form>
						<div class='tcell wynik flex flex-wrap'>
							<div class='title base1 flex flex-items-center'>
								Wynik Twojej kalkulacji
							</div>
							<div class='line proto hide base1 partial flex'>
								<div class='field name base2 flex flex-items-center'></div>
								<div class='field formula base4 flex flex-items-center flex-justify-center'></div>
								<div class='field sum base4 flex flex-items-center flex-justify-center'></div>
								
							</div>
							<div class='line base1 total flex'>
								<div class='field fake base2'></div>
								<div class='field sum bold base2 flex flex-wrap flex-items-center flex-justify-center'>
									SUMA: <span></span>
									<div class='info regular base1'>* Podana cena jest ceną orientacyjną</div>
									
								</div>
								
							</div>
							<div class='line base1 cart flex flex-justify-end'>
								<div class='pointer bold flex flex-items-center flex-justify-center'>
									Dodaj do koszyka
									
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
								'Znakowanie' => implode( "<br>", $item[ 'MARKTYPE' ] ),
								'Wielkość znakowania' => implode( "<br>", $item[ 'MARKSIZE' ] ),
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
			
		</div>
		
	</div>
	
</div>

<?php get_template_part( "template/slider", "katalog" ); ?>

<?php get_template_part( "template/reklama360" ); ?>

<?php get_template_part( "template/slider", "partnerzy" ); ?>

<?php get_template_part( "template/newsletter" ); ?>

<?php get_footer(); ?>