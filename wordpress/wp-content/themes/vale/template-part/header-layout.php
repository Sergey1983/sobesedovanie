<?php

/**
 * Wp in Progress
 * 
 * @package Wordpress
 * @author WPinProgress
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

if (!function_exists('vale_header_layout_function')) {

	function vale_header_layout_function($theme_location, $menu_class) { 
			
			do_action( 'suevafree_mobile_menu', $theme_location, $menu_class );

	?>

            <div id="wrapper">
        
                <div id="overlay-body"></div>
				
                <div id="header-wrapper" class="fixed-header header-10" >
                        
                    <header id="header" >

                    	<nav class="suevafree-menu suevafree-general-menu">
                                            
                    		<?php 
										
                    			wp_nav_menu( array(
                    				'theme_location' => $theme_location,
                    				'menu_class' => $menu_class,
                    				'container' => 'false',
                    				'depth' => 3
                    				)
                    			); 
										
                    		?>

                    	</nav> 
                       
                        <?php echo suevafree_header_cart(); ?>

                    	<div class="mobile-navigation"><i class="fa fa-bars"></i> </div>

					</header>

                </div>

                <div id="logo">
									
                	<?php do_action( 'suevafree_logo_layout', 'on' ); ?>
                                	
                </div>
            
	<?php

	}

	add_action( 'vale_header_layout', 'vale_header_layout_function', 10, 2 );

}

?>