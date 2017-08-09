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
