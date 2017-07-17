<?php
class ASGARD extends XMLAbstract{
	//protected $_debug = false;
	//protected $_cache_write = false;
	//protected $_cache_read = false;
	
	// konstruktor
	public function __construct(){
		$this->logger( "" . __CLASS__ . " loaded!", __FUNCTION__, __CLASS__ );
		//$this->_config['refresh'] = 10 * 60;		// 10 minut
		$this->_config['dnd'] = __DIR__ . "/DND";
		$this->_config['cache'] = __DIR__ . "/CACHE";
		$this->_config['remote'] = array( "http://www.asgard.pl/www/xml/oferta.xml" );
		
	}
	
	// funkcja importująca dane o budowie menu w formie tablicy
	protected function getMenu(){
		$ret = array();
		$file = "oferta.xml";		// plik do załadowania
		
		if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
			$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
			
		}
		else{
			$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
			foreach( $this->_XML[ $file ]->children() as $sxe ){
				$cat = $this->stdName( (string)$sxe->kategoria );
				$subcat = $this->stdName( (string)$sxe->podkategoria );
				
				if( !array_key_exists( $subcat, $ret[ $cat ] ) ){
					$ret[ $cat ][ $subcat ] = array();
					
				}
				
			}
			
		}
		
		//return $ret;
		echo "<!--";
		//print_r( $ret );
		echo "-->";
		return array(
			'ASGARD' => $ret,
			
		);
		
	}
	
	// funkcja importująca dane o produktach w formie tablicy
	protected function getProducts(){
		$ret = array();
		$file = "oferta.xml";		// plik do załadowania
		if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
			$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
			
		}
		else{
			$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
			foreach( $this->_XML[ $file ]->children() as $sxe ){
				
				$cat = array();
				$cat[ $this->stdNameCache( (string)$sxe->kategoria ) ][ $this->stdNameCache( (string)$sxe->podkategoria ) ] = array();
				
				$img = array();
				$img[] = "http://asgard.pl/png/product/" . (string)$sxe->obraz_1;
				
				$mark = array();
				preg_match_all( "~(\w.*?) \((.*?)\)(?: \((.*?)\))?~", (string)$sxe->znakowanie_produktu, $match );
				for( $i=0; $i<count( $match[0] ); $i++ ){
					$type = $match[1][ $i ];
					$size = $match[2][ $i ];
					$place = $match[3][ $i ];
					if( !empty( $place ) ){
						$size .= " ($place)";
					}
					//$mark[ $type ][] = !empty($place)?( "$size ($place)" ):( "$size" );
					$mark[ $size ][] = $type;
					
				}
				
				$ret[] = array(
					'ID' => (int)$sxe->indeks,
					'NAME' => (string)$sxe->nazwa,
					'DSCR' => (string)$sxe->opis_produktu,
					'IMG' => $img,
					'CAT' => $cat,
					'DIM' => (string)$sxe->wymiary_produktu,
					'MARK' => $mark,
					'INSTOCK' => (int)$sxe->in_stock,
					
				);
				
			}
			
		}
		
		return $ret;
	}
	
}
