<?php
// Registering Menu Positions
register_nav_menus(
    array(
        'primary' => __( 'Top Header Menu', 'skelet' ),
        'secondary' => __('Secondary Menu', 'skelet'),
        'footer' => __('Footer Links', 'skelet')
        // if you need to add other menus do it here.
    )
);


// Adding WP Functions & Theme Support
function skelet_theme_support() {

    // Menu Support
    add_theme_support('menus');
	
    // Thumbnail Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 750, '', true); // Large Thumbnail
    add_image_size('medium', 300, '', true); // Medium Thumbnail
    add_image_size('small', 200, '', true); // Small Thumbnail
    add_image_size('post-cover', '', 300); // post page cover img
    add_image_size('custom-size', 750, 250, true); // Custom Size call with; the_post_thumbnail('custom-size');

	add_theme_support( 'automatic-feed-links' ); // Add RSS Support
	
	// Add HTML5 Support
	add_theme_support( 'html5', 
	         array( 
	         	'comment-list', 
	         	'comment-form', 
	         	'search-form', 
	         ) 
	);
	
	// Adding post format support
	 add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	); 
	

	// Set the maximum allowed width for any content in the theme, like oEmbeds and images added to posts.
	$GLOBALS['content_width'] = apply_filters( 'skelet_theme_support', 1200 );	
	
}

add_action( 'after_setup_theme', 'skelet_theme_support' );


// A better wp_title();
add_filter( 'wp_title', 'skelet_title', 10, 3 );

function skelet_title( $title, $sep, $seplocation ) {
    global $page, $paged;

    // Don't affect in feeds.
    if ( is_feed() ) {
        return $title;
    }

    // Add the blog name
    if ( 'right' == $seplocation ) {
        $title .= get_bloginfo( 'name' );
    } else {
        $title = get_bloginfo( 'name' ) . $title;
    }

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " {$sep} {$site_description}";
    }

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 ) {
        $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
    }

    return $title;
}