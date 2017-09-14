<?php
	/*
	Template Name: kalendarze
	*/
	get_header();

?>

<body>
	
	<?php get_template_part( "template/page", "top" ); ?>
	<!-- BANER O NAS-->

	<div class="container-fluid about_us_cover" style="background-image: url('<?php echo wp_get_attachment_image_url( get_post_thumbnail_id( get_post()->ID ), 'full' );?>');">
	<div class="filtr"></div>
		<div class="container">
			<div class="col-sm-12 about_us_content">
				<h1><?php echo get_post()->post_title; ?></h1>
				
			</div>
		</div>
	</div>

<!-- Single US MAIN CONTENT -->

<div class="container-fluid single-page">
		<div class="container">

		
		<div class="col-sm-12">

		<div class="kal_mer">

		<h2 class="kal"> Merkuriusz - PRODUKCJA kalendarzy AUTORSKICH</h2>

		<p>Działamy w segmencie produkcji kalendarzy reklamowych na rynku już 25 lat.
Posiadając wieloletnie doświadczenie w tej dziedzinie możemy zapewnić klientom wysoką jakość
produktów jak również bogatą i wysublimowaną grafikę w przekazie całorocznej reklamy jaką są kalendarze.
Projektujemy kalendarze od najmniejszych tzw. listkowych poprzez najbardziej popularne kalendarze jednodzielne
trójdzielne czy czterodzielne oraz planszety, planery aż po kalendarze plakatowe autorskie A1, B1.i wszystkie półformaty.
Staramy się być pomocni w doborze wykończeń i dodatków kalendarzowych które stanowią dopięcie tak ważne jak
zapięcie ostatniego guzika w garniturze.
Do produkcji kalendarzy korzystamy z galerii papierów nie tylko standardowych ale również z szerokiego wachlarza papierów
ozdobnych, prestiżowych w zależności od potrzeb i wymagań klientów.
Jeżdżąc na coroczne targi reklamy i poligrafii nawiązujemy współpracę z nowymi dostawcami z kraju i zagranicy jak również
mamy możliwość poznać i wdrożyć nowe ciekawe rozwiązania współczesnego designu reklamowego.
W tym roku Nasza NOWA KOLEKCJA - KALENDARZE O TARNOWIE
Jeżeli jeszcze nie jesteś naszym klientem to sprawdź nas idąc razem z nami ze swoimi kalendarzami w Nowy Rok 2018. 
		<br>
			<a href="http://poligon.scepter.pl/PiotrM/wp_merkuriusz/autorskie-kalendarze-merkuriusz" class="ad_btn">zobacz naszą kolekcję</a>

		</div>

		</div>





		<div class="col-sm-12">

		<div class="kal_mer">

		<h3 class="kal">Kalendarze 2018 r. - zapraszamy do zapoznania się z katalogami</h3>

		</div>

		</div>


			<div class="col-sm-12 single_content">

			
				<div class="calendar-wrapper">
					<a href="http://www.merkuriusz.ekalendarze.eu/" target="_blank" title="katalogC" class="calendar-img no-shrink" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/kalendarze/C.jpg);"></a>
					<a href="http://www.pieknekalendarze.pl/" target="_blank" title="katalogJ" class="calendar-img no-shrink" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/kalendarze/J.jpg);"></a>
					<a href="http://www.kalendarz.com.pl/" target="_blank" title="katalogA" class="calendar-img no-shrink" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/kalendarze/A.jpg);"></a>
					<a href="http://www.kalendarze.wizja.net/oferta_MERKURIUSZ_index" target="_blank" title="katalogL" class="calendar-img no-shrink" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/kalendarze/L.jpg);"></a>
				</div>
			</div>
		</div>
	</div>

 <!-- FOOTER -->
<?php get_footer(); ?>