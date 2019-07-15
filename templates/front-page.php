<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */
get_header(); ?>

<!-- site content -->
<div class="site-content clearfix">
	<!-- main-column -->
	<div class="main-container" style="width: 100%;" >
	
	
	<?php
			if(is_home() && !is_paged() ) {
                        if(get_theme_mod( "frindle_config_featured") ==1 ){
                        	?>
                        	<div class="main-column" id="main">
	                        <?php   if(get_theme_mod("frindle_radio_setting_id") == "recent_post_featured"){
	                        				echo esc_attr(recent_featured());
	                        			}
	                        		else {
	                        			echo esc_attr(frindle_the_featured_section());
	                        		} ?>
							</div>                     

                     <?php }

              }
    ?>

    	<div class="main-column" id="main">
			<?php
			if (have_posts()) :
			while (have_posts()) : the_post();  
			
			get_template_part('content',get_post_format()); ?>
			
			<?php endwhile;
			
			else:
				esc_html_e( 'Sorry, nothing found!', 'frindle' );
			endif; ?>

						<div class="navigation" id="navigation"><strong>
                                <div class="previous"><?php esc_html(previous_posts_link(__( '&laquo; Previous Page','frindle' ))); ?></div>
                                <div class="next"><?php esc_html(next_posts_link( __('Next Page &raquo;', 'frindle' ))); ?></div></strong>
                        </div>
		</div>
	</div>
	<!-- /main-column -->
	
	</div>
	
	<!-- /main-column -->

	
<?php

get_footer();

?>