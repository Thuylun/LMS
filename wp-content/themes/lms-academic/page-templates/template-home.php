<?php
/**
 *
 * Template Name: Frontpage

 *
 * @package lms academic
 */

$lms_academic_options = lms_academic_theme_options();
$about_show = $lms_academic_options['about_show'];
$blog_show = $lms_academic_options['blog_show'];
$quote_show = $lms_academic_options['quote_show'];

get_header();


get_template_part('template-parts/homepage/banner', 'section');


get_template_part('template-parts/homepage/course', 'section');



if($about_show == 1)
get_template_part('template-parts/homepage/about', 'section');

if($quote_show == 1)
get_template_part('template-parts/homepage/quote', 'section');

if($blog_show == 1)
get_template_part('template-parts/homepage/blog', 'section');

get_template_part('template-parts/homepage/cta', 'section');
get_footer();
