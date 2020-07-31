<?php  /* Template Name: Home */
$awada_theme_options = awada_theme_options();
if ( $awada_theme_options['_frontpage'] == 1 ) {
	get_header();
	get_template_part('home', 'slider'); 
	foreach($awada_theme_options['home_sections'] as $section){
		get_template_part('home',$section);
	}
	get_footer();
} else {
	if(is_page()) {
		get_template_part('page');
	} else {
		get_template_part('index');
	}
} ?>