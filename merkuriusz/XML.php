<?php

$jaguar_auth = array(
	'http' => array(
		'method' => "GET",
		'header' => implode( "\r\n", array(
			'Accept-language: pl',
			'Authorization: Token b877f60a12c850f74a169fa036265f852b38be79'
		) ),
	)
);

// $AXPOL = new AXPOL();
// $EASYGIFTS = new EASYGIFTS();
// $MACMA = new MACMA();
// $ANDA = new ANDA();
// $FALKROSS = new FALKROSS();
// $JAGUARGIFT = new JAGUARGIFT( $jaguar_auth );
// $ASGARD = new ASGARD();

$INSPIRION = new INSPIRION();

// $PAR = new PAR();

if( isset( $_GET[ 'recache' ] ) ){
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'axpol' ] ) ) ) && isset( $AXPOL ) ) $AXPOL->makeCache();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'easy' ] ) ) ) && isset( $EASYGIFTS ) ) $EASYGIFTS->makeCache();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'macma' ] ) ) ) && isset( $MACMA ) ) $MACMA->makeCache();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'anda' ] ) ) ) && isset( $ANDA ) ) $ANDA->makeCache();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'asgard' ] ) ) ) && isset( $ASGARD ) ) $ASGARD->makeCache();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'inspirion' ] ) ) ) && isset( $INSPIRION ) ) $INSPIRION->makeCache();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'par' ] ) ) ) && isset( $PAR ) ) $PAR->makeCache();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'falkross' ] ) ) ) && isset( $FALKROSS ) ) $FALKROSS->makeCache();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'jaguar' ] ) ) ) && isset( $JAGUARGIFT ) ) $JAGUARGIFT->makeCache();
	
}
elseif( isset( $_GET[ 'update' ] ) ){
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'axpol' ] ) ) ) && isset( $AXPOL ) ) $AXPOL->check();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'easy' ] ) ) ) && isset( $EASYGIFTS ) ) $EASYGIFTS->check();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'macma' ] ) ) ) && isset( $MACMA ) ) $MACMA->check();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'anda' ] ) ) ) && isset( $ANDA ) ) $ANDA->check();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'asgard' ] ) ) ) && isset( $ASGARD ) ) $ASGARD->check();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'inspirion' ] ) ) ) && isset( $INSPIRION ) ) $INSPIRION->check();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'par' ] ) ) ) && isset( $PAR ) ) $PAR->check();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'falkross' ] ) ) ) && isset( $FALKROSS ) ) $FALKROSS->check();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'jaguar' ] ) ) ) && isset( $JAGUARGIFT ) ) $JAGUARGIFT->check();
	
}

$XM = new XMLMan();

if( isset( $AXPOL ) )			$XM->addSupport( $AXPOL );
if( isset( $EASYGIFTS ) )	$XM->addSupport( $EASYGIFTS );
if( isset( $MACMA ) )		$XM->addSupport( $MACMA );
if( isset( $ASGARD ) )		$XM->addSupport( $ASGARD );
if( isset( $PAR ) )				$XM->addSupport( $PAR );
if( isset( $INSPIRION ) )	$XM->addSupport( $INSPIRION );
if( isset( $ANDA ) )			$XM->addSupport( $ANDA );
if( isset( $FALKROSS ) )	$XM->addSupport( $FALKROSS );
if( isset( $JAGUARGIFT ) )	$XM->addSupport( $JAGUARGIFT );

$XM->init();
