<?php get_header(); ?>
<section class="post-wrapper-top section-shadow clearfix">
	<div class="container">
		<div class="col-md-12">
			<div class="col-md-7 awada_pag_title">
				<h2><?php _e('Page Not Found', 'awada'); ?></h2>
			</div>
			<div class="col-md-5 awada_pag_breadcrumb">
				<?php awada_breadcrumbs(); ?>
			</div>
		</div>
	</div>
</section>
<section id="error-404" class="white-wrapper">
	<div class="container">
		<div class="not_found text-center">
		<h1><?php _e('404!', 'awada'); ?></h1>
		<p class="lead"><?php _e('Look like something went wrong! The page you were looking for is not here. <br> Go <a href="<?php echo home_url(); ?>"> Home </a> or try a search.', 'awada'); ?></p>
			<div class="widget padding-top">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>