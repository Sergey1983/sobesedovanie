<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Speedster
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>

		<!-- meta -->
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">

	    <!-- css -->
		<?php wp_head(); ?>
	</head>

	 <body <?php body_class(); ?>>
		<div class="container">	
			<a class="skip-link screen-reader-text" href=".content-body"><?php esc_html_e( 'Skip to content', 'speedster' ); ?></a>
			<header id="site-header">
				<div class="row">
					<div class="col-md-4 col-sm-5 col-xs-8">
						<div class="logo">
							<?php if(has_custom_logo()):
									the_custom_logo(); 
				else: ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><b><?php bloginfo( 'name' ); ?></b></a></h1>
							<?php  $description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
							<p class='site-description'><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php endif; ?>
					<?php endif; ?>

			
						</div>
					</div><!-- col-md-4 -->
					<div class="col-md-8 col-sm-7 col-xs-4">
						<nav class="main-nav" role="navigation">
							<div class="navbar-header">
  								<button type="button" id="trigger-overlay" class="navbar-toggle">
    								<span class="ion-navicon"></span>
  								</button>
							</div>

							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  								<ul class="nav navbar-nav navbar-right">
    								<?php
											wp_nav_menu( array(
							                'theme_location'    => 'menu-1',
							                'depth'             => 8,
							                'menu_id'        => 'primary-menu',
							                'container'         => 'div',
							                'menu_class'        => 'nav navbar-nav menu',
							                'fallback_cb'       => 'Speedster_Wp_Bootstrap_Navwalker::fallback',
							                'walker'            => new Speedster_Wp_Bootstrap_Navwalker()
							            				));
										?>
  								</ul>
							</div><!-- /.navbar-collapse -->
						</nav>

					</div><!-- col-md-8 -->
				</div>
			</header>
		</div>

		<div class="content-body">
			<div class="container">
				<div class="row">
