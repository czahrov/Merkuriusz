<?php
/*
	Template Name: Kalkulator AJAX
*/

if( !isAjax() ){
	header( "Location:" . home_url() );
	exit;
}

// print_r( $_POST );

/* wycena ze znakowaniem */
if( !empty( $_POST[ 'mark' ] ) && $_POST[ 'mark' ] !== 'brak' ){
	$markPrice = markPrice( $_POST[ 'mark' ], $_POST[ 'num' ], $_POST[ 'colors' ] );

	if( $markPrice === false ){
		echo 'fail';
		
	}
	else{
		// print_r( $markPrice );
		
		$ret = array(
			'name' => sprintf( "%s, kolory: %s", $_POST[ 'nazwa' ], $_POST[ 'colors' ] ),
			'num' => $_POST[ 'num' ],
			'type' => $_POST[ 'mark' ],
			
		);

		$lines = array(
			'lines' => array(
				array_merge(		// produkt
					array(
						'title' => $_POST[ 'nazwa' ],
						
					),
					array(
						'formula' => sprintf( "%s x %.2f", $_POST[ 'num' ], $_POST[ 'price' ] ),
						'total' => sprintf( "%.2f", $_POST[ 'num' ] * $_POST[ 'price' ] ),
						
					)
					
				),
				$markPrice[ 'prepare' ],
				$markPrice[ 'marking' ],
				$markPrice[ 'colors' ],
				// $markPrice[ 'repeat' ],
				$markPrice[ 'packing' ],
				$markPrice[ 'added' ]
				
			),
			
		);
		
		$total = (float)$markPrice[ 'total' ] + (float)$_POST[ 'num' ] * (float)$_POST[ 'price'];
		// var_dump( array( (float)$ret[ 'total '], (float)$_POST[ 'num' ], (float)$_POST[ 'price'] ) );
		// var_dump( $ret );
		$ret[ 'total' ] = sprintf( "%.2f", $total );
		
		$ret = array_merge(
			$lines,
			$ret
		 
		);

		print_r( json_encode( $ret ) );
		
	}

}
/* wycena BEZ znakowania */
else{
	echo( json_encode( array(
		'total' => sprintf( "%.2f", (float)$_POST[ 'num' ] * (float)$_POST[ 'price' ] ),
		'lines' => array(
			array(
				'title' => $_POST[ 'nazwa' ],
				'formula' => sprintf( "%s x %.2f", $_POST[ 'num' ], $_POST[ 'price' ] ),
				'total' => sprintf( "%.2f", (float)$_POST[ 'num' ] * (float)$_POST[ 'price' ] ),
				
			),
			
		),
		
	) ) );
	
}

