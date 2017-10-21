<?php

$AXPOL = new AXPOL();
$EASYGIFTS = new EASYGIFTS();
$MACMA = new MACMA();
$ANDA = new ANDA();

// $ASGARD = new ASGARD();

// $INSPIRION = new INSPIRION();
// $PAR = new PAR();

if( isset( $_GET[ 'recache' ] ) ){
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'axpol' ] ) ) ) && isset( $AXPOL ) ) $AXPOL->makeCache();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'easy' ] ) ) ) && isset( $EASYGIFTS ) ) $EASYGIFTS->makeCache();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'macma' ] ) ) ) && isset( $MACMA ) ) $MACMA->makeCache();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'anda' ] ) ) ) && isset( $ANDA ) ) $ANDA->makeCache();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'asgard' ] ) ) ) && isset( $ASGARD ) ) $ASGARD->makeCache();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'inspirion' ] ) ) ) && isset( $INSPIRION ) ) $INSPIRION->makeCache();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'par' ] ) ) ) && isset( $PAR ) ) $PAR->makeCache();
	
}
elseif( isset( $_GET[ 'update' ] ) ){
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'axpol' ] ) ) ) && isset( $AXPOL ) ) $AXPOL->check();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'easy' ] ) ) ) && isset( $EASYGIFTS ) ) $EASYGIFTS->check();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'macma' ] ) ) ) && isset( $MACMA ) ) $MACMA->check();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'anda' ] ) ) ) && isset( $ANDA ) ) $ANDA->check();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'asgard' ] ) ) ) && isset( $ASGARD ) ) $ASGARD->check();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'inspirion' ] ) ) ) && isset( $INSPIRION ) ) $INSPIRION->check();
	if( ( isset( $_GET[ 'all' ] ) or ( isset( $_GET[ 'par' ] ) ) ) && isset( $PAR ) ) $PAR->check();
	
}

$XM = new XMLMan();

if( isset( $PAR ) )				$XM->addSupport( $PAR );
if( isset( $INSPIRION ) )	$XM->addSupport( $INSPIRION );
if( isset( $ASGARD ) )		$XM->addSupport( $ASGARD );
if( isset( $ANDA ) )			$XM->addSupport( $ANDA );
if( isset( $MACMA ) )		$XM->addSupport( $MACMA );
if( isset( $EASYGIFTS ) )	$XM->addSupport( $EASYGIFTS );
if( isset( $AXPOL ) )			$XM->addSupport( $AXPOL );

$XM->init();
