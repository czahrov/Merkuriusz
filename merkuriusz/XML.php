<?php
// $AXPOL = new AXPOL();
// $AXPOL->makeCache();

// $EASYGIFTS = new EASYGIFTS();
// $EASYGIFTS->makeCache();

// $MACMA = new MACMA();
// $MACMA->makeCache();

$ANDA = new ANDA();
// $ANDA->makeCache();


$XM = new XMLMan();
$XM->addSupport( $ANDA );
// $XM->addSupport( $MACMA );
// $XM->addSupport( $EASYGIFTS );
// $XM->addSupport( $AXPOL );
$XM->init();

// $XM->addSupport( new AXPOL() );
// $XM->addSupport( new PAR() );
// $XM->addSupport( new INSPIRION() );
// $XM->addSupport( new ASGARD() );
// $XM->addSupport( new MACMA() );
// $XM->addSupport( new EASYGIFTS() );
// $XM->addSupport( new ANDA() );
