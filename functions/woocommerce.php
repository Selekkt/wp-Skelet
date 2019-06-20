<?php
/*** 
* WooCommerce 
*/

// Declear that your theme is compatible with WooCommerce
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/**
* is_realy_woocommerce_page()
*
* Returns true if on a page which uses WooCommerce templates 
* (cart and checkout are standard pages with shortcodes and which are also included)
*
* @access public
* @return bool
*/
function is_realy_woocommerce_page() {
        if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
                return true;
        }
        $woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
                                        "woocommerce_terms_page_id" ,
                                        "woocommerce_cart_page_id" ,
                                        "woocommerce_checkout_page_id" ,
                                        "woocommerce_pay_page_id" ,
                                        "woocommerce_thanks_page_id" ,
                                        "woocommerce_myaccount_page_id" ,
                                        "woocommerce_edit_address_page_id" ,
                                        "woocommerce_view_order_page_id" ,
                                        "woocommerce_change_password_page_id" ,
                                        "woocommerce_logout_page_id" ,
                                        "woocommerce_lost_password_page_id" ) ;
        foreach ( $woocommerce_keys as $wc_page_id ) {
                if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                        return true ;
                }
        }
        return false;
}

// Remove breadcrumbs
//add_action( 'init', 'remove_wc_breadcrumbs' );
//function remove_wc_breadcrumbs() { remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 ); }

// Remove product quantity from product page
//function baztro_remove_all_quantity_fields( $return, $product ) { return true; }
//add_filter( 'woocommerce_is_sold_individually', 'baztro_remove_all_quantity_fields', 10, 2 );

// Change Add To Cart text
//add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text' );
//function woo_custom_single_add_to_cart_text() { return __( 'Add to Bag', 'woocommerce' ); }
//add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_product_add_to_cart_text' );
//function woo_custom_product_add_to_cart_text() { return __( 'Add to Bag', 'woocommerce' ); }

// remove product meta 
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// remove additional info @ checkout page
//add_filter('woocommerce_enable_order_notes_field', '__return_false');

// remove tabs from product page
//add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

/*
// Remove tabs from Product Page
function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );  // Remove the description tab
    unset( $tabs['reviews'] );      // Remove the reviews tab
    unset( $tabs['additional_information'] ); // Remove the additional information tab

    return $tabs;

}
*/

/*** The Code Below Removes Checkout Fields */
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
    //unset($fields['billing']['billing_first_name']);
    //unset($fields['billing']['billing_last_name']);
    //unset($fields['billing']['billing_company']);
    //unset($fields['billing']['billing_address_1']);
    //unset($fields['billing']['billing_address_2']);
    //unset($fields['billing']['billing_city']);
    //unset($fields['billing']['billing_postcode']);
    //unset($fields['billing']['billing_country']);
    //unset($fields['billing']['billing_state']);
    //unset($fields['billing']['billing_phone']);
    //unset($fields['order']['order_comments']);
    //unset($fields['billing']['billing_email']);
    //unset($fields['account']['account_username']);
    //unset($fields['account']['account_password']);
    //unset($fields['account']['account_password-2']);
    
    return $fields;
}

/**
 * Redirect users after add to cart.
 */
/*
function my_custom_add_to_cart_redirect( $url ) {
    
    if ( ! isset( $_REQUEST['add-to-cart'] ) || ! is_numeric( $_REQUEST['add-to-cart'] ) ) {
        return $url;
    }
    
    $product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_REQUEST['add-to-cart'] ) );
    
    // Only redirect the product IDs in the array to the checkout
    if ( in_array( $product_id, array( 1, 46) ) ) {
        $url = WC()->cart->get_checkout_url();
    }
    
    return $url;

}
add_filter( 'woocommerce_add_to_cart_redirect', 'my_custom_add_to_cart_redirect' );
*/

// Display Sizes on Archive pages
/*
function show_sizes() {
    global $product;

    $dimensions = wc_format_dimensions($product->get_dimensions(false));

        if ( $product->has_dimensions() ) {
                echo '<div class="product-meta">' . $dimensions . '</div>';
        }
}

add_action( 'woocommerce_after_shop_loop_item', 'show_sizes', 9 );
*/

// remove Related Products on Product Page
// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// load WC files only on WC pages.
add_action( 'wp_enqueue_scripts', 'dequeue_woocommerce_styles_scripts', 99 );

function dequeue_woocommerce_styles_scripts() {
    if ( function_exists( 'is_woocommerce' ) ) {
        if ( ! is_realy_woocommerce_page() && ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
            # Styles
            wp_dequeue_style( 'woocommerce-general' );
            wp_dequeue_style( 'woocommerce-layout' );
            wp_dequeue_style( 'woocommerce-smallscreen' );
            wp_dequeue_style( 'woocommerce_frontend_styles' );
            wp_dequeue_style( 'woocommerce_fancybox_styles' );
            wp_dequeue_style( 'woocommerce_chosen_styles' );
            wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
            # Scripts
            wp_dequeue_script( 'wc_price_slider' );
            wp_dequeue_script( 'wc-single-product' );
            wp_dequeue_script( 'wc-add-to-cart' );
            wp_dequeue_script( 'wc-cart-fragments' );
            wp_dequeue_script( 'wc-checkout' );
            wp_dequeue_script( 'wc-add-to-cart-variation' );
            wp_dequeue_script( 'wc-single-product' );
            wp_dequeue_script( 'wc-cart' );
            wp_dequeue_script( 'wc-chosen' );
            wp_dequeue_script( 'woocommerce' );
            wp_dequeue_script( 'prettyPhoto' );
            wp_dequeue_script( 'prettyPhoto-init' );
            wp_dequeue_script( 'jquery-blockui' );
            wp_dequeue_script( 'jquery-placeholder' );
            wp_dequeue_script( 'fancybox' );
            wp_dequeue_script( 'jqueryui' );
        }
    }
}

// Change "out of stock" or "in stock" Messages
/*
function wcs_custom_get_availability( $availability, $_product ) {
    
    // Change In Stock Text 
    if ( $_product->is_in_stock() ) {
        $availability['availability'] = __('Available!', 'woocommerce');
    }

    // Change Out of Stock Text
    if ( ! $_product->is_in_stock() ) {
        $availability['availability'] = __('Sold Out', 'woocommerce');
    }
    return $availability;
}

add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
*/

// Disable all WooCommerce stylesheets
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Set WooCommerce image dimensions upon theme activation
 */

/*
// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
    unset( $enqueue_styles['woocommerce-general'] );    // Remove the gloss
    unset( $enqueue_styles['woocommerce-layout'] );     // Remove the layout
    unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
    return $enqueue_styles;
}
*/
