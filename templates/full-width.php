<?php
/**
 * Template Name: Full Width
 *
 * A full-width page template with no sidebar.
 * Select this from the Page Attributes panel in the WordPress editor.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>

<div class="template-full-width">
	<div class="page-content" style="padding: var(--spacing-section) 0;">
		<div class="container">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="entry-thumbnail" style="margin-bottom: 2rem;">
							<?php the_post_thumbnail( 'full' ); ?>
						</div>
					<?php endif; ?>

					<div class="entry-content">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'synced-wptheme' ),
								'after'  => '</div>',
							)
						);
						?>
					</div>

				</article>

			<?php endwhile; ?>

		</div><!-- .container -->
	</div><!-- .page-content -->
</div><!-- .template-full-width -->

<?php
get_footer();
