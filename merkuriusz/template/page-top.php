<div class="intro-bar">
	<div class="inner-intro-bar container">
		<div class="col-md-6 intro-item1">Merkuriusz - Techniki nadruków Tarnów</div>
		<div class="col-md-6 intro-item2">Masz pytania? Chętnie na nie odpowiemy <span class="big-text">14 662 33 64</span>
		</div>
	</div>
</div>

<div id='top' class='grid flex flex-items-center flex-justify-between'>
	<div class='logo'>
		<a class='pointer' href='<?php echo home_url(); ?>'>
			<img src='<?php echo get_template_directory_uri(); ?>/img/logo_merkuriusz.png' />
		</a>
		
	</div>
	<form class='searchbar flex' method='get' action='<?php echo home_url( 'produkt' ); ?>'>
		<input class='input' type='text' name='nazwa' placeholder='Wpisz nazwę lub kod produktu'/>
		<button class='button pointer flex flex-items-center flex-justify-center' type='submit'>
			<div class='icon fa fa-search'></div>
			
		</button>
		
	</form>
	
</div>

<!-- NAVIGATION -->
<div class="background-theme"></div>
<?php get_template_part( "template/menu"); ?>