<?php
/*
	Template Name: Produkt - single
*/
	get_header();
	
	parse_str( $_SERVER[ 'QUERY_STRING' ], $params );
	// $_SESSION = array_merge( $_SESSION, $params );
	!empty( $params[ 'strona' ] )?( config( 'strona', $params[ 'strona' ] ) ):( config( 'strona', 1 ) );
	
	require_once "XML.php";
	
	$XMLData = $XM->getData();
	echo "<!--";
	// echo count( $XMLData[ 'items' ] );
	echo "-->";
	
	if( count( $XMLData[ 'items' ] ) === 0 ){
		require get_template_directory() . "/template/view-multi.php";
		
	}
	elseif( count( $XMLData[ 'items' ] ) === 1 ){
		$item = $XMLData[ 'items' ][0];
		require get_template_directory() . "/template/view-single.php";
		
	}
	elseif( count( $XMLData[ 'items' ] ) > 1 ){
		require get_template_directory() . "/template/view-multi.php";
		
	}
