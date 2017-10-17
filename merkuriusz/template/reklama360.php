<div class="reklama360 grid flex flex-wrap">
	<div class='header bold uppercase base1 flex flex-items-center flex-justify-center'>
		<div class=''>
			<span class='font-blue'>Reklama</span> 360 stopni
		</div>
	</div>
	<div class='body base1 flex flex-wrap'>
		<?php
			$data = array(
				array(
					'class' => 'identyfikacja',
					'title' => 'identyfikacja wizualna firm',
					'content' => 'Projektujemy, drukujemy oraz składamy roll-upy, ścianki wystawiennicze',
					'img' => 'https://placeimg.com/500/200/tech',
					'url' => home_url(),
					
				),
				array(
					'class' => 'wizualna',
					'title' => 'reklama wizualna',
					'content' => 'Projektujemy banery, szyldy, naklejki samoprzylepne, papierowe, folie wypukłe, magnesy',
					'img' => 'https://placeimg.com/500/200/tech',
					'url' => home_url(),
					
				),
				array(
					'class' => 'techniki',
					'title' => 'techniki nadruków',
					'content' => 'Oferujemy druk wielkoformatowy, offsetowy, cyfrowy, UV',
					'img' => 'https://placeimg.com/500/200/tech',
					'url' => home_url(),
					
				),
				array(
					'class' => 'gadzety',
					'title' => 'gadżety reklamowe',
					'content' => 'Na zamówienie projektujemy gadżety reklamowe oraz eventowe',
					'img' => 'https://placeimg.com/500/200/tech',
					'url' => home_url(),
					
				),
				
			);
			
			foreach( $data as $item ):
		?>
		<div class='item base1 base2-mm flex <?php echo $item[ 'class' ]; ?>'>
			<div class='box bg-cover bg-center base1'>
				<div class='over flex'>
					<div class='content base1 flex flex-items-center'>
						<?php echo $item[ 'content' ]; ?>
					</div>
					
				</div>
				<div class='hint bold uppercase bg-blue'>
					<?php echo $item[ 'title' ] ?>
				</div>
				<a class='hitbox pointer' href='<?php echo $item[ 'url' ]; ?>'></a>
				
			</div>
			
		</div>
		<?php
			endforeach;
		?>
	</div>
	
</div>
