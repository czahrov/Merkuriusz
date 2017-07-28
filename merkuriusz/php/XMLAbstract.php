<?php
class XMLAbstract{
	// tablica na wczytane pliki XML
	protected $_XML = array();
	// tablica na kategorie i podkategorie tworzące drzewo menu
	protected $_menu = array();
	// tablica na produkty wraz z ustandaryzowanymi informacjami o nich
	protected $_items = array();
	// tablica startowej konfiguracji
	protected $_config = array(
		// tablica plików zdalnych do synchronizacji
		'remote' => array(),
		// czas "świeżości" plików XML, po którym należy je aktualizaować
		'refresh' => 0,
		// ścieżka do folderu pobierania plików XML
		'dnd' => '',
		// ścieżka do folderu z cache
		'cache' => '',
		
	);
	// czy wyświetalać komunikaty ze skryptów
	protected $_debug = false;
	// czy dane wyjściowe należy zapisywać w cache
	protected $_cache_write = true;
	// czy dane mogą być odczytane z cache'u
	protected $_cache_read = true;
	// wymuszanie powtórnego cacheowania
	protected $_recache_force = true;
	
	// konstruktor
	public function __construct(){
		if( $this->_debug ) echo "\r\n" . __CLASS__ . " loaded!\r\n";
		$this->_config['refresh'] = 60 * 60;		// 60 minut
		$this->_config['dnd'] = __DIR__ . "/DND";
		$this->_config['cache'] = __DIR__ . "/CACHE";
		
	}
	
	// funckja generująca komunikaty
	protected function logger( $msg = '', $fn = __FUNCTION__, $cn = __CLASS__ ){
		if( $this->_debug === true ) echo "<br>\r\n> [" . $cn . "->" . $fn . "()]:\r\n<br>$msg\r\n<br>";
	}
	
	/*
		Funkcja inicjująca
		[] Sprawdzenie czy odczyt cache jest dozwolony
		[] Próba odczytu z pliku lokalnego tablicy z listą wszystkich kategorii
		[] Próba odczytu z pliku lokalnego tablicy z listą produktów z danej kategorii (kategoria przekazywana przez GET)
		[] Generowanie danych z plików XML
		[] Zwracanie tablicy danych
		
	*/
	public function init(){
		// nazwa pliku z produktami danej kategorii, przekazywany przez GET
		//$item_param = empty( $_GET['cat'] )?( 'root' ):( $this->stdNameCache( $_GET['cat'] ) );
		$t = end( explode( ",", $_GET['cat'] ) );
		//$t = $_GET['cat'];
		// $t = explode( "-", $_GET[ 'cat' ] );
		// if( count( $t ) <= 2 ){
			// $t = end( $t );
		// }
		// else{
			// $t = implode( "-", array_slice( $t, -2 ) );
			
		// }
		$item_param = empty( $t )?( 'root' ):( $this->stdNameCache( $t ) );
		$item_url = "{$this->_config['cache']}/cat_{$item_param}.php";
		$cat_url = "{$this->_config['cache']}/cat.php";
		
		// czy odczyt cache jest dozwolony i istnieją obydwa pliki cache ( test czy cacheowanie miało miejsce )
		if( $this->_cache_read ){
			if( file_exists( $cat_url ) ){
				// próba odczytu cacheu z tablicą kategorii
				$this->_menu = json_decode( file_get_contents( $cat_url ), true );
				
			}
			
			if( $item_param !== 'root' && file_exists( $item_url ) ){
				// próba obczytu produktów z danej kategorii
				$this->_items = json_decode( file_get_contents( $item_url ), true );
				
			}
			else{
				$this->_items = array();
				
			}
			
		}
		// generowanie danych z plików XML
		else{
			// czy wczytać pliki XML do tablicy
			if( count( $this->_XML ) === 0 ){
				// ładowanie XML do pamięci
				foreach( $this->_config['remote'] as $source ){
					$pinfo = pathinfo( $source );
					$fname = $pinfo['filename'] . ".xml";
					
					$fpath =  $this->_config['dnd'] . "/" . $fname;
					$this->_XML[ $fname ] = simplexml_load_file( $fpath );
					
					$this->logger( "ładuję plik $fpath do pamięci z dysku", __FUNCTION__ );
					
				}
				
			}
			
			// wyciąganie danych z XML i zapis ich w pamięci
			$this->save();
			$this->_items = $this->binder( $item_param );
			
		}
		
		/*
		if( !empty( $_GET['product'] ) ){
			$this->search( $_GET['product'] );
			
		}
		*/
		
		// zwracanie wyniku
		return array(
			'menu' => $this->_menu,
			'items' => $this->_items,
			
		);
		
	}
	
	/*
		Funkcja sprawdzająca aktualność zasobów i generuje cache dla init()
		[] Sprawdzanie czy istnieje folder dla pobieranych plików XML. Jeśli nie istnieje, zostanie on utworzony.
		[] Próba pobrania plików z serwera zdalnego
		[] Generowanie danych z XML, gdy odczyt cache jest niedozwolony
		[] Wywołanie funkcji cacheującej
		
	*/
	public function check(){
		// resetowanie tablicy na pliki XML
		$this->_XML = array();
		// czy ponowne cacheowanie jest wymagane
		$recache = false || $this->_recache_force;
		
		// czy istnieje folder na pobierane pliki
		if( !file_exists( $this->_config['dnd'] ) ){
			$this->_cache_read = false;
			$this->logger( "Brak folderu, tworzę nową lokację: {$this->_config['dnd']}", __FUNCTION__ );
			mkdir( $this->_config['dnd'], 0770 );
			chmod( $this->_config['dnd'], 0770 );
			
			$this->download( $this->_config['remote'] );
			
		}
		
		
		// testowanie "świeżości" zasobów i pobieranie ich
		foreach( $this->_config['remote'] as $source ){
			$pinfo = pathinfo( $source );
			$fname = $pinfo['filename'] . ".xml";
			$fpath =  $this->_config['dnd'] . "/" . $fname;
			
			/*
				Jeśli zasób nie znajduje się na dysku lokalnym, następuje próba jego pobrania
			*/
			if( !file_exists( $fpath ) ){
				$this->logger( "$fpath\r\nplik nie istnieje, pobieram...", __FUNCTION__ );
				if( $this->download( $source ) ) $recache = true;
				
			}
			
			/*
				Jeśli czas ostatniej modyfikacji zasoby ( czas jego ostatniej aktualizacji ) jest większy niż ustawiony limit, następuje próba pobrania zasobu
			*/
			elseif( filemtime( $fpath ) + $this->_config['refresh'] <= time() ){
				$this->logger( "$fpath\r\nplik jest nieaktualny, pobieram...", __FUNCTION__ );
				if( $this->download( $source ) ) $recache = true;
				
			}
			
			/*
				Sprawdza czy folder cache zawiera podstawowe pliki, jeśli nie cachowanie zostanie wymuszone
			*/
			if( !$recache && ( !file_exists( "{$this->_config['cache']}/cat.php" ) or count( glob( "{$this->_config['cache']}/.php" ) ) < 3 ) ){
				$recache = true;
				
			}
			
			
		}
		
		/*
			Testowanie czy istnieje plik z indeksem
		*/
		if( !file_exists( "{$this->_config['cache']}/indexer.php" ) ){
			$recache = true;
			
		}
		
		// wywołanie funkcji cacheującej
		if( $this->_cache_write && $recache ){
			$this->makeCache();
			
		}
		
	}
	
	/*
		Funkcja rekurencyjna pobierająca zasób z serwera zdalnego
		[#1] Wywołanie rekurencyjne funkcji, w przypadku gdy argumentem jest tablica ( z listą zasobów )
		[#2] Próba odczytania pliku zdalnego i ustawienie 120 sekund jako czas oczekiwania na połączenie z serwerem zdalnym
		[#3] Testowanie czy plik został odczytany.
			Limit 100 znaków ustawiony ze względu na sklep ANDA, z którego plik można pobrać raz na 4 godziny.
			W międzyczasie zwracana jest jedynie informacja kiedy znów można pobrać plik
		[#4] Próba zapisu odczytanego pliku na dysku lokalnym
	*/
	protected function download( $fpath ){
		// [#1]
		if( is_array( $fpath ) ){
			foreach( $fpath as $link ){
				$this->download( $link );
				
			}
			
		}
		elseif( is_string( $fpath ) ){
			$fname = pathinfo( $fpath )['filename'] . ".xml";
			$this->logger( "pobieram plik $fname do folderu {$this->_config['dnd']}", __FUNCTION__ );
			
			if( $this->_debug === true ) $this->checkpoint( __CLASS__ . ">" . __FUNCTION__ . ">$fname>start" );
			
			// [#2]
			$context = stream_context_create( array(
				'http' => array(
					'timeout' => 180.0,
					
				),
				
			) );
			$content = file_get_contents( $fpath, false, $context );
			
			// [#3]
			if( $content !== false && strlen( $content ) > 100 ){
				$this->_cache_read = false;
				// [#4]
				if( file_put_contents( $this->_config['dnd'] . "/$fname" , $content ) === false ){
					$this->logger( "nie udało się zapisać pliku $fname", __FUNCTION__ );
					return false;
					
				}
				else{
					$this->logger( "plik $fname zapisany pomyślnie", __FUNCTION__ );
					if( $this->_debug === true ){
						$this->checkpoint( __CLASS__ . ">" . __FUNCTION__ . ">$fname>stop" );
						if( $this->_debug === true ) echo "Pobrano w  [" . $this->checkpoint( __CLASS__ . ">" . __FUNCTION__ . ">$fname>start", __CLASS__ . ">" . __FUNCTION__ . ">$fname>stop" ) . " sekund]\r\n<br>";
						return true;
						
					}
					
				}
				
			}
			else{
				$this->logger( "plik $fpath jest nieosiągalny", __FUNCTION__ );
				return false;
				
			}
			
		}
		
	}
	
	// funkcja zapisująca wygenerowane dane w tablicy
	protected function save(){
		$this->_menu = $this->getMenu();
		$this->_items = $this->getProducts();
		
	}
	
	// funkcja importująca dane o produktach w formie tablicy
	protected function getProducts(){
		/*
			ID
			NAME
			DESCR
			IMGS
				IMG,
				...
			CAT
				NAME,
					NAME,
					...
			DIM
			MARK
			INSTOCK
		*/
		return array();
		
	}
	
	// funkcja importująca dane o budowie menu w formie tablicy
	protected function getMenu(){
		/*
			name
				name
				...
			...
		*/
		return array();
		
	}
	
	// dodaje znacznik czasu albo zwraca czas pomiędzy dwoma podanymi punktami kontrolnymi
	protected function checkpoint( $start = null, $stop = null ){
		static $board = array();
		
		// odczyt
		if( $start !== null && array_key_exists( $start, $board ) && $stop !== null && array_key_exists( $stop, $board ) ){
			return (float)$board[ $stop ] - (float)$board[ $start ];
			
		}
		// zapis
		elseif( $start !== null && !array_key_exists( $start, $board ) ){
			$board[ $start ] = gettimeofday( true );
			
		}
		
	}
	
	/*
		Funkcja standaryzująca zapis nazwy kategorii
		[#1] Zamiana polskich wielkich liter, na polskie małe litery
		[#2] Usuwa tagi z tekstu
		
	*/
	protected function stdName( $name ){
		$find = explode( ",", "Ą,Ę,Ż,Ź,Ó,Ł,Ć,Ń,Ś" );
		$replace = explode( ",", "ą,ę,ż,ź,ó,ł,ć,ń,ś" );
		
		return str_replace( $find, $replace, strtolower( strip_tags( (string)$name ) ) );
		
	}
	
	/*
		Funkcja standaryzująca zapis nazwy dla CACHE
		[#1] Zamiana polskich wielkich liter, na małe litery bez polskich ogonków
		[#2] Usuwa tagi z tekstu
		
	*/
	protected function stdNameCache( $name ){
		$find = 			explode( ",", " ,Ą,Ę,Ż,Ź,Ó,Ł,Ć,Ń,Ś,ą,ę,ż,ź,ó,ł,ć,ń,ś,/" );
		$replace = 	explode( ",", "_,a,e,z,z,o,l,c,n,s,a,e,z,z,o,l,c,n,s,_" );
		
		return str_replace( $find, $replace, strtolower( strip_tags( (string)$name ) ) );
		
	}
	
	/*
		Funkcja generująca cache
		[] Czyszczenie folderu CACHE
		[] Sprawdza czy istnieje folder CACHEu
		[] Zapisuje CACHE z drzewem kategorii
		[] Generowanie tablicy powiązania produktów z kategoriami. Nazwa tablicy jest nazwą generowanego pliku cache.
		[] Zapisuje CACHE z produktami dla danych kategorii
		
	*/
	public function makeCache(){
		// czy istnieje folder cache
		$cache_url = $this->_config['cache'];
		if( !file_exists( $cache_url ) ){
			$this->logger( "Brak folderu CACHE, tworzę nową lokację: {$cache_url}", __FUNCTION__ );
			mkdir( $cache_url, 0770 );
			chmod( $cache_url, 0770 );
			
		}
		else{
			// czyszczenie folderu
			if( $this->_cache_write ){
				array_map( 'unlink', glob( "{$this->_config['cache']}/*.*" ) );
				
			}
			
		}
		
		// czy załadować pliki XML do pamięci
		if( empty( $this->_XML ) ) foreach( $this->_config['remote'] as $source ){
			$pinfo = pathinfo( $source );
			$fname = $pinfo['filename'] . ".xml";
			$fpath =  $this->_config['dnd'] . "/" . $fname;
			
			$this->_XML[ $fname ] = simplexml_load_file( $fpath );
			$this->logger( "ładuję plik $fpath do pamięci z dysku", __FUNCTION__ );
			
		}
		
		// zapis cache z drzewem kategorii
		if( empty( $this->_menu ) ) $this->_menu = $this->getMenu();
		if( file_put_contents( "{$cache_url}/cat.php", json_encode( $this->_menu ) ) === false){
			$this->logger( "Zapis cache ({$cache_url}/cat.php) nie powiódł się", __FUNCTION__ );
			
		}
		
		/*
			Generowanie tablicy powiązań
			Generowanie indeksu
		*/
		$data = $this->binder();
		
		// generowanie cache z tablicą powiązań
		foreach( $data as $name => $items ){
			$content = json_encode( $items );
			if( file_put_contents( "{$cache_url}/cat_{$this->stdNameCache( $name )}.php", $content ) === false){
				$this->logger( "Zapis cache (cat_{$cache_url}/{$name}.php) nie powiódł się", __FUNCTION__ );
				
			}
			
		}
		
		// generowanie cache z indeksem
		$indeks = $this->indexer();
		$content = json_encode( $indeks );
		if( file_put_contents( "{$cache_url}/indexer.php", $content ) === false){
			$this->logger( "Zapis cache {$cache_url}/indexer.php nie powiódł się", __FUNCTION__ );
			
		}
		
	}
	
	/*
		Funkcja łączącza grupy produktów z kategoriami, zwracająca statyczną tablicę
		[] Generowanie tablicy 
		[] Przechodzi przez listę produktów i zapisuje w tablicy odnośniki do nich
		
	*/
	protected function binder( $arg = null ){
		static $arr = array();
		
		// czy należy wygenerować tablicę
		if( empty( $arr ) ){
			// pobieranie listy produktów
			if( !empty( $this->_items ) ){
				$t = $this->_items;
				
			}
			else{
				$t = $this->getProducts();
				
			}
			
			foreach( $t as $item ){
				// funkcja pomocnicza
				$this->binderHelper( $item['CAT'], $item, $arr );
				
			}
			
			echo "<!--BINDER\r\n";
			//print_r( $arr );
			echo "-->";
			
		}
		
		if( $arg === null ) return $arr;
		
		if( array_key_exists( $arg, $arr ) ){
			return $arr[ $arg ];
			
		}
		else{
			return array();
			
		}
		
	}
	
	/*
		Pomocnicza rekurencyjna funkcja do wiązania produktów z kategoriami.
		Przechodzi przez całe drzewo kategorii i zapisuje powiązanie,
		dodatkowo wywołuje funkcję indeksującą.
		
	*/
	protected function binderHelper( &$cat, &$item, &$arr ){
		foreach( $cat as $name => $subcat ){
			//$arr[ 'root' ][] = $item;
			if( count( $subcat ) > 0 ){
				$this->binderHelper( $subcat, $item, $arr );
				
			}
			else{
				$index = $this->stdNameCache( $name );
				if( !empty( $index ) ){
					$arr[ $index ][] = $item;
					$this->indexer( $item, $index, count( $arr[ $index ] ) - 1 );
					
				}
				
			}
			
		}
		
	}
	
	/*
		Funkcja tworząca tablicę indeksu produktów do wyszukiwania
		po nazwie produktu i po jego numerze ID
		
	*/
	protected function indexer( $item = null, $cat = null, $num = null ){
		static $arr = array();
		
		/*
		echo "<!--INDEXER";
		var_dump( array( $item, $cat ) );
		echo "-->";
		*/
		
		if( $item !== null && $cat !== null && $num !== null ){
			$arr[ $item['ID'] ] = $arr[ $this->stdNameCache( trim( $item['NAME'] ) ) ] = array(
				'file' => $cat,
				'num' => $num,
				
			);
			
		}
		else{
			return $arr;
			
		}
		
	}
	
	/*
		Funkcja wyszukująca produkt po ID
	*/
	public function search( $arg = null, $isName = false ){
		static $arr = array();
		
		if( empty( $arr ) ){
			$index_url = "{$this->_config['cache']}/indexer.php";
			//if( !file_exists( $index_url ) ) return false;
			
			$content = file_get_contents( $index_url );
			//if( $content === false ) return false;
			
			$this->logger( "Tworzenie tablicy indeksów. Odczyt pliku: {$index_url}", __FUNCTION__ );
			$arr = json_decode( $content, true );
			
			/*
			echo "<!--SEARCH";
			print_r( $arr );
			echo "-->";
			*/
			
		}
		
		
		// czy argument jest stringiem
		if( is_string( $arg ) ){
			// tablica znalezionych produktów
			$found = array();
			
			// szukanie po nazwie
			if( $isName ){
				$key = $this->stdNameCache( $arg );
				if( array_key_exists( $key, $arr ) ){
					$item = $arr[ $key ];
					$file = $item['file'];
					$num = $item['num'];
					
					$content = file_get_contents( "{$this->_config['cache']}/cat_{$file}.php" );
					$data = json_decode( $content, true );
					
					$found[] =  $data[ $num ];
					
				}
				else{
					foreach( $arr as $name => $item ){
						if( stripos( $name, $key ) !== false ){
							$file = $item['file'];
							$num = $item['num'];
							
							$content = file_get_contents( "{$this->_config['cache']}/cat_{$file}.php" );
							$data = json_decode( $content, true );
							
							$found[] = $data[ $num ];
							
						}
						
					}
					
				}
				
			}
			// szukanie po ID
			else{
				$key = $arg;
				// czy dany klucz istnieje w tablicy
				if( array_key_exists( $key, $arr ) ){
					$item = $arr[ $key ];
					$file = $item['file'];
					$num = $item['num'];
					
					$content = file_get_contents( "{$this->_config['cache']}/cat_$file.php" );
					$data = json_decode( $content, true );
					
					$found[] = $data[ $num ];
					
				}
				else{
					//echo "\r\nKlucz nie istnieje\r\n";
					return false;
				}
				
			}
			
			//print_r( $found );
			return $found;
			
		}
		else{
			return false;
			
		}
		
	}
	
}
