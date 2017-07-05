<?php
	/*
	Template Name: single
	*/
	get_header();
	the_post();
?>

<body>
	
	<div class="intro-bar">
		<div class="inner-intro-bar container">
			<div class="col-md-6 intro-item1">Merkuriusz - Techniki nadruków Tarnów</div>
			<div class="col-md-6 intro-item2">Masz pytania? Chętnie na nie odpowiemy <span class="big-text">14 662 33 64</span></div>
		</div>
	</div>

	<div class="container">

		<div class="col-md-5">
			<div class="logo">
				<a href="index.html">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo_merkuriusz.png" class="logo-src" alt="merkuriusz logo">
			</a>
			</div>
		</div>
		<div class="col-md-7">
			<div class="input-group">
                <input type="text" placeholder="Wpisz nazwę lub kod produktu" class="form-control">
                <span class="input-group-btn">
                 <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                </span>
             </div>
		</div>
	</div>

<!-- NAVIGATION -->
		  <?php get_template_part("template/menu"); ?>
	<!-- BANER O NAS-->

	<div class="container-fluid about_us_cover">
		<div class="container">
			<div class="col-sm-12 about_us_content">
				<h1>MERKURIUSZ</h1>
				<p>Dowiedz się więcej o naszej Agencji Reklamowej</p>
			</div>
		</div>
	</div>

<!-- Single US MAIN CONTENT -->

<div class="container-fluid single-page">
		<div class="container">
			<div class="col-sm-12 single_content">
				<p><?php the_content(); ?></p>
			</div>
		</div>
	</div>

 <!-- FOOTER -->
<?php get_footer(); ?>