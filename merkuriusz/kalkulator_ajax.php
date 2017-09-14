<?php
/*
	Template Name: Kalkulator AJAX
*/

if( !isAjax() ){
	header( "Location:" . home_url() );
	exit;
}

// print_r( $_POST );

$markPrice = markPrice( $_POST[ 'mark' ], $_POST[ 'num' ] );

if( $markPrice === false ){
	echo 'fail';
	
}
else{
	$ret = array_merge(
		array(
			'name' => $_POST[ 'nazwa' ],
			'num' => $_POST[ 'num' ],
			'type' => $_POST[ 'mark' ],
		),
		array(
			'price' => array(
				'formula' => sprintf( "%s x %.2f", $_POST[ 'num' ], $_POST[ 'price' ] ),
				'total' => sprintf( "%.2f", $_POST[ 'num' ] * $_POST[ 'price' ] ),
			)
		),
		$markPrice
	);

	$total = (float)$ret[ 'total' ] + (float)$_POST[ 'num' ] * (float)$_POST[ 'price'];
	// var_dump( array( (float)$ret[ 'total '], (float)$_POST[ 'num' ], (float)$_POST[ 'price'] ) );
	// var_dump( $ret );
	$ret[ 'total' ] = sprintf( "%.2f", $total );

	print_r( json_encode( $ret ) );
	
}
