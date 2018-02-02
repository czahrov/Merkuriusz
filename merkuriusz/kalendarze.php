<?php
	/*
	Template Name: kalendarze
	*/
	get_header();

?>

<body id='kalendarze'>
	
	<?php get_template_part( "template/page", "top" ); ?>
	<?php get_template_part( "template/menu", "top" ); ?>
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

<?php
	$children = get_pages( array(
		'parent' => get_post()->ID,
		
	) );
	
	foreach( $children as $child ):
?>

	<div class="container-fluid single-page">
		
		<div class="container">
		
			<div class="col-sm-12">

				<div class="kal_mer">

					<h2 class="kal"><?php echo $child->post_title; ?></h2>
				
				</div>
			
			</div>
			
		</div>
		
	</div>

	<div class="kafelki grid flex flex-wrap">
		<?php
			$pages = get_pages( array(
				'parent' => $child->ID,
				'exclude' => array( get_page_by_title( "Kalendarze Kolekcja Tarnów" )->ID ),
				
			) );
			
			foreach( $pages as $page ):
			$img = wp_get_attachment_image_url( get_post_meta( $page->ID, 'img', true ), 'full' );
			if( empty( $img ) ) $img = get_the_post_thumbnail_url( $page->ID );
			
		?>
		<div class='item base1 base2-mm base3-ml base4-ds flex'>
			<a class='box pointer grow' href='<?php echo get_permalink( $page->ID ); ?>'>
				<img src='<?php echo $img; ?>'>
				<div class='title text-center'>
					<?php echo $page->post_title; ?>
				</div>
				
			</a>
			
		</div>
		<?php endforeach; ?>
		
	</div>

<?php endforeach; ?>

<div class="container content">
	<?php echo apply_filters( 'the_content', get_post()->post_content ); ?>
</div>


<!-- FOOTER -->
<?php get_footer(); ?>