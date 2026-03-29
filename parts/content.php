<?php
/**
 * Template part for displaying a post in archive/index contexts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail" style="margin-bottom: 1.25rem;">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'medium_large' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php
		the_title(
			sprintf(
				'<h2 class="entry-title"><a href="%s" rel="bookmark">',
				esc_url( get_permalink() )
			),
			'</a></h2>'
		);
		?>

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
		</div>
	</header>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<footer class="entry-footer">
		<a href="<?php the_permalink(); ?>" class="btn btn-outline" style="font-size: 0.85rem; padding: 0.5rem 1rem;">
			<?php esc_html_e( 'Read more', 'synced-wptheme' ); ?>
			<span class="screen-reader-text">
				<?php
				/* translators: %s: post title */
				printf( esc_html__( 'about %s', 'synced-wptheme' ), wp_kses_post( get_the_title() ) );
				?>
			</span>
		</a>
	</footer>

</article>
