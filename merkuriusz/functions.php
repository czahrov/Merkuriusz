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


add_action( 'pre_get_posts', 'search_by_cat' );

function search_by_cat()
{
    if ( is_search() )
    {
        $cat = empty( $_GET['cat'] ) ? '' : (int) $_GET['cat'];
        add_query_arg( 'cat', $cat );
    }
}

