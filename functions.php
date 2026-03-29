<?php
/**
 * Synced WP Theme — functions.php
 *
 * Theme setup, asset enqueueing via Vite manifest, and nav menu registration.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ─── Theme Setup ──────────────────────────────────────────────────────────────

add_action( 'after_setup_theme', 'synced_theme_setup' );

function synced_theme_setup(): void {
	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Featured images
	add_theme_support( 'post-thumbnails' );

	// HTML5 markup for core elements
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	// Navigation menus
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'synced-wptheme' ),
			'footer'  => esc_html__( 'Footer Menu', 'synced-wptheme' ),
		)
	);

	// Wide and full-width block alignment support
	add_theme_support( 'align-wide' );

	// Responsive embeds
	add_theme_support( 'responsive-embeds' );

	// Custom logo
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Editor stylesheet
	add_editor_style( 'assets/dist/app.css' );
}

// ─── Vite Asset Loading ────────────────────────────────────────────────────────

/**
 * Read and parse the Vite manifest file.
 *
 * @return array<string, array<string, mixed>>
 */
function synced_vite_manifest(): array {
	static $manifest = null;

	if ( null === $manifest ) {
		$manifest_path = get_template_directory() . '/assets/dist/.vite/manifest.json';

		if ( ! file_exists( $manifest_path ) ) {
			// Fallback: try legacy manifest location (Vite <5 wrote manifest.json directly in outDir)
			$manifest_path = get_template_directory() . '/assets/dist/manifest.json';
		}

		if ( file_exists( $manifest_path ) ) {
			$contents = file_get_contents( $manifest_path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			$manifest = json_decode( $contents, true ) ?? array();
		} else {
			$manifest = array();
		}
	}

	return $manifest;
}

/**
 * Return the URL for a Vite-built asset from the manifest.
 *
 * @param string $entry  The entry key as defined in vite.config.js input (e.g. 'assets/src/css/app.css').
 * @return string|null   The public URL or null if not found.
 */
function synced_vite_asset_url( string $entry ): ?string {
	$manifest = synced_vite_manifest();

	if ( empty( $manifest[ $entry ] ) ) {
		return null;
	}

	return get_template_directory_uri() . '/assets/dist/' . $manifest[ $entry ]['file'];
}

// ─── Enqueue Scripts & Styles ─────────────────────────────────────────────────

add_action( 'wp_enqueue_scripts', 'synced_enqueue_assets' );

function synced_enqueue_assets(): void {
	$theme_version = wp_get_theme()->get( 'Version' );

	// ── Production: load from Vite manifest ──
	$css_url = synced_vite_asset_url( 'assets/src/css/app.css' );
	$js_url  = synced_vite_asset_url( 'assets/src/js/app.js' );

	if ( $css_url ) {
		wp_enqueue_style(
			'synced-theme',
			$css_url,
			array(),
			$theme_version
		);
	}

	if ( $js_url ) {
		wp_enqueue_script(
			'synced-theme',
			$js_url,
			array(),
			$theme_version,
			true // Load in footer
		);
	}

	// ── Comment reply script (WordPress core) ──
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

// ─── Content Width ─────────────────────────────────────────────────────────────

if ( ! isset( $content_width ) ) {
	$content_width = 1152; // pixels — matches --container-max in variables.css
}

// ─── Excerpt ──────────────────────────────────────────────────────────────────

add_filter( 'excerpt_more', 'synced_excerpt_more' );

function synced_excerpt_more( string $more ): string {
	return '&hellip;';
}
