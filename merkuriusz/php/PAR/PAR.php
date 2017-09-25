<?php
class PAR extends XMLAbstract {
	public $_shop = 'PAR';
	//protected $_debug = false;
	//protected $_cache_write = false;
	//protected $_cache_read = false;
	
	// konstruktor
	public function __construct(){
		$this->logger( "" . __CLASS__ . " loaded!", __FUNCTION__, __CLASS__ );
		//$this->_config['refresh'] = 60 * 60;		// 1h
		$this->_config['dnd'] = __DIR__ . "/DND";
		$this->_config['cache'] = __DIR__ . "/CACHE";
		$this->_config['remote'] = array(
			"http://biuro@merkuriusz.pl:merkuriusz345@www.par.com.pl/api/categories",
			"http://biuro@merkuriusz.pl:merkuriusz345@www.par.com.pl/api/products",
			"http://biuro@merkuriusz.pl:merkuriusz345@www.par.com.pl/api/stocks"
		);
		
	}
	
	// funkcja importująca dane o budowie menu w formie tablicy
	protected function getMenu(){
		$ret = array();
		$file = "categories.xml";		// plik do załadowania
		
		if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
			$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
			
		}
		else{
			$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
			foreach( $this->_XML[ $file ]->category as $category ){
				$cat_name = $this->stdName( (string)$category->attributes()->name );
				$ret[ $cat_name ] = array();
				
				foreach( $category->node as $subcategory ){
					$subcat_name = $this->stdName( (string)$subcategory->attributes()->name );
					$ret[ $cat_name ][ $subcat_name ] = array();					
					
				}
				
			}
			
		}
		
		//return $ret;
		return array(
			'PAR' => $ret,
			
		);
		/*
		*/
		
	}
	
	// funkcja importująca dane o produktach w formie tablicy
	protected function getProducts(){
		$ret = array();
		$file = "products.xml";		// plik do załadowania
		if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
			$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
			
		}
		else{
			$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
			foreach( $this->_XML[ $file ]->product as $item ){
				
				$img = array();
				foreach( $item->zdjecia->children() as $image ){
					$img[] = "http://www.par.com.pl" . (string)$image;
					
				}
				
				$cat = array();
				foreach( $item->kategorie->kategoria as $kategoria ){
					$cat[ (string)$kategoria ] = array();
					
				}
				
				$mark = array();
				foreach( $item->techniki_zdobienia->technika as $technika ){
					$size = (string)$technika->maksymalny_rozmiar_logo;
					$type = sprintf( "%s (%s)", (string)$technika->technika_zdobienia, (string)$technika->miejsce_zdobienia );
					$mark[ $size ][] = $type;
					
				}
				
				$ret[] = array(
					'SHOP' => $this->_shop,
					'ID' => (string)$item->kod,
					'NAME' => (string)$item->nazwa,
					'DSCR' => (string)$item->opis,
					'IMG' => $img,
					'CAT' => $cat,
					'DIM' => (string)$item->wymiary,
					'MARK' => $mark,
					'INSTOCK' => $this->getStock( (string)$item->kod ),
					
				);
				
			}
			
		}
		
		return $ret;
	}
	
	// funkcja zwracająca stan magazynowy danego produktu
	private function getStock( $id ){
		static $arr = array();
		
		if( count( $arr ) === 0 ){
			$file = "stocks.xml";		// plik do załadowania
			if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
				$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
				
				return false;
			}
			else{
				$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
				foreach( $this->_XML[ $file ]->produkt as $item ){
					$arr[ (string)$item->kod ] = (int)$item->stan_magazynowy;
					
				}
				
			}
			
		}
		
		if( array_key_exists( $id, $arr ) ){
			return $arr[ $id ];
			
		}
		else{
			return false;
			
		}
		
	}
	
}
