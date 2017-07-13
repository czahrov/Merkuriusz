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
	
	$arr = array( 20, 40, 100 );
	
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
	
	for( $i=0; $i< config('num'); $i++ ){
		printf( "<div class='item base1 base2-ms base3-mm base4-ml flex'>
						<div class='wrapper flex flex-column'>
							<div class='img bgimg full' style='background-image:url(%s);'></div>
							<div class='title bold'>%s</div>
							<div class='code'>Kod produktu: <span class='bold'>%s</span></div>
						</div>
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

// filter hook

add_filter( 'stdName', function( $arg ){
	$find = explode( ",", " ,Ą,Ę,Ż,Ź,Ó,Ł,Ć,Ń,Ś,ą,ę,ż,ź,ó,ł,ć,ń,ś" );
	$replace = explode( ",", "_,a,e,z,z,o,l,c,n,s,a,e,z,z,o,l,c,n,s" );
	
	return str_replace( $find, $replace, strtolower( strip_tags( (string)$arg ) ) );
	
} );

