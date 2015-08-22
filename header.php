<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slidebars.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slick.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slick-theme.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/base.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/IE9.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php if(is_page('161')): ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/kakinoki.css">
    <?php elseif(is_page('163')): ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/hachifuku.css">
    <?php elseif(is_page('165')): ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/kokubunsai.css">
    <?php elseif(is_page('167')): ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/filltry.css">
    <?php elseif(is_page('169')): ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/fillcolor.css">
    <?php elseif(is_page('171')): ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/tokyo.css">
    <?php elseif(is_page('173')): ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/niyaku.css">
    <?php elseif(is_page('175')): ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ondiina.css">
    <?php elseif(is_page('177')): ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/youho.css">
    <?php endif; ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="<?php echo esc_attr( $post->post_name ); ?>">
<div id="wrapper">
<div id="sb-site" class="main_content">
<div id="header" class="sb-slide">
    <p class="sb-toggle-right"><i class="fa fa-bars fa-2x"></i></p>
</div>