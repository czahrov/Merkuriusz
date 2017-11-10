<?php
/*
	Template Name: Kontakt - AJAX
*/

if( !isAajx ){
	header( sprintf( "Location:%s", home_url() ) );
	exit;
	
}

$errs = array();

$subject = filter_input( INPUT_POST, 'subject', FILTER_SANITIZE_STRING );
if( strlen( $subject ) === 0 ) $errs[] = "Temat wiadomości jest polem wymaganym";

$name = filter_input( INPUT_POST, 'firstname', FILTER_SANITIZE_STRING );
if( strlen( $name ) === 0 ) $errs[] = "Imię jest polem wymaganym";

$lastname = filter_input( INPUT_POST, 'lastname', FILTER_SANITIZE_STRING );
if( strlen( $lastname ) === 0 ) $errs[] = "Nazwisko jest polem wymaganym";

$mail = filter_input( INPUT_POST, 'e-mail', FILTER_VALIDATE_EMAIL );
if( strlen( $mail ) === 0 ) $errs[] = "Adres e-mail jest polem wymaganym";

$phone = filter_input( INPUT_POST, 'phonenumber', FILTER_VALIDATE_REGEXP, array(
	'options' => array(
		'regexp' => "~^(?:\+\d+)?(?:\d+[ \-]?)+$~",
		
	),
	
) );

if( $phone === false ) $errs[] = "Numer telefonu jest polem wymaganym i może składać się z cyfr, myślników i spacji";

$msg = filter_input( INPUT_POST, 'message', FILTER_SANITIZE_STRING );

if( count( $errs ) > 0 ){
	echo json_encode( array(
		'status' => 'fail',
		'msg' => "Następujące pola formularza zawierają błędy: " . implode( ',', $errs ),
		
	) );
	
}
else{
	require_once __DIR__ . "/php/PHPMailer/PHPMailerAutoload.php";
	$mailer = new PHPMailer();
	$mailer->CharSet = "utf8";
	$mailer->Encoding = "base64";
	$mailer->setLanguage( 'pl' );
	$mailer->setFrom( "noreply@{$_SERVER[ 'HTTP_HOST' ]}", "Formularz kontaktowy - Merkuriusz" );
	
	// $mailer->AddAddress( 'biuro@merkuriusz.pl' );
	$mailer->AddAddress( $mail );
	$mailer->Subject = $subject;
	$mailer->Body = sprintf( "%s %s, <%s> ( tel: %s )\r\nPrzesyła wiadomość:\r\n%s\r\n\r\n---\r\nWiadomość wygnerowana automatycznie na %s", 
	$name,
	$lastname,
	$mail,
	$phone,
	$msg,
	home_url()
	);
	
	if( $mailer->send() ){
		echo json_encode( array(
			'status' => 'ok',
			'msg' => 'Wiadomość wysłana pomyślnie',
			
		) );
		
	}
	else{
		echo json_encode( array(
			'status' => 'fail',
			'msg' => "Wysłanie wiadomości zakończone niepowodzeniem.<br>Powód: " . $mailer->ErrorInfo,
			
		) );
		
	}
	
}



