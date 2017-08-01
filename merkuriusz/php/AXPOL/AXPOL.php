<?php
class AXPOL extends XMLAbstract{
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
		$this->_getStock();
		$ret = array();
		$file = "axpol_product_data_PL.xml";		// plik do załadowania
		if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
			$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
			
		}
		else{
			$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
			
			foreach( $this->_XML[ $file ]->children() as $item ){
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
				if( in_array( $cat_name, array( 'do pisania', 'przybory piśmienne' ) ) ){
					$cat_name = 'materiały piśmiennicze';
					
				}
				elseif( in_array( $cat_name, array( 'narzędzia i latarki' ) ) ){
					$cat_name = 'narzędzia';
					
				}
				elseif( in_array( $cat_name, array( 'wypoczynek i plener' ) ) ){
					$cat_name = 'wypoczynek';
					
					if( in_array( $subcat_name, array( 'grill', 'piknik' ) ) ){
						$subcat_name = 'grill i piknik';
						
					}
					
				}
				elseif( in_array( $cat_name, array( 'teczki i notatniki' ) ) ){
					$cat_name = 'biuro';
					
					if( $subcat_name === 'notatniki' ){
						$subcat_name = 'Notatniki i notesy';
						
					}
					
				}
				elseif( $cat_name === 'przybory piśmienne' ){
					$cat_name = 'materiały piśmiennicze';
					
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
				elseif( strpos( $subcat_name, 'ekologiczn' ) !== false ){
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
					$subcat_name = "adaptery i huby usb";
					
				}
				elseif( $subcat_name === 'koce' ){
					$subcat_name = "poduszki i koce";
					
				}
				elseif( $subcat_name === 'akcesoria do komputerów' ){
					$subcat_name = "akcesoria komputerowe";
					
				}
				elseif( $subcat_name === 'teczki konferencyjne' ){
					$subcat_name = "teczki";
					
				}
				elseif( $subcat_name === 'power banki' ){
					$cat_name = 'power banki';
					
				}
				elseif( $subcat_name === 'kubki podróżne' ){
					$subcat_name = 'kubki';
					
				}
				elseif( strpos( $subcat_name, "wino: " ) !== false ){
					$cat_name = "Wino";
					$subcat_name = str_replace( "wino: ", "", $subcat_name );
					
				}
				elseif( $subcat_name === 'akcesoria do telefonów' ){
					$cat_name = 'Akcesoria do telefonów i tabletów';
					$subcat_name = 'Akcesoria do telefonów';
					
				}
				elseif( $subcat_name === 'zegary i zegarki' ){
					$cat_name = 'Zegary i zegarki';
					
					if( strpos( (string)$item->TitlePL, 'ścianę' ) !== false ){
						$subcat_name = 'zegary ścienne';
						
					}
					elseif( strpos( (string)$item->TitlePL, 'biurko' ) !== false ){
						$subcat_name = 'zegary biurkowe';
						
					}
					elseif( strpos( (string)$item->TitlePL, 'rękę' ) !== false ){
						$subcat_name = 'zegarki na rekę';
						
					}
					else{
						$subcat_name = 'Pozostałe';
						
					}
					
				}
				
				/* ========== PODKATEGORIE ========== */
				
				if( strpos( (string)$item->TitlePL, 'Mauro Conti' ) !== false ){
					$cat_name = 'vip skóra';
					$subcat_name = '';
					
				}
				
				/* ================== */
				
				//$cat[ $catalog ] = array();
				$cat[ $cat_name ] = array();
				
				if( !empty( $subcat_name ) ){
					$subcat_name = $cat_name . "-" . $subcat_name;
					
					$cat[ $subcat_name ] = array();
					
				}
				
				preg_match( "/^\d+$/", (string)$item->Page, $match );
				$page_test = empty($match)?( (string)$item->Page ):( "strona {$item->Page}" );
				
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
						'ID' => (string)$item->CodeERP,
						'NAME' => (string)$item->TitlePL,
						'DSCR' => (string)$item->DescriptionPL,
						'IMG' => $img,
						'CAT' => $cat,
						'DIM' => (string)$item->Dimensions,
						'MARK' => $this->_getMark( (string)$item->CodeERP ),
						'INSTOCK' => $this->_getStock( (string)$item->CodeERP ),
						'MATTER' => (string)$item->MaterialPL,
						'COLOR' => (string)$item->ColorPL,
						'COUNTRY' => (string)$item->CountryOfOrigin,
						'CATALOG' => sprintf( "%s (%s)", (string)$item->Catalog, $page_test ),
						'PACKAGE' => array(
							'SINGLE' => (string)$item->IndividualPacking,
							'TOTAL' => (string)$item->ExportCtnQty,
							'DIM' => (string)$item->CtnDimensions,
							'WEIGHT' => sprintf( "%s kg", (string)$item->CtnWeightKG ),
							'INSIDE' => (string)$item->InnerCtnQty,
						),
						
					)
				);
				
			}
			
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
			
			echo "<!--MARK";
			//print_r( $mark );
			echo "-->";
			
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
