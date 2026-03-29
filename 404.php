<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>

<div class="container">
	<section class="error-404 not-found">

		<p class="page-title">404</p>
		<p class="page-subtitle"><?php esc_html_e( 'Page not found.', 'synced-wptheme' ); ?></p>

		<p><?php esc_html_e( "The page you're looking for doesn't exist or has been moved.", 'synced-wptheme' ); ?></p>

		<div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
				<?php esc_html_e( 'Go Home', 'synced-wptheme' ); ?>
			</a>

			<?php if ( get_option( 'page_for_posts' ) ) : ?>
				<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn btn-outline">
					<?php esc_html_e( 'Read the Blog', 'synced-wptheme' ); ?>
				</a>
			<?php endif; ?>
		</div>

	</section>
</div><!-- .container -->

<?php
get_footer();
