<?php
// Fully disable Gutenberg editorm, and prevent it from including its files on frontend
add_filter('use_block_editor_for_post_type', '__return_false', 10);

// Don't load Gutenberg-related stylesheets
function remove_block_css() {
	wp_dequeue_style( 'wp-block-library' ); // WordPress core
	wp_dequeue_style( 'wp-block-library-theme' ); // WordPress core
	wp_dequeue_style( 'wc-block-style' ); // WooCommerce
	wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
}
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );