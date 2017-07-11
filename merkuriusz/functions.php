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
}

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
	$num = (int)$_SESSION['num'];
	
	echo "Na stronie:";
	
	$arr = array( 20, 40, 100 );
	foreach( $arr as $item ){
		$active = $item === $num?( ' active' ):( '' );
		$t = $args;
		$t[ 'num' ] = $item;
		$url = http_build_query( $t );
		printf( "<a class='flex flex-items-center flex-justify-center%s' href='?%s'>%s</a>", $active, $url, $item );
		
	}
	
} );

add_action( 'kafelki_kategoria', function( $arg ){
	$data = array(
		'img' => 'https://placeimg.com/200/200/tech',
		'title' => 'Drewniany parasol automatyczny NANCY, jasnozielony',
		'code' => '513129',
		
	);
	
	for( $i=0; $i<20; $i++ ){
		printf( "<div class='item flex flex-column'>
						<div class='img bgimg full' style='background-image:url(%s);'></div>
						<div class='title bold'>%s</div>
						<div class='code'>Kod produktu: <span class='bold'>%s</span></div>
					</div>",
		$data['img'], $data['title'], $data['code'] );
		
	}
	
} );

add_action( 'number', function( $arg ){
	$total = 149;
	$perpage = !empty( $_SESSION['num'] )?( (int)$_SESSION['num'] ):( !empty( $_GET['num'] )?( (int)$_GET['num'] ):( 20 ) );
	$strona = !empty( $_GET['strona'] )?( (int)$_GET['strona'] ):( 1 );
	
	printf( "Produktów %u-%u / %u",
		1 + ( $strona - 1) * $perpage,
		$strona * $perpage,
		$total
	);
	
} );

add_action( 'kategoria_pagin_next', function( $arg ){
	$query = $_SERVER[ 'QUERY_STRING' ];
	parse_str( $query, $args );
	
	$total = 149;
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
	
	$total = 149;
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

add_filter( 'stdName', function( $arg ){
	$find = explode( ",", " ,Ą,Ę,Ż,Ź,Ó,Ł,Ć,Ń,Ś,ą,ę,ż,ź,ó,ł,ć,ń,ś" );
	$replace = explode( ",", "_,a,e,z,z,o,l,c,n,s,a,e,z,z,o,l,c,n,s" );
	
	return str_replace( $find, $replace, strtolower( strip_tags( (string)$arg ) ) );
	
} );


