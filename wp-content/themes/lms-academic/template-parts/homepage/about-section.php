<?php


$lms_academic_options = lms_academic_theme_options();


$about_show = $lms_academic_options['about_show'];
$choose_about_page = $lms_academic_options['choose_about_page'];

$choose_about_page2 = $lms_academic_options['choose_about_page2'];


$content_length = '300';

if (!empty($choose_about_page)):
    $intro_pages_arg = array(
        'post_type' => 'page',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'page_id' => $choose_about_page);


    $about_page = new WP_Query($intro_pages_arg);

    if ($about_page->have_posts()): ?>

        <section id="primary" class="about-sec section">
            <div class="container">
                <div class="row">
                    <div class="about-sec-wrap">
                    <?php
                    while ($about_page->have_posts()):
                        $about_page->the_post();
                        $image_style = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        ?>
                        <div class="col-md-6">


                        <?php if ($image_style[0]): ?>
                                <div class="about-section-img">

                                    <img src="<?php echo esc_url($image_style[0]) ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <div class="about-second-wrap">
                            <div class="about-section-wrap">
                                <div class="section-title">
                                    <h2><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                                </div>

                            </div>
                            <p><?php echo wp_kses_post(lms_academic_get_excerpt($about_page->post->ID, $content_length)); ?></p>
                            <a href="<?php echo esc_url(get_the_permalink()); ?>" class="btn btn-default"><?php esc_html_e("Read More", "lms-academic") ?></a>
                             
                         </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
                </div>
        </section>

    <?php endif;
endif;



if (!empty($choose_about_page2)):
    $intro_pages_arg2 = array(
        'post_type' => 'page',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'page_id' => $choose_about_page2);


    $about_page2 = new WP_Query($intro_pages_arg2);

    if ($about_page2->have_posts()): ?>

        <section id="primary2" class="about-sec section">
            <div class="container">
                <div class="row">
                    <div class="about-sec-wrap">
                    <?php
                    while ($about_page2->have_posts()):
                        $about_page2->the_post();
                        $image_style = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        ?>

                        <div class="col-md-6">
                            <div class="about-second-wrap">
                            <div class="about-section-wrap">
                                <div class="section-title">
                                    <h2><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                                </div>

                            </div>
                            <p><?php echo wp_kses_post(lms_academic_get_excerpt($about_page2->post->ID, $content_length)); ?></p>
                            <a href="<?php echo esc_url(get_the_permalink()); ?>" class="btn btn-default"><?php esc_html_e("Read More", "lms-academic") ?></a>
                             
                         </div>
                        </div>
                        <div class="col-md-6">


                        <?php if ($image_style[0]): ?>
                                <div class="about-section-img">

                                    <img src="<?php echo esc_url($image_style[0]) ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
                </div>
        </section>

    <?php endif;
endif;







