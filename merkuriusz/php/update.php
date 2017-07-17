<?php
	set_time_limit( 300 );
	require_once "autoloader.php";
	$XM = new XMLMan();
	$XM->addSupport( new PAR() );
	$XM->addSupport( new INSPIRION() );
	$XM->addSupport( new ANDA() );
	$XM->addSupport( new ASGARD() );
	$XM->addSupport( new MACMA() );
	$XM->addSupport( new EASYGIFTS() );
	$XM->addSupport( new AXPOL() );
	
	$XM->update();