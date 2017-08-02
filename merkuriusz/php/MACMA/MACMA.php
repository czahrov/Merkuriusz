<?php
class MACMA extends XMLAbstract{
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
			"http://www.macma.pl/data/webapi/pl/xml/offer.xml",
			"http://www.macma.pl/data/webapi/pl/xml/categories.xml",
			"http://www.macma.pl/data/webapi/pl/xml/stocks.xml",
			
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
				if( strlen( (string)$category->name ) === 0 ) continue;
				//$cat_name = $this->stdName( (string)$category->name );
				$cat_name = apply_filters( 'stdName', (string)$category->name );
				$ret[ $cat_name ] = array();
				$p =& $ret[ $cat_name ];
				
				if( count( $category->subcategories->category ) > 0 ){
					foreach( $category->subcategories->category as $subcategory ){
						if( !strlen( (string)$subcategory->name ) ) continue;
						//$subcat_name = $this->stdName( (string)$subcategory->name );
						$subcat_name = apply_filters( 'stdName', (string)$subcategory->name );
						if( !array_key_exists( $subcat_name, $p ) ){
							$p[ $subcat_name ] = array();
							
						}
						
					}
					
				}
				
			}
			
		}
		
		return array(
			'MACMA' => $ret,
			
		);
	}
	
	// funkcja importująca dane o produktach w formie tablicy
	protected function getProducts(){
		$this->_getStock();
		$ret = array();
		$file = "offer.xml";		// plik do załadowania
		if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
			$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
			
		}
		else{
			$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
			foreach( $this->_XML[ $file ]->children() as $item ){
				
				// generowanie tablicy kategorii i podkategorii
				$cat = array();
				$cat_name = '';
				$subcat_name = '';
				
				if( count( $item->categories->category ) > 0 ){
					foreach( $item->categories->category as $category ){
						$cat_name = strtolower( (string)$category->name );
						/* ============== KATEGORIE ==============  */
						
						if( $cat_name === 'długopisy i zestawy piśmienne' ){
							$cat_name = 'Materiały piśmiennicze';
							
						}
						elseif( $cat_name === 'mark twain' ){
							$cat_name = 'vip piśmiennicze';
							$subcat_name = 'mark twain';
							
						}
						elseif( $cat_name === 'artykuły biurowe' ){
							$cat_name = 'biuro';
							
						}
						elseif( $cat_name === 'elektronika i zegary' ){
							$cat_name = 'elektronika';
							
						}
						elseif( $cat_name === 'kosmetyki i pielęgnacja' ){
							$cat_name = 'Uroda';	
							
						}
						elseif( $cat_name === 'dom i wyposażenie wnętrz' ){
							$cat_name = 'dom';	
							
						}
						elseif( $cat_name === 'latarki i narzędzia' ){
							$cat_name = 'narzędzia';	
							
						}						
						elseif( $cat_name === 'odzież reklamowa' ){
							$cat_name = 'tekstylia';
							
						}
						elseif( $cat_name === 'kubki reklamowe' ){
							$cat_name = 'do picia';
							
						}
						
						/* ============== //KATEGORIE ==============  */
						
						if( count( $category->subcategories->subcategory ) > 0 ){
							foreach( $category->subcategories->subcategory as $subcategory ){
								$subcat_name = strtolower( (string)$subcategory->name );
								/* ============== PODKATEGORIE ==============  */
								
								if( $cat_name === 'biuro' ){
									if( $subcat_name === 'etui na długopisy i wizytówki' ){
										$subcat_name = 'Etui na wizytówki';
										
									}
									elseif( $subcat_name === 'stojaki biurkowe' ){
										$subcat_name = 'stojaki';
										
									}
									
								}
								elseif( $cat_name === 'elektronika' ){
									if( $subcat_name === 'akcesoria do telefonów' ){
										$cat_name = 'Akcesoria do telefonów i tabletów';
										$subcat_name = 'Akcesoria do telefonów';
										
									}
									elseif( $subcat_name === 'akcesoria do komputerów' ){
										$subcat_name = 'Akcesoria komputerowe';
										
									}
									elseif( $subcat_name === 'zegarki i smartwatche' ){
										
										if( strpos( (string)$item->baseinfo->name, 'zegarek' ) !== false ){
											$cat_name = 'Zegary i zegarki';
											$subcat_name = 'zegarki na rękę';
											
										}
										elseif( strpos( (string)$item->baseinfo->name, 'Smart' ) !== false ){
											$cat_name = 'Smartwatche';
											$subcat_name = 'Inne';
											
										}
										else{
											$cat_name = 'Zegary i zegarki';
											$subcat_name = 'Pozostałe';
											
										}
										
									}
									elseif( in_array( $subcat_name, array( 'zegary biurkowe', 'zegary ścienne' ) ) ){
										$cat_name = 'Zegary i zegarki';
										
									}
									
									
								}
								elseif( $cat_name === 'parasole i płaszcze' ){
									if( in_array( $subcat_name, array( 'automatyczne', 'manualne' ) ) or strpos( $subcat_name, 'panel' ) !== false ){
										$cat_name = 'Przeciwdeszczowe';
										$subcat_name = 'Parasole';
										
									}
									elseif( $subcat_name === 'płaszcze przeciwdeszczowe' ){
										$cat_name = 'Przeciwdeszczowe';
										$subcat_name = 'Płaszcze';
										
									}
									elseif( $subcat_name === 'plażowe' ){
										$cat_name = 'Wypoczynek';
										$subcat_name = 'Akcesoria plażowe';
										
									}
									else{
										$cat_name = 'Przeciwdeszczowe';
										$subcat_name = 'Inne';
										
									}
									
								}
								elseif( $cat_name === 'podróże i turystyka' ){
									$cat_name = 'podróż';
									
									if( $subcat_name === 'torby na zakupy' ){
										$cat_name = 'torby i plecaki';
										$subcat_name = 'na zakupy';
										
									}
									elseif( $subcat_name === 'torby termiczne' ){
										$cat_name = 'torby i plecaki';
										$subcat_name = 'termoizolacyjne';
										
									}
									elseif( $subcat_name === 'portfele i portmonetki' ){
										$cat_name = 'podróż';
										
										if( stripos( (string)$item->baseinfo->name, 'portmonetka' ) !== false ){
											$subcat_name = 'portmonetki';
											
										}
										else{
											$subcat_name = 'portfele';
											
										}
										
									}
									elseif( in_array( $subcat_name, array( 'torby podróżne', 'torby i worki sportowe', 'torby i worki bawełniane' ) ) ){
										$cat_name = 'Torby i plecaki';
										$subcat_name = 'Podróżne i sportowe';
										
									}
									elseif( $subcat_name === 'odblaski' ){
										$cat_name = 'odblaski';
										$subcat_name = 'odblaski';
										
									}
									
								}
								elseif( $cat_name === 'sport i rekreacja' ){
									if( in_array( $subcat_name, array( 'czapki zimowe', 'czapki z daszkiem' ) ) ){
										$cat_name = 'Tekstylia';
										
									}
									elseif( $subcat_name === 'gry i zabawy' ){
										$cat_name = 'wypoczynek';
										
									}
									elseif( $subcat_name === 'koce i leżaki' ){
										$cat_name = 'wypoczynek';
										
										if( stripos( (string)$item->baseinfo->name, 'koc' ) !== false ){
											$subcat_name = 'Koce';
											
										}
										else{
											$subcat_name = 'Leżaki';
											
										}
										
									}
									elseif( $subcat_name === 'materace i maty' ){
										$cat_name = 'wypoczynek';
										
										if( stripos( (string)$item->baseinfo->name, 'mata' ) !== false ){
											$subcat_name = 'Maty';
											
										}
										else{
											$subcat_name = 'Materace';
											
										}
										
									}
									elseif( $subcat_name === 'okulary i etui do okularów' ){
										$cat_name = 'wypoczynek';
										
									}
									elseif( $subcat_name === 'kosze piknikowe i grille' ){
										$cat_name = 'wypoczynek';
										
										if( stripos( (string)$item->baseinfo->name, 'grill' ) !== false ){
											$subcat_name = 'Grill';
											
										}
										else{
											$subcat_name = 'Piknik';
											
										}
										
									}
									
								}
								elseif( $cat_name === 'dom' ){
									if( $subcat_name === 'akcesoria kuchenne' ){
										$subcat_name = 'kuchnia';
										
									}
									elseif( $subcat_name === 'akcesoria łazienkowe' ){
										$subcat_name = 'łazienka';
										
									}
									elseif( $subcat_name === 'wyposażenie wnętrz' ){
										$subcat_name = 'wnętrze';
										
									}
									
								}
								elseif( $cat_name === 'skrzynki i akcesoria barowe' ){
									if( $subcat_name === 'otwieracze i noże kelnerskie' ){
										$cat_name = 'wino';
										$subcat_name = 'akcesoria';
										
									}
									elseif( $subcat_name === 'piersiówki' ){
										$cat_name = 'do picia';
										
									}
									elseif( $subcat_name === 'skrzynki i zestawy do wina' ){
										$cat_name = 'wino';
										
										if( stripos( (string)$item->baseinfo->name, 'zestaw' ) !== false ){
											$subcat_name = 'zestawy';
											
										}
										elseif( stripos( (string)$item->baseinfo->name, 'skrzynka' ) !== false ){
											$subcat_name = 'opakowania';
											
										}
										else{
											$subcat_name = 'akcesoria';
											
										}
										
									}
									
								}
								elseif( $cat_name === 'narzędzia' ){
									if( $subcat_name === 'akcesoria samochodowe' ){
										$subcat_name = 'samochód';
										
									}
									elseif( $subcat_name === 'latarki i lampki' ){
										if( stripos( (string)$item->baseinfo->name, 'latark' ) !== false ){
											$subcat_name = 'latarki';
											
										}
										else{
											$subcat_name = 'lampki';
											
										}
										
									}
									elseif( $subcat_name === 'miarki i taśmy miernicze' ){
										$subcat_name = 'miarki';
										
									}
									elseif( $subcat_name === 'noże i scyzoryki' ){
										if( stripos( (string)$item->baseinfo->name, 'scyzoryk' ) !== false ){
											$subcat_name = 'scyzoryki';
											
										}
										else{
											$subcat_name = 'noże i nożyki';
											
										}
										
									}
									elseif( $subcat_name === 'zapalniczki' ){
										$cat_name = 'Dodatki';
										
									}
									elseif( $subcat_name === 'narzędzia' ){
										if( stripos( (string)$item->baseinfo->name, 'wielofunkcyjn' ) !== false or stripos( (string)$item->baseinfo->name, 'multi' ) !== false ){
											$subcat_name = 'wielofunkcyjne';
											
										}
										elseif( stripos( (string)$item->baseinfo->name, 'rower' ) !== false ){
											$subcat_name = 'rower';
											
										}
										elseif( stripos( (string)$item->baseinfo->name, 'zestaw' ) !== false ){
											$subcat_name = 'zestawy';
											
										}
										else{
											$subcat_name = 'inne';
											
										}
										
									}
									
								}
								elseif( $cat_name === 'breloki i odznaki' ){
									if( $subcat_name === 'breloki akrylowe' ){
										$cat_name = 'breloki';
										$subcat_name = 'akrylowe';
										
									}
									elseif( $subcat_name === 'breloki metalowe' ){
										$cat_name = 'breloki';
										$subcat_name = 'metalowe';
										
									}
									elseif( $subcat_name === 'inne' ){
										$cat_name = 'breloki';
										
									}
									elseif( $subcat_name === 'odznaki metalowe' ){
										$cat_name = 'pinsy';
										$subcat_name = 'metalowe';
										
									}
									
								}
								elseif( $cat_name === 'tekstylia' ){
									//$cat_name = '';
									
								}
								elseif( $cat_name === 'do picia' ){
									//$cat_name = '';
									
								}
								
								
								/* ============== //PODKATEGORIE ==============  */
								
							}
							
						}
						
						$cat_name_slug = apply_filters( 'stdName', $cat_name );
						
						if( !empty( $subcat_name ) ){
							$subcat_name_slug = apply_filters( 'stdName', $subcat_name );
							$subcat_name_slug = $cat_name_slug . "-" . $subcat_name_slug;
							
							$cat[ $cat_name_slug ][ $subcat_name_slug ] = array();
							
						}
						else{
							$cat[ $cat_name_slug ] = array();
							
							
						}
						
					}
					
				}
				
				// generowanie tablicy z obrazkami
				$img = array();
				foreach( $item->images->children() as $image ){
					$img[] = (string)$image;
					
				}
				
				$mark = array();
				$size = (string)$item->marking_size;
				if( empty( $size ) ) $size = '??';
				foreach( $item->markgroups->markgroup as $markgrp ){
					$type = (string)$markgrp->name;
					$mark[ $size ][] = $type;
					
				}
				
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
						'ID' => (string)$item->baseinfo->code_full,
						'NAME' => (string)$item->baseinfo->name,
						'DSCR' => (string)$item->baseinfo->intro[0],
						'IMG' => $img,
						'CAT' => $cat,
						'DIM' => (string)$item->attributes->size,
						'MARK' => $mark,
						'INSTOCK' => $this->_getStock( (string)$item->baseinfo->code_full ),
						
					)
				);
			}
			
		}
		
		return $ret;
	}
	
	// funkcja importująca dane o stanie magazynowym w formie tablicy
	private function _getStock( $id = null ){
		static $stock = array();
		$file = 'stocks.xml';
		
		// generowanie tablicy
		if( count($stock) === 0 ){
			if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] !== false ){
				foreach( $this->_XML[ $file ]->children() as $item ){
					$stock[ (string)$item->code_full ] = (int)$item->quantity_24h;
					
				}
				
			}
			else{
				return false;
				
			}
			
		}
		
		// odczyt
		if( $id !== null ){
			return $stock[ $id ];
		}
		else{
			return false;
			
		}
		
	}
	
}
