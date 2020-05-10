<?php
// Theme support options
require_once(get_template_directory().'/functions/setup.php');

// WP Head and other cleanup functions
require_once(get_template_directory().'/functions/cleaner.php');

// Register sidebars/widget areas
require_once(get_template_directory().'/functions/sidebar.php'); 

// Makes WordPress comments suck less
require_once(get_template_directory().'/functions/comments.php'); 

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/functions/page-navi.php'); 

// Adds support for multiple languages
require_once(get_template_directory().'/locales/translation.php'); 

// Remove 4.2 Emoji Support
// require_once(get_template_directory().'/functions/disable-emoji.php');

// Disable Gutenberg
// require_once(get_template_directory().'/functions/disable-gutenberg.php'); 

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/functions/related-posts.php'); 

// Use this as a template for custom post types
// require_once(get_template_directory().'/functions/post-types/loader.php');

// Customize the WordPress login menu
// require_once(get_template_directory().'/functions/login.php'); 

// Customize the WordPress admin
// require_once(get_template_directory().'/functions/dashboard.php'); 

// WooCommerce Resets
// require_once(get_template_directory().'/functions/woocommerce.php'); 

// Your custom functions go in this file!
// require_once(get_template_directory().'/functions/functions.php'); 
