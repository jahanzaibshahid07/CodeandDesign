<?php $awada_theme_options = awada_theme_options();
// Theme_mod settings to check.
$awada_portfolio_setting = $awada_theme_options[ 'awada_portfolio_setting' ]; ?>
<section id="home_portfolio" class="white-wrapper sec-spacing">
	<div class="container">
		<div class="main_title">
			<?php if($awada_theme_options['home_portfolio_title']!=""){ ?>
			<h2 id="portfolio_heading"><?php echo wp_kses_post($awada_theme_options['home_portfolio_title']); ?></h2>
			<hr>
			<?php } if ($awada_theme_options['home_portfolio_subtitle'] != ""){ ?>
			<p id="portfolio_sub_heading" class="lead"><?php echo wp_kses_post($awada_theme_options['home_portfolio_subtitle']); ?></p>
			<?php } ?>
		</div><!-- end general title -->
		<div class="padding-top">
			<?php
			if(!empty($awada_portfolio_setting) && is_array($awada_portfolio_setting)) {
				foreach( $awada_portfolio_setting as $setting ) {
					$post_id = $setting['content_page'];
					$post = get_post( $post_id );
					$post->post_excerpt;
					$src = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'awada_port_home_thumb' );
					$url = $src[0]; ?>
					<div class="col-lg-4 col-sm-4 col-md-4 col-sm-4">
						<div class="portfolio_list">
							<div class="content_entry">
								<img src="<?php echo esc_url( $url ); ?>" alt="" class="img-responsive">
								<div class="magnifier">
									<div class="buttons">
										<a class="st" rel="bookmark" href="<?php echo get_the_permalink($post_id); ?>"><i class="fa fa-link"></i></a>
										<a class="sf" data-gal="prettyPhoto[product-gallery]" href="<?php echo esc_url( $url ); ?>"><i class="fa fa-expand"></i></a>
										<h3><?php echo esc_html( $post->post_title ); ?></h3>
									</div><!-- end buttons -->
								</div><!-- end magnifier -->
							</div><!-- end portfoliobox -->
						</div><!-- end portfolio_list -->
					</div><!-- end col-lg-4 -->
				<?php }
			} else {
				$port_title = array(__('PERFECT THEME', 'awada'), __('QUICK SUPPORT', 'awada'), __('RESPONSIVE THEME', 'awada'), __('MULTIPLE COLOR SCHEME', 'awada'), __('RETINA READY', 'awada'), __('AMAZING SHORTCODES', 'awada'));
				$j = 0;
				for($i=1 ; $i<=3 ; $i++){ ?>
					<div class="col-lg-4 col-sm-4 col-md-4 col-sm-4">
						<div class="portfolio_list">
							<div class="content_entry">
								<img src="<?php echo get_template_directory_uri(); ?>/images/Portfolio/port1.jpg" alt="" class="img-responsive">
								<div class="magnifier">
									<div class="buttons">
										<a class="st" rel="bookmark" href="#"><i class="fa fa-link"></i></a>
										<a class="sf" data-gal="prettyPhoto[product-gallery]" href="<?php echo get_template_directory_uri(); ?>/images/portfolio/port1.jpg"><i class="fa fa-expand"></i></a>
										<h3><?php echo esc_attr($port_title[$j]); ?></h3>
									</div><!-- end buttons -->
								</div><!-- end magnifier -->
							</div><!-- end portfoliobox -->
						</div><!-- end portfolio_list -->
					</div><!-- end col-lg-4 -->
				<?php $j++; }
			} ?>	
		</div>
		<div class="clearfix"></div>
	</div><!-- end container -->
</section><!-- end white-wrapper -->