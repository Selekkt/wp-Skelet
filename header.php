<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <meta name="Skelet." property="Sēlekkt. Studio" content="https://selekkt.dk/skelet/v3/">
    
    <title><?php wp_title( '-', true, 'right' ); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <link href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/touch.png" rel="apple-touch-icon-precomposed">

	<?php wp_head(); ?>

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"> 
    <!-- browse the icons: https://fontawesome.com/icons?d=listing&m=free -->

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/skelet.css">
    <!-- include Skēlet. -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/app.css">
    <!-- write all of your CSS here -->

</head>
<body <?php body_class(); ?>>
<div id="app">

	<header class="header">
		<div class="logo">
			<a href="<?php echo home_url(); ?>">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="Logo">
			</a>
		</div>

		<nav class="nav">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav>
	</header>
