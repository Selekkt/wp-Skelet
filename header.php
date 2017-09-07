<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta data-framework="Skēlet." data-ver="2.0.0" data-dev="Sēlekkt. Studio">

	<title><?php wp_title( '-', true, 'right' ); ?><</title>
	<meta name="description" content="<?php bloginfo('description'); ?>">

	<link href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.ico" rel="shortcut icon">
	<link href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/touch.png" rel="apple-touch-icon-precomposed">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,300,600">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/skelet.css" > <!-- include Skēlet. -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/app.css"> <!-- write all of your CSS here -->

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="app">

	<header class="header">
		<div class="logo">
			<a href="<?php echo home_url(); ?>">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="Logo">
			</a>
		</div>

		<nav class="nav" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav>
	</header>
