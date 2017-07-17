<?php
class ANDA extends XMLAbstract{
	//protected $_debug = false;
	//protected $_cache_write = false;
	//protected $_cache_read = false;
	
	// konstruktor
	public function __construct(){
		$this->logger( "" . __CLASS__ . " loaded!", __FUNCTION__, __CLASS__ );
		//$this->_config['refresh'] = 60 * 60 * 4.5;		// 4.5 godziny
		$this->_config['dnd'] = __DIR__ . "/DND";
		$this->_config['cache'] = __DIR__ . "/CACHE";
		$this->_config['remote'] = array( "http://andapresent.hu/admin/system/anda_xml_export2.php?&orszag_id=6&nyelv_id=7&password=92ba3632c8c22ebd65fbce872b317875" );
		
	}
	
	// funkcja importująca dane o budowie menu w formie tablicy
	protected function getMenu(){
		//return array();
		
		$ret = array();
		$file = "anda_xml_export2.xml";		// plik do załadowania
		
		if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
			$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
			
		}
		else{
			$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
			foreach( $this->_XML[ $file ]->product as $product ){
				foreach( $product->folders as $folders ){
					$this->genMenuTree( $folders, $ret );
					
				}
				
			}
			
		}
		
		return array(
			'ANDA' => $ret,
			
		);
		
	}
	
	// funckja generująca drzewo podkategorii
	private function genMenuTree( SimpleXMLElement $node, Array &$arr ){
		// tablica wskaźników
		$proxy = array();
		
		foreach( $node->folder as $folder ){
			$cat = $this->stdName( (string)$folder->attributes()->category );
			$subcat = $this->stdName( (string)$folder->attributes()->subcategory );
			
			/*
				Sprawdza czy w tablicy wskaźników istnieje wpis dla danej kategorii i podkategorii.
				Jeśli nie, to go dodaje.
			*/
			if( !array_key_exists( $cat, $proxy ) ){
				if( !array_key_exists( $cat, $arr ) ){
					$arr[ $cat ] = array();
					
				}
				
				$proxy[ $cat ] =& $arr[ $cat ];
				
			}
			
			if( !array_key_exists( $subcat, $proxy ) ){
				if( !array_key_exists( $subcat, $arr[ $cat ] ) ){
					$arr[ $cat ][ $subcat ] = array();
					
				}
				
				$proxy[ $subcat ] =& $arr[ $cat ][ $subcat ];
				
			}
			
		}
		
	}
	
	// funkcja importująca dane o produktach w formie tablicy
	protected function getProducts(){
		//return array();
		
		$ret = array();
		$file = "anda_xml_export2.xml";		// plik do załadowania
		if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
			$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
			
		}
		else{
			$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
			foreach( $this->_XML[ $file ]->children() as $item ){
				// tablica z obrazkami
				$img = array();
				foreach( $item->images->children() as $image ){
					$img[] = (string)$image->attributes()->src;
					
				}
				
				// tablica z kategoriami / podkategoriami
				$cat = array();
				foreach( $item->folders->children() as $folder ){
					$cat_name = $this->stdNameCache( (string)$folder->attributes()->category );
					$subcat_name = $this->stdNameCache( (string)$folder->attributes()->subcategory );
					$cat[ $cat_name ][ $subcat_name ] = array();
				}
				
				// tablica z wymiarami
				$dim = array();
				foreach( $item->properties->children() as $property ){
					if( strpos( (string)$property->attributes()->name, 'WYM' ) === 0 ){
						$dim[] = (string)$property->attributes()->value;
						
					}
					
				}
				
				// znakowanie
				$mark = array();
				foreach( $item->properties->children() as $property ){
					if( strpos( (string)$property->attributes()->name, 'METODA' ) === 0 ){
						//$mark[] = (string)$property->attributes()->value;
						//preg_match_all( "~([\w\d]+) \((?:([\w\d]+), )?(.*?) MM\)~", (string)$property->attributes()->value, $match );
						preg_match_all( "~([\w\d]+) \((?:.*?, )?(.*?MM)\)~", (string)$property->attributes()->value, $match );
						for( $i=0; $i<count( $match[0] ); $i++ ){
							$type = $match[1][ $i ];
							$size = $match[2][ $i ];
							if( !empty( $type ) ){
								$mark[ $size ][] = $type;
								
							}
							
						}
						
					}
					
				}
				
				$ret[] = array(
					'ID' => (string)$item->attributes()->no,
					'NAME' => (string)$item->attributes()->name,
					'DSCR' => (string)$item->description,
					'IMG' => $img,
					'CAT' => $cat,
					'DIM' => implode( " x ", $dim ),
					'MARK' => $mark,
					'INSTOCK' => (int)$item->stocks[0]->attributes()->value,
					
				);
				
			}
			
		}
		
		echo "<!--";
		//print_r( array_slice( $ret, 0, 10 ) );
		echo "-->";
		
		return $ret;
	}
	
}
