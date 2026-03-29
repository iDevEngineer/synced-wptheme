<?php
/**
 * The main template file.
 *
 * Fallback template for all pages not matched by a more specific template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>

<div class="container">
	<div class="page-content">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header class="archive-header">
					<h1 class="archive-title"><?php esc_html_e( 'Blog', 'synced-wptheme' ); ?></h1>
				</header>
			<?php endif; ?>

			<div class="posts-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'parts/content', get_post_format() ); ?>
				<?php endwhile; ?>
			</div>

			<?php the_posts_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'parts/content', 'none' ); ?>

		<?php endif; ?>

	</div><!-- .page-content -->
</div><!-- .container -->

<?php
get_footer();
