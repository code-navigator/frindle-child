<!DOCTYPE html>
<html<?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo('charset');?>">
		<meta name="viewport" content="width=device-width">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<div class="container" id="container">
					
			<!-- Site-Header -->
			<div class="site-header">

				<!-- Site-Branding -->
				<div class="site-branding"></div>

				<!-- Site-banner -->
				<div class="site-banner"></div>				
								
			</div><!-- /site-header -->
					
					
					
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