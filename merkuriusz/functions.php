<?php
add_theme_support('post-thumbnails');

if( !is_admin() ){
	wp_enqueue_style( "boostrap", get_template_directory_uri() . "/css/bootstrap.css", array() );
	wp_enqueue_style( "fonts", get_template_directory_uri() . "/css/fonts.css", array() );
	wp_enqueue_style( "font-awesome", get_template_directory_uri() . "/css/font-awesome.min.css", array() );
	wp_enqueue_style( "facepalm", get_template_directory_uri() . "/css/facepalm.css", array() );
	wp_enqueue_style( "style", get_template_directory_uri() . "/style.css", array() );
	wp_enqueue_style( "style_dawid", get_template_directory_uri() . "/css/override.css", array() );
	
	wp_enqueue_script( "jQ", get_template_directory_uri() . "/js/jquery.js" );
	wp_enqueue_script( "boostrap", get_template_directory_uri() . "/js/bootstrap.min.js" );
	wp_enqueue_script( "TweenLite", get_template_directory_uri() . "/js/TweenLite.min.js" );
	wp_enqueue_script( "CSSPlugin", get_template_directory_uri() . "/js/CSSPlugin.min.js" );
	wp_enqueue_script( "ScrollToPlugin", get_template_directory_uri() . "/js/ScrollToPlugin.min.js" );
	wp_enqueue_script( "gmap3", get_template_directory_uri() . "/js/gmap3.min.js" );
	wp_enqueue_script( "mapa", get_template_directory_uri() . "/js/mapa.js" );
	wp_enqueue_script( "touchSwipe", get_template_directory_uri() . "/js/jquery.touchSwipe.min.js" );
	wp_enqueue_script( "main", get_template_directory_uri() . "/js/main.js" );
	wp_enqueue_script( "facepalm", get_template_directory_uri() . "/js/facepalm.js" );
}

// funkcje

function genSibPage(){
	$current = get_post();
	$root = get_post( $current->post_parent );
	$pages = get_pages(array(
		'parent' => $root->ID,
		
	));
	
	if( count( $pages ) > 0 ){
		echo "<ul>";
		
		foreach( $pages as $page ){
			$addon = $page->post_name === $current->post_name?( ' selected ' ):( '' );
			printf( "<li class='%s'><a href='%s'>%s</a></li>", $addon, get_permalink( $page->ID ), $page->post_title );
			
		}
		
		echo "</ul>";
		
	}
	
	
}

function search_by_cat(){
    if ( is_search() )
    {
        $cat = empty( $_GET['cat'] ) ? '' : (int) $_GET['cat'];
        add_query_arg( 'cat', $cat );
    }
}

function config( $var = null, $val = null ){
	if( $var !== null ){
		// getter
		if( $val === null ){
			if( !empty( $_SESSION['config'][ $var ] ) ){
				return $_SESSION['config'][ $var ];
				
			}
			else return false;
			
		}
		// setter
		else{
			$_SESSION['config'][ $var ] = $val;
			return true;
			
		}
		
	}
	else return $_SESSION['config'];
	
}

// sprawdza czy strona została otworzona poprzez AJAXa
function isAjax(){
	return $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest";
}

function markTypes( $type ){
	/*
		AXPOL
			+T1, +T2, +T3, +T4
			-TF1, -TF2, -TF3, -TF4
			+TC, -TC1, -TC2
			-L0, +L1, +L2, +L3, -L4
			+S1, +S2, -S3, -S4
			-SL
			-FC1, -FC2
			-D
			-H
		
	*/
	$data = array(
		'T1' => array(
			'przygotowanie' => 35.00,
			'powtórzenie' => 15.00,
			'pakowanie' => 0.00,
			'ryczałt' => array(
				0		=> 65.00,
			),
			'price' => array(
				250		=> 0.21,
				500		=> 0.18,
				1000		=> 0.15,
				2000		=> 0.13,
				5000		=> 0.10,
				10000	=> 0.08,
				20000	=> 0.07,
				50000	=> 0.06,
				
			),
			
		),
		'T2' => array(
			'przygotowanie' => 35.00,
			'powtórzenie' => 15.00,
			'pakowanie' => 0.05,
			'ryczałt' => array(
				0		=> 70.00,
			),
			'price' => array(
				100		=> 0.34,
				250		=> 0.30,
				500		=> 0.24,
				1000		=> 0.18,
				2000		=> 0.16,
				5000		=> 0.15,
				10000	=> 0.13,
				20000	=> 0.12,
				50000	=> 0.09,
				
			),
			
		),
		'T3' => array(
			'przygotowanie' => 35.00,
			'powtórzenie' => 15.00,
			'pakowanie' => 0.08,
			'ryczałt' => array(
				0		=> 80.00,
			),
			'price' => array(
				50		=> 0.55,
				100		=> 0.50,
				250		=> 0.45,
				500		=> 0.40,
				1000		=> 0.35,
				2000		=> 0.32,
				5000		=> 0.30,
				10000	=> 0.28,
				20000	=> 0.26,
				50000	=> 0.23,
				
			),
			
		),
		'T4' => array(
			'przygotowanie' => 35.00,
			'powtórzenie' => 15.00,
			'pakowanie' => 0.10,
			'ryczałt' => array(
				0		=> 90.00,
			),
			'price' => array(
				50		=> 0.90,
				100		=> 0.80,
				250		=> 0.75,
				500		=> 0.70,
				1000		=> 0.65,
				2000		=> 0.60,
				5000		=> 0.55,
				10000	=> 0.53,
				20000	=> 0.50,
				50000	=> 0.45,
				
			),
			
		),
		'L1' => array(
			'przygotowanie' => 15.00,
			'powtórzenie' => 15.00,
			'pakowanie' => 0.00,
			'ryczałt' => array(
				0		=> 45.00,
				20	=> 0.00,
			),
			'price' => array(
				20		=> 0.99,
				50		=> 0.89,
				100		=> 0.79,
				250		=> 0.65,
				500		=> 0.49,
				1000		=> 0.35,
				2000		=> 0.29,
				5000		=> 0.24,
				10000	=> 0.19,
				
			),
			
		),
		'L2' => array(
			'przygotowanie' => 15.00,
			'powtórzenie' => 15.00,
			'pakowanie' => 0.08,
			'ryczałt' => array(
				0		=> 55.00,
				20	=> 0.00,
			),
			'price' => array(
				20		=> 1.45,
				50		=> 1.29,
				100		=> 1.19,
				250		=> 0.99,
				500		=> 0.79,
				1000		=> 0.65,
				2000		=> 0.59,
				5000		=> 0.45,
				
			),
			
		),
		'L3' => array(
			'przygotowanie' => 15.00,
			'powtórzenie' => 15.00,
			'pakowanie' => 0.10,
			'ryczałt' => array(
				0		=> 60.00,
				20	=> 0.00,
			),
			'price' => array(
				20		=> 1.69,
				50		=> 1.49,
				100		=> 1.39,
				250		=> 1.19,
				500		=> 0.99,
				1000		=> 0.79,
				2000		=> 0.69,
				5000		=> 0.55,
				
			),
			
		),
		'S1' => array(
			'przygotowanie' => 48.00,
			'powtórzenie' => 28.00,
			'pakowanie' => 0.10,
			'ryczałt' => array(
				0		=> 70.00,
				50	=> 60.00,
			),
			'price' => array(
				50		=> 1.20,
				100		=> 1.00,
				250		=> 0.90,
				500		=> 0.80,
				1000		=> 0.70,
				2000		=> 0.65,
				5000		=> 0.60,
				10000	=> 0.55,
				20000	=> 0.53,
				50000	=> 0.50,
				
			),
			
		),
		'S2' => array(
			'przygotowanie' => 48.00,
			'powtórzenie' => 28.00,
			'pakowanie' => 0.15,
			'ryczałt' => array(
				0		=> 80.00,
				50	=> 70.00,
			),
			'price' => array(
				50		=> 1.55,
				100		=> 1.40,
				250		=> 1.20,
				500		=> 1.15,
				1000		=> 1.00,
				2000		=> 0.90,
				5000		=> 0.75,
				10000	=> 0.65,
				20000	=> 0.55,
				50000	=> 0.53,
				
			),
			
		),
		'TC' => array(
			'przygotowanie' => 48.00,
			'powtórzenie' => 30.00,
			'pakowanie' => 0.15,
			'ryczałt' => array(
				0		=> 80.00,
				20	=> 0.00,
			),
			'price' => array(
				20		=> 3.15,
				50		=> 2.95,
				100		=> 2.75,
				250		=> 2.65,
				500		=> 2.45,
				1000		=> 2.25,
				2000		=> 2.15,
				5000		=> 1.99,
				
			),
			
		),
		
	);
	
	if( !empty( $data[ $type ] ) ){
		return $data[ $type ];
		
	}
	else{
		return false;
		
	}
	
}

function markPrice( $type, $num, $repeat = 1 ){
	$item = markTypes( $type );
	
	if( $item === false ) return false;
	
	$ret = array(
		'prepare' => array(
			'title' => 'Przygotowanie do znakowania',
			'formula' => sprintf( "%s x %.2f", 1, $item[ 'przygotowanie' ] ),
			'total' => sprintf( "%.2f", 1 * $item[ 'przygotowanie' ] ),
		),
		'repeat' => array(
			'title' => 'Powtórzenie',
			'formula' => sprintf( "%s x %.2f", ( $repeat - 1 ), $item[ 'powtórzenie' ] ),
			'total' => sprintf( "%.2f", ( $repeat - 1 ) * $item[ 'powtórzenie' ] ),
		),
		'packing' => array(
			'title' => 'Pakowanie',
			'formula' => sprintf( "%s x %.2f", $num, $item[ 'pakowanie' ] ),
			'total' => sprintf( "%.2f", $num * $item[ 'pakowanie' ] ),
		),
		
	);
	
	
	$cena = $item[ 'przygotowanie' ] + $item[ 'powtórzenie' ] * ( $repeat - 1 ) + $item[ 'pakowanie' ] * $num;
	
	reset( $item[ 'ryczałt' ] );
	$found = null;
	do{
		$found = current( $item[ 'ryczałt' ] );
	}
	while( next( $item[ 'ryczałt' ] ) !== false && $num > key( $item[ 'ryczałt' ] ) );
	$cena += (float)$found;
	
	$ret[ 'added' ] = array(
		'title' => 'Ryczałt',
		'formula' => sprintf( "%s x %.2f", 1, $found ),
		'total' => sprintf( "%.2f", $found ),
	);
	
	
	reset( $item[ 'price' ] );
	$found = null;
	do{
		$found = current( $item[ 'price' ] );
	}
	while( next( $item[ 'price' ] ) !== false && $num > key( $item[ 'price' ] ) );
	$cena += (float)$found * $num;
	
	$ret[ 'marking' ] = array(
		'title' => 'Znakowanie',
		'formula' => sprintf( "%s x %.2f", $num, $found ),
		'total' => sprintf( "%.2f", $num * $found ),
	);
	
	
	$ret[ 'total' ] = sprintf( "%.2f", $cena );
	
	return $ret;
}

function cartStatus(){
	// zwracanie stanu koszyka
	$total = 0;
	
	if( count( $_SESSION[ 'cart' ] ) > 0 ) foreach( $_SESSION[ 'cart' ] as $set ){
		// print_r( $set );
		$marking = markPrice( $set[ 'mark' ][ 'type' ], $set[ 'num' ] );
		if( $marking === false ){
			$marking = 0;
			
		}
		else{
			$marking = $marking[ 'total' ];
			
		}
		$total += (float)$set[ 'price' ] * (float)$set[ 'num' ] + (float)$marking;
		
	}
	
	return array(
		'num' => count( $_SESSION[ 'cart' ] ),
		'price' => sprintf( "%.2f", $total ),
		
	);
	
}

// action hook

add_action( 'pre_get_posts', 'search_by_cat' );

add_action( 'breadcrumb', function( $arg = '' ){
	/*
	$cat = $_GET['cat'];
	if( empty( $cat ) ) return '';
	$part = explode( ",", $cat );
	$t = array_slice( $part, 0, -1 );
	$t[] = explode( "-", end( $part ) )[1];
	if( !empty( $arg ) ) $t[] = $arg;
	
	$ret = str_replace( "_", " ", implode( " > ", $t ) );
	*/
	
	echo implode( " > ", $_SESSION[ 'breadc' ] );
	
} );

add_action( 'num_switcher', function( $arg ){
	$query = $_SERVER[ 'QUERY_STRING' ];
	parse_str( $query, $args );
	
	//$arr = array( 20, 40, 100 );
	$arr = array( 12,24,48,96 );
	
	if( array_key_exists( 'num', $args ) ){
		$num = (int)$args[ 'num' ];
		
	}
	elseif( config( 'num' ) !== false ){
		$num = (int)config( 'num' );
		
	}
	else{
		$num = (int)$arr[0];
		
	}
	
	config( 'num', $num );
	
	echo "Na stronie:";
	
	foreach( $arr as $item ){
		$active = $item === $num?( ' active' ):( '' );
		$t = $args;
		$t[ 'strona' ] = 1;
		$t[ 'num' ] = $item;
		$url = http_build_query( $t );
		printf( "<a class='flex flex-items-center flex-justify-center%s' href='?%s'>%s</a>", $active, $url, $item );
		
	}
	
} );

add_action( 'kafelki_kategoria', function( $arg ){
	/*
	Array(
		[ID] => V2560-03
		[NAME] => Wizytownik
		[DSCR] => Wizytownik, etui na karty kredytowe, 7 przegródek
		[IMG] => Array(
			[0] => http://axpol.com.pl/files/fotob/V2560_03_A.jpg
			[1] => http://axpol.com.pl/files/foto_add_big/V2560_03_B.jpg
			[2] => http://axpol.com.pl/files/foto_add_big/V2560_A.jpg
		)

		[CAT] => Array(
			[VOYAGER 2017] => Array(
					[BIURO] => Array(
							[wizytowniki] => Array(
							)

					)

			)

			[BIURO] => Array(
			)

		)

		[DIM] => 11 x 7,5 x 2,1 cm
		[MARK] => Array(
				[60x40 (item underside)] => Array(
						[0] => T2
						[1] => L2
					)

			)

		[INSTOCK] => 0
	)
	*/
	$num = config( 'num' );
	$page = config( 'strona' );
	$pagin = array_chunk( $arg, $num );
	if( !empty( $pagin[ $page - 1 ] ) ){
		foreach( $pagin[ $page - 1 ] as $item ){
			printf( "<div class='item base1 base2-ms base3-mm base4-ds flex'>
							<div class='wrapper grow flex flex-column'>
								<div class='img bgimg contain' style='background-image:url(%s);'>
									<a href='%s'></a>
								</div>
								<div class='title bold'>
									<a href='%s'>
										%s
									</a>
								</div>
								<div class='code'>Kod produktu: <span class='bold'>%s</span></div>
							</div>
						</div>",
				$item['IMG'][0], 
				home_url( "produkt?cat={$_GET['cat']}&code={$item['ID']}" ), 
				home_url( "produkt?cat={$_GET['cat']}&code={$item['ID']}" ), 
				$item['NAME'], 
				$item['ID'] );
			
		}
		
	}
	else{
		printf( "<div class='%s'>%s</div>",
			'noitems',
			'Brak produktów w tej kategorii'
		);
		
	}
	
} );

add_action( 'number', function( $arg ){
	if( $arg > 0 ){
		$total = $arg;
		//$perpage = !empty( $_SESSION['num'] )?( (int)$_SESSION['num'] ):( !empty( $_GET['num'] )?( (int)$_GET['num'] ):( 20 ) );
		$perpage = config( 'num' );
		//$strona = !empty( $_GET['strona'] )?( (int)$_GET['strona'] ):( 1 );
		$strona = config( 'strona' );
		
		printf( "Produktów %u-%u / %u",
			1 + ( $strona - 1) * $perpage,
			min( $strona * $perpage, $total ),
			$total
		);
		
	}
	else{
		echo "- brak produktów -";
		
	}
	
} );

add_action( 'kategoria_pagin_next', function( $arg ){
	$query = $_SERVER[ 'QUERY_STRING' ];
	parse_str( $query, $args );
	
	$total = $arg;
	//$perpage = !empty( $_SESSION['num'] )?( (int)$_SESSION['num'] ):( !empty( $args['num'] )?( (int)$args['num'] ):( 20 ) );
	$perpage = (int)config( 'num' );
	//$strona = !empty( $args['strona'] )?( (int)$args['strona'] ):( 1 );
	$strona = (int)config( 'strona' );
	
	if( $strona * $perpage <= $total ){
		$args['strona'] = ++$strona;
		printf( "<div class='next base2 grow flex flex-items-center flex-justify-center'>
					<a class='base1 flex flex-items-center flex-justify-center' href='?%s'>Następna strona >></a>
					</div>", 
					http_build_query( $args ) );
		
	}
	
} );

add_action( 'kategoria_pagin_prev', function( $arg ){
	$query = $_SERVER[ 'QUERY_STRING' ];
	parse_str( $query, $args );
	
	$total = $arg;
	//$perpage = !empty( $_SESSION['num'] )?( (int)$_SESSION['num'] ):( !empty( $args['num'] )?( (int)$args['num'] ):( 20 ) );
	$perpage = (int)config( 'num' );
	//$strona = !empty( $args['strona'] )?( (int)$args['strona'] ):( 1 );
	$strona = (int)config( 'strona' );
	
	if( $strona > 1 ){
		$args['strona'] = --$strona;
		printf( "<div class='prev base2 grow flex flex-items-center flex-justify-center'>
					<a class='base1 flex flex-items-center flex-justify-center' href='?%s'><< Poprzednia strona</a>
					</div>", 
					http_build_query( $args ) );
		
	}
	
} );

add_action( 'gen_menu', function( $arg ){
	if( !is_array( $arg ) ) return false;
	
	// echo "<!--";
	// print_r( $arg );
	// echo "-->";
	
	if( !empty( $_GET['cat'] ) ){
		$query = explode( ",", $_GET['cat'] );
		// $query = explode( "-", $_GET['cat'] );
	}
	else{
		$query = array( "", "" );
		
	}
	
	$icon_arrow = "<span class='icon fa fa-angle-right'></span>";
	$icon_double_arrow = "<span class='icon fa fa-angle-double-right'></span>";
	$icon_plus = "<span class='icon'>+</span>";
	
	$_SESSION[ 'breadc' ] = array();
	
	// LISTA GŁÓWNA
	echo "<ul class='menu'>";
	foreach( $arg as $cat_name => $cat_data ){
		$cat_slug = apply_filters( 'stdName', $cat_name );
		if( $query[0] === $cat_slug ){
			$cat_active = 'active';
			if( empty( $_SESSION[ 'breadc' ] ) ) $_SESSION[ 'breadc' ] = array( $cat_name );
			
		}
		else{
			$cat_active = '';
			
		}
		//$cat_active = $query[0] === $cat_slug?( 'active' ):( '' );
		
		// PIERWSZY STOPIEŃ
		printf( "<li class='item flex flex-column %s %s' item-slug='%s' item-title='%s'>
				<div class='head flex flex-items-center'>
					<div class='title uppercase bold'>
						%s
					</div>
					%s
				</div>
				<ul class='sub flex flex-column'>",
		$cat_data['class'],
		$cat_active,
		$cat_slug,
		$cat_name,
		$cat_name,
		!empty( $cat_data[ 'items' ] )?( $icon_arrow ):( '' )
		);
		
		foreach( $cat_data['items'] as $item ){
			$item_slug = apply_filters( 'stdName', $item['title'] );
			//$item_slug = empty( $item[ 'slug' ] )?( apply_filters( 'stdName', $item['title'] ) ):( $item[ 'slug' ] );
			//$item_active = $query[1] === $item_slug?( 'active' ):( '' );
			if( $query[1] === $item_slug ){
				$item_active = 'active';
				if( count( $_SESSION[ 'breadc' ] ) == 1 ) $_SESSION[ 'breadc' ] = array( $cat_name, $item[ 'title' ] );
				
			}
			else{
				$item_active = '';
				
			}
			
			if( empty( $item['sub'] ) ){
				printf( "<a class='item flex flex-column %s %s' href='%s' item-slug='%s' item-title='%s'>",
				$item['class'],
				$item_active,
				// home_url( sprintf( "kategoria?cat=%s-%s", $cat_slug, $item_slug ) ),
				// home_url( sprintf( "kategoria?cat=%s,%s,%s-%s", $cat_slug, $item_slug, $cat_slug, $item_slug ) ),
				$cat_slug === 'gadzety_reklamowe'?(
					home_url( sprintf( "kategoria?cat=%s,%s", $cat_slug, $item_slug ) )
				):(
					home_url( sprintf( "kategoria?cat=%s,%s,%s-%s", $cat_slug, $item_slug, $cat_slug, $item_slug ) )
				),
				$item_slug,
				$item['title']
				);
				
			}
			else{
				printf( "<div class='item flex flex-column %s %s' item-slug='%s' item-title='%s'>",
				$item['class'],
				$item_active,
				$item_slug,
				$item['title']
				);
				
			}
			
				echo "<div class='head grow flex flex-items-center'>";
					if( !empty( $item['pikto'] ) ){
						printf( "<img class='pikto' src='%s/img/piktogramy/%s'>", get_template_directory_uri(), $item['pikto'] );
					}
					if( !empty( $item['title'] ) && empty( $item['logo'] ) ){
						printf( "<div class='title'>%s</div>", $item['title'] );
					}
					if( !empty( $item['logo'] ) ){
						printf( "<div class='logotyp flex grow bgimg contain flex-self-stretch' style='background-image: url(%s/img/logotypy/%s);'></div>", get_template_directory_uri(), $item['logo'] );
					}
					
					if( !empty( $item[ 'sub' ] ) ){
						echo $icon_plus;
						
					}
					else{
						echo $icon_double_arrow;
						
					}
					
				echo "</div>";	
				
			// DRUGI STOPIEŃ
			if( !empty( $item['sub'] ) ){
				echo "<div class='sub flex flex-column'>";
					
					foreach( $item['sub'] as $subitem ){
						$subitem_slug = apply_filters( 'stdName', $subitem[ 'title' ] );
						//$subitem_slug = empty( $subitem[ 'slug' ] )?( apply_filters( 'stdName', $subitem['title'] ) ):( $subitem[ 'slug' ] );
						//$subitem_active = $query[2] === $subitem_slug;
						//$subitem_active = explode( "-", end( $query ) )[1] === $subitem_slug;
						if( explode( "-", end( $query ) )[1] === $subitem_slug ){
							$subitem_active = 'active';
							if( count( $_SESSION[ 'breadc' ] ) == 2 ) $_SESSION[ 'breadc' ] = array( $cat_name, $item[ 'title' ], $subitem[ 'title' ] );
						}
						else{
							$subitem_active = '';
							
						}
						
						printf( "<a class='item flex flex-column %s %s' href='%s' item-slug='%s' item-title='%s'>",
						$item['class'],
						$subitem_active,
						// home_url( sprintf( "kategoria?cat=%s-%s-%s", $cat_slug, $item_slug, $subitem_slug ) ),
						home_url( sprintf( "kategoria?cat=%s,%s,%s-%s", $cat_slug, $item_slug, $item_slug, $subitem_slug ) ),
						$subitem_slug,
						$item['title']
						);
					
							echo "<div class='head grow flex flex-items-center'>";
								if( !empty( $subitem['pikto'] ) ){
									printf( "<img class='pikto' src='%s/img/piktogramy/%s'>", get_template_directory_uri(), $subitem['pikto'] );
								}
								if( !empty( $subitem['title'] ) && empty( $subitem['logo'] ) ){
									printf( "<div class='title'>%s</div>", $subitem['title'] );
								}
								if( !empty( $subitem['logo'] ) ){
									printf( "<div class='logotyp flex grow bgimg contain flex-self-stretch' style='background-image: url(%s/img/logotypy/%s);'></div>", get_template_directory_uri(), $subitem['logo'] );
								}
								
								echo $icon_double_arrow;
								
							echo "</div>";
						
						echo "</a>";
						
					}
				
				echo "</div>";
				
				echo "</div>";
			}
			else{
				echo "</a>";
				
			}
				
		}
			
		echo "</ul>";
		
	}
	echo "</ul>";
	
} );

add_action( 'single-picture', function( $arg ){
	echo "<div class='pic base2 flex flex-column'>";
		printf( "<div class='large bgimg contain pointer' style='background-image: url( %s );'>
					<div class='icon'>
						<span class='fa fa-search-plus'></span>
					</div>
					
				</div>",
		$arg[ 'IMG' ][0]
	);
	
	if( count( $arg['IMG'] ) > 1 ){
		echo "<div class='mini flex'>";
		
			if( count( $arg['IMG'] ) > 3 )
			{
				echo "<div class='nav prev pointer flex flex-items-center flex-justify-center'><span class='icon fa fa-angle-left'></span></div>";
				
			}
			echo "<div class='view grow flex'>";
				
				for( $i=0; $i<count( $arg['IMG'] ); $i++ ){
					printf( "<div class='item bgimg contain base3 no-shrink pointer' style='background-image: url( %s );'></div>", 
						$arg[ 'IMG' ][ $i ]
					);
					
				}
			
			echo "</div>";
			
			if( count( $arg['IMG'] ) > 3 )
			{
				echo "<div class='nav next pointer flex flex-items-center flex-justify-center'><span class='icon fa fa-angle-right'></span></div>";
				
			}
		
		
		echo "</div>";
		
	}
	
	/*
	echo "<div class='download'>
					<a class='flex flex-items-center'>
						do pobrania:
						<span class='bold'>
							???.pdf [???kB]
						</span>
						
					</a>
				</div>";
	*/
	
	echo "</div>";
	
} );

add_action( 'single-dane-main', function( $arg ){
	$id = apply_filters( 'emptyAttr', $arg[ 'ID' ] );
	$name = apply_filters( 'emptyAttr', $arg[ 'NAME' ] );
	$dscr = apply_filters( 'emptyAttr', $arg[ 'DSCR' ] );
	
	echo "<div class='main seg base2'>
		<div class='box'>
			<div class='line code flex flex-items-center'>
				<div class='key'>
					Kod produktu:
				</div>
				<div class='val bold'>
					{$id}
				</div>
				
			</div>
			<div class='line name flex flex-items-center'>
				<div class='key'>
					Nazwa:
				</div>
				<div class='val bold'>
					{$name}
				</div>
				
			</div>
			<div class='line desc flex flex-column flex-justify-center'>
				<div class='key'>
					Opis:
				</div>
				<div class='val bold'>
					{$dscr}
				</div>
				
			</div>
			
		</div>
		
	</div>";
	
} );

add_action( 'single-dane-specyfikacja', function( $arg ){
	/*
	<div class='spec seg'>
		<div class='title uppercase flex flex-items-center'>
			specyfikacja
		</div>
		<div class='box'>
			<div class='line dim flex flex-items-center'>
				<div class='key'>
					Wymiary:
				</div>
				<div class='val bold'>
					0.5 x 9 cm
				</div>
				
			</div>
			<div class='line matter flex flex-items-center'>
				<div class='key'>
					Materiał:
				</div>
				<div class='val bold'>
					Drewno
				</div>
				
			</div>
			<div class='line cat flex flex-items-center'>
				<div class='key'>
					Strona w katalogu:
				</div>
				<div class='val bold'>
					128
				</div>
				
			</div>
			<div class='line color flex flex-items-center'>
				<div class='key'>
					Kolor:
				</div>
				<div class='val bold'>
					naturalny
				</div>
				
			</div>
			
		</div>
		
	</div>
	
	*/
	
	$dim = apply_filters( 'emptyAttr', $arg[ 'DIM' ] );
	$matter = apply_filters( 'emptyAttr', $arg[ 'MATTER' ] );
	$color = apply_filters( 'emptyAttr', $arg[ 'COLOR' ] );
	$country = apply_filters( 'emptyAttr', $arg[ 'COUNTRY' ] );
	$catalog = apply_filters( 'emptyAttr', $arg[ 'CATALOG' ] );
	
	echo "<div class='spec seg'>
		<div class='title uppercase flex flex-items-center'>
			specyfikacja
		</div>
		<div class='box'>
			<div class='line dim flex flex-items-center'>
				<div class='key'>
					Wymiary:
				</div>
				<div class='val bold'>
					{$dim}
				</div>
				
			</div>
			<div class='line matter flex flex-items-center'>
				<div class='key'>
					Materiał:
				</div>
				<div class='val bold'>
					{$matter}
				</div>
				
			</div>
			<div class='line color flex flex-items-center'>
				<div class='key'>
					Kolor:
				</div>
				<div class='val bold'>
					{$color}
				</div>
				
			</div>
			<div class='line origin flex flex-items-center'>
				<div class='key'>
					Kraj pochodzenia:
				</div>
				<div class='val bold'>
					{$country}
				</div>
				
			</div>
			<div class='line cat flex flex-items-center'>
				<div class='key'>
					Katalog:
				</div>
				<div class='val bold'>
					{$catalog}
				</div>
				
			</div>
			
		</div>
		
	</div>";
	
} );

add_action( 'single-dane-znakowanie', function( $arg ){
	$data = array();
	
	if( !empty( $arg[ 'MARK' ] ) ){
		foreach( $arg[ 'MARK' ] as $size_place => $types ){
		preg_match( "~^(.+)\s\((.+)\)$~", $size_place, $match );
		$size = $match[1];
		$place = $match[2];
			
			foreach( $types as $type ){
				$data[] = array( $size, $place, $type );
				
			}
			
		}
		
	}
	else return false;
	
	echo "<div class='marking multi seg'>
					<div class='tabs flex'>
						<div class='title uppercase pointer base2 flex flex-items-center active'>
							znakowanie
						</div>
						<div class='title uppercase pointer base2 flex flex-items-center'>
							kalkulator
						</div>
						
					</div>
					<div class='box znakowanie flex active'>
						<div class='line check flex flex-column'>
							<div class='key flex flex-items-center flex-justify-center'>Wybór</div>";
	foreach( $data as $item ){
		echo 			"<div class='custom-checkbox pointer flex flex-items-center flex-justify-center' mark-size='{$item[0]}' mark-place='{$item[1]}' mark-type='{$item[2]}'>
								<span class='icon fa fa-check'></span>
							</div>";
	}
		echo		"</div>
						<div class='line area base3 flex flex-column flex-justify-start'>
							<div class='key flex flex-items-center'>
								Rozmiar:
							</div>";
	foreach( $data as $item ){
		echo			"<div class='val bold flex flex-items-center'>
								{$item[ 0 ]}
							</div>";
	}
							
	echo 			"</div>
						<div class='line place base3 flex flex-column flex-justify-start'>
							<div class='key flex flex-items-center'>
								Miejsce:
							</div>";
	foreach( $data as $item ){
		echo 			"<div class='val bold flex flex-items-center'>
							{$item[1]}
						</div>";
	}
							
	echo			"</div>
						<div class='line method base3 flex flex-column flex-justify-start'>
							<div class='key flex flex-items-center'>
								Metoda:
							</div>";
	foreach( $data as $item ){
		echo 			"<div class='val bold flex flex-items-center'>
								{$item[2]}
								<div class='icon fa fa-info'></div>
							</div>";
	}
							
	echo			"</div>
						
					</div>
					
					<div class='box kalkulator flex flex-wrap'>
						<div class='empty base1 flex flex-items-center flex-justify-center'>
							Nie wybrano żadnego wariantu znakowania!
						</div>
						<div class='order base1 flex flex-wrap'>
							<div class='number base1 flex flex-items-center'>
								<div class='base2'>
									Ilość zamawianych produktów:
								</div>
								<div class='base2'>
									<input class='user' type='number' step=1 min=1 max=999999>
								</div>
							</div>
							<div class='price base1 flex flex-items-center'>
								<div class='base2'>
									Cena znakowania:
								</div>
								<div class='base2 bold ajax'>
									...
								</div>
							</div>
							<div class='add base1 flex flex-justify-center'>
								<div class='btn pointer'>
									Dodaj do koszyka
								</div>
								
							</div>
							
						</div>
						
					</div>
					
				</div>";
	
} );

add_action( 'single-dane-multi', function( $arg ){
	$data = array(
		'pakowanie' => array(
			'Opakowanie jednostkowe' => apply_filters( 'emptyAttr', $arg['PACKAGE']['SINGLE'] ),
			'Ilość w kartonie zbiorczym' => apply_filters( 'emptyAttr', $arg['PACKAGE']['TOTAL'] ),
			'Wymiary kartonu zbiorczego' => apply_filters( 'emptyAttr', $arg['PACKAGE']['DIM'] ),
			'Waga kartonu zbiorczego' => apply_filters( 'emptyAttr', $arg['PACKAGE']['WEIGHT'] ),
			'Ilość w kartonie wewnętrznym' => apply_filters( 'emptyAttr', $arg['PACKAGE']['INSIDE'] ),
			
		),
		'inne' => array(
			'Inne' => apply_filters( 'emptyAttr', '' ),
			
		),
		
	);
	
	echo "<div class='multi seg'>
					<div class='flex tabs'>
						<div class='pakowanie title uppercase base2 pointer flex flex-items-center active'>
							pakowanie
						</div>
						<div class='inne title uppercase base2 pointer flex flex-items-center'>
							inne
						</div>
						
					</div>
					<div class='box pakowanie'>";
					foreach( $data['pakowanie'] as $name => $item ){
						echo "<div class='line flex flex-items-center'>
									<div class='key base2'>
										{$name}:
									</div>
									<div class='val bold'>
										{$item}
									</div>
									
								</div>";
						
					}
						
	echo		"</div>
					<div class='box inne fp-hide'>";
					foreach( $data['inne'] as $name => $item ){
						echo "<div class='line flex flex-items-center'>
									<div class='key base2'>
										{$name}:
									</div>
									<div class='val bold'>
										{$item}
									</div>
									
								</div>";
						
					}
						
	echo		"</div>
					
				</div>";
	
} );

// filter hook

add_filter( 'stdName', function( $arg ){
	$find = explode( "|", " |,|&|?|-|#|Ą|Ę|Ż|Ź|Ó|Ł|Ć|Ń|Ś|ą|ę|ż|ź|ó|ł|ć|ń|ś" );
	$replace = explode( "|", "_||||||a|e|z|z|o|l|c|n|s|a|e|z|z|o|l|c|n|s" );
	
	return str_replace( $find, $replace, strtolower( strip_tags( (string)$arg ) ) );
	
} );

add_filter( 'emptyAttr', function( $arg ){
	return empty( $arg )?( "- brak danych -" ):( $arg );
	
} );

// XML

require_once __DIR__ . '/php/autoloader.php';

?>


<?php
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'extra-menu' => __( 'Extra Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

?>


<?php

add_action('wp_enqueue_scripts', 'cssmenumaker_scripts_styles' );

function cssmenumaker_scripts_styles() {
   //wp_enqueue_style( 'cssmenu-styles', get_template_directory_uri() . '/cssmenu/styles.css');
}

class CSS_Menu_Maker_Walker extends Walker {

  var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul>\n";
  }

  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }

  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $class_names = $value = '';        
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;

    /* Add active class */
    if(in_array('current-menu-item', $classes)) {
      $classes[] = 'active';
      unset($classes['current-menu-item']);
    }

    /* Check for children */
    $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
    if (!empty($children)) {
      $classes[] = 'has-sub';
    }

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'><span>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= '</span></a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }
}