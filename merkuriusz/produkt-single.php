<?php
/*
	Template Name: Produkt - single
*/
	get_header();
	
	parse_str( $_SERVER[ 'QUERY_STRING' ], $params );
	$_SESSION = array_merge( $_SESSION, $params );
	
?>
<body id='single'>
<?php get_template_part( "template/page", "top" ); ?>
<div class='container'>
	<?php get_template_part( "template/menu", "side" ); ?>
	<div id='grid' class='col-md-8'>
		<div class='top flex flex-wrap flex-items-center flex-justify-between'>
			<div class='breadc uppercase base1 base0-mm flex flex-items-center flex-justify-center'></div>
			
		</div>
		<div class='mid flex flex-items-start'>
			<div class='pic base2 flex flex-column'>
				<div class='large bgimg full'>
					<div class='icon'>
						<span class='fa fa-search-plus'></span>
					</div>
					
				</div>
				<div class='mini flex'>
					<div class='item bgimg full base0 grow pointer'></div>
					<div class='item bgimg full base0 grow pointer'></div>
					<div class='item bgimg full base0 grow pointer'></div>
					
				</div>
				<div class='download'>
					<a class='flex flex-items-center'>
						do pobrania:
						<span class='bold'>
							7699.pdf [38.2kB]
						</span>
						
					</a>
				</div>
				
			</div>
			<div class='dane base2 flex flex-column'>
				<div class='main seg'>
					<div class='box'>
						<div class='line code flex flex-items-center'>
							<div class='key'>
								Kod produktu:
							</div>
							<div class='val bold'>
								513129
							</div>
							
						</div>
						<div class='line name flex flex-items-center'>
							<div class='key'>
								Nazwa:
							</div>
							<div class='val bold'>
								Ołówek drewniany
							</div>
							
						</div>
						<div class='line desc flex flex-column flex-justify-center'>
							<div class='key'>
								Opis:
							</div>
							<div class='val bold'>
								Ołówek drewniany
							</div>
							
						</div>
						
					</div>
					
				</div>
				<div class='spec seg'>
					<div class='title uppercase flex flex-items-center'>
						specyfikacja
					</div>
					<div class='box'>
						<div class='line dim flex flex-items-center'>
							<div class='key'>
								Wymiary:
							</div>
							<div class='val bold'>
								0.5 x 9 cm
							</div>
							
						</div>
						<div class='line matter flex flex-items-center'>
							<div class='key'>
								Materiał:
							</div>
							<div class='val bold'>
								Drewno
							</div>
							
						</div>
						<div class='line cat flex flex-items-center'>
							<div class='key'>
								Strona w katalogu:
							</div>
							<div class='val bold'>
								128
							</div>
							
						</div>
						<div class='line color flex flex-items-center'>
							<div class='key'>
								Kolor:
							</div>
							<div class='val bold'>
								naturalny
							</div>
							
						</div>
						
					</div>
					
				</div>
				<div class='marking seg'>
					<div class='title uppercase flex flex-items-center'>
						znakowanie
					</div>
					<div class='box flex'>
						<div class='line area base2 flex flex-column flex-justify-center'>
							<div class='key flex flex-items-center'>
								Rozmiar:
							</div>
							<div class='val bold flex flex-items-center'>
								6 x 20 mm
							</div>
							
						</div>
						<div class='line method base2 flex flex-column flex-justify-center'>
							<div class='key flex flex-items-center'>
								Metoda:
							</div>
							<div class='val bold flex flex-items-center flex-justify-between'>
								TI
								<span class='icon fa fa-info'></span>
							</div>
							
						</div>
						
					</div>
					
				</div>
				<div class='multi seg'>
					<div class='flex'>
						<div class='pakowanie title uppercase base2 pointer flex flex-items-center'>
							pakowanie
						</div>
						<div class='inne title uppercase base2 pointer flex flex-items-center'>
							inne
						</div>
						
					</div>
					<div class='box pakowanie'>
						<div class='line flex flex-items-center'>
							<div class='key base2'>
								Pakowanie indywidualne:
							</div>
							<div class='val bold'>
								100pc / box
							</div>
							
						</div>
						<div class='line flex flex-items-center'>
							<div class='key base2'>
								Ilość w kartonie zbiorczym:
							</div>
							<div class='val bold'>
								2000
							</div>
							
						</div>
						<div class='line flex flex-items-center'>
							<div class='key base2'>
								Wymiary kartonu zbiorczego:
							</div>
							<div class='val bold'>
								40 x 29 x 12 cm
							</div>
							
						</div>
						<div class='line flex flex-items-center'>
							<div class='key base2'>
								Waga kartonu zbiorczego:
							</div>
							<div class='val bold'>
								7
							</div>
							
						</div>
						<div class='line flex flex-items-center'>
							<div class='key base2'>
								Ilość w kartonie wewnętrznym:
							</div>
							<div class='val bold'>
								100
							</div>
							
						</div>
						
					</div>
					<div class='box inne fp-hide'>
						<div class='line flex flex-items-center'>
							<div class='key base2'>
								Pakowanie indywidualne:
							</div>
							<div class='val bold'>
								inne
							</div>
							
						</div>
						<div class='line flex flex-items-center'>
							<div class='key base2'>
								Ilość w kartonie zbiorczym:
							</div>
							<div class='val bold'>
								inne
							</div>
							
						</div>
						<div class='line flex flex-items-center'>
							<div class='key base2'>
								Wymiary kartonu zbiorczego:
							</div>
							<div class='val bold'>
								inne
							</div>
							
						</div>
						<div class='line flex flex-items-center'>
							<div class='key base2'>
								Waga kartonu zbiorczego:
							</div>
							<div class='val bold'>
								inne
							</div>
							
						</div>
						<div class='line flex flex-items-center'>
							<div class='key base2'>
								Ilość w kartonie wewnętrznym:
							</div>
							<div class='val bold'>
								inne
							</div>
							
						</div>
						
						
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

<?php
	get_footer();
?>