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
					$this->genMenuTree( $folders, $ret, $product );
					
				}
				
			}
			
		}
		
		return array(
			'ANDA' => $ret,
			
		);
		
	}
	
	// funckja generująca drzewo podkategorii
	private function genMenuTree( SimpleXMLElement $node, Array &$arr){
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
				//if( !array_key_exists( $subcat, $arr[ $cat ] ) ){
				if( empty( $arr[ $cat ][ $subcat ] ) ){
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
					//$cat_name = $this->stdNameCache( (string)$folder->attributes()->category );
					//$subcat_name = $this->stdNameCache( (string)$folder->attributes()->subcategory );
					$cat_name = strtolower( (string)$folder->attributes()->category );
					$subcat_name = strtolower( (string)$folder->attributes()->subcategory );
					
					/* ========== KATEGORIE ==========  */
					
					if( $cat_name === 'textile & fashion' ){
						$cat_name = 'tekstylia';
						
					}
					elseif( $cat_name === 'vitality & wellness' ){
						$cat_name = 'uroda';
						
					}
					elseif( $cat_name === 'technology & mobile' ){
						$cat_name = 'elektronika';
						
					}
					elseif( $cat_name === 'writing' ){
						$cat_name = 'materiały piśmiennicze';
						
					}
					elseif( $cat_name === 'home & kitchen' ){
						$cat_name = 'dom';
						
					}
					
					/* ========== //KATEGORIE ==========  */
					/* ========== PODKATEGORIE ==========  */
					
					if( $cat_name === 'tekstylia' ){
						if( $subcat_name === 'kurtki, płaszcze przeciwdeszczowe oraz ponczo' ){
							if( stripos( (string)$item->attributes()->name, 'kurtka' ) !== false ){
								$subcat_name = 'kurtki';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'bluza' ) !== false ){
								$subcat_name = 'Bluzy, polary, softshelle';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'kamizelka' ) !== false ){
								$subcat_name = 'Kamizelki';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'płaszcz' ) !== false ){
								$subcat_name = 'Płaszcze';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'ponczo' ) !== false or stripos( (string)$item->attributes()->name, 'poncho' ) !== false ){
								$subcat_name = 'Ponczo';
								
							}
							else{
								$subcat_name = 'Inne';
								
							}
							
						}
						elseif( $subcat_name === 'akcesoria polarowe' ){
							if( stripos( (string)$item->attributes()->name, 'kurtka' ) !== false ){
								$subcat_name = 'bluzy, polary, softshelle';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'szalik' ) !== false ){
								$subcat_name = 'szaliki';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'rękawiczki' ) !== false ){
								$subcat_name = 'rękawiczki';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'nausznik' ) !== false ){
								$subcat_name = 'nauszniki';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'ogrzewacz' ) !== false ){
								$subcat_name = 'ogrzewacz na szyję';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'kurtka' ) !== false ){
								$subcat_name = 'kurtki';
								
							}
							else{
								$subcat_name = 'Inne';
								
							}
							
						}
						elseif( $subcat_name === 'odznaki' ){
							$cat_name = 'pinsy';
							
							if( stripos( (string)$item->attributes()->name, 'metal' ) !== false ){
								$subcat_name = 'metalowe';
								
							}
							else{
								$subcat_name = 'pozostałe';
								
							}
							
						}
						elseif( $subcat_name === 'czapki oraz czapki z daszkiem' ){
							if( stripos( (string)$item->description, ' zimowa' ) !== false ){
								$subcat_name = 'czapki zimowe';
								
							}
							elseif( stripos( (string)$item->description, ' przeciw' ) !== false or stripos( (string)$item->attributes()->name, ' daszek' ) !== false ){
								$subcat_name = 'daszki przeciwsłoneczne';
								
							}
							elseif( stripos( (string)$item->attributes()->name, ' baseball' ) !== false or stripos( (string)$item->description, ' baseball' ) !== false or stripos( (string)$item->attributes()->name, ' dasz' ) !== false or stripos( (string)$item->description, ' dasz' ) !== false ){
								$subcat_name = 'czapki z daszkiem';
								
							}
							else{
								$subcat_name = 'inne';
								
							}
							
						}
						
					}
					elseif( $cat_name === 'uroda' ){
						if( stripos( (string)$item->description, 'ręcznik' ) !== false ){
							$subcat_name = 'Ręczniki';
							
						}
						elseif( stripos( (string)$item->description, 'szlafrok' ) !== false ){
							$subcat_name = 'Szlafroki';
							
						}
						elseif( $subcat_name === 'akcesoria łazienkowe' ){
							$cat_name = 'dom';
							$subcat_name = 'Łazienka';
							
						}
						elseif( $subcat_name === 'lusterko ze szczotką' ){
							$subcat_name = 'Lusterka';
							
						}
						elseif( $subcat_name === 'pudełeczka na tabletki oraz akcessoria medyczne' ){
							$cat_name = 'medyczne';
							$subcat_name = '';
							
						}
						elseif( $subcat_name === 'lusterka oraz zestawy make-up oraz manicure' ){
							if( stripos( (string)$item->attributes()->name, ' lusterk' ) !== false or stripos( (string)$item->description, ' lusterk' ) !== false ){
								$subcat_name = 'lusterka';
								
							}
							elseif( stripos( (string)$item->attributes()->name, ' manicure' ) !== false or stripos( (string)$item->attributes()->name, ' manikiur' ) !== false ){
								$subcat_name = 'Pielęgnacja dłoni';
								
							}
							elseif( stripos( (string)$item->attributes()->name, ' makijaż' ) !== false ){
								$subcat_name = 'Uroda i pielęgnacja';
								
							}
							else{
								$subcat_name = 'Inne';
								
							}
							
						}
						elseif( $subcat_name === 'akcesoria antystresowe' ){
							$cat_name = 'biuro';
							$subcat_name = 'antystresy';
							
						}
						
					}
					elseif( $cat_name === 'elektronika' ){
						if( $subcat_name === 'akcesoria do telefonów i tabletów' ){
							$cat_name = 'akcesoria do telefonów i tabletów';
							
							if( stripos( (string)$item->attributes()->name, ' etui' ) !== false or stripos( (string)$item->attributes()->name, ' uchwyt' ) !== false ){
								$subcat_name = 'etui i podstawki';
								
							}
							elseif( stripos( (string)$item->attributes()->name, ' vr' ) !== false ){
								$subcat_name = 'Okulary wirtualnej rzeczywistości';
								
							}
							elseif( stripos( (string)$item->attributes()->name, ' ładowarka' ) !== false ){
								$subcat_name = 'Ładowarki i kable';
								
							}
							elseif( stripos( (string)$item->attributes()->name, ' stick' ) !== false or stripos( (string)$item->attributes()->name, ' ramię' ) !== false ){
								$subcat_name = 'akcesoria do telefonów';
								
							}
							else{
								$subcat_name = 'Akcesoria';
							}
							
						}
						elseif( $subcat_name === 'zegary ścienne oraz na biurko' ){
							$cat_name = 'zegary i zegarki';
							if( stripos( (string)$item->attributes()->name, ' ścienny' ) !== false or stripos( (string)$item->description, ' ścienny' ) !== false ){
								$subcat_name = 'zegary ścienne';
								
							}
							elseif( stripos( (string)$item->description, ' stołow' ) !== false or stripos( (string)$item->description, ' stół' ) !== false or stripos( (string)$item->description, ' biurko' ) !== false ){
								$subcat_name = 'zegary biurkowe';
								
							}
							else{
								$subcat_name = 'pozostałe';
								
							}
							
						}
						elseif( $subcat_name === 'akcesoria komputerowe' ){
							$cat_name = 'akcesoria komputerowe';
							
							if( stripos( (string)$item->attributes()->name, 'mysz' ) !== false ){
								$subcat_name = 'Mysz';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'klawiatura' ) !== false ){
								$subcat_name = 'Klawiatura';
								
							}
							elseif( stripos( (string)$item->attributes()->name, ' usb' ) !== false ){
								$subcat_name = 'Akcesoria USB';
								
							}
							else{
								$subcat_name = 'pozostałe';
								
							}
							
						}
						elseif( $subcat_name === 'pendrive-y a hub-y usb i czytniki kart pamięci' ){
							if( strpos( (string)$item->attributes()->name, 'drive' ) !== false or stripos( (string)$item->attributes()->name, 'pamięć' ) !== false or stripos( (string)$item->attributes()->name, 'GB' ) !== false ){
								$cat_name = 'pendrive';
								$subcat_name = 'pozostałe';
							}
							if( stripos( (string)$item->attributes()->name, 'hub' ) !== false or stripos( (string)$item->attributes()->name, 'rozdzielacz' ) !== false ){
								$subcat_name = 'adaptery i huby usb';
							}
							else{
								$subcat_name = 'inne';
								
							}
							
						}
						elseif( $subcat_name === 'głośniki, słuchawki' ){
							if( stripos( (string)$item->attributes()->name, 'słuchawk' ) !== false ){
								$subcat_name = 'słuchawki';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'głoś' ) !== false ){
								$subcat_name = 'głośniki';
								
							}
							else{
								$subcat_name = 'inne';
								
							}
							
						}
						elseif( $subcat_name === 'zegarki na rękę' ){
							 $cat_name = 'zegary i zegarki';
							 $subcat_name = 'zegarki na rękę';
							
						}
						elseif( $subcat_name === 'power banki i ładowarki do telefonów' ){
							if( stripos( (string)$item->attributes()->name, 'samochod' ) !== false ){
								$subcat_name = 'Ładowarki samochodowe';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'bank' ) !== false or stripos( (string)$item->description, 'bank' ) !== false ){
								$cat_name = 'Power banki';
								$val = null;
						
								if( stripos( (string)$item->attributes()->name, ' mAh' ) !== false ){
									preg_match( "@ (\d+) mAh@i", (string)$item->attributes()->name, $match );
									$val = (int)$match[1];
									
								}
								elseif( stripos( (string)$item->description, ' mAh' ) !== false ){
									preg_match( "@ (\d+) mAh@i", (string)$item->description, $match );
									$val = (int)$match[1];
									
								}
								
								if( is_int( $val ) ){
									$cap = array( 0, 500, 1000, 2000, 4000, 6000, 8000, 10000 );
									reset( $cap );
									
									$f = current( $cap );
									foreach( $cap as $t ){
										if( $val >= $t ) $f = $t;
										
									}
									if( $f > 0 ){
										$subcat_name = "Pojemność od " . $f . " mAh";
										
									}
									else{
										$subcat_name = 'Pozostałe';
										
									}
									
								}
								else{
									$subcat_name = 'Pozostałe';
									
								}
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'ładowar' ) !== false or stripos( (string)$item->description, 'ładowar' ) !== false ){
								$subcat_name = 'Ładowarki USB';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'brelok' ) !== false ){
								$cat_name = 'breloki';
								$subcat_name = 'inne';
								
							}
							else{
								$subcat_name = 'inne';
								
							}

						}
						elseif( $subcat_name === 'rękawiczki do smartphonów' ){
							$cat_name = 'akcesoria do telefonów i tabletów';
							$subcat_name = 'akcesoria do telefonów';
							
						}
						elseif( $subcat_name === 'stacje pogodowe' ){
							$cat_name = 'elektronika';
							
						}
						
					}
					elseif( $cat_name === 'materiały piśmiennicze' ){
						if( $subcat_name === 'długopisy metal-alu i drewniane' ){
							if( stripos( (string)$item->description, 'ekolog' ) !== false or stripos( (string)$item->description, 'bambus' ) !== false ){
								$subcat_name = 'długopisy ekologiczne';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'zestaw' ) !== false ){
								$subcat_name = 'zestawy piśmienne';
								
							}
							elseif( stripos( (string)$item->description, 'metal' ) !== false ){
								$subcat_name = 'długopisy metalowe';
								
							}
							elseif( stripos( (string)$item->description, 'alumin' ) !== false ){
								$subcat_name = 'długopisy aluminiowe';
								
							}
							elseif( stripos( (string)$item->description, 'plastik' ) !== false ){
								$subcat_name = 'długopisy plastikowe';
								
							}
							else{
								$subcat_name = 'Inne';
								
							}
							
						}
						elseif( $subcat_name === 'zestawy piśmiennicze' ){
							$subcat_name = 'zestawy piśmienne';
							
						}
						elseif( $subcat_name === 'pudełka na długopisy' ){
							$subcat_name = 'etui';
							
						}
						elseif( $subcat_name === 'gumki i ostrzynki' ){
							if( stripos( (string)$item->attributes()->name, 'gumk' ) !== false ){
								$subcat_name = 'Gumki do mazania';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'temper' ) !== false or stripos( (string)$item->description, 'temper' ) !== false or stripos( (string)$item->attributes()->name, 'ostrzynk' ) !== false ){
								$subcat_name = 'Temperówki';
								
							}
							
						}
						elseif( $subcat_name === 'rysiki do ekranów dotykowych' ){
							$subcat_name = 'Touch peny';
							
						}
						
					}
					elseif( $cat_name === 'dom' ){
						if( $subcat_name === 'kubki i szklanki' ){
							$cat_name = 'do picia';
							
							if( stripos( (string)$item->attributes()->name, 'szklank' ) !== false ){
								$subcat_name = 'szklanki';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'metal' ) !== false or stripos( (string)$item->description, 'alumin' ) !== false ){
								$subcat_name = 'kubki';
								
							}
							elseif( stripos( (string)$item->description, 'ceram' ) !== false ){
								$subcat_name = 'kubki ceramiczne';
								
							}
							elseif( stripos( (string)$item->description, 'plastik' ) !== false ){
								$subcat_name = 'kubki plastikowe';
								
							}
							elseif( stripos( (string)$item->description, 'porcelan' ) !== false ){
								$subcat_name = 'kubki porcelanowe';
								
							}
							elseif( stripos( (string)$item->description, 'szklan' ) !== false or stripos( (string)$item->description, 'szron' ) !== false ){
								$subcat_name = 'kubki szklane';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'pudeł' ) !== false or stripos( (string)$item->attributes()->name, 'opakow' ) !== false ){
								$subcat_name = 'opakowania do kubków';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'taca' ) !== false ){
								$cat_name = 'dom';
								$subcat_name = 'kuchnia';
								
							}
							else{
								$subcat_name = 'kubki';
								
							}
							
						}
						elseif( $subcat_name === 'akcesoria do win i otwieracze do butelek' ){
							if( stripos( (string)$item->attributes()->name, 'otwier' ) !== false or stripos( (string)$item->description, 'otwier' ) !== false ){
								$subcat_name = 'otwieracze do butelek';
								
							}
							elseif( stripos( (string)$item->attributes()->name, ' win' ) !== false ){
								$cat_name = 'wino';
								
								if( stripos( (string)$item->attributes()->name, 'torba' ) !== false ){
									$subcat_name = 'opakowania';
									
								}
								elseif( stripos( (string)$item->attributes()->name, 'zestaw' ) !== false ){
									$subcat_name = 'zestawy';
									
								}
								else{
									$subcat_name = 'akcesoria';
									
								}
								
							}
							else{
								$cat_name = 'wino';
								$subcat_name = 'akcesoria';
								
							}
							
						}
						//elseif( $subcat_name === 'świece i kadzidła' ){		nie chciało działać, możliwe że to jakiś problem z kodowaniem polskich znaków w plikach XML
						elseif( stripos( $subcat_name, 'kadzid' ) !== false ){
							$cat_name = 'uroda';
							$subcat_name = 'świece i zestawy do aromaterapii';
							
						}
						//elseif( $subcat_name === 'akcesoria do koktaili i palenia' ){
						elseif( stripos( $subcat_name, 'palenia' ) !== false ){
							if( stripos( (string)$item->attributes()->name, 'zapal' ) !== false ){
								$cat_name = 'dodatki';
								$subcat_name = 'zapalniczki';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'schowek' ) !== false ){
								$cat_name = 'dodatki';
								$subcat_name = 'inne';
								
							}
							elseif( stripos( (string)$item->attributes()->name, 'brel' ) !== false or stripos( (string)$item->description, 'brelok' ) !== false ){
								$cat_name = 'breloki';
								$subcat_name = 'breloki';
								
							}
							else{
								$cat_name = 'do picia';
								$subcat_name = 'inne';
							}
							
						}
						elseif( $subcat_name === 'dekoracje domowe' ){
							if( stripos( (string)$item->attributes()->name, 'doniczka' ) !== false ){
								$subcat_name = 'ogród';
								
							}
							
						}
						
					}
					
					// (string)$item->attributes()->name
					// (string)$item->description
					
					/* ========== //PODKATEGORIE ==========  */
					
					$cat_name_slug = $this->stdNameCache( $cat_name );
					$subcat_name_slug = $cat_name_slug . "-" . $this->stdNameCache( $subcat_name );
					
					//$cat[ $cat_name ][ $subcat_name ] = array();
					$cat[ $cat_name_slug ][ $subcat_name_slug ] = array();
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
						'ID' => (string)$item->attributes()->no,
						'NAME' => (string)$item->attributes()->name,
						'DSCR' => (string)$item->description,
						'IMG' => $img,
						'CAT' => $cat,
						'DIM' => implode( " x ", $dim ),
						'MARK' => $mark,
						'INSTOCK' => (int)$item->stocks[0]->attributes()->value,
						
					)
				);
				
			}
			
		}
		
		echo "<!--";
		//print_r( array_slice( $ret, 0, 10 ) );
		echo "-->";
		
		return $ret;
	}
	
}
