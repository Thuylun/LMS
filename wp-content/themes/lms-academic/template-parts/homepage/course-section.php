<?php
$lms_academic_options = lms_academic_theme_options();

$course_show = $lms_academic_options['course_show'];
$course_category = $lms_academic_options['course_category'];
$course_title = $lms_academic_options['course_title'];
$course_desc = $lms_academic_options['course_desc'];
$content_length = '100';
if($course_show) {

    if (1 == $course_show):
        if ($course_category == 'none') {
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'order' => 'desc',
                'orderby' => 'menu_order date',

            );
        } else {
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'order' => 'desc',
                'orderby' => 'menu_order date',
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => array( $course_category ),
                    ),
                ),
            );
        } ?>
        <div class="course-section section">
            <div class="container">
                <div class="row">
                    <?php if ($course_title || $course_desc): ?>
                        <div class="section-title">
                            <?php
                            if ($course_desc)
                                echo '<p>' . esc_html($course_desc) . '</p>';
                            
                            if ($course_title)
                                echo '<h2>' . esc_html($course_title) . '</h2>';
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
             </div>
             <div class="container">
                <div class="row"> 
                    <div class="course-list-wrap">
                <?php $recent_query = new WP_Query($args);
                    if ($recent_query->have_posts()) :
                    ?>

                        <?php
                        while ($recent_query->have_posts()) : $recent_query->the_post();
                        global $post;
                            $content = get_the_content();
                            $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
                            $image = wp_get_attachment_image_src($post_thumbnail_id, 'lms-academic-blog-thumbnail-img');
                            ?>


                                <div class="course-wrap">
                                    <a href="<?php echo esc_url(get_the_permalink()); ?>"><img src="<?php echo esc_url($image[0]); ?>" alt="" /></a>

                                    <div class="course-footer">
                                    <h2 class="title"> <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                                    </div>
                                </div>
                        <?php endwhile;
                        wp_reset_postdata();
                        ?>
                    <?php
                    endif; ?>
                    </div>
                </div>
             </div>
        </div>
        <?php
        
    endif;
}



