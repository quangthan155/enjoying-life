<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package enjoying-life
 */
// General settings 
$general    = get_field('general_settings' , OPTION_KEY);
$favicon    = $general[ 'favicon' ];

// Header settings 
$today = date("d/m/Y"); 
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title('') ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="BESTOURS - Travel and Tours multipurpose template">
	<meta name="author" content="Ansonika">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Favicons-->
	<link rel="apple-touch-icon" type="image/x-icon" href="http://www.ansonika.com/bestours/adventure_tours/img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="http://www.ansonika.com/bestours/adventure_tours/img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="http://www.ansonika.com/bestours/adventure_tours/img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="http://www.ansonika.com/bestours/adventure_tours/img/apple-touch-icon-144x144-precomposed.png">
    <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> style="overflow: visible;">
	<!--[if lte IE 8]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
    <![endif]-->

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

	<div id="preloader" style="display: none;">
		<div data-loader="circle-side" style="display: none;"></div>
	</div>
	<!-- End Preload -->

	<!-- Header================================================== -->
    <div id="header_1">
        <header class="sticky">
            <div id="top_line">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <a href="tel://004542344599" id="phone_top">0045 043204434</a><span id="opening">Mon - Sat 8.00/18.00</span>
                        </div>
                        <div class="col-md-6 col-sm-6 hidden-xs">
                            <ul id="top_links">
                                <li><a></a>
                                </li>
                                <li><a></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End row -->
                </div>
                <!-- End container-->
            </div>
            <!-- End top line-->

            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <div id="logo_home">                        
                            <?php insert_title_tag_output( 'start' ); ?>
                            <a href="/" title="">Enjoying life</a>
                            <?php insert_title_tag_output( 'end' ); ?>
                        </div>
                    </div>
                    <nav class="col-md-9 col-sm-9 col-xs-9">
                        <ul id="tools_top">
                            <li><a class="search-overlay-menu-btn"><i class="icon-search-6"></i></a>
                            </li>
                        </ul>
                        <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                        <div class="main-menu">
                            <div id="header_menu">
                                <img src="<?php echo get_template_directory_uri() . '/assets/images/logo_menu.png' ?>" width="145" height="34" alt="Bestours" data-retina="true">
                            </div>
                            <a href="http://www.ansonika.com/bestours/adventure_tours/index.html?fbclid=IwAR2nqeo9w8BrwQFgSNW1Tvo8e6WDTYfrIYE6FPEUapCzA5TLqjTkurBf5IM#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                            <?php get_primary_menu() ?>
                        </div>
                        <!-- End main-menu -->
                    </nav>
                </div>
            </div>
            <!-- container -->
        </header>
        <!-- End Header -->
    </div>
    <!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="header-video" style="width: 1840px; height: 718.75px;">
		<div id="hero_video">
			<div id="animate_intro" class="animated fadeInUp">
				<h3>Enjoy a Perfect Tour</h3>
				<p>
					Find the best Tours and Excursion at the best price
				</p>
			</div>
		</div>
		<img src="<?php echo get_template_directory_uri() . '/assets/images/video_fix.png '?>" alt="" class="header-video--media" data-video-src="<?php echo get_template_directory_uri() . '/assets/video/intro.mp4' ?>" data-teaser-source="./assets/video/intro" data-provider="" data-video-width="1920" data-video-height="750" style="display: none;">
	<video autoplay="true" loop="loop" muted="" id="teaser-video" class="teaser-video"><source src="<?php echo get_template_directory_uri() . '/assets/video/intro.mp4'?>" type="video/mp4"><source src="./assets/video/intro.ogv" type="video/ogg"></video></section>
	<!-- End Header video -->
	<!-- End SubHeader ============================================ -->
