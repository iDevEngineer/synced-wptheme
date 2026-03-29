<?php
/**
 * The template for displaying single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>

<div class="container">
	<div class="page-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<div class="entry-meta">
						<span class="posted-on">
							<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
								<?php echo esc_html( get_the_date() ); ?>
							</time>
						</span>
						<span class="byline">
							<?php
							/* translators: %s: author display name */
							printf( esc_html__( 'By %s', 'synced-wptheme' ), esc_html( get_the_author() ) );
							?>
						</span>
						<?php if ( has_category() ) : ?>
							<span class="cat-links"><?php the_category( ', ' ); ?></span>
						<?php endif; ?>
					</div>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="entry-thumbnail" style="margin-bottom: 2rem;">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>

				<div class="entry-content">
					<?php
					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: post title */
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'synced-wptheme' ),
								array( 'span' => array( 'class' => array() ) )
							),
							wp_kses_post( get_the_title() )
						)
					);

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'synced-wptheme' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>

				<footer class="entry-footer">
					<?php if ( has_tag() ) : ?>
						<div class="tags-links"><?php the_tags( esc_html__( 'Tags: ', 'synced-wptheme' ), ', ' ); ?></div>
					<?php endif; ?>
				</footer>

			</article>

			<nav class="post-navigation" aria-label="<?php esc_attr_e( 'Post navigation', 'synced-wptheme' ); ?>">
				<div class="nav-links">
					<?php
					previous_post_link( '<div class="nav-previous">%link</div>', esc_html__( '&larr; %title', 'synced-wptheme' ) );
					next_post_link( '<div class="nav-next">%link</div>', esc_html__( '%title &rarr;', 'synced-wptheme' ) );
					?>
				</div>
			</nav>

			<?php if ( comments_open() || get_comments_number() ) : ?>
				<?php comments_template(); ?>
			<?php endif; ?>

		<?php endwhile; ?>

	</div><!-- .page-content -->
</div><!-- .container -->

<?php
get_footer();
