<?php
class AXPOL extends XMLAbstract{
	//protected $_debug = false;
	//protected $_cache_write = false;
	//protected $_cache_read = false;
	
	// konstruktor
	public function __construct(){
		$this->logger( "" . __CLASS__ . " loaded!", __FUNCTION__, __CLASS__ );
		//$this->_config['refresh'] = 60 * 60 * 24;		// 24h
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
						//$img[] = $t;
						$t2 = $i === 1?( 'fotob' ):( 'foto_add_big' );
						$img[] = sprintf( "http://axpol.com.pl/files/%s/%s", $t2, $t );
						
					}
					
				}
				
				$cat = array();
				$catalog = (string)$item->Catalog;
				if( empty( $catalog ) ) $catalog = "Bez katalogu";
				
				$cat_name = (string)$item->MainCategoryPL;
				if( empty( $cat_name ) ) $cat_name = "Pozostałe";
				switch( $cat_name ){
					case 'DO PISANIA':
						$cat_name = 'materiały piśmiennicze';
						
					break;
					
				}
				
				$subcat_name = (string)$item->SubCategoryPL;
				
				/* dostosowanie nazwy kategorii pod nazwy z menu na stronie */
				$cat[ $catalog ] = array();
				$cat[ $cat_name ] = array();
				
				if( !empty( $subcat_name ) ){
					$cat[ $subcat_name ] = array();
					
				}
				
				/*	oryginał
				if( empty( $subcat_name ) ){
						$cat[ $catalog ][ $cat_name ] = array();
					
				}
				else{
					$cat[ $catalog ][ $cat_name ][ $subcat_name ] = array();
					
				}
				*/
				
				$ret[] = array(
					'ID' => (string)$item->CodeERP,
					'NAME' => (string)$item->TitlePL,
					'DSCR' => (string)$item->DescriptionPL,
					'IMG' => $img,
					'CAT' => $cat,
					'DIM' => (string)$item->Dimensions,
					'MARK' => $this->_getMark( (string)$item->CodeERP ),
					'INSTOCK' => $this->_getStock( (string)$item->CodeERP ),
					
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
