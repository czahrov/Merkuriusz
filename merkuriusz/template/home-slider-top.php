<!-- SLAJDER -->
<?php
	$posts = get_posts(array(
		'numberposts' => -1,
		'category_name' => 'slider-na-stronie-glownej',
		
	));
	
	$data_slider = array();
	
	foreach( $posts as $post ){
		$data_slider[] = array_merge(
			array(
				'title_alt' => 'Lorem ipsum',
				'content' => 'Lorem ipsum',
				'img_alt' => "https://placeimg.com/200/200/tech",
				'link_title_alt' => 'Link',
				'link_url_alt' => '#',
				
			),
			array(
				'title' => $post->post_title,
				'content' => $post->post_content,
				'img' => wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), 'full' ),
				'link_title' => get_post_meta( $post->ID, 'slider_link_title', true ),
				'link_url' => get_post_meta( $post->ID, 'slider_link_url', true ),
				
			)
			
		);
		
	}
	
	echo "<!--";
	print_r( $data_slider );
	echo "-->";
	
?>
<div class='top-slider grow flex'>
	<div class='imgs base3 grow flex' style='margin-left: 0; position: relative;'>
		<div class='view grow flex'>
			<?php
				foreach( $data_slider as $num => $item ):
			?>
			<div class='item base1 no-shrink bg-cover bg-top<?php if( $num === 0 ) echo " active "; ?>' style='background-image: url(<?php echo empty( $item[ 'img' ] )?( $item[ 'img_alt' ] ):( $item[ 'img' ] ); ?>);'>
				<div class='box flex flex-column flex-items-start'>
					<div class='title bold font-blue uppercase'>
						<?php //echo $item[ 'title' ]; ?>
					</div>
					<div class='content bold alt'>
						<?php //echo empty( $item[ 'content' ] )?( $item[ 'content_alt' ] ):( $item[ 'content' ] ); ?>
					</div>
					<div class='link'>
						<div class='button bg-blue font-light text-center uppercase flex flex-items-center'>
							<div class='text bold alt base1'>
								<?php echo empty( $item[ 'link_title' ] )?( $item[ 'link_title_alt' ] ):( $item[ 'link_title' ] ); ?>
							</div>
							<a class='hitbox' href='<?php echo empty( $item[ 'link_url' ] )?( $item[ 'link_url_alt' ] ):( $item[ 'link_url' ] ); ?>'></a>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
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