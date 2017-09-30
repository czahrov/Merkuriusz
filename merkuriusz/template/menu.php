	  <nav class="navbar custom-navbar" role="navigation">
		        <div class="container" style="position: relative;">
		        	<div class="col-lg-9 relative">
		            <!-- Brand and toggle get grouped for better mobile display -->
					
		            <div class="navbar-header navbar-left">
		                <button type="button" class="navbar-toggle hamburger-menu" data-toggle="collapse" data-target="#navbar-collapse-1">
		                    <span class="sr-only">Toggle navigation</span>
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		                </button>
		            </div>
		            <!-- Collect the nav links, forms, and other content for toggling -->
		            <div class="collapse navbar-collapse normal-navbar" id="navbar-collapse-1">
						<?php
							$post = get_post();
							$slug = $post->post_name;
							$cat_znak = get_category_by_slug('znakowanie_kategorie');
							$cats = wp_get_post_categories( $post->ID );
							echo "<!--";
							echo "-->";
						?>
		                <ul class="nav navbar-nav navbar-left">
		                    <li>
		                        <a href="<?php echo home_url(); ?>" class="<?php if( $slug === 'strona-glowna' ) echo "actived"; ?>">Strona główna</a>
		                    </li>
		             
		                    <li class="dropdown">
		                        <a class="dropdown-toggle <?php if( $slug === 'o_nas' ) echo "actived"; ?>" data-toggle="dropdown">O Nas <b class="caret"></b></a>
		                        <ul class="dropdown-menu">
		                        	 <li>
		                                <a href="<?php echo home_url('o_nas'); ?>">O NASZEJ FIRMIE</a>
		                            </li>
		                            <li>
		                                <a href="<?php echo home_url('single'); ?>">GADŻETY</a>
		                            </li>
		                            <li>
		                                <a href="<?php echo home_url('single'); ?>">SYSTEMY WYSTAWNICZE</a>
		                            </li>
		                            <li>
		                                <a href="<?php echo home_url('single'); ?>">WYDRUKI</a>
		                            </li>
		                            <li>
		                                <a href="<?php echo home_url('single'); ?>">KOSZULKI</a>
		                            </li>
		                            <li>
		                                <a href="<?php echo home_url('single'); ?>">CERAMIKA</a>
		                            </li>
		                            <li>
		                                <a href="<?php echo home_url('single'); ?>">KALENDARZE</a>
		                            </li>
									
		                        </ul>
		                    </li>
		                    <li>
		                        <a href="<?php echo home_url('oferta'); ?>" class="<?php if( $slug === 'oferta' ) echo "actived"; ?>">Oferta</a>
		                    </li>
		                    <li>
		                        <a href="<?php echo home_url('znakowanie'); ?>" class="<?php if( $slug === 'znakowanie' || in_array( $cat_znak->cat_ID, $cats )) echo "actived"; ?>">Znakowanie</a>
		                    </li>
							  <li>
		                        <a href="<?php echo home_url('drukarnia'); ?>" class="<?php if( $slug === 'drukarnia' ) echo "actived"; ?>">Drukarnia</a>
		                    </li>
							  <li>
		                        <a href="<?php echo home_url('kalendarze'); ?>" class="<?php if( $slug === 'kalendarze' ) echo "actived"; ?>">Kalendarze</a>
		                    </li>
							   <li>
		                        <a href="<?php echo home_url('kontakt'); ?>" class="<?php if( $slug === 'kontakt' ) echo "actived"; ?>">Kontakt</a>
		                    </li>
		                </ul>
		            </div>
		            <!-- /.navbar-collapse -->

		       		</div>

		        </div>
		        <!-- /.container -->
		    </nav>