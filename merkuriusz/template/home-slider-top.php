<!-- SLAJDER -->
<?php
	$data_slider = array(
		array(
			'title' => 'Lokalizator kluczy',
			'content' => 'Urządzenie współpracuje z aplikacjami na Androida i iOS (iPhone). Wystarczy, że pobierzesz aplikację iTracking dostępną w Sklepie Play lub Apple Store i już możesz zacząć konfigurację swojego lokalizatora.',
			'img' => sprintf( "%s/img/slajder.jpg", get_template_directory_uri() ),
			'link' => array(
				'url' => '#',
				
			),
			
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'content' => 'Lorem ipsum tekst',
			'img' => "http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/08/slajder.jpg",
			'link' => array(
				'url' => '#',
				
			),
			
		),
		array(
			'title' => 'Lorem ipsum inny tytuł',
			'content' => 'Lorem ipsum inny tekst',
			'img' => 'http://poligon.scepter.pl/PiotrM/wp_merkuriusz/wp-content/uploads/2017/08/slajder.jpg',
			'link' => array(
				'url' => '#',
				
			),
			
		),
		
	);
?>
<div class='top-slider grow flex'>
	<div class='text base3 grow flex flex-column' style='display: none;'>
		<div class='view grow flex'>
			<?php
				foreach( $data_slider as $num => $item ):
			?>
			<div class='item base1 no-shrink flex flex-column<?php if( $num === 0 ) echo " active "; ?>'>
				<div class='title semibold uppercase'>
					<?php echo $item['title']; ?>
				</div>
				<div class='content grow'>
					<?php echo $item['content']; ?>
				</div>
				<a class='button semibold uppercase flex-self-start' href='<?php echo $item['link']['url'] ?>'>
					O produkcie
				</a>
				
			</div>
			<?php endforeach; ?>
		</div>

		
	</div>
	<div class='imgs base3 grow fp-hide flex-mm flex-column' style='margin-left: 0; position: relative;'>
		<div class='view grow flex'>
			<?php
				foreach( $data_slider as $num => $item ):
			?>
			<div class='item base1 no-shrink bgimg full<?php if( $num === 0 ) echo " active "; ?>' style='background-image: url(<?php echo $item['img']; ?>);'></div>
			<?php endforeach; ?>
		</div>
		<div class='pagin flex'>
			<?php
				foreach( $data_slider as $num => $item ): 
			?>
			<div class='item pointer<?php if( $num === 0 ) echo " active "; ?>'></div>
			<?php endforeach; ?>
			
		</div>
	</div>
	
</div>