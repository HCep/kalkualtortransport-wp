<?php

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">
		<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
<?php if(is_page('o-firmie') || is_page('about-us')): ?>
<link rel="stylesheet" href="<?php  echo get_stylesheet_directory_uri(); ?>/css/splide.min.css">
<?php endif; ?>
<link rel="stylesheet" href="<?php  echo get_stylesheet_directory_uri(); ?>/css/hamburgers.css">
		<?php wp_head(); ?>
		<style type="text/css">
	input[name="dateFrom"]::-webkit-calendar-picker-indicator {
	 background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/calendar-blue.svg');
	 background-repeat:no-repeat;
	 background-size:contain;
	}
	input[name="dateTo"]::-webkit-calendar-picker-indicator {
	 background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/calendar-orange.svg');
	 background-repeat:no-repeat;
	 background-size:contain;
	}
	ul.custom-list {
  list-style-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/Yes.svg');
}
<?php if(is_checkout()){ ?>
	/* .vege_wrapper{
		
		height:350vh;
		
	}
	@media (min-width:320px){
		.vege_wrapper{
			height:340vh;
	}
	}
	@media (min-width:420px){
		.vege_wrapper{
			height:310vh;
	}
	}
	@media (min-width:579px){
		.vege_wrapper{
		height:230vh;
	}
	}
	@media (min-width:786px){
		.vege_wrapper{
		height:180vh;
	}
	}
	@media (min-width:992px){
		.vege_wrapper{
		
		height:1600px;
	}}
	 */
	<?php } ?>
</style>
	</head>

	<body <?php body_class(); ?>>


	<div id="page" class="feed site">
	<div class="vege_wrapper">

	
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'materialwp' ); ?></a>
	
	<nav class="navbar navbar-expand-lg" id="site-header">
  
	<a class="navbar-brand custom-brand logo-none" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
								$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
				
							if ( has_custom_logo() ) {
								echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . ' width="117" height="117">';
							} else {
								echo '<h1>' . get_bloginfo('name') . '</h1>';
							}?>	
		</a>
  <button class="hamburger hamburger--squeeze navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
  
  <span class="hamburger-box">
    <span class="hamburger-inner"></span>
  </span>

  </button>

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
	<?php
					
					wp_nav_menu(array(
							'theme_location'  => 'primary',
							'container_class' => 'collapse navbar-collapse',
							'container_id'    => 'navbarNavDropdown',
							'menu_class'      => 'navbar-nav ms-auto menu-list-container menu-list-container-main',
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'depth'           => 2,
							'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					));
					
						
					?>
     
    </div>

  </div>
  
</nav>



	
	<div id="content" class="site-content">
