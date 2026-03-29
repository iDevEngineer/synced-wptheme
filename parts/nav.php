<?php
/**
 * Template part for displaying navigation between posts/pages.
 *
 * Use get_template_part( 'parts/nav' ) where you need post navigation.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<nav class="post-navigation" aria-label="<?php esc_attr_e( 'Posts navigation', 'synced-wptheme' ); ?>">
	<div class="nav-links">
		<?php
		previous_post_link(
			'<div class="nav-previous">%link</div>',
			esc_html__( '&larr; %title', 'synced-wptheme' )
		);
		next_post_link(
			'<div class="nav-next">%link</div>',
			esc_html__( '%title &rarr;', 'synced-wptheme' )
		);
		?>
	</div>
</nav>
