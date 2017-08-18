<?php
class EASYGIFTS extends XMLAbstract {
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
			"http://www.easygifts.com.pl/data/webapi/pl/xml/offer.xml",
			"http://www.easygifts.com.pl/data/webapi/pl/xml/stocks.xml"
		);
		
	}
	
	// funkcja importująca dane o budowie menu w formie tablicy
	protected function getMenu(){
		$ret = array();
		$file = "offer.xml";		// plik do załadowania
		
		if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
			$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
			
		}
		else{
			$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
			foreach( $this->_XML[ $file ]->product as $product ){
				if( $product->categories->count() > 0 ) foreach( $product->categories->category as $category ){
					//$this->genMenuTree( $category, $ret );
					
					//$name = $this->stdNameCache( (string)$category->name );
					//$ret[ $name ] = $this->genMenuTree( $category );
					$ret = array_merge_recursive( $ret, $this->genMenuTree( $category, $product ) );
					
				}
				
			}
			
		}
		
		return array(
			'EASY_GIFTS' => $ret,
			
		);
		
	}
	
	// funkcja rekurencyjna tworząca drzewo podkategorii danej kategorii
	private function genMenuTree( SimpleXMLElement $category, $node ){
		$ret = array();
		// $cat_name = $this->stdNameCache( (string)$category->name );
		//$cat_name = apply_filters( 'stdName', (string)$category->name );
		$cat_name = strtolower( (string)$category->name );
		//$ret[ $cat_name ] = array();
		
		/* ========== KATEGORIA ========== */
			
		if( $cat_name === 'podróże' ){
			$cat_name = 'podróż';
			
		}
		elseif( $cat_name === 'torby' ){
			$cat_name = 'torby i plecaki';
			
		}
		elseif( $cat_name === "pendrive'y" ){
			$cat_name = 'pendrive';
			
		}
		elseif( $cat_name === "elektronika markowa" ){
			$cat_name = 'vip elektronika';
			
		}
		elseif( $cat_name === "biuro i akcesoria biurowe" ){
			$cat_name = 'biuro';
			
		}
		elseif( $cat_name === "odpoczynek" ){
			$cat_name = 'wypoczynek';
			
		}
		elseif( $cat_name === "czas i elektronika" ){
			$cat_name = 'elektronika';
			
		}
		elseif( $cat_name === "czapki cofee" ){
			$cat_name = 'cofee';
			
		}
		elseif( strpos( $cat_name, "świąteczn" ) !== false ){
			$cat_name = 'świąteczne';
			
		}
		
		
		//$cat_name = $this->stdNameCache( $cat_name );
		
		/* ==================== */
		
		if( $category->subcategories->count() > 0 ){
			foreach( $category->subcategories->subcategory as $subcategory ){
				//$subcat_name = $this->stdNameCache( (string)$subcategory->name );
				//$subcat_name = apply_filters( 'stdName', (string)$subcategory->name );
				$subcat_name = strtolower( (string)$subcategory->name );
				
				/* ========== PODKATEGORIA ========== */
				
				if( $subcat_name === 'parasole i parasolki' ){
					$cat_name = "Przeciwdeszczowe";
					
					if( stripos( (string)$node->baseinfo->name, 'parasolka' ) !== false ){
						$subcat_name = "parasolki";
						
					}
					elseif( stripos( (string)$node->baseinfo->name, 'parasol' ) !== false ){
						$subcat_name = "parasole";
						
					}
					else{
						$subcat_name = "inne";
						
					}
					
					
				}
				elseif( $subcat_name === 'poduszki i koce' ){
					$cat_name = "wypoczynek";
					
					if( stripos( (string)$node->baseinfo->name, 'koc' ) !== false ){
						$subcat_name = 'Koce';
						
					}
					else{
						$subcat_name = 'Poduszki';
						
					}
					
				}
				elseif( $subcat_name === 'pielęgnacja obuwia' ){
					$cat_name = "dom";
					
				}
				elseif( $subcat_name === 'płaszcze przeciwdeszczowe' ){
					$cat_name = "Przeciwdeszczowe";
					
					if( stripos( (string)$node->baseinfo->name, 'peleryna' ) !== false ){
						$subcat_name = "Peleryny";
						
					}
					else{
						$subcat_name = "Płaszcze";
						
					}
					
					
				}
				elseif( $subcat_name === 'torby podróżne' ){
					if( stripos( (string)$node->baseinfo->name, 'ramię' ) !== false ){
						$subcat_name = 'na ramię';
						
					}
					else{
						$subcat_name = 'podróżne';
						
					}
					
				}
				elseif( $subcat_name === 'torby i worki sportowe' ){
					if( stripos( (string)$node->baseinfo->name, 'sport' ) !== false ){
						$subcat_name = 'sportowe';
					}
					else{
						$cat_name = 'xxx';
						$subcat_name = '';
						
					}
					
				}
				elseif( $subcat_name === 'torby na zakupy' ){
					$subcat_name = 'na zakupy';
					
				}
				elseif( $subcat_name === 'torby na laptopy' ){
					$subcat_name = 'na laptopa';
					
				}
				elseif( $subcat_name === 'torby jassz' ){
					$cat_name = 'tekstylia';
					
				}
				elseif( $subcat_name === 'narzędzie wielofunkcyjne' ){
					$subcat_name = 'Wielofunkcyjne';
					
				}
				elseif( $subcat_name === 'zestawy narzędzi' ){
					$subcat_name = 'zestawy';
					
				}
				elseif( strpos( $subcat_name, "pendrive'y " ) !== false ){
					$subcat_name = str_replace( "pendrive'y ", "", $subcat_name );
					
				}
				elseif( $subcat_name === 'kalkulatory' ){
					$cat_name = 'elektronika';
					
				}
				elseif( $subcat_name === 'teczki na dokumenty' ){
					$subcat_name = 'teczki';
					
				}
				elseif( $subcat_name === 'stojaki biurkowe' ){
					$subcat_name = 'stojaki';
					
				}
				elseif( $subcat_name === 'akcesoria do telefonów' ){
					$cat_name = 'elektronika';
					
				}
				elseif( $subcat_name === 'zestawy upominkowe (sety)' ){
					$subcat_name = 'zestawy upominkowe';
					
				}
				elseif( $subcat_name === 'zestawy piśmiennicze' ){
					$subcat_name = 'zestawy piśmienne';
					
				}
				elseif( $subcat_name === 'eko długopisy' ){
					$cat_name = 'eco gadżet';
					$subcat_name = '';
					
				}
				elseif( $subcat_name === 'wskaźniki laserowe' ){
					$cat_name = 'elektronika';
					
				}
				elseif( $cat_name === 'wypoczynek' ){
					if( $subcat_name === 'czapki z daszkiem' ){
						$cat_name = 'tekstylia';
						
					}
					elseif( $subcat_name === 'kubki termiczne i termosy' ){
						$cat_name = 'do picia';
						$subcat_name = 'kubki podróżne';
						
					}
					elseif( $subcat_name === 'akcesoria do grillowania' ){
						$subcat_name = 'Grill i piknik';
						
					}
					elseif( $subcat_name === 'lornetki i okulary' ){
						if( stripos( (string)$node->baseinfo->name, 'okular' ) !== false ){
							$subcat_name = 'okulary';
						}
						elseif( stripos( (string)$node->baseinfo->name, 'lornet' ) !== false ){
							$subcat_name = 'lornetki';
						}
						else{
							
							$subcat_name = 'inne';
						}
						
					}
					
				}
				elseif( $subcat_name === 'pozostałe power banki' ){
					$subcat_name = 'power banki';
					
				}
				elseif( $cat_name === "dodatki" ){
					if( $subcat_name === 'portfele' ){
						$cat_name = 'Podróż';
						
					}
					elseif( in_array( $subcat_name, array( 'breloki metalowe', 'breloki wielofunkcyjne' ) ) ){
						$cat_name = 'breloki';
						
					}
					elseif( $subcat_name === 'odblaski' ){
						$cat_name = 'odblaski';
						
					}
					elseif( $subcat_name === 'etui' ){
						$cat_name = 'materiały piśmiennicze';
						
					}
					
				}
				elseif( $cat_name === 'elektronika' && in_array( $subcat_name, array( 'zegary biurkowe', 'zegary ścienne', 'zegarki na rękę' ) ) ){
					$cat_name = 'zegary i zegarki';
					
				}
				elseif( $subcat_name === 'kubki i opakowania do kubków' ){
					$cat_name = 'do picia';
					$subcat_name = 'kubki';
					
				}
				elseif( $subcat_name === 'akcesoria kuchenne' ){
					$subcat_name = 'kuchnia';
					
				}
				elseif( $subcat_name === 'akcesoria do wina' ){
					$cat_name = 'wino';
					$subcat_name = 'akcesoria';
					
				}
				elseif( $cat_name === 'dyski' ){
					$subcat_name = str_replace( "dyski ", "", $subcat_name );
					
				}
				elseif( $cat_name === 'świąteczne' ){
					$subcat_name = '';
					
				}
				elseif( $cat_name === 'mykronoz' ){
					$cat_name = 'smartwatche';
					$subcat_name = 'mykronoz';
					
				}
				elseif( $cat_name === 'mobile' ){
					$cat_name = $this->stdNameCache( 'Akcesoria do telefonów i tabletów' );
					$subcat_name = 'Okulary wirtualnej rzeczywistości';
					
				}
				elseif( $subcat_name === 'zestawy do manicure' ){
					$cat_name = 'uroda';
					$subcat_name = 'Pielęgnacja dłoni';
					
				}
				elseif( $cat_name === 'elektronika' ){
					if( $subcat_name === 'akcesoria komputerowe' ){
						$cat_name = 'Akcesoria komputerowe';
						
						if( stripos( (string)$node->baseinfo->name, 'słuchawk' ) !== false ){
							$subcat_name = 'Słuchawki';
							
						}
						else{
							$subcat_name = 'Pozostałe';
							
						}
						
					}
					
				}
				
				/* 
				(string)$node->baseinfo->name
				(string)$node->baseinfo->intro
				 */
				/* ==================== */
				
				if( !empty( $subcat_name ) ){
					$cat_name_slug = $this->stdNameCache( $cat_name );
					$subcat_name_slug = $this->stdNameCache( $subcat_name );
					$subcat_name_slug = $cat_name_slug . "-" . $subcat_name_slug;
					$ret[ $cat_name_slug ][ $subcat_name_slug ] = array();
					
				}
				else{
					$cat_name_slug = $this->stdNameCache( $cat_name );
					$ret[ $cat_name_slug ] = array();
					
				}
				
				if( $subcategory->subcategories->count() > 0 ){
					$cat_name_slug = $this->stdNameCache( $cat_name );
					//$ret[ $cat_name ][ $subcat_name ] = $this->genMenuTree( $subcategory );
					$ret[ $cat_name_slug ] = $this->genMenuTree( $subcategory, $node );
					
				}
				
			}
			
		}
		else{
			$cat_name_slug = $this->stdNameCache( $cat_name );
			$ret[ $cat_name_slug ] = array();
			
		}
		
		/*
		echo "<!--";
		print_r( $ret );
		echo "-->";
		*/
		
		return $ret;
	}
	
	// funkcja importująca dane o produktach w formie tablicy
	protected function getProducts(){
		//return array();
		$ret = array();
		$file = "offer.xml";		// plik do załadowania
		if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
			$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
			
		}
		else{
			$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
			foreach( $this->_XML[ $file ]->product as $item ){
				
				$img = array();
				if( $item->images->count() > 0 ) foreach( $item->images->children() as $image ){
					$img[] = (string)$image;
				}
				
				$cat = array();
				if( $item->categories->count() > 0 ) foreach( $item->categories->category as $category ){
					$cat = array_merge_recursive( $cat, $this->genMenuTree( $category, $item ) );
					
				}
				
				$mark = array();
				$mark_size = (string)$item->marking_size;
				if( empty( $mark_size ) ) $mark_size = '???';
				foreach( $item->markgroups->markgroup as $group ){
					$mark_type = (string)$group->name;
					if( empty( $mark_type ) ) $mark_type = '???';
					$mark[ $mark_size ][] = $mark_type;
					
				}
				
				$id = (string)$item->baseinfo->code_full;
				if( empty( $id ) ) $id = (string)$item->baseinfo->id;
				
				$name = (string)$item->baseinfo->name;
				if( empty( $name ) ) $name = '- brak danych -';
				
				$ret[] = array_merge(
					array(
						'ID' => 'brak danych',
						'NAME' => 'brak danych',
						'DSCR' => 'brak danych',
						'IMG' => array(),
						'CAT' => array(),
						'DIM' => 'brak danych',
						'MARK' => array(),
						'INSTOCK' => 'brak danych',
						'MATTER' => 'brak danych',
						'COLOR' => 'brak danych',
						'COUNTRY' => 'brak danych',
						'CATALOG' => 'brak danych',
						'PACKAGE' => array(
							'SINGLE' => 'brak danych',
							'TOTAL' => 'brak danych',
							'DIM' => 'brak danych',
							'WEIGHT' => 'brak danych',
							'INSIDE' => 'brak danych',
							
						),
					),
					array(
						'ID' => $id,
						'NAME' => $name,
						'DSCR' => (string)$item->baseinfo->intro,
						'IMG' => $img,
						'CAT' => $cat,
						'DIM' => (string)$item->attributes->size,
						'MARK' => $mark,
						'INSTOCK' => $this->getStock( (int)$item->baseinfo->id ),
						
					)
				);
				
			}
			
		}
		
		return $ret;
	}
	
	// funkcja importująca dane o stanie magazynowym
	private function getStock( $id ){
		static $arr = array();
		if( !is_int( $id ) ) return false;
		if( count( $arr ) === 0 ){
			$file = "stocks.xml";		// plik do załadowania
			
			if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
				$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
				
			}
			else{
				$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
				foreach( $this->_XML[ $file ]->product as $product ){
					$arr[ (int)$product->stock->id ] = (int)$product->stock->quantity_24h;
					
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
