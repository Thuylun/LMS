<?php
$lms_academic_options = lms_academic_theme_options();
$quote_show            = $lms_academic_options['quote_show'];
$quote_message           = $lms_academic_options['quote_message'];
$quote_name           = $lms_academic_options['quote_name'];
$quote_bg_image  = $lms_academic_options['quote_bg_image'];
$quote_youtube_url      = $lms_academic_options['quote_youtube_url'];

?>



    <div class="section quote-section">
        <div class="container">
            <div class="row">
                <div class="quote-content">
                    <div class="col-md-6">
                        <img src="<?php echo esc_url($quote_bg_image); ?>" alt="" />
                        <a href="<?php echo esc_url($quote_youtube_url); ?>" class="iframe-link"><i class="fa fa-play-circle" aria-hidden="true"></i></a>
                    </div>
                    
                     <div class="col-md-6">
                        <div class="quote-wrap">
                            <h2><?php echo esc_html($quote_message); ?></h2>
                            <p><?php echo esc_html($quote_name); ?></p>
                        </div>
                     </div>
                    <!--                    <button class="button"><span>Book Now</span></button>-->
                </div>

                <div class="blob-wrapper__background"><div class="inline-svg " style=""><svg xmlns="http://www.w3.org/2000/svg" width="1232" height="696" viewBox="0 0 1232 696" preserveAspectRatio="none">
  <path fill="#01095B" fill-rule="evenodd" d="m0 0 14.249 211-14.249 221 6.577 157v107l311.288-16h802.334l111.801 16v-696l-428.569 27-230.178-11-344.171 11z"></path>
</svg></div></div>
            </div>
        </div>
    </div>