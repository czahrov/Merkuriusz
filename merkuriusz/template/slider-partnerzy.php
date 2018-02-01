<div class="container grid partnerzy">
	<div class="col-md-12">
		<h2 class="title  flex flex-items-center flex-justify-center">
			<div class='bold uppercase'>
				<span class='font-blue'>Nasi</span> Partnerzy
			</div>
			
		</h2>
		<div class="col-md-12 partner-container partner-slider" style="padding: 0;">
			<div class="partner-arrow-box partner-left">
				<i class="fa fa-angle-left fa-2x arrow-position" aria-hidden="true"></i>
			</div>

			<div class="partner-wrapper">
				<?php
					$posts = get_posts( array(
						'numberposts' => -1,
						'category_name' => 'Nasi partnerzy',
						'orderby' => 'rand',
						
					) );
					
					foreach( $posts as $item):
				?>
				<div class="partner-icon-box">
					<img src="<?php echo get_the_post_thumbnail_url( $item->ID, 'medium' ); ?>" class="partner-icon">
				</div>
				<?php endforeach; ?>
			</div>
				
			<div class="partner-arrow-box partner-right"><i class="fa fa-angle-right fa-2x arrow-position" aria-hidden="true"></i></div>

		</div>
	
	</div>
	
</div>
