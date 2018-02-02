<?php
	
	/* tablica na dane do generowania slidera */
	$data = array();
	
	/* pobieranie listy podstron tworzących slajdy */
	$pages = get_pages( array(
		'parent' => 1436,
		'sort_column' => 'menu_order',
		
	) );
	
	foreach( $pages as $page ){
		$slug = $page->post_name;
		$pdf = wp_get_attachment_url( get_post_meta( $page->ID, 'pdf', true ) );
		
		/* wyciąganie odnośników z treści strony */
		$pattern = "~<a.*?href=\"([^\"]+).*?>.*?(?:src=\"([^\"]+).*?)?([\w ]+?)?</a>~";
		$pattern = "~<a href=\"([^\"]+)[^>]+>(?:([^<]+)|(?:.*?src=\"([^\"]+).*?))</a>~";
		preg_match_all( $pattern, $page->post_content, $match );
		
		/* match
			Array
			(
				[0] => Array
					(
						[0] => <a href="/wp-content/uploads/2017/08/dream-pen.pdf" target="_blank" rel="noopener">dream pen</a>
						[1] => <a href="/wp-content/uploads/2017/08/katalog-VIVA-classic.pdf" target="_blank" rel="noopener"><img class="alignnone wp-image-1461 size-medium" src="http://merkuriusz.pl/wp-content/uploads/2018/02/slider_katalog_ikonka-viva_pens-300x68.png" alt="" width="300" height="68" /></a>
						[2] => <a href="/wp-content/uploads/2017/08/lecce-pen-katalog-z-cenami.pdf" target="_blank" rel="noopener"><img class="alignnone wp-image-1454 size-medium" src="http://merkuriusz.pl/wp-content/uploads/2018/02/slider_katalog_ikonka-logo-lecce-pen-300x60.png" alt="" width="300" height="60" /></a>
						[3] => <a href="/wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf" target="_blank" rel="noopener"><img class="alignnone wp-image-1455 size-full" src="http://merkuriusz.pl/wp-content/uploads/2018/02/slider_katalog_ikonka-ritter_pen.png" alt="" width="280" height="115" /></a>
						[4] => <a href="/wp-content/uploads/2017/10/BIC-2-Pricelist.pdf" target="_blank" rel="noopener"><img class="alignnone wp-image-1453 size-medium" src="http://merkuriusz.pl/wp-content/uploads/2018/02/slider_katalog_ikonka-bic_logo-300x127.png" alt="" width="300" height="127" /></a>
					)

				[1] => Array
					(
						[0] => /wp-content/uploads/2017/08/dream-pen.pdf
						[1] => /wp-content/uploads/2017/08/katalog-VIVA-classic.pdf
						[2] => /wp-content/uploads/2017/08/lecce-pen-katalog-z-cenami.pdf
						[3] => /wp-content/uploads/2017/06/Ritter-Katalog-2017_EXPORT_100dpi.pdf
						[4] => /wp-content/uploads/2017/10/BIC-2-Pricelist.pdf
					)

				[2] => Array
					(
						[0] => 
						[1] => http://merkuriusz.pl/wp-content/uploads/2018/02/slider_katalog_ikonka-viva_pens-300x68.png
						[2] => http://merkuriusz.pl/wp-content/uploads/2018/02/slider_katalog_ikonka-logo-lecce-pen-300x60.png
						[3] => http://merkuriusz.pl/wp-content/uploads/2018/02/slider_katalog_ikonka-ritter_pen.png
						[4] => http://merkuriusz.pl/wp-content/uploads/2018/02/slider_katalog_ikonka-bic_logo-300x127.png
					)

				[3] => Array
					(
						[0] => pen
						[1] => 
						[2] => 
						[3] => 
						[4] => 
					)

			)

		*/
		
		$files = $match[1];
		$texts = $match[2];
		$imgs = $match[3];
		
		/* tablica na odnośniki z treści strony */
		$items = array();
		
		foreach( $files as $index => $file ){
			$items[] = array(
				'class' => '',
				'url' => $files[ $index ],
				'img' => $imgs[ $index ],
				'title' => $texts[ $index ],
				
			);
			
		}
		
		$data[ $slug ] = array(
			'slider' => array(
				'title' => $page->post_title,
				'cover-class' => '',
				'img' => get_the_post_thumbnail_url( $page->ID ),		/* string | false */
				'url' => $pdf,		/* string | false */
				
			),
			'popup' => array(
				'title' => $page->post_title,
				'subtitle' => '',
				'items' => $items,
				
			),
			
		);
		
	}
	
	echo "<!--XXX";
	// print_r( $data );
	echo "-->";
	
?>

<!-- CATALOG SLIDER -->
<div class="catalog-slider grid">
	<h2 class="section-title uppercase bold flex flex-items-center flex-justify-center">
		<div class=''>
			<span class='font-blue'>Zobacz produkty</span> w katalogach pdf
		</div>
	</h2>
	<div class="catalog-slider-wrapper">
		<div class="catalog-arrow-box">
			<i class="fa fa-angle-left fa-2x arrow-position" aria-hidden="true"></i>
		</div>
		<div class="catalog-container">
			<?php
				foreach( $data as $name => $item ):
				$slider = $item[ 'slider' ];
			?>
			<div class="catalog-element">
				<div class="catalog" item='<?php echo $name; ?>' style='background-image: url(<?php echo empty( $slider[ 'img' ] )?( 'https://placeimg.com/200/200' ):( $slider[ 'img' ] ); ?>);'>
					<div class="catalog-cover pointer <?php echo $slider[ 'cover-class' ]; ?> flex">
						<div class="cat-cover-text uppercase base1 flex-self-stretch flex flex-items-center flex-justify-center">zobacz katalog</div>
					<?php
						if( !empty( $slider[ 'url' ] ) ){
							$url = stripos( $slider[ 'url' ], 'http' ) === 0?( $slider[ 'url' ] ):( home_url( $slider[ 'url' ] ) );
							printf( "<a class='hitbox' href='%s' target='_blank'></a>", $url );
							
						}
						
					?>
					</div>
				</div>
				<div class="catalog_signature"><?php echo $slider[ 'title' ]; ?></div>
			</div>
			<?php endforeach; ?>
			
		</div>
		<div class="catalog-arrow-box catalog-right">
			<i class="fa fa-angle-right fa-2x arrow-position" aria-hidden="true"></i>
		</div>

	</div>
	
</div>

<!-- CONTAINER END -->

<div class='popup katalog flex flex-items-center flex-justify-center'>
	<div class='box grid bg-light flex flex-column'>
		<div class='close-fp pointer bg-blue font-light flex flex-items-center flex-justify-center'>
			<span class='icon fa fa-times'></span>
		</div>
		<div class='viewbox'>
			<?php
				
				foreach( $data as $name => $item ):
				$popup = $item[ 'popup' ];
			?>
			<div class='view <?php echo $name; ?> hide-fp flex flex-column'>
				<div class='top bold uppercase'>
					<?php echo $popup[ 'title' ]; ?>
				</div>
				<div class='mid flex flex-items-start'>
					<div class='pic base4 no-shrink flex flex-column'>
						<div class='img'>
							<img/>
						</div>
						<div class='text uppercase bold font-blue text-center'>
							<?php echo $popup [ 'subtitle' ]; ?>
						</div>
						
					</div>
					<div class='items grow flex flex-wrap'>
						<?php
							foreach( $popup[ 'items' ] as $item ):
						?>
						<div class='item bold' item='<?php echo $name; ?>'>
							<div class='link uppercase bg-center bg-contain bg-norepeat flex flex-items-center flex-justify-center' style='background-image:url( <?php echo $item[ 'img' ] ?> );'>
								<?php echo $item[ 'title' ]; ?>
							</div>
							<?php
								$url = "";
								
								if( !empty( $item[ 'url' ] ) ){
									$url = stripos( $item[ 'url' ], 'http' ) === 0?( $item[ 'url' ] ):( home_url( $item[ 'url' ] ) );
									
								}
								
								printf( "<a class='hitbox'%s></a>",
									sprintf( " href='%s' target='_blank'", $url )
									
								);
									
							?>
						</div>
						<?php endforeach; ?>
						
					</div>
					
				</div>
				
			</div>
			<?php endforeach; ?>
			<div class='view reklamowa hide-fp flex flex-column'>
				<div class='top bold uppercase'></div>
				<div class='mid flex flex-items-start'>
					<div class='pic base4 no-shrink flex flex-column'>
						<div class='img'>
							<img/>
						</div>
						<div class='text uppercase bold font-blue text-center'></div>
						
					</div>
					<div class='items grow flex flex-wrap'>
						<div class='item bold hide'>
							<div class='link uppercase bg-center bg-contain bg-norepeat flex flex-items-center flex-justify-center' style='background-image:url(  );'></div>
							<a class='hitbox'></a>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
</div>
