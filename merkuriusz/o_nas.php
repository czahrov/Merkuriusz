<?php
	/*
	Template Name: o_nas
	*/
	get_header();
?>

<body>
	
	<div class="intro-bar">
		<div class="inner-intro-bar container">
			<div class="col-md-6 intro-item1">Merkuriusz - Techniki nadruków Tarnów</div>
			<div class="col-md-6 intro-item2">Masz pytania? Chętnie na nie odpowiemy <span class="big-text">14 662 33 64</span></div>
		</div>
	</div>

	<div class="container">

		<div class="col-md-5">
			<div class="logo">
				<a href="index.html">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo_merkuriusz.png" class="logo-src" alt="merkuriusz logo">
			</a>
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

	<!-- BANER O NAS-->

	<div class="container-fluid about_us_cover">
		<div class="container">
			<div class="col-sm-12 about_us_content">
				<h1>MERKURIUSZ</h1>
				<p>Dowiedz się więcej o naszej Agencji Reklamowej</p>
			</div>
		</div>
	</div>

<!-- ABOUT US MAIN CONTENT -->

<div class="container-fluid about-section-bg">
	<div class="about-section">
		<div class="col-md-12 about-content-box">
			<h2><span class="about-us-one">KOMPLEKSOWA OBSŁUGA W ZAKRESIE REKLAMY</span> MERKURIUSZ
			</h2>
			<p>Jesteśmy już z Państwem 25 lat. Bardzo nam miło że dzięki Państwa zaufaniu możemy przez ten czas istnieć i rozwijać się na rynku reklamowym. Sukcesy rynkowe Państwa są także naszymi sukcesami dlatego z dużą dokładnośią realizujemy powierzone nam zadania. Do każdego nawet łatwego do zrealizowania projektu podchodzimy indywidualnie, dzięki temu wyróżnia nas szybkie reagowanie na zmiany potrzeb biznesowych naszych klientów.</p>
			<p>Nasze motto biznesowe brzmi: DBAJ O WIZERUNEK, BUDUJ DOBRE PIERWSZE WRAŻENIE</p>
		</div>
		<a><div class="about-arrow-btn down-slider"><i class="fa fa-angle-down" aria-hidden="true"></i></div></a>
	</div>
</div> <!-- END CONTAINER FLUID -->

<div class="container-fluid">
	<div id="about-section1" class="about-section">
		<div class="col-md-12 about-content-box" id="section_about_2">
			<h2><span class="about-us-one">KIM</span> JESTEŚMY?
			</h2>
			<p>Specjalizujemy się w zaopatrywaniu firm i instytucji w gadżety reklamowe od popularnych i lubianych poprzez markowe i ekskluzywne,odzież promocyjną oraz ceramikę reklamową. Zajmujemy się również identyfikacją wizualną firm zarówno wewnętrzną jak i zewnętrzną. zapewniając tym samym klientom kompleksową obsługę co powoduje że klienci otrzymują kilka produktów w jednym miejscu i z ochotą wracają do nas następnym razem. Naszym dużym atutem na rynku reklamowym jest zarządzanie własnym parkiem maszynowym dzięki czemu możemy zapewniać krótkie terminy realizacji, najwyższą jakość usług jak również konkurować cenowo na rynku. Nadążając za trendami runku a równocześnie chcąć ułatwić Państwu szybkie,sprawne wyszukanie gadżetu i jego zakup stworzyliśmy sklep który to umożliwia.

			</p>
			<a href="<?php echo home_url(); ?>" class="btn about-us-btn">PRZEJDŹ DO SKLEPU</a>
		</div>
		
	</div>
</div> <!-- END CONTAINER FLUID -->

<div class="container-fluid about-section-bg">
	<div class="about-section">
		<div class="col-md-12 about-content-box" id="section_about_3">
			<h2><span class="about-us-one">Z KIM</span> WSPÓŁPRACUJEMY?
			</h2>
			<p>Współpracujemy dla Państwa z najpoważniejszymi na polskim rynku producentami, importerami ( m.in. Azja, USA, Europa) oraz dystrybutorami materiałów i nośników reklamowych. Do naszej pracy wykorzystujemy nowoczesne uznane technologie i nowatorskie metody znakowania mające zastosowanie w reklamie.Jesteśmy pewni że sprostamy wymaganiom najbardziej wymagających klientów.
</p>
		</div>
	</div>
</div> <!-- END CONTAINER FLUID -->

<!-- PARTNERS --> 

<div class="container">
		<div class="col-md-12">
			<div class="col-md-12 partner-container" style="padding: 0;">
				<div class="partner-arrow-box partner-left">
				<i class="fa fa-angle-left fa-2x arrow-position" aria-hidden="true"></i>
				</div>


				<div class="partner-wrapper">
						<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/bc.svg" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/sols.svg" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/sg.svg" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/fruit.png" class="partner-icon"></div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/logo_adler.svg" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/alex_fox.svg" class="partner-icon"></div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/jhk.svg" class="partner-icon" >
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/macma.svg" class="partner-icon" >
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/happy_gifts.png" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/waterman.svg" class="partner-icon" >
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/Parker-logo-new-and-original.png" class="partner-icon">
					</div>

					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/nina_rici.svg" class="partner-icon" >
					</div>
					
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/diplomat.svg" class="partner-icon" >
					</div>
				
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/blue_collection.svg" class="partner-icon" >
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/royal_design.svg" class="partner-icon">
					</div>
					
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/cool.svg" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/easy_gifts.svg" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/tops.svg" class="partner-icon">
					</div>
					<div class="partner-icon-box">
						<img src="<?php echo get_template_directory_uri(); ?>/img/partnerzy/voyager-XD.png" class="partner-icon"></div>
				</div>


				<div class="partner-arrow-box partner-right"><i class="fa fa-angle-right fa-2x arrow-position" aria-hidden="true"></i></div>

			</div>
		
		</div>
	</div>

<!--END OF PARTNERS -->
<div class="container-fluid">
	<div class="about-section">
		<div class="col-md-12 about-content-box">
			<h2><span class="about-us-one">DOKĄD</span> DĄŻYMY?
			</h2>
			<p>Pragniemy być w Państwach oczachwiarygodnym i solidnym partnerem w biznesie. Naszym celem jest pozyskanie, utrzymywanie i rozwijanie dobrych relacji z klientami, uczciwie budując naszą markę na rynku Naszym celem jest, aby produkty które proponujemy, umożliwiały naszym klientom osiąganie swoich celów marketingowych.
			</p>
			<a href="<?php echo home_url('kontakt'); ?>" class="btn about-us-btn">SKONTAKTUJ SIĘ Z NAMI</a>
		</div>
		
	</div>
</div> <!-- END CONTAINER FLUID -->


<div class="container-fluid about-section-bg">
	<div class="about-section">
		<div class="col-md-12 about-content-box " id="section_about_5">
			<h2><span class="about-us-one">PRZEDE WSZYSTKIM</span> DBAMY O TO, ABY:
			</h2>
			<p>– być partnerem i doradcą dla wszystkich klientów poszukujących rozwiązań w zakresie reklamy</p>
			<p>– poprzez ciągłe dążenie do perfekcji wychodzić naprzeciw oczekiwaniom i ambicjom naszych klientów</p>
			<p>- budować zaufanie klientów poprzez dostarczanie im produktów i usług oznakomitej jakości</p>
			<a href="<?php echo home_url('oferta'); ?>" class="btn about-us-btn">ZOBACZ NASZĄ OFERTĘ</a>
		</div>
		
	</div>
</div> <!-- END CONTAINER FLUID -->

<div class="white-space-70"></div>

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