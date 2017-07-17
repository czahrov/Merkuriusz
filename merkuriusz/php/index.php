<?php
	session_start();
	set_time_limit( 300 );		// limit czasu wykonania skryptu w sekundach
	$develop = false;
	
	
	if( $develop ){
		if( isset( $_GET['coin'] ) ){
			$_SESSION['show'] = true;
			
		}
		
		if( $_SESSION['show'] !== true ){
			include 'wbudowie.php';
			exit;
			
		}		
		
	}
	
	require_once "autoloader.php";
	
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<script src="jquery-1.12.4.min.js"></script>
	<script>
		$(function(){
			$('body > ol:first')
			.css({
				float:'left',
				
			});
			
		});
		
	</script>
</head>
<body>
	<?php
		/*
			system cache'owania
				- odczyt
					- odczyt z pliku i zwracanie tablicy z podkategoriami żądanej kategorii ( o ile takowe posiada )
					- odczyt z pliku i zwracanie tablicy z produktami żądnej kategorii
					
				- generowanie danych z XML
					- tworzenie drzewa kategorii
						- każda z kategorii ( i podkategorii ) musi mieć swoją listę z produktami do niej przypisanymi
							- powiązanie na wskaźnikach (?)
							
				- zapis
					- tworzenie plików z tablicami produktów dla każdej z kategorii
					
		*/
		$XM = new XMLMan();
		/*
		*/
		$XM->addSupport( new PAR() );
		$XM->addSupport( new INSPIRION() );
		$XM->addSupport( new ASGARD() );
		$XM->addSupport( new MACMA() );
		$XM->addSupport( new EASYGIFTS() );
		$XM->addSupport( new ANDA() );
		$XM->addSupport( new AXPOL() );
		/*
		*/
		
		$XM->init();
		echo "<!--INDEX\r\n";
		//print_r( $XM->getData()['menu'] );
		//print_r( array_slice( $XM->getData()['items'], 0, 50 ) );
		echo "-->";
		//$XM->printProducts( array_slice( $XM->getData()['items'], 0, 100 ) );
		
	?>
	
</body>
</html>
