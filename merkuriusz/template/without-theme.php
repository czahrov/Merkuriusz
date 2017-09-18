<div class="intro-bar">
	<div class="inner-intro-bar container">
		<div class="col-md-6 intro-item1">Merkuriusz - Techniki nadruków Tarnów</div>
		<div class="col-md-6 intro-item2">Masz pytania? Chętnie na nie odpowiemy <span class="big-text">14 662 33 64</span>
		</div>
	</div>
</div>

<div class="container">

	<div class="col-md-5">
		<div class="logo">
			<a href="<?php echo home_url(); ?>">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo_merkuriusz.png" class="logo-src pointer" alt="merkuriusz logo">
			</a>
		</div>
	</div>
	<div class="col-md-7">
		<form class="input-group" id="searchform" method="get" action="<?php echo home_url(); ?>">
			<input type="text" name="s" id="s" size="15" placeholder="Wpisz nazwę lub kod produktu" class="form-control search_input">

			<?php wp_dropdown_categories( 'show_option_none=Wybierz kategorię' ); ?>

			<!--
<select class="form-control depart_input">
<option>Wszystkie działy</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
</select>  -->
			<span class="input-group-btn">
				<button class="btn btn-default" type="submit" value="Search">
					<i class="fa fa-search"></i>
					</button>
			</span>
		</form>
	</div>
</div>

<!-- NAVIGATION -->
<?php get_template_part( "template/menu"); ?>