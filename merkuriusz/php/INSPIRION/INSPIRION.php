<?php
class INSPIRION extends XMLAbstract {
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
			"http://inspirion.pl/sites/default/files/exports/products.xml"
		);
		
	}
	
	// funkcja importująca dane o budowie menu w formie tablicy
	protected function getMenu(){
		//return array();
		$ret = array();
		$file = "products.xml";		// plik do załadowania
		
		if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
			$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
			
		}
		else{
			$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
			foreach( $this->_XML[ $file ]->children() as $item ){
				$cat_name = $this->stdNameCache( (string)$item->catalog );
				if( !empty( $cat_name ) ) $ret[ $cat_name ] = array();
				$cat2_name = $this->stdNameCache( (string)$item->catalog_special );
				if( !empty( $cat2_name ) ) $ret[ $cat2_name ] = array();
				
				
			}
			
		}
		
		//return $ret;
		return array(
			'INSPIRION' => $ret,
			
		);
		/*
		*/
		
	}
	
	// funkcja importująca dane o produktach w formie tablicy
	protected function getProducts(){
		//return array();
		$ret = array();
		$file = "products.xml";		// plik do załadowania
		if( !array_key_exists( $file, $this->_XML ) or $this->_XML[ $file ] === false ){
			$this->logger( "plik $file nie został prawidłowo wczytany!", __FUNCTION__, __CLASS__ );
			
		}
		else{
			$this->logger( "odczyt XML z pliku $file", __FUNCTION__, __CLASS__ );
			foreach( $this->_XML[ $file ]->node as $item ){
				
				//preg_match_all( "~http://inspirion.pl/.*?\.\w{3}~", (string)$item->product_images, $img );
				preg_match_all( "~http://.*?\.\w{3}~", (string)$item->product_images, $img );
				
				/*
				print_r( array(
					'id' => (string)$item->sku,
					'images' => (string)$item->product_images,
					'img' => $img,
				) );
				*/
				
				$cat = array();
				$cat_name = $this->stdNameCache( (string)$item->catalog );
				if( !empty( $cat_name ) ) $cat[ $cat_name ] = array();
				$cat2_name = $this->stdNameCache( (string)$item->catalog_special );
				if( !empty( $cat2_name ) ) $cat[ $cat2_name ] = array();
				
				$mark = array();
				$t = (string)$item->{'Imprint-size'};
				if( !empty( $t ) ){
					preg_match_all( "/(\S+):(\d+x\d+)/", $t, $match );
					foreach( $match[1] as $key => $val ){
						$type = $match[1][ $key ];
						$size = $match[2][ $key ];
						$mark[ $size ][] = $type;
						
					}
				}
				
				$ret[] = array(
					'ID' => (string)$item->sku,
					'NAME' => (string)$item->product_name,
					'DSCR' => (string)$item->body,
					'IMG' => $img[0],
					'CAT' => $cat,
					'DIM' => (string)$item->wymiary,
					'MARK' => $mark,
					'INSTOCK' => '???',
					
				);
				
			}
			
		}
		
		echo "<!--";
		//print_r( array_slice( $ret, 0, 10 ) );
		echo "-->";
		
		return $ret;
	}
	
}
