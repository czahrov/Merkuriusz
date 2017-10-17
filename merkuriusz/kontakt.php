<?php
	/*
	Template Name: kontakt
	*/
	get_header();
?>

<body>
	   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArrRNhUZZaxx6Qvd_ESnz9OEQ_5g_sLfE"></script>
        
<?php get_template_part( "template/page", "top" ); ?>
<?php get_template_part( "template/menu", "top" ); ?>

	<!-- GOOGLE MAP -->
	<div id="map">
		
	</div>


	<!-- CONTACT FORM -->
	<div id="contact">
		<div class="container contact-box">
			<div class="contact-desc">
				<p>Wszystkie zapytania oraz zamówienia prosimy kierować</p>
				<p>za pośrednictwem poczty elektronicznej</p>
				<p>bądź o kontakt telefoniczny</p>
				<ul class="phone-mail">
					<li>
						Merkuriusz s.c.,ul. Szpitalna 25 B, 33-100 Tarnów
					</li>
					<li>
						tel./fax +48 14 622 33 64, 
					</li>
					<li></li>
					<li></li>
					<li>	
						dział obsługi klienta;
					</li>
					<li>	
						zamówienia; +48 14 628 44 11
					</li>
					<li>	
						e-mail;biuro@merkuriusz.pl
					</li>
					<li></li>
					<li></li>
					<li>	
						marketing; 607 297 778, 607 297 787
					</li>
					<li>	
						marketing@merkuriusz.pl
					</li>
					<li></li>
					<li></li>
					<li>	
						renata@merkuriusz.pl
					</li>
					<li>	
						stanislaw@merkuriusz.pl
					</li>
					<li>	
						grafika; +48 14 628 44 11 
					</li>
					<li>	
						grafika@merkuriusz.pl
					</li>
					
				</ul>
			</div>
	
			<form class="contact-form hide">
					<div class='form_row form-row1'>
						<label for="subject">Temat <span class="red">*</span></label>
						<input type="text" name="subject" id="subject" class="input-normal">
					</div>
					<div class="personal-data">
						<div class='form_row form-row2'>
							<label for="firstname">Imię <span class="red">*</span></label>
							<input type="text" name="firstname" id="firstname" class="input-normal">
						</div>
						<div class='form_row form-row3'>
							<label for="lastname">Nazwisko <span class="red">*</span></label>
							<input type="text" name="lastname" id="lastname" class="input-normal">
						</div>
					</div>
					<div class="personal-data">
						<div class='form_row form-row4'>
							<label for="e-mail">Adres e-mail <span class="red">*</span></label>
							<input type="email" name="e-mail" id="e-mail" class="input-normal error">
						</div>
						<div class='form_row form-row5'>
							<label for="phonenumber">Numer telefonu <span class="red">*</span></label>
							<input type="tel" name="phonenumber" id="phonenumber" class="input-normal ok">
						</div>
					</div>
	
						<div class='form_row'>
							<label for="message">Treść wiadomości <span class="red">*</span></label>
							<textarea id="message" class="input-normal"></textarea>
						</div>
						<div class='form_row form-row-button'>
							<button type="button" class="cotact-form-btn">wyślij wiadomość</button>
						</div>
					</form>
			

		</div>
	</div>
<?php get_template_part( "template/newsletter" ); ?>
 <!-- FOOTER -->
<?php get_footer(); ?>