<?php
// Adding Translation Option
add_action('after_setup_theme', 'load_translations');
function load_translations(){
	load_theme_textdomain( 'skelet', get_template_directory() .'/languages' );
}
?>