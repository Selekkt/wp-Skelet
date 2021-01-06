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

//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );


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

/* *** ***
	* Since the REST API is used by WordPress admin you can't turn it off
	* but you can ⤵
	* Require Authentication for All Requests on the API

	+ Keep in mind that, for instance, plugin such as Contact form 7 use the API to submit the form
	+ and if the user isn't logged in the form wont submit.
	++++ Please test before activating ++++

	* https://developer.wordpress.org/rest-api/frequently-asked-questions/#can-i-disable-the-rest-api
*** *** */
/*
add_filter( 'rest_authentication_errors', function( $result ) {
    // If a previous authentication check was applied,
    // pass that result along without modification.
    if ( true === $result || is_wp_error( $result ) ) {
        return $result;
    }
 
    // No authentication has been performed yet.
    // Return an error if user is not logged in.
    if ( ! is_user_logged_in() ) {
        return new WP_Error(
            'rest_not_logged_in',
            __( 'You are not currently logged in.' ),
            array( 'status' => 401 )
        );
    }
 
    // Our custom authentication check should have no effect
    // on logged-in requests
    return $result;
});
*/

// removing admin bar
//add_filter('show_admin_bar', '__return_false');

// removing admin bar for NON admins
//if (!current_user_can('administrator')) : show_admin_bar(false); endif;

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

// Load Contact Form 7 files only on pages where the shortcode is present 
/*
function rjs_lwp_contactform_css_js() {
    global $post;
    if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'contact-form-7') ) {
        // CF7
        wp_enqueue_script( 'contact-form-7' );
        wp_enqueue_style( 'contact-form-7' );
        // re-captcha 
        wp_enqueue_script( 'google-recaptcha' );
        wp_enqueue_script( 'wpcf7-recaptcha' );
    } else {
        // CF7
        wp_dequeue_script( 'contact-form-7' );
        wp_dequeue_style( 'contact-form-7' );
        // re-captcha 
        wp_dequeue_script( 'google-recaptcha' );
        wp_dequeue_script( 'wpcf7-recaptcha' );
    }
}
add_action( 'wp_enqueue_scripts', 'rjs_lwp_contactform_css_js');
*/