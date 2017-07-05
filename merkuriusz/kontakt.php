<?php
	/*
	Template Name: kontakt
	*/
	get_header();
?>

<body>
	   <script src="//maps.google.com/maps/api/js?language=pl&key=AIzaSyBxVNTb4QJSrSuBpEe_3NpRgl_bwlt8kdk"></script>
        
	<div class="intro-bar">
		<div class="inner-intro-bar container">
			<div class="col-md-6 intro-item1">Merkuriusz - Techniki nadruków Tarnów</div>
			<div class="col-md-6 intro-item2">Masz pytania? Chętnie na nie odpowiemy <span class="big-text">14 662 33 64</span></div>
		</div>
	</div>

	<div class="container">

		<div class="col-md-5">
			<div class="logo">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo_merkuriusz.png" class="logo-src" alt="merkuriusz logo">
			</div>
		</div>
		<div class="col-md-7">
			<div class="input-group">
                <input type="text" placeholder="Wpisz nazwę lub kod produktu" class="form-control">
                <span class="input-group-btn">
                 <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                </span>
             </div>
		</div>
	</div>

<!-- NAVIGATION -->
		  <?php get_template_part("template/menu"); ?>
		
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
					<li>tel.14 622 33 64</li>
					<li>tel. kom. 607 297 778, 607 297 787</li>
					<li>e-mail: biuro@merkuriusz.pl</li>
				</ul>
			</div>
	
			<form class="contact-form">
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



		<!-- NEWSLETTER -->

		

	

	<div class="container-fluid newsletter">
		<h2 class="section-title" id="newsletter-title">Zapisz się do naszego Newslettera</h2>
		<div class="col-md-8 col-md-offset-2">
		<form>
			<div class="form-row">
				<input class="form-control input-newsletter" type="email" name="e-mail" id="e-mail" placeholder="wpisz swój adres e-mail">
				<button type="submit" class="btn btn-newsletter">Zapisz się!</button>
			</div>
		</form>

		<div class="newsletter-text">Zapisując się do naszego newslettera będziesz informowany na bieżąco o najnowszych produktach na naszej stronie. W każdej chwili możesz się z niego wypisać</div>
		<div class="white-space-50"></div>
		</div>
	</div>

	

 <!-- FOOTER -->
<?php get_footer(); ?>