<div class="col-md-4" id='sidebar'>
	<!-- SIDEBAR NAVIGATION -->
	<div class="sidebar-navigation background-white">
		<ul class='menu'>
			<li class='item flex flex-column'>
				<div class='head flex flex-items-center'>
					<div class='title uppercase bold'>
						gadżety reklamowe
					</div>
					<span class='icon fa fa-angle-right'></span>
				</div>
				<ul class='sub flex flex-column'>
					<?php
					$reklamowe = array(
						'Materiały Piśmiennicze'=> array(
							'img' => 'pisemnicze.png',
						),
						'Biuro' => array(
							'img' => 'biuro.png',
						),
						'Torby, plecaki' => array(
							'img' => 'torby.png',
						),
						'Parasole i peleryny' => array(
							'img' => 'parasole.png',
						),
						'Do picia' => array(
							'img' => 'do_picia.png',
						),
						'Narzędzia' => array(
							'img' => 'narzedzia.png',
						),
						'Dom' => array(
							'img' => 'dom.png',
						),
						'Uroda' => array(
							'img' => 'uroda.png',
						),
						'Rozrywka i szkoła' => array(
							'img' => 'szkola.png',
						),
						'Eco gadżet' => array(
							'img' => 'eco.png',
						),
						'Medyczne' => array(
							'img' => 'medyczne.png',
						),
						'Transport' => array(
							'img' => 'transport.png',
						),
						'Tekstylia' => array(
							'img' => 'tekstylia.png',
						),
						'Świąteczne' => array(
							'img' => 'swiateczne.png',
						),
						'Opakowania upominkowe' => array(
							'img' => 'upominkowe.png',
						),
						
					);
					
					foreach( $reklamowe as $name => $item ): ?>
					<li class='item flex'>
						<div class='head grow flex flex-items-center'>
							<img class='pikto' src='<?php printf( "%s/img/piktogramy/%s", get_template_directory_uri(), $item['img'] ); ?>'>
							<div class='title'>
								<?php echo $name; ?>
							</div>
							<span class='icon fa fa-angle-double-right'></span>
						</div>

					</li>
					<?php endforeach; ?>

				</ul>

			</li>
			<li class='item fofcio flex flex-column'>
				<div class='head flex flex-items-center'>
					<div class='title uppercase bold'>
						fofcio promo toys
					</div>
					<span class='icon fa fa-angle-right'></span>
				</div>
				<ul class='sub flex flex-column'>
					<?php
					$fofcio = array(
						'Opcja 1'=> array(
							'img' => 'pisemnicze.png',
						),
						'Opcja 2' => array(
							'img' => 'biuro.png',
						),
						'Opcja 3' => array(
							'img' => 'torby.png',
						),
						
					);
					
					foreach( $fofcio as $name => $item ): ?>
					<li class='item flex'>
						<div class='head grow flex flex-items-center'>
							<img class='pikto' src='<?php printf( "%s/img/piktogramy/%s", get_template_directory_uri(), $item['img'] ); ?>'>
							<div class='title'>
								<?php echo $name; ?>
							</div>
							<span class='icon fa fa-angle-double-right'></span>
						</div>

					</li>
					<?php endforeach; ?>

				</ul>
			</li>
			<li class='item elektronika flex flex-column'>
				<div class='head flex flex-items-center'>
					<div class='title uppercase bold'>
						elektronika
					</div>
					<span class='icon fa fa-angle-right'></span>
				</div>
				<ul class='sub flex flex-column'>
					<?php
					$elektronika = array(
						'Opcja 1'=> array(
							'img' => 'pisemnicze.png',
						),
						'Opcja 2' => array(
							'img' => 'biuro.png',
						),
						'Opcja 3' => array(
							'img' => 'torby.png',
						),
						
					);
					
					foreach( $elektronika as $name => $item ): ?>
					<li class='item flex'>
						<div class='head grow flex flex-items-center'>
							<img class='pikto' src='<?php printf( "%s/img/piktogramy/%s", get_template_directory_uri(), $item['img'] ); ?>'>
							<div class='title'>
								<?php echo $name; ?>
							</div>
							<span class='icon fa fa-angle-double-right'></span>
						</div>

					</li>
					<?php endforeach; ?>

				</ul>
			</li>
			<li class='item vip open flex flex-column'>
				<div class='head flex flex-items-center flex-justify-between'>
					<div class='title uppercase bold'>
						kolekcja vip
					</div>
					<span class='icon fa fa-angle-right'></span>
				</div>
				<ul class='sub flex flex-column'>
					<?php
						$vip = array(
							'collection'=> array( 
								'title' => 'vip collection',
							 ),
							'skóra' => array( 
								'title' => 'vip skóra',
							 ),
							'viktronix' => array( 
								'title' => 'viktronix',
							 ),
							'vine' => array( 
								'title' => 'vine club',
							 ),
							'piśmiennicze' => array( 
								'title' => 'vip piśmiennicze',
							 ),
							'parker' => array( 
								'pikto' => 'feather.png', 
								'logo' => 'Parker_logo.png',
							 ),
							'waterman' => array( 
								'pikto' => 'pen3.png', 
								'logo' => 'waterman_logo.png',
							 ),
							'ferraghini' => array( 
								'pikto' => 'wallet.png', 
								'logo' => 'ferraghini.png',
							 ),
							'marktwain' => array( 
								'pikto' => 'pen1.png', 
								'logo' => 'marktwain.svg',
							 ),
							'schwarzwolf' => array( 
								'logo' => 'schwarzwolf.png',
							 ),
							'ungaro' => array( 
								'pikto' => 'U.png', 
								'logo' => 'ungaro.png',
							 ),
							'herlitz' => array( 
								'pikto' => 'suitcase.png', 
								'logo' => 'Herlitz_logo.svg',
							 ),
							'pelikan' => array( 
								'pikto' => 'inkwell.png', 
								'logo' => 'pelikan-logo.png',
							 ),
							'diplomat' => array( 
								'pikto' => 'pen2.png', 
								'logo' => 'diplomat.svg',
							 ),
							'cofee' => array( 
								'pikto' => 'cap.png', 
								'logo' => 'coFee.svg',
							),
							
						);
					
					foreach( $vip as $item ): ?>
					<li class='item flex'>
						<div class='head grow flex flex-items-center'>
							<?php if( !empty( $item[ 'pikto'] ) ): ?>
							<img class='pikto' src='<?php printf( "%s/img/ikony/%s", get_template_directory_uri(), $item['pikto'] ); ?>'>
							<?php endif; ?>
							<?php if( !empty( $item[ 'title'] ) ): ?>
							<div class='title bold uppercase'>
								<?php echo $item[ 'title']; ?>
							</div>
							<?php elseif( !empty( $item[ 'logo'] ) ): ?>
							<div class='logotyp flex grow bgimg contain flex-self-stretch' style='background-image: url(<?php printf( "%s/img/logotypy/%s", get_template_directory_uri(), $item['logo']  ); ?>);'></div>
							<?php endif; ?>
							<span class='icon fa fa-angle-double-right'></span>
						</div>

					</li>
					<?php endforeach; ?>

				</ul>

			</li>

		</ul>
	</div>
</div>