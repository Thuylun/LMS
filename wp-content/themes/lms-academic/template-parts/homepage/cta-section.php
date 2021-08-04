<?php


$lms_academic_options = lms_academic_theme_options();
$cta_show            = $lms_academic_options['cta_show'];
$cta_title           = $lms_academic_options['cta_title'];
$cta_button_txt  = $lms_academic_options['cta_button_txt'];
$cta_button_url      = $lms_academic_options['cta_button_url'];


if($cta_show) { 
    if (1 == $cta_show):?>
    <div class="section cta-section">
        <div class="container">
            <div class="row">
                <div class="cta-content">
                    <div class="col-md-8">
                    <h2 class="cta-title"><?php echo esc_html($cta_title); ?></h2>
                    </div>
                    
                     <div class="col-md-4">
                        
                    <?php  if( $cta_button_txt && $cta_button_url):?>
                        <a href="<?php echo esc_url($cta_button_url); ?>" class="btn btn-default"><?php echo esc_html($cta_button_txt); ?></a>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <?php
        
    endif;
}


