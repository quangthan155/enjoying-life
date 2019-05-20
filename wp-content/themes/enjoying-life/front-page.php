<?php
/**
 * The template for displaying the home page
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package enjoying-life
 */
get_header();
// General settings
$prefix 	= get_device_prefix();
$general_st = get_field( 'general_settings' );
$logo       = $general_st[ 'logo_header' . $prefix ];
$top_tours	= get_tours_by_category_name('', 20);
?>
<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">
		<!-- End top tours section -->
			<div class="main_title">
				<h2>Our <span>Top</span> Adventure Tours</h2>
				<p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
			</div>
			<div class="row">
				<?php if(!empty($top_tours)) :
				foreach($top_tours as $tour) : ?>
				<div class="col-md-4 col-sm-6 wow fadeIn animated animated" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeIn;">
					<div class="img_wrapper">
						<div class="ribbon">
							<span>Popular</span>
						</div>
						<div class="price_grid">
							<sup>$</sup>23
						</div>
						<div class="img_container">
							<a href="http://www.ansonika.com/bestours/adventure_tours/detail-page.html">
								<img src="<?php echo get_template_directory_uri() . '/assets/images/tour_list_1.jpg'?>" width="800" height="533" class="img-responsive" alt="">
								<div class="short_info">
									<h3><?php echo $tour->post_title ?> </h3>
									<em>Duration 45 mins</em>
									<p>
										A quam morbi ut arcu, eget neque molestie, ullamcorper congue pharetra, hendrerit odio consectetuer.
									</p>
									<div class="score_wp">Superb
										<div class="score">7.5</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- End img_wrapper -->
				</div>    
				<?php endforeach; endif; ?>        
			</div>
			<!-- End row -->
		<!-- End top tours section -->
			<div class="main_title_2">
				<h3>View other <span>popular</span> tours</h3>
				<p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
			</div>
			<div class="row list_tours">
				<div class="col-sm-6">
					<h3>New Tours</h3>
					<ul>
						<li>
							<div>
								<a href="http://www.ansonika.com/bestours/adventure_tours/detail-page.html">
									<figure><img src="<?php echo get_template_directory_uri() . '/assets/images/thumb_tabs_1.jpg' ?>" alt="thumb" class="img-rounded" width="60" height="60">
									</figure>
									<h4>Adipisci voluptatum ea</h4>
									<small>Duration 1hr 20 minutes</small>
									<span class="price_list">$23</span>
								</a>
							</div>
						</li>

                        <li>
							<div>
								<a href="http://www.ansonika.com/bestours/adventure_tours/detail-page.html">
									<figure><img src="<?php echo get_template_directory_uri() . '/assets/images/thumb_tabs_1.jpg' ?>" alt="thumb" class="img-rounded" width="60" height="60">
									</figure>
									<h4>Adipisci voluptatum ea</h4>
									<small>Duration 1hr 20 minutes</small>
									<span class="price_list">$23</span>
								</a>
							</div>
                        </li>
                        
                        <li>
							<div>
								<a href="http://www.ansonika.com/bestours/adventure_tours/detail-page.html">
									<figure><img src="<?php echo get_template_directory_uri() . '/assets/images/thumb_tabs_1.jpg' ?>" alt="thumb" class="img-rounded" width="60" height="60">
									</figure>
									<h4>Adipisci voluptatum ea</h4>
									<small>Duration 1hr 20 minutes</small>
									<span class="price_list">$23</span>
								</a>
							</div>
						</li>
					</ul>
				</div>

				<div class="col-sm-6">
					<h3>Special offers</h3>
					<ul>
                        <li>
							<div>
								<a href="http://www.ansonika.com/bestours/adventure_tours/detail-page.html">
									<figure><img src="<?php echo get_template_directory_uri() . '/assets/images/thumb_tabs_1.jpg' ?>" alt="thumb" class="img-rounded" width="60" height="60">
									</figure>
									<h4>Adipisci voluptatum ea</h4>
									<small>Duration 1hr 20 minutes</small>
									<span class="price_list">$23</span>
								</a>
							</div>
                        </li>
                        
                        <li>
							<div>
								<a href="http://www.ansonika.com/bestours/adventure_tours/detail-page.html">
									<figure><img src="<?php echo get_template_directory_uri() . '/assets/images/thumb_tabs_1.jpg' ?>" alt="thumb" class="img-rounded" width="60" height="60">
									</figure>
									<h4>Adipisci voluptatum ea</h4>
									<small>Duration 1hr 20 minutes</small>
									<span class="price_list">$23</span>
								</a>
							</div>
                        </li>
                        
                        <li>
							<div>
								<a href="http://www.ansonika.com/bestours/adventure_tours/detail-page.html">
									<figure><img src="<?php echo get_template_directory_uri() . '/assets/images/thumb_tabs_1.jpg' ?>" alt="thumb" class="img-rounded" width="60" height="60">
									</figure>
									<h4>Adipisci voluptatum ea</h4>
									<small>Duration 1hr 20 minutes</small>
									<span class="price_list">$23</span>
								</a>
							</div>
						</li>
					</ul>
				</div>

			</div>
			<!-- End row -->

			<p class="text-center add_bottom_45">
				<a href="http://www.ansonika.com/bestours/adventure_tours/grid.html" class="btn_1">Explore all tours (24)</a>
			</p>

		</div>
	</section>
	<!-- End section -->
<?php get_footer();