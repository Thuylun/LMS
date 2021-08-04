<?php
$lms_academic_options = lms_academic_theme_options();

$banner_title = $lms_academic_options['banner_title'];
$banner_desc = $lms_academic_options['banner_desc'];
$banner_button_txt = $lms_academic_options['banner_button_txt'];
$banner_button_url = $lms_academic_options['banner_button_url'];
$banner_bg_image = $lms_academic_options['banner_bg_image'];
if(!empty($banner_bg_image)){
    $background_style = "style='background-image:url(".esc_url($banner_bg_image).")'";
}
else{
    $background_style = '';
}

?>


<div class="hero-section image" <?php echo wp_kses_post($background_style); ?>>
	<div class="container">
			<div class="col-md-6">
		        <h1><?php echo esc_html($banner_title); ?></h1>
		        <p><?php echo esc_html($banner_desc); ?></p>
		        <?php  if( $banner_button_txt && $banner_button_url):?>
		        <a href="<?php echo esc_url($banner_button_url); ?>" class="btn btn-default"><?php echo esc_html($banner_button_txt); ?></a>
		        <?php endif; ?>
		    </div>
		</div>
	</div>
</div>




