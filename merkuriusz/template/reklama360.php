<div class="reklama360 grid flex flex-wrap">
	<div class='header bold alt uppercase base1 flex flex-items-center flex-justify-center'>
		<div class=''>
			<span class='font-blue'>Reklama</span> 360 stopni
		</div>
	</div>
	<div class='body base1 flex flex-wrap'>
		<?php
			$data = array(
				array(
					'title' => 'identyfikacja wizualna firm',
					'content' => 'Projektujemy banery, szyldy, naklejki samoprzylepne, papierowe, folie wypukłe, magnesy',
					'img' => 'https://placeimg.com/500/200/tech',
					'url' => home_url(),
					
				),
				array(
					'title' => 'reklama wizualna',
					'content' => 'Projektujemy banery, szyldy, naklejki samoprzylepne, papierowe, folie wypukłe, magnesy',
					'img' => 'https://placeimg.com/500/200/tech',
					'url' => home_url(),
					
				),
				array(
					'title' => 'techniki nadruków',
					'content' => 'Projektujemy banery, szyldy, naklejki samoprzylepne, papierowe, folie wypukłe, magnesy',
					'img' => 'https://placeimg.com/500/200/tech',
					'url' => home_url(),
					
				),
				array(
					'title' => 'gadżety reklamowe',
					'content' => 'Projektujemy banery, szyldy, naklejki samoprzylepne, papierowe, folie wypukłe, magnesy',
					'img' => 'https://placeimg.com/500/200/tech',
					'url' => home_url(),
					
				),
				
			);
			
			foreach( $data as $item ):
		?>
		<div class='item base1 base2-mm flex'>
			<div class='box bgimg full base1' style='background-image:url(<?php echo $item[ 'img' ]; ?>);'>
				<div class='over flex'>
					<div class='content flex flex-items-center'>
						<?php echo $item[ 'content' ]; ?>
					</div>
					
				</div>
				<div class='hint bold alt uppercase bg-blue'>
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
