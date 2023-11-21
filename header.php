<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CT_Custom
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ct-custom' ); ?></a>

	<header id="masthead" class="site-header container-fluid bg-light">
		<div class="header-top bg-orange overflow-hidden">
			<div class="container lh-lg">
				<div class="col-4 float-start fs-5 bebas-neue text-dark">CALL US NOW: <span class="text-white"><?php echo get_option( 'ct_options' )['ct_option_phone'] ?? '' ?></span></div>
				<div class="col-8 float-end text-end fs-5 bebas-neue">
					<a href="#" class="text-uppercase text-dark me-2 text-decoration-none">Login</a>
					<a href="#" class="text-uppercase text-dark text-decoration-none">Sign Up</a>
				</div>
			</div>			
		</div>
		<div class="branding-nav">
			<div class="row container mx-auto">
				<div class="site-branding col-4">
					<?php  
						if(! empty(get_option('ct_options')['ct_option_logo'])){
							echo '<a href="' . esc_url( home_url( '/' )) . '">';
							echo '<img src="' . esc_url(get_option('ct_options')['ct_option_logo']) . '" alt="Custom Logo" class="w-75">';
							echo '</a>';
						}else{ ?>
							<h1 class="site-title text-uppercase"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class=" text-decoration-none"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
						}
					?>
					
					<?php			
					$ct_custom_description = get_bloginfo( 'description', 'display' );
					if ( $ct_custom_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $ct_custom_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation col-8">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'ct-custom' ); ?></button>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
					?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
		<div class="breadcrumb"><?php get_breadcrumb(); ?></div>
