<?php
if (!function_exists('lms_academic_theme_options')) :
    function lms_academic_theme_options()
    {
        $defaults = array(

            //banner section
            'header_button_txt' => '',
            'header_button_url' => '',
            'facebook' => '',
            'search_show' => 1,
            'twitter' => '',
            'instagram' => '',
            'banner_title' => '',
            'banner_button_txt' => '',
            'banner_desc' => '',
            'banner_button_url' => '',
            'banner_bg_image' => '',

            'about_show' => 0,
            'choose_about_page' => '',
            'choose_about_page2' => '',

            'cta_show' => 0,
            'cta_title' => '',
            'cta_button_txt' => '',
            'cta_button_url' => '',

            'quote_show' => 0,
            'quote_message' => '',
            'quote_name' => '',
            'quote_youtube_url' => '',
            'quote_bg_image' => '',

            'course_show' => 0,
            'course_title' => '',
            'course_desc' => '',
            'course_category' => '',

            'blog_show' => 0,
            'blog_title' => '',
            'blog_desc' => '',
            'blog_category' => '',
            'show_prefooter' => 1,


        );

        $options = get_option('lms_academic_theme_options', $defaults);

        //Parse defaults again - see comments
        $options = wp_parse_args($options, $defaults);

        return $options;
    }
endif;
