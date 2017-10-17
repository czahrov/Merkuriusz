<?php
	/*
	Template Name: o_nas
	*/
	get_header();
?>

<body>
	
	<?php get_template_part( "template/page", "top" ); ?>
	<?php get_template_part( "template/menu", "top" ); ?>
	<!-- BANER O NAS-->

	<div class="container-fluid about_us_cover" style="background-image: url('<?php echo wp_get_attachment_image_url( get_post_thumbnail_id( get_post()->ID ), 'full' );?>');">
	<div class="filtr"></div>
		<div class="container">
			<div class="col-sm-12 about_us_content">
				<h1><?php echo get_post()->post_title; ?></h1>
				
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
<?php get_template_part( 'template/newsletter' ); ?>


 <!-- FOOTER -->
	
<?php get_footer(); ?>