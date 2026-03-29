<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>

<div class="container">

	<header class="archive-header">
		<?php
		the_archive_title( '<h1 class="archive-title">', '</h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
		?>
	</header>

	<div class="page-content">

		<?php if ( have_posts() ) : ?>

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
