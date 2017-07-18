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

// action hook

add_action( 'pre_get_posts', 'search_by_cat' );

add_action( 'breadcrumb', function( $arg ){
	if( !empty( $_GET['cat'] ) ){
		$cat = explode( ",", $_GET['cat'] );
		echo implode( " > ", $cat );
	}
	else{
		echo "breadcrumb!";
		
	}
	
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
	if( !empty( $pagin[ $page ] ) ){
		foreach( $pagin[ $page ] as $item ){
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
	$total = $arg;
	//$perpage = !empty( $_SESSION['num'] )?( (int)$_SESSION['num'] ):( !empty( $_GET['num'] )?( (int)$_GET['num'] ):( 20 ) );
	$perpage = config( 'num' );
	//$strona = !empty( $_GET['strona'] )?( (int)$_GET['strona'] ):( 1 );
	$strona = config( 'strona' );
	
	printf( "Produktów %u-%u / %u",
		1 + ( $strona - 1) * $perpage,
		$strona * $perpage,
		$total
	);
	
} );

add_action( 'kategoria_pagin_next', function( $arg ){
	$query = $_SERVER[ 'QUERY_STRING' ];
	parse_str( $query, $args );
	
	$total = $arg;
	$perpage = !empty( $_SESSION['num'] )?( (int)$_SESSION['num'] ):( !empty( $args['num'] )?( (int)$args['num'] ):( 20 ) );
	$strona = !empty( $args['strona'] )?( (int)$args['strona'] ):( 1 );
	
	if( $strona * $perpage < $total ){
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
	$perpage = !empty( $_SESSION['num'] )?( (int)$_SESSION['num'] ):( !empty( $args['num'] )?( (int)$args['num'] ):( 20 ) );
	$strona = !empty( $args['strona'] )?( (int)$args['strona'] ):( 1 );
	
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
	if( !empty( $_GET['cat'] ) ){
		$query = explode( ",", $_GET['cat'] );
	}
	else{
		$query = array( "", "" );
		
	}
	
	echo "<ul class='menu'>";
	foreach( $arg as $cat_name => $cat_data ){
		$cat_slug = apply_filters( 'stdName', $cat_name );
		$cat_active = $query[0] === $cat_slug?( 'active' ):( '' );
		
		printf( "<li class='item flex flex-column %s %s' item-slug='%s' item-title='%s'>
				<div class='head flex flex-items-center'>
					<div class='title uppercase bold'>
						%s
					</div>
					<span class='icon fa fa-angle-right'></span>
				</div>
				<ul class='sub flex flex-column'>",
		$cat_data['class'], $cat_active, $cat_slug, $cat_name, $cat_name );
				
		foreach( $cat_data['items'] as $item ){
			$item_slug = apply_filters( 'stdName', $item['title'] );
			$item_active = $query[1] === $item_slug?( 'active' ):( '' );
			
			printf( "<a class='item flex %s %s' href='%s' item-slug='%s' item-title='%s'>",
			$item['class'], $item_active, home_url( sprintf( "kategoria?cat=%s,%s", $cat_slug, $item_slug ) ), $item_slug, $item['title'] );
			
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
					
					echo "<span class='icon fa fa-angle-double-right'></span>";
					
				echo "</div>";
			
			echo "</a>";
		}
			
		echo "</ul>";
		
	}
	echo "</ul>";
	
} );

add_action( 'single-picture', function( $arg ){
	/*
	<div class='pic base2 flex flex-column'>
				<div class='large bgimg full' style='background-image: url( https://placeimg.com/300/300/tech );'>
					<div class='icon'>
						<span class='fa fa-search-plus'></span>
					</div>
					
				</div>
				<div class='mini flex'>
					<div class='item bgimg full base0 grow pointer'></div>
					<div class='item bgimg full base0 grow pointer'></div>
					<div class='item bgimg full base0 grow pointer'></div>
					
				</div>
				<div class='download'>
					<a class='flex flex-items-center'>
						do pobrania:
						<span class='bold'>
							7699.pdf [38.2kB]
						</span>
						
					</a>
				</div>
				
			</div>
	*/
	
	echo "<div class='pic base2 flex flex-column'>";
		printf( "<div class='large bgimg full' style='background-image: url( %s );'>
					<div class='icon'>
						<span class='fa fa-search-plus'></span>
					</div>
					
				</div>",
		$arg[ 'IMG' ][0]
	);
	
	if( count( $arg[ 'IMG' ] ) > 1 ){
		echo "<div class='mini flex'>";
		
		for( $i=1; $i<count( $arg['IMG'] ); $i++ ){
			printf( "<div class='item bgimg contain base3 no-shrink pointer' style='background-image: url( %s );'></div>", 
				$arg[ 'IMG' ][ $i ]
			);
			
		}
		
		echo "</div>";
	}
	
	echo "<div class='download'>
					<a class='flex flex-items-center'>
						do pobrania:
						<span class='bold'>
							7699.pdf [38.2kB]
						</span>
						
					</a>
				</div>";
	
	echo "</div>";
	
} );

add_action( 'single-dane-main', function( $arg ){
	echo "<div class='main seg'>
		<div class='box'>
			<div class='line code flex flex-items-center'>
				<div class='key'>
					Kod produktu:
				</div>
				<div class='val bold'>
					{$arg[ 'ID' ]}
				</div>
				
			</div>
			<div class='line name flex flex-items-center'>
				<div class='key'>
					Nazwa:
				</div>
				<div class='val bold'>
					{$arg[ 'NAME' ]}
				</div>
				
			</div>
			<div class='line desc flex flex-column flex-justify-center'>
				<div class='key'>
					Opis:
				</div>
				<div class='val bold'>
					{$arg[ 'DSCR' ]}
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
					{$arg[ 'DIM' ]}
				</div>
				
			</div>
			<div class='line matter flex flex-items-center'>
				<div class='key'>
					Materiał:
				</div>
				<div class='val bold'>
					???
				</div>
				
			</div>
			<div class='line cat flex flex-items-center'>
				<div class='key'>
					Strona w katalogu:
				</div>
				<div class='val bold'>
					???
				</div>
				
			</div>
			<div class='line color flex flex-items-center'>
				<div class='key'>
					Kolor:
				</div>
				<div class='val bold'>
					???
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
	
	echo "<div class='marking seg'>
					<div class='title uppercase flex flex-items-center'>
						znakowanie
					</div>
					<div class='box flex'>
						<div class='line area base2 flex flex-column flex-justify-center'>
							<div class='key flex flex-items-center'>
								Rozmiar:
							</div>";
	foreach( $data as $item ){
		echo "<div class='val bold flex flex-items-center'>
					{$item[ 0 ]}
				</div>";
	}
							
	echo 			"</div>
						<div class='line place base2 flex flex-column flex-justify-center'>
							<div class='key flex flex-items-center'>
								Miejsce:
							</div>";
	foreach( $data as $item ){
		echo "<div class='val bold flex flex-items-center'>
				{$item[1]}
			</div>";
	}
							
	echo			"</div>
						<div class='line method base2 flex flex-column flex-justify-center'>
							<div class='key flex flex-items-center'>
								Metoda:
							</div>";
	foreach( $data as $item ){
		echo "<div class='val bold flex flex-items-center'>
				{$item[2]}
				<div class='icon fa fa-info'></div>
			</div>";
	}
							
	echo			"</div>
						
					</div>
					
				</div>";
	
} );

add_action( 'single-dane-multi', function( $arg ){
	$data = array(
		'pakowanie' => array(
			'Pakowanie indywidualne' => '???',
			'Ilość w kartonie zbiorczym' => '???',
			'Wymiary kartonu zbiorczego' => '???',
			'Waga kartonu zbiorczego' => '???',
			'Ilość w kartonie wewnętrznym' => '???',
			
		),
		'inne' => array(
			'Pakowanie indywidualne' => '??? ???',
			'Ilość w kartonie zbiorczym' => '??? ???',
			'Wymiary kartonu zbiorczego' => '??? ???',
			'Waga kartonu zbiorczego' => '??? ???',
			'Ilość w kartonie wewnętrznym' => '??? ???',
			
		),
		
	);
	
	echo "<div class='multi seg'>
					<div class='flex'>
						<div class='pakowanie title uppercase base2 pointer flex flex-items-center'>
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
	$find = explode( ",", " ,Ą,Ę,Ż,Ź,Ó,Ł,Ć,Ń,Ś,ą,ę,ż,ź,ó,ł,ć,ń,ś" );
	$replace = explode( ",", "_,a,e,z,z,o,l,c,n,s,a,e,z,z,o,l,c,n,s" );
	
	return str_replace( $find, $replace, strtolower( strip_tags( (string)$arg ) ) );
	
} );

// XML

require_once __DIR__ . '/php/autoloader.php';

