<?php
/*
	Template Name: Produkt - single
*/
	get_header();
	
	parse_str( $_SERVER[ 'QUERY_STRING' ], $params );
	// $_SESSION = array_merge( $_SESSION, $params );
	!empty( $params[ 'strona' ] )?( config( 'strona', $params[ 'strona' ] ) ):( config( 'strona', 1 ) );
	
	require_once "XML.php";
	
	$XMLData = array(
		'items' => array(),
		
	);
	
	if( !empty( $_GET[ 'code' ] ) ){
		$XMLData[ 'items' ] = $XM->getProducts( 'single', $_GET[ 'code' ] );
		
	}
	elseif( !empty( $_GET[ 'cat' ] ) ){
		header( sprintf( "Location:%s", home_url( "kategoria?cat={$_GET[ 'cat' ]}" ) ) );
		
	}
	/* elseif( !empty( $_GET[ 'nazwa' ] ) ){
		$XMLData[ 'items' ] = $XM->getProducts( 'custom', "WHERE `title` LIKE '%{$_GET[ 'nazwa' ]}%' OR `description` LIKE '%{$_GET[ 'nazwa' ]}%' OR `code` LIKE '%{$_GET[ 'nazwa' ]}%'" );
		
	} */
	
	echo "<!--SINGLE\r\n";
	// echo count( $XMLData[ 'items' ] );
	echo "-->";
	
	if( count( $XMLData[ 'items' ] ) === 0 ){
		require get_template_directory() . "/template/view-multi.php";
		
	}
	elseif( count( $XMLData[ 'items' ] ) === 1 ){
		require get_template_directory() . "/template/view-single.php";
		
	}
	elseif( count( $XMLData[ 'items' ] ) > 1 ){
		require get_template_directory() . "/template/view-multi.php";
		
	}
