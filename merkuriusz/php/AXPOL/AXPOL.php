<?php
class AXPOL extends XMLAbstract{
	public $_shop = 'AXPOL';
	//protected $_debug = false;
	//protected $_cache_write = false;
	//protected $_cache_read = false;
	
	// konstruktor
	public function __construct(){
		$this->logger( "" . __CLASS__ . " loaded!", __FUNCTION__, __CLASS__ );
		//$this->_config['refresh'] = 60 * 30;		// 30m
		$this->_config['dnd'] = __DIR__ . "/DND";
		$this->_config['cache'] = __DIR__ . "/CACHE";
		$this->_config['remote'] = array(
			"ftp://userPL099:QwqChVFh@ftp.axpol.com.pl/axpol_print_data_PL.xml",
			"ftp://userPL099:QwqChVFh@ftp.axpol.com.pl/axpol_stocklist_pl.xml",
			"ftp://userPL099:QwqChVFh@ftp.axpol.com.pl/axpol_product_data_PL.xml",
			
		);
		
	}
	
	// funkcja importująca dane o budowie menu w formie tablicy
	protected function getMenu(){
		//return array();
		$ret = array();
		$file = "axpol_product_data_PL.xml";		// plik do załadowania
		if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
			$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
			
		}
		else{
			$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
			foreach( $this->_XML[ $file ]->children() as $item ){
				$catalog = $this->stdNameCache( (string)$item->Catalog );
				if( empty( $catalog ) ) $catalog = "bez_katalogu";
				
				$cat_name = $this->stdNameCache( (string)$item->MainCategoryPL  );
				if( empty( $cat_name ) ) $cat_name = "pozostale";

				$subcat_name = $this->stdNameCache( (string)$item->SubCategoryPL );
				
				if( empty( $ret[ $catalog ][ $cat_name ] ) ) $ret[ $catalog ][ $cat_name ] = array();
				
				if( empty( $ret[ $catalog ][ $cat_name ][ $subcat_name ] ) ) $ret[ $catalog ][ $cat_name ][ $subcat_name ] = array();
				
				/* oryginał
				if( empty( $subcat_name ) ){
					if( !array_key_exists( $cat_name, $ret[ $catalog ] ) ) $ret[ $catalog ][ $cat_name ] = array();
					
				}
				else{
					if( !array_key_exists( $subcat_name, $ret[ $catalog ][ $cat_name ] ) ) $ret[ $catalog ][ $cat_name ][ $subcat_name ] = array();
				}
				*/
				
			}
			
		}
		
		//return $ret;
		return array(
			'AXPOL' => $ret,
			
		);
	}
	
	// funkcja importująca dane o produktach w formie tablicy
	protected function getProducts(){
		//return array();
		$this->_getMark();
		//$this->_getStock();
		$ret = array();
		$file = "axpol_product_data_PL.xml";		// plik do załadowania
		if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
			$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
			
		}
		else{
			$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
			
			foreach( $this->_XML[ $file ]->children() as $item ){
				
				$item_title = (string)$item->TitlePL;
				$item_dscr = (string)$item->DescriptionPL;
				
				// generowanie tablicy z obrazami
				$img = array();
				for( $i=1; $i<=20; $i++ ){
					$num = sprintf( "%'02d", $i );
					if( strlen( $t = (string)$item->{"Foto{$num}"} ) > 0 ){
						$t2 = $i === 1?( 'fotob' ):( 'foto_add_big' );
						$img[] = sprintf( "http://axpol.com.pl/files/%s/%s", $t2, $t );
						
					}
					
				}
				
				$cat = array();
				$catalog = strtolower( (string)$item->Catalog );
				if( empty( $catalog ) ) $catalog = "Bez katalogu";
				
				$cat_name = strtolower( (string)$item->MainCategoryPL );
				if( empty( $cat_name ) ) $cat_name = "Pozostałe";
				
				$subcat_name = strtolower( (string)$item->SubCategoryPL );
				
				/* ========== KATALOGI ========== */
				// if( $catalog === 'voyager wine club' ){
					// $cat_name = 'vine club';
					
				// }
				
				/* ========== KATEGORIE ========== */
				if( in_array( $cat_name, array( 'do pisania', 'przybory piśmienne', 'przybory piŚmienne' ) ) ){
					$cat_name = 'materiały piśmiennicze';
					
					if( $subcat_name === 'biurowe' ){
						$subcat_name = 'inne';
						
					}
					elseif( $subcat_name === 'zestawy' ){
						$subcat_name = 'zestawy piśmienne';
						
					}
					elseif( $subcat_name === 'długopisy' ){
						$subcat_name = 'długopisy plastikowe';
						
					}
					
				}
				elseif( in_array( $cat_name, array( 'narzędzia i latarki' ) ) ){
					$cat_name = 'narzędzia';
					
				}
				elseif( in_array( $cat_name, array( 'wypoczynek i plener' ) ) ){
					$cat_name = 'wypoczynek';
					
				}
				elseif( in_array( $cat_name, array( 'teczki i notatniki' ) ) ){
					$cat_name = 'biuro';
					
					if( $subcat_name === 'notatniki' ){
						$subcat_name = 'notatniki i notesy';
						
					}
					
				}
				elseif( $cat_name === 'torby i podróż' ){
					$cat_name = 'podróż';
					
				}
				elseif( $cat_name === 'dom i wnętrze' ){
					$cat_name = 'dom';
					
				}
				elseif( $cat_name === 'technologia' ){
					$cat_name = 'elektronika';
					
				}
				elseif( $cat_name === 'fofcio promo toys' ){
					$cat_name = "pluszaki i maskotki";
					
				}
				elseif( $cat_name === 'voyager wine club' ){
					$cat_name = "vine club";
					
				}
				
				/* ========== PODKATEGORIE ========== */
				if( in_array( $subcat_name, array( 'parasole automatyczne', 'parasole manualne' ) ) or $cat_name === 'parasole' ){
					$cat_name = 'przeciwdeszczowe';
					$subcat_name = 'parasole';
					
				}
				elseif( $subcat_name === 'peleryny'  ){
					$cat_name = 'przeciwdeszczowe';
					$subcat_name = 'peleryny';
					
				}
				elseif( in_array( $subcat_name, array( 'uroda i pielęgnacja' ) ) ){
					$cat_name = 'uroda';
					
				}
				elseif( stripos( $subcat_name, 'ekologiczn' ) !== false ){
					$cat_name = 'eco gadżet';
					
				}
				elseif( in_array( $subcat_name, array( 'świąteczne' ) ) ){
					$cat_name = 'świąteczne';
					$subcat_name = '';
					
				}
				elseif( $subcat_name === 'apteczki' ){
					$cat_name = "Medyczne";
					
				}
				elseif( $subcat_name === 'huby usb' ){
					$subcat_name = "huby usb";
					
				}
				elseif( $subcat_name === 'koce' ){
					$subcat_name = "poduszki i koce";
					
				}
				elseif( $subcat_name === 'akcesoria do komputerów' ){
					//$subcat_name = "akcesoria komputerowe";
					$cat_name = 'akcesoria komputerowe';
					
					if( stripos( $item_title, ' usb' ) !== false ){
						$subcat_name = 'Akcesoria USB';
						
					}
					elseif( stripos( $item_title, ' klawiatura' ) !== false ){
						$subcat_name = 'Klawiatura';
						
					}
					elseif( stripos( $item_title, ' mysz' ) !== false ){
						$subcat_name = 'Mysz';
						
					}
					else{
						$subcat_name = 'Pozostałe';
					}
					
				}
				elseif( $subcat_name === 'teczki konferencyjne' ){
					$subcat_name = "teczki";
					
				}
				elseif( $subcat_name === 'kubki podróżne' ){
					$cat_name = 'do picia';
					$subcat_name = 'kubki';
					
				}
				elseif( stripos( $subcat_name, "wino: " ) !== false ){
					$cat_name = "vine club";
					$subcat_name = str_replace( "wino: ", "", $subcat_name );
					
				}
				elseif( $subcat_name === 'akcesoria do telefonów' ){
					$cat_name = 'Akcesoria do telefonów i tabletów';
					$subcat_name = 'Akcesoria do telefonów';
					
				}
				elseif( $subcat_name === 'zegary i zegarki' ){
					$cat_name = 'Zegary i zegarki';
					
					if( strpos( $item_title, 'ścianę' ) !== false ){
						$subcat_name = 'zegary ścienne';
						
					}
					elseif( strpos( $item_title, 'biurko' ) !== false ){
						$subcat_name = 'zegary biurkowe';
						
					}
					elseif( strpos( $item_title, 'rękę' ) !== false ){
						$subcat_name = 'zegarki na rękę';
						
					}
					else{
						$subcat_name = 'Pozostałe';
						
					}
					
				}
				elseif( $subcat_name === 'grill i piknik' ){
					if( stripos( $item_title, 'grill' ) !== false ){
						$subcat_name = 'grill';
						
					}
					elseif( stripos( $item_title, 'plecak' ) !== false or stripos( $item_title, 'kosz' ) !== false ){
						$subcat_name = 'Plecaki i kosze piknikowe';
						
					}
					else{
						$subcat_name = 'piknik';
						
					}
					
				}
				elseif( $cat_name === 'elektronika' ){
					if( $subcat_name === 'pamięci usb' ){
						$cat_name = 'pamięci usb';
					
						if( stripos( $item_dscr, ' 1GB' ) !== false ){
							$subcat_name = '1GB';
							
						}
						elseif( stripos( $item_dscr, ' 2GB' ) !== false ){
							$subcat_name = '2GB';
							
						}
						elseif( stripos( $item_dscr, ' 4GB' ) !== false ){
							$subcat_name = '4GB';
							
						}
						elseif( stripos( $item_dscr, ' 8GB' ) !== false ){
							$subcat_name = '8GB';
							
						}
						elseif( stripos( $item_dscr, ' 16GB' ) !== false ){
							$subcat_name = '16GB';
							
						}
						elseif( stripos( $item_dscr, ' 32GB' ) !== false ){
							$subcat_name = '32GB';
							
						}
						elseif( stripos( $item_dscr, ' 64GB' ) !== false ){
							$subcat_name = '64GB';
							
						}
						else{
							$subcat_name = 'pozostałe';
							
						}
						
					}
					elseif( $subcat_name === 'power banki' ){
						$cat_name = 'power banki';
						// $item_title
						// $item_dscr
						
						$val = null;
						
						if( stripos( $item_title, ' mAh' ) !== false ){
							preg_match( "@ (\d+) mAh@i", $item_title, $match );
							$val = (int)$match[1];
							
						}
						elseif( stripos( $item_dscr, ' mAh' ) !== false ){
							preg_match( "@ (\d+) mAh@i", $item_dscr, $match );
							$val = (int)$match[1];
							
						}
						
						if( is_int( $val ) ){
							$cap = array( 0, 500, 1000, 2000, 4000, 6000, 8000, 10000 );
							reset( $cap );
							//while( current( $cap ) < $val && next( $cap ) !== false ){}
							/* $t = current( $cap );
							while( $t < $val && next( $cap ) !== false  ){
								$t = current( $cap );
								
							} */
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
					elseif( $subcat_name === 'adaptery i huby usb' ){
						if( stripos( $item_title, 'hub' ) !== false ){
							$subcat_name = 'huby usb';
							
						}
						else{
							$cat_name = 'inne';
							
						}
						
					}
					
				}
				elseif( $cat_name === 'dom' ){
					if( $subcat_name === 'ramki do zdjęć' ){
						$cat_name = 'biuro';
						$subcat_name = 'ramki na zdjęcia';
						
					}
					
				}
				elseif( $cat_name === 'torby i plecaki' ){
					if( stripos( $item_title, 'laptop' ) !== false ){
						$cat_name = 'torby i plecaki';
						$subcat_name = 'na laptopa';
						
					}
					elseif( stripos( $item_title, 'dokument' ) !== false ){
						$cat_name = 'torby i plecaki';
						$subcat_name = 'na dokumenty';
						
					}
					elseif( stripos( $item_title, 'sport' ) !== false ){
						$cat_name = 'torby i plecaki';
						$subcat_name = 'sportowe';
						
					}
					elseif( stripos( $item_title, 'kółk' ) !== false ){
						$cat_name = 'torby i plecaki';
						$subcat_name = 'podróżne';
						
					}
					elseif( stripos( $item_title, 'plecak' ) !== false ){
						$cat_name = 'torby i plecaki';
						$subcat_name = 'plecaki';
						
					}
					elseif( stripos( $item_title, 'sznurk' ) !== false or stripos( $item_title, 'żeglar' ) !== false ){
						$cat_name = 'torby i plecaki';
						$subcat_name = 'worki ze sznurkiem';
						
					}
					elseif( stripos( $item_title, 'ramię' ) !== false ){
						$cat_name = 'torby i plecaki';
						$subcat_name = 'na ramię';
						
					}
					elseif( stripos( $item_title, 'term' ) !== false ){
						$cat_name = 'torby i plecaki';
						$subcat_name = 'termoizolacyjne';
						
					}
					elseif( stripos( $item_title, 'plaż' ) !== false ){
						$cat_name = 'torby i plecaki';
						$subcat_name = 'torby plażowe';
						
					}
					elseif( stripos( $item_title, 'zakup' ) !== false ){
						$cat_name = 'torby i plecaki';
						$subcat_name = 'na zakupy';
						
					}
					elseif( stripos( $item_title, 'tablet' ) !== false ){
						$cat_name = 'akcesoria do telefonów i tabletów';
						$subcat_name = 'akcesoria do tabletów';
						
					}
					elseif( stripos( $item_title, 'podróż' ) !== false ){
						$cat_name = 'torby i plecaki';
						$subcat_name = 'podróżne';
						
					}
					elseif( stripos( $item_title, 'wodoodporn' ) !== false ){
						$cat_name = 'torby i plecaki';
						$subcat_name = 'wodoodporne';
						
					}
					else{
						$cat_name = 'torby i plecaki';
						$subcat_name = 'inne';
						
					}
					
				}
				
				/* 
				$item_title = (string)$item->TitlePL
				$item_dscr = (string)$item->DescriptionPL
				*/
				 
				/* ========== PODKATEGORIE ========== */
				
				if( strpos( (string)$item->TitlePL, 'Mauro Conti' ) !== false ){
					$cat_name = 'vip skóra';
					$subcat_name = '';
					
				}
				
				/* ================== FILTRY ================== */
				if( stripos( $item_title, 'waterman' ) !== false ){
					$cat_name = 'vip piśmiennicze';
					$subcat_name = 'waterman';
					
				}
				elseif( stripos( $item_title, 'parker' ) !== false ){
					$cat_name = 'vip piśmiennicze';
					$subcat_name = 'parker';
					
				}
				elseif( stripos( $item_title, 'kielisz' ) !== false ){
					$cat_name = 'do picia';
					$subcat_name = 'kieliszki';
					
				}
				elseif( $subcat_name === 'długopisy ekologiczne' ){
					$cat_name = 'eco gadżet';
					$subcat_name = '';
					
				}
				elseif( $cat_name === 'akcesoria do telefonÓw i tabletÓw' &&  $subcat_name === 'power banki' ){
					$cat_name = 'power banki';
					$subcat_name = 'pozostałe';
					
				}
				elseif( $cat_name === 'dom i wnĘtrze'){
					$cat_name = 'dom';
					
					if( $subcat_name === 'eco' ){
						$cat_name = 'eco gadżet';
						$subcat_name = '';
						
					}
					elseif( $subcat_name === 'akcesoria do wina	' ){
						$cat_name = 'vine club';
						$subcat_name = 'akcesoria';
						
					}
					else{
						$subcat_name = 'inne';
						
					}
					
				}
				elseif( $cat_name === 'narzĘdzia i latarki' ){
					$cat_name = 'narzędzia';
					
				}
				elseif( $cat_name === 'wypoczynek' ){
					
					if( $subcat_name === 'poduszki i koce' ){
						
						if( stripos( (string)$item->TitlePL, 'koc' ) ){
							$subcat_name = 'koce';
							
						}
						else{
							$subcat_name = 'poduszki';
							
						}
						
					}
					
				}
				elseif( $cat_name === 'torby i plecaki' ){
					
					if( $subcat_name === 'na ramię' ){
						$subcat_name = 'torby na ramię';
						
					}
					
				}
				elseif( $cat_name === 'akcesoria' ){
					$cat_name = 'vine club';
					$subcat_name = 'akcesoria';
					
				}
				elseif( $cat_name === 'wyprzedaż voyager wine club' ){
					$cat_name = 'vine club';
					
					if( stripos( $item_title, 'lindt' ) !== false ){
						$subcat_name = 'czekolada';
						
					}
					elseif( stripos( (string)$item->TitlePL, 'zestaw' ) !== false ){
						$subcat_name = 'zestawy';
						
					}
					else{
						$subcat_name = 'wino';
						
					}
					
				}
				elseif( $cat_name === 'medyczne' ){
					
					if( $subcat_name === 'apteczki' ){
						$cat_name = 'dom';
						
					}
					
				}
				elseif( $cat_name === 'pozostałe' ){
					$cat_name = 'do picia';
					$subcat_name = 'inne';
					
				}
				elseif( $cat_name === 'air gifts' ){
					$cat_name = 'do picia';
					$subcat_name = 'kubki';
					
				}
				elseif( $cat_name === 'lato' ){
					$cat_name = 'wypoczynek';
					$subcat_name = 'lato';
					
				}
				elseif( $cat_name === 'wino' ){
					$cat_name = 'vine club';
					$subcat_name = 'wino';
					
				}
				elseif( $cat_name === 'vip skóra' ){
					$cat_name = 'kolekcja vip';
					$subcat_name = 'mauro conti';
					
				}
				elseif( in_array( $cat_name, array( 'wyprzedaż voyager', 'wyprzedaŻ voyager xd' ) ) ){
					$cat_name = 'inne';
					
				}
				
				
				/* ================== */
				
				//$cat[ $catalog ] = array();
				$cat[ $cat_name ] = array();
				
				// $this->debugger( $cat_name, $subcat_name );
				
				if( !empty( $subcat_name ) ){
					$subcat_name = $cat_name . "-" . $subcat_name;
					
					$cat[ $subcat_name ] = array();
					
				}
				
				preg_match( "/^\d+$/", (string)$item->Page, $match );
				$page_test = empty($match)?( (string)$item->Page ):( "strona {$item->Page}" );
				
				/* $mark_array = $this->_getMark( (string)$item->CodeERP );
				$mark_size = array();
				$mark_types = array();
				if( !empty( $mark_array ) ){
					foreach( $mark_array as $size => $types ){
						if( !in_array( $size, $mark_size ) ) $mark_size[] = $size;
						
						foreach( $types as $type ){
							if( !in_array( $type, $mark_types ) ) $mark_types[] = $type;
							
						}
						
					}
					
				}
				else{
					$mark_types[] = "Brak";
					$mark_size[] = "Brak";
					
				} */
				
				$marks_text = array();
				foreach( $this->_getMark( (string)$item->CodeERP ) as $t_place => $t_types ){
					$marks_text[] = sprintf( "%s: %s", 
						$t_place,
						implode( ", ", $t_types )
					);
					
				}
				
				$ret[] = array_merge(
					array(
						'SHOP' => $this->_shop,
						'ID' => 'brak danych',
						'NAME' => 'brak danych',
						'DSCR' => 'brak danych',
						'IMG' => array(),
						'CAT' => array(),
						'DIM' => 'brak danych',
						// 'MARK' => array(),
						// 'MARKSIZE' => array(),
						// 'MARKTYPE' => array(),
						'MARK_TEXT' => '',
						'INSTOCK' => 'brak danych',
						'MATTER' => 'brak danych',
						'COLOR' => 'brak danych',
						'COUNTRY' => 'brak danych',
						'MARKCOLORS' => 1,
						'PRICE' => array(
							'BRUTTO' => 0,
							'NETTO' => null,
							'CURRENCY' => '',
						),
						'PRICE_ALT' => 'Wycena indywidualna<br>( telefon/mail )',
						'MODEL' => 'brak danych',
						'WEIGHT' => 'brak danych',
						'BRAND' => 'brak danych',
						
					),
					array(
						'ID' => (string)$item->CodeERP,
						'NAME' => (string)$item->TitlePL,
						'DSCR' => (string)$item->DescriptionPL,
						'IMG' => $img,
						'CAT' => $cat,
						'DIM' => (string)$item->Dimensions,
						// 'MARK' => empty( $mark_array )?( array() ):( $mark_array ),
						// 'MARKSIZE' => $mark_size,
						// 'MARKTYPE' => $mark_types,
						'MARK_TEXT' => implode( "<br>", $marks_text ),
						'INSTOCK' => $this->_getStock( (string)$item->CodeERP ),
						'MATTER' => (string)$item->MaterialPL,
						'COLOR' => (string)$item->ColorPL,
						'COUNTRY' => (string)$item->CountryOfOrigin,
						'PRICE' => array(
							'NETTO' => (float)$item->CatalogPricePLN,
							'BRUTTO' => $this->price2brutto( (float)$item->CatalogPricePLN ),
							'CURRENCY' => 'PLN',
						),
						'WEIGHT' => sprintf( "%s g", (float)$item->ItemWeightG ),
						
					)
				);
				
			}
			
			// $this->debugger();
			
		}
		
		return $ret;
	}
	
	// funkcja importująca dane o znakowaniach w formie tablicy
	private function _getMark( $id = null ){
		static $mark = array();
		// generowanie tablicy
		if( count( $mark ) === 0 ){
			$file = "axpol_print_data_PL.xml";
			if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
				$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
				
			}
			else{
				$this->logger( "analiza pliku  $file i tworzenie tablicy znakowań", __FUNCTION__, __CLASS__ );
				//print_r( $this->_XML[ $file ] );
				foreach( $this->_XML[ $file ]->children() as $item ){
					$code = (string)$item->CodeERP;
					//echo "\r\nid: $code";
					for( $i=1; $i <= 6; $i++ ){
						$position = (string)$item->{"Position_{$i}_PrintPosition"};
						//echo "\r\nposition:$position";
						if( strlen( $position ) > 0 ){
							$size = (string)$item->{"Position_{$i}_PrintSize"};
							$types = array();
							for( $j=1; $j<=5; $j++ ){
								$type = (string)$item->{"Position_{$i}_PrintTech_{$j}"};
								if( strlen( $type ) > 0 ){
									$types[] = $type;
									
								}
								
							}
							
							//$mark[ $code ][ $position ][ $size ] = $types;
							$mark[ $code ][ "$size ($position)" ] = $types;
							
						}
						
					}
					
				}
				
			}
			
			// echo "<!--MARK";
			//print_r( $mark );
			// echo "-->";
			
		}
		
		// odczyt
		if( $id !== null && array_key_exists( $id, $mark ) ){
			return $mark[ $id ];
		}
		else return array();
		
	}
	
	// funkcja importująca dane o stanie magazynowym w formie tablicy
	private function _getStock( $id = null ){
		static $stock = array();
		
		// generowanie tablicy
		if( count( $stock ) === 0 ){
			$file = "axpol_stocklist_pl.xml";
			if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
				$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
				
			}
			else{
				$this->logger( "analiza pliku  $file i tworzenie tablicy stanu magazynowego", __FUNCTION__, __CLASS__ );
				foreach( $this->_XML[ $file ]->items->children() as $item ){
					$stock[ (string)$item->Kod ] = (int)$item->na_magazynie_dostepne_teraz;
					
				}
				
			}
			
			//print_r( $stock );
			
		}
		
		// odczyt
		if( $id !== null && array_key_exists( $id, $stock ) ){
			return $stock[ $id ];
			
		}
		
	}
	
}
