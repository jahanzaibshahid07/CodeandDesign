<?php $awada_theme_options = awada_theme_options();
$post_id = ($awada_theme_options['extra_post'] == ''?'':$awada_theme_options['extra_post']);
$awada_extra_post = get_post($post_id); ?>
<section id="home_extra" class="white-wrapper sec-spacing">
	<div class="container">
		<div class="main_title">
			<?php if($awada_theme_options['home_extra_title']!=""){ ?>
			<h2 id="extra_heading"><?php echo wp_kses_post($awada_theme_options['home_extra_title']); ?></h2>
			<hr>
			<?php } if ($awada_theme_options['home_extra_description'] != ""){ ?>
			<p id="extra_description" class="lead"><?php echo wp_kses_post($awada_theme_options['home_extra_description']); ?></p>
			<?php } ?>
		</div><!-- end general title -->
		<div class="padding-top"><?php
			if($awada_extra_post->post_content):
				echo apply_filters('the_content',$awada_extra_post->post_content);
			else:
				esc_html_e('Add extra content here.', 'awada');
			endif; ?>	
		</div>
		<div class="clearfix"></div>
	</div><!-- end container -->
</section><!-- end white-wrapper -->