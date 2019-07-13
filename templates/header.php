<!DOCTYPE html>
<html<?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo('charset');?>">
		<meta name="viewport" content="width=device-width">
		
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<div class="container" id="container">
					
			<!-- site-header -->
			
			<div class="site-header">
					
				<div class="site-branding">
						<div class="site-title">
							<h2>
								<a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a>
							</h2>
							<div id="tagline"><?php bloginfo('description'); ?> </div>
						</div>
				</div><!-- .site-branding -->

				<div style="width: 800px;" >
					<img src="../images/Cygnus_2006-10-21_1_PS.jpg" alt="" width="200" height="50">
				</div>				
								
			</div>
			
			<!-- /site-header -->
					
					
					
					<span class="menu-trigger" id="menu-trigger"> <i class="fa fa-bars" style="font-size:20px"></i>&nbsp; </span>
					
					
					
					<!-- header-menu -->
					<div class="main-nav site-nav">
					
					<?php
					
					$args = array(
						'theme_location' => 'primary'
					);
					
					?>
					<?php if ( get_theme_mod( 'header_menu_search' ) == 1 ) : ?>
					<div class="header-search">
					
						<?php get_search_form(); ?>

				
					</div>
					<?php 	endif; ?>
					<?php wp_nav_menu(  $args ); ?>
					
				</div>
					<!-- /header-menu -->
				<?php 

					$notification = get_theme_mod( 'main_notification' );

			
					if ( get_theme_mod( 'quick_notify' ) == 1 ) : ?>
					<div class="quick-notification">
					<i class="fa fa-exclamation-circle" style="font-size:14px"> </i>   &nbsp;
					<?php echo frindle_sanitize_html($notification); ?>
					
					</div>
					<?php 	endif; ?>