<?php

class XMLMan{
	private $_debug = false;
	private $_proxy = array();
	private $_data = array(
		'menu' => array(),
		'items' => array(),
		
	);
	
	public function __construct(){
		if( $this->_debug === true) echo "\r\nXMLMan loaded!\r\n";
		
	}
	
	// dodawanie obsługi modułu dla sklepu
	public function addSupport( &$handler ){
		$this->_proxy[] = $handler;
		
	}
	
	/*
		Funkcja inicjująca wszystkie moduły
	*/
	public function init(){
		
		$found = array();
		foreach( $this->_proxy as $handler ){
			//$handler->check();
			$data = $handler->init();
			$this->_data['menu'] = array_merge( $this->_data['menu'], $data['menu'] );
			
			if( !empty( $_GET['code'] ) ){
				$item = $handler->search( $_GET['code'] );
				if( !empty( $item ) ) $this->_data['items'] = array_merge( $this->_data['items'], $item );
				
			}
			elseif( !empty( $_GET[ 'nazwa' ] ) ){
				$item = $handler->search( $_GET[ 'nazwa' ], true );
				if( !empty( $item ) ) $this->_data[ 'items' ] = array_merge( $this->_data[ 'items' ], $item );
				
			}
			else{
				$this->_data['items'] = array_merge( $this->_data['items'], $data['items'] );
				
			}
			
		}
		
		// echo "<!--DATA\r\n";
		//print_r( $data );
		//print_r( $this->_data );
		//print_r( array_slice( $data['items'], 0, 10 ) );
		// echo "-->";
		//$this->printCat( $this->_data['menu'] );
		//$this->printProducts( $this->_data['items'] );
		
	}
	
	/*
		Funkcja aktualizująca zasoby
	*/
	public function update(){
		foreach( $this->_proxy as $handler ){
			$handler->check();
			
		}
		
	}
	
	// funckja zwracająca tablicę z danymi
	public function getData(){
		return $this->_data;
		
	}
	
	// funkcja rekurencyjna wypisująca listę kategorii
	public function printCat( Array $root ){
		echo "<ol>";
		foreach( $root as $name => $item ){
			if( count( $item ) ){
				//echo "<li>$name</li>";
				//printf( "<li><a href='%s'>%s</a></li>", "?cat={$this->stdNameCache( $name )}" , $name );
				printf( "<li>%s</li>", $name );
				$this->printCat( $item );
				
			}
			else{
				//echo "<li>$name</li>";
				printf( "<li><a href='%s'>%s</a></li>", "?cat={$this->stdNameCache( $name )}" , $name );
				
				
			}
			
		}
		
		echo "</ol>";
		
	}
	
	// funkcja wypisująca produkty
	public function printProducts( Array $arr ){
		foreach( $arr as $item ){
			$gallery = array();
			foreach( $item['IMG'] as $img ){
				$gallery[] = sprintf( "<a href='%s' target='_blank'>%s</a>", $img, $img );
				
			}
			
			printf( "
			<table border=1>
			<tr>
				<td>%s ( ID: <a href='?search_id=%s'>%s</a> )</td>
			</tr>
			<tr>
				<td>Wymiar:<br>%s</td>
			</tr>
			<tr>
				<td>Opis:<br>%s</td>
			</tr>
			<tr>
				<td>Galeria:<br>%s</td>
			</tr>
			<tr>
				<td>Stan magazynowy:<br>%u</td>
			</tr>", 
			$item['NAME'], $item['ID'], $item['ID'], $item['DIM'], $item['DSCR'], implode( "<br>", $gallery ), $item['INSTOCK'] );
			
			echo "<tr><td>Znakowanie: <table>";
			if( !empty( $item['MARK'] ) ){
				foreach( $item['MARK'] as $size => $item ){
					foreach( $item as $type ){
						printf( "<tr><td>%s (%s)</td></tr>", $type, $size );
						
					}
					
				}
				
			}
			else{
				printf( "<tr><td>%s</td></tr>", "Brak znakowania" );
				
			}
			
			echo "</table></td></tr>";
			
			echo "</table><br><br>";
			
		}
		
	}
	
	// funkcja standaryzująca zapis nazw, dla CACHE
	protected function stdNameCache( $name ){
		$find = explode( ",", " ,Ą,Ę,Ż,Ź,Ó,Ł,Ć,Ń,Ś,ą,ę,ż,ź,ó,ł,ć,ń,ś" );
		$replace = explode( ",", "_,a,e,z,z,o,l,c,n,s,a,e,z,z,o,l,c,n,s" );
		
		return str_replace( $find, $replace, strtolower( strip_tags( (string)$name ) ) );
		
	}
	
}
