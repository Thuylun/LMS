<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lms_academic
 */

$lms_academic_options = lms_academic_theme_options();

$show_prefooter = $lms_academic_options['show_prefooter'];

?>

<footer id="colophon" class="site-footer">


	<?php if ($show_prefooter== 1){ ?>
	    <section class="footer-sec">
	        <div class="container">
	            <div class="row">
	                <?php if (is_active_sidebar('lms_academic_footer_1')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('lms_academic_footer_1') ?>
	                    </div>
	                    <?php
	                else: lms_academic_blank_widget();
	                endif; ?>
	                <?php if (is_active_sidebar('lms_academic_footer_2')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('lms_academic_footer_2') ?>
	                    </div>
	                    <?php
	                else: lms_academic_blank_widget();
	                endif; ?>
	                <?php if (is_active_sidebar('lms_academic_footer_3')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('lms_academic_footer_3') ?>
	                    </div>
	                    <?php
	                else: lms_academic_blank_widget();
	                endif; ?>
	            </div>
	        </div>
	    </section>
	<?php } ?>

		<div class="site-info">
		<p><?php esc_html_e('Powered By WordPress', 'lms-academic');
                    esc_html_e(' | ', 'lms-academic') ?>
                    <span><?php esc_html_e('LMS Academic' , 'lms-academic'); ?></span>
                </p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
