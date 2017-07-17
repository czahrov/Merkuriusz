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
			foreach( $this->_XML[ $file ]->children() as $category ){
				if( !strlen( (string)$category->name ) ) continue;
				$cat_name = $this->stdName( (string)$category->name );
				$ret[ $cat_name ] = array();
				$p =& $ret[ $cat_name ];
				
				foreach( $category->subcategories->children() as $subcategory ){
					if( !strlen( (string)$subcategory->name ) ) continue;
					$subcat_name = $this->stdName( (string)$subcategory->name );
					if( !array_key_exists( $subcat_name, $p ) ){
						$p[ $subcat_name ] = array();
						
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
				foreach( $item->categories->children() as $category ){
					$cat_name = $this->stdNameCache( (string)$category->name );
					foreach( $category->subcategories->children() as $subcategory ){
						$subcat_name = $this->stdNameCache( (string)$subcategory->name );
						$cat[ $cat_name ][ $subcat_name ] = array();
						
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
				
				$ret[] = array(
					'ID' => (string)$item->baseinfo->code_full,
					'NAME' => (string)$item->baseinfo->name,
					'DSCR' => (string)$item->baseinfo->intro[0],
					'IMG' => $img,
					'CAT' => $cat,
					'DIM' => (string)$item->attributes->size,
					'MARK' => $mark,
					'INSTOCK' => $this->_getStock( (string)$item->baseinfo->code_full ),
					
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
