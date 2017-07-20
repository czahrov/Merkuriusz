<?php
/*
	Template Name: Kalkulator AJAX
*/

if( !isAjax() ){
	header( "Location:" . home_url() );
	exit;
}

print_r( $_POST );

$total = 0;
$num = (int)$_POST[ 'num' ];
foreach( $_POST[ 'order' ] as $type => $items ){
	$t = markPrice( $type, $num, count( $items ) );
	if( $t === false ){
		echo "[res:Nieobsługiwany typ znakowania]";
		exit;
		
	}
	else{
		$total += $t;
		
	}
	
}

printf( "[res:%.2f PLN]", $total );
