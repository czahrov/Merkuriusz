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
				foreach( $product->categories->category as $category ){
					//$this->genMenuTree( $category, $ret );
					
					//$name = $this->stdNameCache( (string)$category->name );
					//$ret[ $name ] = $this->genMenuTree( $category );
					$ret = array_merge_recursive( $ret, $this->genMenuTree( $category ) );
					
				}
				
			}
			
		}
		
		return array(
			'EASY_GIFTS' => $ret,
			
		);
		
	}
	
	// funkcja rekurencyjna tworząca drzewo podkategorii danej kategorii
	private function genMenuTree( SimpleXMLElement $category ){
		$ret = array();
		$cat_name = $this->stdNameCache( (string)$category->name );
		//$ret[ $cat_name ] = array();
		
		foreach( $category->subcategories->subcategory as $subcategory ){
			$subcat_name = $this->stdNameCache( (string)$subcategory->name );
			
			if( $subcategory->subcategories->count() === 0 ){
				$ret[$cat_name][ $subcat_name ] = array();
				
			}
			else{
				//$ret[ $cat_name ][ $subcat_name ] = $this->genMenuTree( $subcategory );
				$ret[ $cat_name ] = $this->genMenuTree( $subcategory );
				
			}
			
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
				foreach( $item->images->children() as $image ){
					$img[] = (string)$image;
				}
				
				$cat = array();
				foreach( $item->categories->category as $category ){
					$cat = array_merge_recursive( $cat, $this->genMenuTree( $category ) );
					
				}
				
				$mark = array();
				$mark_size = (string)$item->marking_size;
				if( empty( $mark_size ) ) $mark_size = '???';
				foreach( $item->markgroups->markgroup as $group ){
					$mark_type = (string)$group->name;
					if( empty( $mark_type ) ) $mark_type = '???';
					$mark[ $mark_size ][] = $mark_type;
					
				}
				
				$ret[] = array(
					'ID' => (string)$item->baseinfo->code_full,
					'NAME' => (string)$item->baseinfo->name,
					'DSCR' => (string)$item->baseinfo->intro,
					'IMG' => $img,
					'CAT' => $cat,
					'DIM' => (string)$item->attributes->size,
					'MARK' => $mark,
					'INSTOCK' => $this->getStock( (int)$item->baseinfo->id ),
					
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
