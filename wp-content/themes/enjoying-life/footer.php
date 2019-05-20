<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package enjoying-life
 */
$general_st     = get_field( 'general_settings' , OPTION_KEY);
$email          = $general_st[ 'email' ];
$phone          = $general_st[ 'phone' ];
$copyright      = $general_st[ 'copyright' ];
?>
<footer>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <h3>Need help?</h3>
            <a href="tel://<?php echo $phone ?>" id="phone"><?php echo $phone ?></a>
            <a href="mailto:help@citytours.com" id="email_footer"><?php echo $email ?></a>
        </div>
        <div class="col-md-2 col-sm-3">

        </div>
        <div class="col-md-4 col-sm-6">
        </div>
        <div class="col-md-3 col-sm-12">
            <h3>Newsletter</h3>
            <div id="message-newsletter_2">
            </div>
            <form method="post" action="http://www.ansonika.com/bestours/adventure_tours/assets/newsletter.php" name="newsletter_2" id="newsletter_2">
                <div class="form-group">
                    <input name="email_newsletter_2" id="email_newsletter_2" type="email" value="" placeholder="Your email" class="form-control">
                </div>
                <input type="submit" value="Subscribe" class="btn_1" id="submit-newsletter_2">
            </form>
        </div>
    </div>
    <!-- End row -->
    <hr>
    <div class="row">
        <div class="col-sm-8">
            <div class="styled-select">
                <select class="form-control" name="lang" id="lang">
                    <option value="English" selected="">English</option>
                    <option value="French">Korean</option>
                    <option value="Spanish">VietNamese</option>
                </select>
            </div>
            <span id="copy"><?php echo $copyright ?> </span>
        </div>
        <div class="col-sm-4" id="social_footer">
            <ul>
                <li><a href="http://www.ansonika.com/bestours/adventure_tours/index.html?fbclid=IwAR2nqeo9w8BrwQFgSNW1Tvo8e6WDTYfrIYE6FPEUapCzA5TLqjTkurBf5IM#"><i class="icon-facebook"></i></a>
                </li>
                <li><a href="http://www.ansonika.com/bestours/adventure_tours/index.html?fbclid=IwAR2nqeo9w8BrwQFgSNW1Tvo8e6WDTYfrIYE6FPEUapCzA5TLqjTkurBf5IM#"><i class="icon-twitter"></i></a>
                </li>
                <li><a href="http://www.ansonika.com/bestours/adventure_tours/index.html?fbclid=IwAR2nqeo9w8BrwQFgSNW1Tvo8e6WDTYfrIYE6FPEUapCzA5TLqjTkurBf5IM#"><i class="icon-google"></i></a>
                </li>
                <li><a href="http://www.ansonika.com/bestours/adventure_tours/index.html?fbclid=IwAR2nqeo9w8BrwQFgSNW1Tvo8e6WDTYfrIYE6FPEUapCzA5TLqjTkurBf5IM#"><i class="icon-instagram"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- End row -->
</div>
<!-- End container -->
</footer>
<!-- End footer -->

<div id="toTop" style="display: block; opacity: 0.774511;"></div>
<!-- Back to top button -->

<!-- Search Menu -->
<div class="search-overlay-menu">
<span class="search-overlay-close"><i class="icon_close"></i></span>
<form role="search" id="searchform" method="get">
    <input value="" name="q" type="search" placeholder="Search...">
    <button type="submit"><i class="icon-search-6"></i>
    </button>
</form>
</div>
<!-- End Search Menu -->
<?php wp_footer(); ?>
<!-- SPECIFIC SCRIPTS -->
	<script>
		'use strict';
		HeaderVideo.init({
			container: $('.header-video'),
			header: $('.header-video--media'),
			videoTrigger: $("#video-trigger"),
			autoPlayVideo: true
		});
    </script>
    
</body>
</html>