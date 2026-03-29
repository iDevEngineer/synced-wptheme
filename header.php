<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#primary">
		<?php esc_html_e( 'Skip to content', 'synced-wptheme' ); ?>
	</a>

	<header id="masthead" class="site-header">
		<div class="container">

			<div class="site-branding">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
					<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
				<?php endif; ?>
			</div>

			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'synced-wptheme' ); ?>">
					<button class="nav-toggle" aria-controls="primary-menu" aria-expanded="false">
						<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'synced-wptheme' ); ?></span>
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
							<line x1="3" y1="6" x2="21" y2="6"/>
							<line x1="3" y1="12" x2="21" y2="12"/>
							<line x1="3" y1="18" x2="21" y2="18"/>
						</svg>
					</button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'nav-menu',
							'container'      => false,
						)
					);
					?>
				</nav>
			<?php endif; ?>

		</div><!-- .container -->
	</header><!-- #masthead -->

	<main id="primary" class="site-main">
