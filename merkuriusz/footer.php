<!-- FOOTER -->
 <footer>
 	<div class='infobar grid'>
		<div class='box flex flex-wrap flex-justify-around'>
			<div class='item base1 base0-mm flex flex-items-center'>
				<div class='icon no-shrink flex flex-items-center flex-justify-center'>
					<img src='<?php echo get_template_directory_uri(); ?>/img/poi.png' />
					
				</div>
				<div class='text'>
					<span class='bold alt'>Adres:</span> Szpitalna 25B, 33-100 Tarnów
					
				</div>
				
			</div>
			<div class='item base1 base0-mm flex flex-items-center'>
				<div class='icon flex flex-items-center flex-justify-center'>
					<img src='<?php echo get_template_directory_uri(); ?>/img/phone.png' />
					
				</div>
				<div class='text'>
					<span class='bold alt'>Tel / Fax:</span> +48 14 622 33 64
					
				</div>
				
			</div>
			<div class='item base1 base0-mm flex flex-items-center'>
				<div class='icon flex flex-items-center flex-justify-center'>
					<img src='<?php echo get_template_directory_uri(); ?>/img/mail.png' />
					
				</div>
				<div class='text'>
					<span class='bold alt'>E-mail:</span> biuro@merkuriusz.pl
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	<?php get_template_part( 'template/slider-partnerzy' ); ?>
	<div class='mid bg-gray2'>
		<div class='box grid flex flex-wrap'>
			<div class='info grow base1 base0-mm text-center text-left-mm'>
				<img src='<?php echo get_template_directory_uri(); ?>/img/logo_merkuriusz.png'/>
				<div class='text'>
					Jestesmy pasjonatami projektowania unikalnych rozwiązań i mozemy zaoferować specjalistyczną wiedzę i doświadczenie. Jesteśmy pewni, że znejdziesz to, czego szukasz. Praktyczne, eleganckie i trwałe artykuły promocyjne, mogą kreować wizerunek marki oraz przekazywać czytelne komunikaty lud wiadomości do wszystkich Twoich odbiorców.
				</div>
				
			</div>
			<div class='linki grow base1 base0-mm text-center text-left-mm'>
				<div class='title bold uppercase'>
					Na skróty
				</div>
				<ul>
					<li>
						<a href='<?php echo home_url(); ?>'>
							Strona główna
						</a>
						
					</li>
					<li>
						<a href='<?php echo home_url( 'o-nas' ); ?>'>
							O nas
						</a>
						
					</li>
					<li>
						<a href='<?php echo home_url( 'oferta' ); ?>'>
							Oferta
						</a>
						
					</li>
					<li>
						<a href='<?php echo home_url( 'znakowanie' ); ?>'>
							Znakowanie
						</a>
						
					</li>
					<li>
						<a href='<?php echo home_url( 'drukowanie' ); ?>'>
							Drukowanie
						</a>
						
					</li>
					<li>
						<a href='<?php echo home_url( 'kalendarze' ); ?>'>
							Kalendarze
						</a>
						
					</li>
					<li>
						<a href='<?php echo home_url( 'kontakt' ); ?>'>
							Kontakt
						</a>
						
					</li>
					
				</ul>
				
			</div>
			<div class='linki grow base1 base0-mm text-center text-left-mm'>
				<div class='title bold uppercase'>
					Informacje
				</div>
				<ul>
					<li>
						<a href='<?php echo home_url( 'polityka-prywatnosci' ); ?>'>
							Polityka prywatności
						</a>
						
					</li>
					<li>
						<a href='<?php echo home_url( 'targi' ); ?>'>
							Targi
						</a>
						
					</li>
					<li>
						<a href='<?php echo home_url( 'mapa-strony' ); ?>'>
							Mapa strony
						</a>
						
					</li>
					<li>
						<a href='<?php echo home_url( 'projekty-ue' ); ?>'>
							Projekty ue
						</a>
						
					</li>
					<li>
						<a href='<?php echo home_url( 'pliki-cookies' ); ?>'>
							Pliki cookies
						</a>
						
					</li>
					<li>
						<a href='<?php echo home_url( 'inne' ); ?>'>
							Inne
						</a>
						
					</li>
					
				</ul>
				
			</div>
			
		</div>
	</div>
	<div class='bot grid flex flex-wrap flex-items-center flex-justify-center flex-justify-between-mm'>
		<div class='cell flex flex-items-center'>
			<span class='bold alt'>Copyright 2017</span>
			<span class=''>Merkuriusz Techniki nadruków</span>
			
		</div>
		<div class='cell flex flex-items-center'>
			<span class='bold alt'>Projekt i wykonanie:</span>
			<a href='http://www.scepter.pl' target='_blank'>Scepter Agencja interaktywna</a>
			
		</div>
		
	</div>
	
 </footer>

<!-- FACEBOK SLIDER -->
	<div id="face-slider">

		<div id="face-code">
		
		<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fmerkuriuszpl%2F%3Fref%3Dbr_rs&tabs&width=340&height=214&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="287" height="290" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>

		</div>
		<div id="tab"></div>
	</div>
	<?php get_template_part( "template/popup", "hint" ); ?>
	<?php wp_footer(); ?>
</body>
</html>
