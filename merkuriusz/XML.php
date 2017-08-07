<?php
$AXPOL = new AXPOL();
// if( isset( $_GET[ 'recache' ] ) ) $AXPOL->makeCache();

$EASYGIFTS = new EASYGIFTS();
// if( isset( $_GET[ 'recache' ] ) ) $EASYGIFTS->makeCache();

$MACMA = new MACMA();
// if( isset( $_GET[ 'recache' ] ) ) $MACMA->makeCache();

$ANDA = new ANDA();
// if( isset( $_GET[ 'recache' ] ) ) $ANDA->makeCache();


$XM = new XMLMan();
$XM->addSupport( $ANDA );
$XM->addSupport( $MACMA );
$XM->addSupport( $EASYGIFTS );
$XM->addSupport( $AXPOL );
$XM->init();

// $XM->addSupport( new AXPOL() );
// $XM->addSupport( new PAR() );
// $XM->addSupport( new INSPIRION() );
// $XM->addSupport( new ASGARD() );
// $XM->addSupport( new MACMA() );
// $XM->addSupport( new EASYGIFTS() );
// $XM->addSupport( new ANDA() );
