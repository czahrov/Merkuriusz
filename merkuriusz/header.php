<?php
	// $develop = true;
	if( $develop === true && !isset( $_COOKIE['coin'] ) ){
		include "wbudowie.php";
		exit;
		
	}
	if( session_id() === "" ){
		session_start();
		
	}
	
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
  	<title><?php do_action( 'print_title' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
 	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <?php wp_head(); ?>
</head>