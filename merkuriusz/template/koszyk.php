<?php get_template_part( "template/page", "top" ); ?>
<body id='cart'>
	<div class='container grid flex'>
		<?php get_template_part( "template/menu", "side" ); ?>
		<div id='grid' class='base1'>
			<?php get_template_part( "template/menu", 'top'); ?>
			<div class='top flex flex-wrap flex-items-center flex-justify-between'>
				<div class='breadc uppercase base1 base0-mm flex flex-items-center flex-justify-center'></div>
				
			</div>
			<div class='mid flex flex-column'>
				<div class='table flex flex-column'>
					<div class='title bold flex flex-items-center'>
						Podgląd stanu koszyka
					</div>
					<div class='thead bold flex'>
						<div class='base4 flex flex-items-center flex-justify-start'>Produkt</div>
						<div class='base6 flex flex-items-center flex-justify-center'>Ilość</div>
						<div class='base4 grow flex flex-items-center flex-justify-center'>Znakowanie</div>
						<div class='base4 flex flex-items-center flex-justify-center'>Cena</div>
						<div class='base6 flex flex-items-center flex-justify-center'>Zaznacz</div>
						
					</div>
					<form class='tbody opcje'>
						<?php
							if( count( $_SESSION[ 'cart' ] ) > 0 ):
								foreach( $_SESSION[ 'cart' ] as $id => $set ): ?>
						<div class='line flex'>
							<div class='field name base4 flex flex-items-center flex-justify-start'>
								<?php echo $set[ 'name' ]; ?>
							</div>
							<div class='field num base6 flex flex-items-center flex-justify-center'>
								<?php echo $set[ 'num' ]; ?>
							</div>
							<div class='field marking grow base4 flex flex-items-center flex-justify-center'>
								<?php
									if( $set[ 'mark' ][ 'type' ] === 'brak' ){
										echo "Brak";
										
									}
									else{
										printf( "%s, %s, kolory: %s", $set[ 'mark' ][ 'type' ], $set[ 'mark' ][ 'place' ], $set[ 'colors' ] );
										
									}
								?>
							</div>
							<div class='field price base4 flex flex-items-center flex-justify-center'>
								<?php
									if( $set[ 'mark' ][ 'type' ] !== 'brak' ){
										printf( "%.2f zł brutto", (float)$set[ 'num' ] * (float)$set[ 'num' ] + markPrice( $set[ 'mark' ][ 'type' ], $set[ 'num' ] )[ 'total' ] );
										
									}
									else{
										printf( "%.2f zł brutto", $set[ 'num' ] * $set[ 'num' ] );
										
									}
								?>
							</div>
							<div class='field options base6 flex flex-items-center flex-justify-around'>
								<input class='hide' id='<?php echo $id; ?>' type='checkbox' value='<?php echo $id; ?>' name='produkt[]'/>
								<label class='pointer flex flex-items-center flex-justify-center' for='<?php echo $id; ?>'>
									<div class='icon fa fa-check'></div>
									
								</label>
								
							</div>
							
						</div>
						<?php
								endforeach;
							else:
						?>
						<div class='line flex'>
							<div class='field bold grow flex flex-items-center flex-justify-center'>
								Twój koszyk jest pusty
							</div>
							
						</div>
						<?php
							endif;
						?>
						<div class='line options flex flex-justify-between'>
							<div class='title bold flex flex-items-center'>
								Opcje
							</div>
							<div class='buttons base4 flex flex-items-center flex-justify-around'>
								<div class='icon pointer del fa fa-trash' title='usuń zaznaczone zestawy'></div>
								<div class='icon pointer buy fa fa-shopping-cart' title='zamów zaznaczone zestawy'></div>
								
							</div>
							
						</div>
						
					</form>
					<form class='table form'>
						<div class='thead bold flex flex-items-center'>
							Formularz zamówienia
						</div>
						<div class='tbody flex flex-wrap'>
							<div class='field imie base2 flex'>
								<input class='input base1' type='text' name='imie' placeholder='Imię i nazwisko' />
								
							</div>
							<div class='field tel base2 flex'>
								<input class='input base1' type='tel' name='tel' placeholder='Numer telefonu' />
								
							</div>
							<div class='field mail base2 flex'>
								<input class='input base1' type='email' name='mail' placeholder='Adres e-mail' />
								
							</div>
							<div class='field file base2 flex'>
								<input class='hide' type='file' name='file'/>
								<div class='input base1 pointer flex flex-items-center flex-justify-between'>
									<div class='title'>
										Dodaj załącznik
									</div>
									<div class='icon fa fa-upload'></div>
									
								</div>
								
							</div>
							<div class='field msg base1 flex'>
								<textarea class='input grow' name='msg' placeholder='Treść wiadomości'></textarea>
								
							</div>
							
						</div>
						<div class='tbottom flex flex-items-center flex-justify-between'>
							<div class='status grow flex flex-items-center'>
								<div class='icon'>
									<div class='ok fa fa-check-circle'></div>
									<div class='fail fa fa-times-circle'></div>
									<div class='info fa fa-info-circle'></div>
									<div class='wait fa fa-circle-o-notch fa-spin'></div>
									
								</div>
								<div class='text grow'></div>
								<div class='load base1 flex flex-wrap flex-items-center'>
									<div class='progres bold'></div>
									<div class='bar grow'></div>
									
								</div>
								
							</div>
							<div class='button send pointer flex flex-items-center flex-justify-center'>
								Wyślij
							</div>
							
						</div>
						
					</form>
					
				</div>
				
			</div>
			
		</div>
		
	</div>

<?php get_template_part( "template/slider", "katalog" ); ?>

<?php get_template_part( "template/reklama360" ); ?>

<?php get_template_part( "template/newsletter" ); ?>

<?php get_footer(); ?>
