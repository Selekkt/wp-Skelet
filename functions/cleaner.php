<?php

// Fire all our initial functions at the start
add_action('after_setup_theme','skelet_start', 16);

function skelet_start() {
    add_action('init', 'skelet_head_cleanup'); // launch cleaner
    
    add_filter( 'wp_head', 'skelet_remove_wp_widget_recent_comments_style', 1 ); // remove css for recent comments widget
    add_action( 'wp_head', 'skelet_remove_recent_comments_style', 1 ); // clean up comment styles in the head
    add_filter( 'gallery_style', 'skelet_gallery_style' ); // clean up gallery output in wp
    add_action( 'widgets_init', 'skelet_register_sidebars' ); // adding sidebars to Wordpress
    add_filter( 'excerpt_more', 'skelet_excerpt_more' ); // cleaning up excerpt
}


// The default wordpress head is a mess. 
// Let's clean it up by removing all the junk we don't need.
function skelet_head_cleanup() {

	remove_action( 'wp_head', 'feed_links_extra', 3 ); // Removes the links to the extra feeds such as category feeds
	remove_action( 'wp_head', 'feed_links', 2 ); // Removes the links to the general feeds: Post and Comment Feed
	remove_action( 'wp_head', 'rsd_link' ); // Removes the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' ); // Removes the link to the Windows Live Writer manifest file.
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Removes prev link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Removes link
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Removes relational links for the posts adjacent to the current post.
	remove_action( 'wp_head', 'wp_generator' ); // Removes the XHTML generator that is generated on the wp_head hook, WP version
	remove_action( 'wp_head', 'rel_canonical' ); // Removes WordPress' canonical links
	remove_action( 'wp_head', 'index_rel_link' ); // index link
	if (!is_admin()) {
		wp_deregister_script('jquery'); // De-Register jQuery
		wp_register_script('jquery', '', '', '', true); // Register as 'empty', because we manually insert our script
	}

}


// Remove l10n.js
function kill_l10n() { if (!is_admin()) wp_deregister_script( 'l10n' ); }
add_action( 'wp_print_scripts', 'kill_l10n' );


// hide the meta tag generator from head and rss
function disable_version() { return ''; }
add_filter( 'the_generator','disable_version' );
remove_action( 'wp_head', 'wp_generator' );

// Remove <p> tags from Excerpt
remove_filter( 'the_excerpt', 'wpautop' );

// Remove <p> tags from the_content
remove_filter('the_content','wpautop');

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}


// Disabling WordPress' default REST API
function disable_json_api() {
	// Filters for WP-API version 1.x
	add_filter('json_enabled', '__return_false');
	add_filter('json_jsonp_enabled', '__return_false');

	// Filters for WP-API version 2.x
	add_filter('rest_enabled', '__return_false');
	add_filter('rest_jsonp_enabled', '__return_false');
}
add_action( 'after_setup_theme', 'disable_json_api' );


// Removing WordPress wp-json & oembed
function remove_oembed() {
    // Remove the REST API lines from the HTML Header
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

    // Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );

    // Turn off oEmbed auto discovery.
    add_filter( 'embed_oembed_discover', '__return_false' );

    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );

   // Remove all embeds rewrite rules.
   //add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
}
add_action( 'after_setup_theme', 'remove_oembed' );


// removing admin bar
//add_filter('show_admin_bar', '__return_false');


// Remove injected CSS for recent comments widget
function skelet_remove_wp_widget_recent_comments_style() {
	if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
		remove_filter('wp_head', 'wp_widget_recent_comments_style' );
	}
}


// Remove injected CSS from recent comments widget
function skelet_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}


// Remove injected CSS from gallery
function skelet_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}


// This removes the annoying […] to a Read More link
function skelet_excerpt_more($more) {
	global $post;
	// edit here if you like
return '<a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __('Read', 'skelet') . get_the_title($post->ID).'">'. __('... Read more &raquo;', 'skelet') .'</a>';
}


// This is a modified the_author_posts_link() which just returns the link. This is necessary to allow usage of the usual l10n process with printf()
function skelet_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s', 'skelet' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}
