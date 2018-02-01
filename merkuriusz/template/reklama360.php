<div class="reklama360 grid flex flex-wrap">
	<div class='header bold uppercase base1 flex flex-items-center flex-justify-center'>
		<div class=''>
			<span class='font-blue'>Reklama</span> 360 stopni
		</div>
	</div>
	<div class='body base1 flex flex-wrap'>
		<?php
			$posts = get_posts( array(
				'numberposts' => -1,
				'category_name' => 'Reklama 360 stopni',
				'order' => 'ASC',
				'orderby' => 'meta_value',
				'meta_key' => 'order',
				
			) );
			
			foreach( $posts as $item ):
		?>
		<div class='item base1 base2-mm flex'>
			<div class='box bg-cover bg-center base1' style='background-image: url(<?php echo get_the_post_thumbnail_url( $item->ID, 'large' ); ?>)'>
				<div class='over flex'>
					<div class='content base1 flex flex-items-center'>
						<?php echo $item->post_content; ?>
					</div>
					
				</div>
				<div class='hint bold uppercase bg-blue'>
					<?php echo $item->post_title; ?>
				</div>
				<a class='hitbox pointer' href='<?php echo get_post_meta( $item->ID, 'link', true ); ?>'></a>
				
			</div>
			
		</div>
		<?php
			endforeach;
		?>
	</div>
	
</div>
