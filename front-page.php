<?php
/**
 * The front page template.
 *
 * Used when "Front page displays" is set to "A static page" in Settings > Reading,
 * or when a page with the slug 'front-page' exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>

<div class="container">
	<div class="page-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( get_the_content() ) : ?>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				<?php else : ?>
					<!-- No static front page content set — add your hero and sections here -->
					<section class="hero" style="padding: 6rem 0; text-align: center;">
						<h1><?php bloginfo( 'name' ); ?></h1>
						<p><?php bloginfo( 'description' ); ?></p>
						<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn btn-primary">
							<?php esc_html_e( 'Read the Blog', 'synced-wptheme' ); ?>
						</a>
					</section>
				<?php endif; ?>

			</article>

		<?php endwhile; ?>

	</div><!-- .page-content -->
</div><!-- .container -->

<?php
get_footer();
