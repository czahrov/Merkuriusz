<?php get_template_part( 'template/page', 'top-bar' ); ?>

<div id='top' class='grid flex flex-justify-between'>
	<div class='logo flex'>
		<a class='pointer bgimg contain' href='<?php echo home_url(); ?>'></a>
		
	</div>
	<form class='searchbar grow flex' method='get' action='<?php echo home_url( 'produkt' ); ?>'>
		<input class='input grow' type='text' name='nazwa' placeholder='Wpisz nazwę lub kod produktu'/>
		<button class='button pointer bold alt flex flex-items-center flex-justify-center' type='submit'>
			Szukaj
			
		</button>
		
	</form>
	<div id='basket' class="pointer flex flex-items-center">
		<a class="basket-text bold" href='<?php echo home_url( 'koszyk' ); ?>'>
		<?php
			if( count( $_SESSION[ 'cart' ] ) > 0 ){
				$status = cartStatus();
				printf( "%s szt | %.2f zł", $status[ 'num' ], $status[ 'price' ] );
			}
			else{
				echo "Pusty";

			}

		?>
		</a>
		<i class="icon fa fa-shopping-basket fa-2x" aria-hidden="true"></i>

	</div>
	
</div>
