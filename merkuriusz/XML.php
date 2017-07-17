<?php
/*
	Template Name: XML
*/

if( !isAjax() ){
	header( "Location:" . home_url() );
	exit;
	
}

echo "AJAX!";

$XM = new XMLMan();
//$XM->addSupport( new PAR() );
//$XM->addSupport( new INSPIRION() );
//$XM->addSupport( new ASGARD() );
//$XM->addSupport( new MACMA() );
//$XM->addSupport( new EASYGIFTS() );
//$XM->addSupport( new ANDA() );
$XM->addSupport( new AXPOL() );
$XM->init();
