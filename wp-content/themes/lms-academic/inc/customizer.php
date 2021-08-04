<?php
/**
 * LMS Academic Theme Customizer
 *
 * @package lms_academic
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lms_academic_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$lms_academic_options = lms_academic_theme_options();

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'lms_academic_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'lms_academic_customize_partial_blogdescription',
			)
		);
	}


    $wp_customize->add_panel(
        'theme_options',
        array(
            'title' => esc_html__('Theme Options', 'lms-academic'),
            'priority' => 2,
        )
    );



    /* Header Section */
    $wp_customize->add_section(
        'header_section',
        array(
            'title' => esc_html__( 'Header Section','lms-academic' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );

	$wp_customize->add_setting('lms_academic_theme_options[facebook]',
	    array(
	        'type' => 'option',
	        'default' => $lms_academic_options['facebook'],
	        'sanitize_callback' => 'lms_academic_sanitize_url',
	    )
	);
	$wp_customize->add_control('lms_academic_theme_options[facebook]',
	    array(
	        'label' => esc_html__('Facebook Link', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'header_section',
	        'settings' => 'lms_academic_theme_options[facebook]',
	    )
	);


	$wp_customize->add_setting('lms_academic_theme_options[twitter]',
	    array(
	        'type' => 'option',
	        'default' => $lms_academic_options['twitter'],
	        'sanitize_callback' => 'lms_academic_sanitize_url',
	    )
	);
	$wp_customize->add_control('lms_academic_theme_options[twitter]',
	    array(
	        'label' => esc_html__('Twitter Link', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'header_section',
	        'settings' => 'lms_academic_theme_options[twitter]',
	    )
	);


	$wp_customize->add_setting('lms_academic_theme_options[instagram]',
	    array(
	        'type' => 'option',
	        'default' => $lms_academic_options['instagram'],
	        'sanitize_callback' => 'lms_academic_sanitize_url',
	    )
	);
	$wp_customize->add_control('lms_academic_theme_options[instagram]',
	    array(
	        'label' => esc_html__('Instagram Link', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'header_section',
	        'settings' => 'lms_academic_theme_options[instagram]',
	    )
	);
    $wp_customize->add_setting('lms_academic_theme_options[search_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $lms_academic_options['search_show'],
            'sanitize_callback' => 'lms_academic_sanitize_checkbox',
        )
    );

	$wp_customize->add_setting('lms_academic_theme_options[header_button_txt]',
	    array(
	        'type' => 'option',
	        'default' => $lms_academic_options['header_button_txt'],
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('lms_academic_theme_options[header_button_txt]',
	    array(
	        'label' => esc_html__('Button Text', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'header_section',
	        'settings' => 'lms_academic_theme_options[header_button_txt]',
	    )
	);
	$wp_customize->add_setting('lms_academic_theme_options[header_button_url]',
	    array(
	        'type' => 'option',
	        'default' => $lms_academic_options['header_button_url'],
	        'sanitize_callback' => 'lms_academic_sanitize_url',
	    )
	);
	$wp_customize->add_control('lms_academic_theme_options[header_button_url]',
	    array(
	        'label' => esc_html__('Button Link', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'header_section',
	        'settings' => 'lms_academic_theme_options[header_button_url]',
	    )
	);


    $wp_customize->add_control('lms_academic_theme_options[search_show]',
        array(
            'label' => esc_html__('Show Search Form', 'lms-academic'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'header_section',

        )
    );


    /* Banner Section */

    $wp_customize->add_section(
        'banner_section',
        array(
            'title' => esc_html__( 'Banner Section','lms-academic' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );




	$wp_customize->add_setting('lms_academic_theme_options[banner_title]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('banner_title',
	    array(
	        'label' => esc_html__('Title', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'banner_section',
	        'settings' => 'lms_academic_theme_options[banner_title]',
	    )
	);


	$wp_customize->add_setting('lms_academic_theme_options[banner_desc]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('banner_desc',
	    array(
	        'label' => esc_html__('Description', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'banner_section',
	        'settings' => 'lms_academic_theme_options[banner_desc]',
	    )
	);




	$wp_customize->add_setting('lms_academic_theme_options[banner_button_txt]',
	    array(
	        'type' => 'option',
	        'default' => $lms_academic_options['banner_button_txt'],
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('lms_academic_theme_options[banner_button_txt]',
	    array(
	        'label' => esc_html__('Button Text', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'banner_section',
	        'settings' => 'lms_academic_theme_options[banner_button_txt]',
	    )
	);
	$wp_customize->add_setting('lms_academic_theme_options[banner_button_url]',
	    array(
	        'type' => 'option',
	        'default' => $lms_academic_options['banner_button_url'],
	        'sanitize_callback' => 'lms_academic_sanitize_url',
	    )
	);
	$wp_customize->add_control('lms_academic_theme_options[banner_button_url]',
	    array(
	        'label' => esc_html__('Button Link', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'banner_section',
	        'settings' => 'lms_academic_theme_options[banner_button_url]',
	    )
	);


	$wp_customize->add_setting('lms_academic_theme_options[banner_bg_image]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'esc_url_raw',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'lms_academic_theme_options[banner_bg_image]',
	        array(
	            'label' => esc_html__('Add Background Image', 'lms-academic'),
	            'section' => 'banner_section',
	            'settings' => 'lms_academic_theme_options[banner_bg_image]',
	        ))
	);



	/* Course Section*/


    $wp_customize->add_section(
        'course_section',
        array(
            'title' => esc_html__( 'Course Section ','lms-academic' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );

    $wp_customize->add_setting('lms_academic_theme_options[course_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $lms_academic_options['course_show'],
            'sanitize_callback' => 'lms_academic_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('lms_academic_theme_options[course_show]',
        array(
            'label' => esc_html__('Show course Section', 'lms-academic'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'course_section',

        )
    );
	$wp_customize->add_setting('lms_academic_theme_options[course_title]',
	    array(
	        'default' => $lms_academic_options['course_title'],
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field'
	    )
	);

	$wp_customize->add_control('lms_academic_theme_options[course_title]',
	    array(
	        'label' => esc_html__('course Section Title', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'course_section',
	        'settings' => 'lms_academic_theme_options[course_title]',
	    )
	);
	$wp_customize->add_setting('lms_academic_theme_options[course_desc]',
	    array(
	        'default' => $lms_academic_options['course_desc'],
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field'
	    )
	);

	$wp_customize->add_control('lms_academic_theme_options[course_desc]',
	    array(
	        'label' => esc_html__('course Section Description', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'course_section',
	        'settings' => 'lms_academic_theme_options[course_desc]',
	    )
	);
	$wp_customize->add_setting('lms_academic_theme_options[course_category]', array(
	    'default' => $lms_academic_options['course_category'],
	    'type' => 'option',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability' => 'edit_theme_options',

	));

	$wp_customize->add_control(new lms_academic_course_Dropdown_Customize_Control(
	    $wp_customize, 'lms_academic_theme_options[course_category]',
	    array(
	        'label' => esc_html__('Select course Posts Category', 'lms-academic'),
	        'section' => 'course_section',
	        'settings' => 'lms_academic_theme_options[course_category]',
	    )
	));



	/* About Section*/


    $wp_customize->add_section(
        'about_section',
        array(
            'title' => esc_html__( 'About Section ','lms-academic' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );

     function lms_academic_sanitize_checkbox( $input ) {
        if ( true === $input ) {
            return 1;
         } else {
            return 0;
         }
    }
    $wp_customize->add_setting('lms_academic_theme_options[about_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $lms_academic_options['about_show'],
            'sanitize_callback' => 'lms_academic_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('lms_academic_theme_options[about_show]',
        array(
            'label' => esc_html__('Show About Section', 'lms-academic'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'about_section',

        )
    );
	$wp_customize->add_setting(
	    'lms_academic_theme_options[choose_about_page]',
	    array(
	        'default' => $lms_academic_options['choose_about_page'],
	        'type' => 'option',
	        'sanitize_callback' => 'absint',
	        'capability' => 'edit_theme_options'
	    )
	);
	$wp_customize->add_control('choose_about_page', array(
	    'label' => esc_html__('Choose About Page :', 'lms-academic'),
	    'type' => 'dropdown-pages',
	    'section' => 'about_section',
	    'settings' => 'lms_academic_theme_options[choose_about_page]'
	));

	$wp_customize->add_setting(
	    'lms_academic_theme_options[choose_about_page2]',
	    array(
	        'default' => $lms_academic_options['choose_about_page2'],
	        'type' => 'option',
	        'sanitize_callback' => 'absint',
	        'capability' => 'edit_theme_options'
	    )
	);
	$wp_customize->add_control('choose_about_page2', array(
	    'label' => esc_html__('Choose About Page 2:', 'lms-academic'),
	    'type' => 'dropdown-pages',
	    'section' => 'about_section',
	    'settings' => 'lms_academic_theme_options[choose_about_page2]'
	));














    /* CTA Section */

    $wp_customize->add_section(
        'cta_section',
        array(
            'title' => esc_html__( 'Call to Action Section','lms-academic' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );


    $wp_customize->add_setting('lms_academic_theme_options[cta_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $lms_academic_options['cta_show'],
            'sanitize_callback' => 'lms_academic_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('lms_academic_theme_options[cta_show]',
        array(
            'label' => esc_html__('Show CTA Section', 'lms-academic'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'cta_section',

        )
    );
	$wp_customize->add_setting('lms_academic_theme_options[cta_title]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('cta_title',
	    array(
	        'label' => esc_html__('Title', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'cta_section',
	        'settings' => 'lms_academic_theme_options[cta_title]',
	    )
	);


	$wp_customize->add_setting('lms_academic_theme_options[cta_button_txt]',
	    array(
	        'type' => 'option',
	        'default' => $lms_academic_options['cta_button_txt'],
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('lms_academic_theme_options[cta_button_txt]',
	    array(
	        'label' => esc_html__('CTA Button Text', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'cta_section',
	        'settings' => 'lms_academic_theme_options[cta_button_txt]',
	    )
	);
	$wp_customize->add_setting('lms_academic_theme_options[cta_button_url]',
	    array(
	        'type' => 'option',
	        'default' => $lms_academic_options['cta_button_url'],
	        'sanitize_callback' => 'lms_academic_sanitize_url',
	    )
	);
	$wp_customize->add_control('lms_academic_theme_options[cta_button_url]',
	    array(
	        'label' => esc_html__('CTA Button Link', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'cta_section',
	        'settings' => 'lms_academic_theme_options[cta_button_url]',
	    )
	);








    /* Quote Section */

    $wp_customize->add_section(
        'quote_section',
        array(
            'title' => esc_html__( 'Quote Section','lms-academic' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );


    $wp_customize->add_setting('lms_academic_theme_options[quote_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $lms_academic_options['quote_show'],
            'sanitize_callback' => 'lms_academic_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('lms_academic_theme_options[quote_show]',
        array(
            'label' => esc_html__('Show quote Section', 'lms-academic'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'quote_section',

        )
    );
	$wp_customize->add_setting('lms_academic_theme_options[quote_message]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('quote_message',
	    array(
	        'label' => esc_html__('Quote Message', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'quote_section',
	        'settings' => 'lms_academic_theme_options[quote_message]',
	    )
	);

	$wp_customize->add_setting('lms_academic_theme_options[quote_name]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('quote_name',
	    array(
	        'label' => esc_html__('Person Name', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'quote_section',
	        'settings' => 'lms_academic_theme_options[quote_name]',
	    )
	);


	$wp_customize->add_setting('lms_academic_theme_options[quote_youtube_url]',
	    array(
	        'type' => 'option',
	        'default' => $lms_academic_options['quote_youtube_url'],
	        'sanitize_callback' => 'lms_academic_sanitize_url',
	    )
	);
	$wp_customize->add_control('lms_academic_theme_options[quote_youtube_url]',
	    array(
	        'label' => esc_html__('Video Link', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'quote_section',
	        'settings' => 'lms_academic_theme_options[quote_youtube_url]',
	    )
	);


	$wp_customize->add_setting('lms_academic_theme_options[quote_bg_image]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'esc_url_raw',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'lms_academic_theme_options[quote_bg_image]',
	        array(
	            'label' => esc_html__('Add Image', 'lms-academic'),
	            'section' => 'quote_section',
	            'settings' => 'lms_academic_theme_options[quote_bg_image]',
	        ))
	);


    /* Blog Section */

    $wp_customize->add_section(
        'blog_section',
        array(
            'title' => esc_html__( 'Blog Section','lms-academic' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );

    $wp_customize->add_setting('lms_academic_theme_options[blog_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $lms_academic_options['blog_show'],
            'sanitize_callback' => 'lms_academic_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('lms_academic_theme_options[blog_show]',
        array(
            'label' => esc_html__('Show Blog Section', 'lms-academic'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'blog_section',

        )
    );
	$wp_customize->add_setting('lms_academic_theme_options[blog_title]',
	    array(
	        'capability' => 'edit_theme_options',
	        'default' => $lms_academic_options['blog_title'],
	        'sanitize_callback' => 'sanitize_text_field',
	        'type' => 'option',
	    )
	);
	$wp_customize->add_control('lms_academic_theme_options[blog_title]',
	    array(
	        'label' => esc_html__('Section Title', 'lms-academic'),
	        'priority' => 1,
	        'section' => 'blog_section',
	        'type' => 'text',
	    )
	);

	$wp_customize->add_setting('lms_academic_theme_options[blog_desc]',
	    array(
	        'default' => $lms_academic_options['blog_desc'],
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field'
	    )
	);

	$wp_customize->add_control('lms_academic_theme_options[blog_desc]',
	    array(
	        'label' => esc_html__('Blog Section Description', 'lms-academic'),
	        'type' => 'text',
	        'section' => 'blog_section',
	        'settings' => 'lms_academic_theme_options[blog_desc]',
	    )
	);

	$wp_customize->add_setting('lms_academic_theme_options[blog_category]', array(
	    'default' => $lms_academic_options['blog_category'],
	    'type' => 'option',
	    'sanitize_callback' => 'lms_academic_sanitize_select',
	    'capability' => 'edit_theme_options',

	));

	$wp_customize->add_control(new lms_academic_Dropdown_Customize_Control(
	    $wp_customize, 'lms_academic_theme_options[blog_category]',
	    array(
	        'label' => esc_html__('Select Blog Category', 'lms-academic'),
	        'section' => 'blog_section',
	        'choices' => lms_academic_get_categories_select(),
	        'settings' => 'lms_academic_theme_options[blog_category]',
	    )
	));



    /* Blog Section */

    $wp_customize->add_section(
        'prefooter_section',
        array(
            'title' => esc_html__( 'Prefooter Section','lms-academic' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );

    $wp_customize->add_setting('lms_academic_theme_options[show_prefooter]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $lms_academic_options['show_prefooter'],
            'sanitize_callback' => 'lms_academic_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('lms_academic_theme_options[show_prefooter]',
        array(
            'label' => esc_html__('Show Prefooter Section', 'lms-academic'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'prefooter_section',

        )
    );
}
add_action( 'customize_register', 'lms_academic_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function lms_academic_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function lms_academic_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lms_academic_customize_preview_js() {
	wp_enqueue_script( 'lms-academic-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'lms_academic_customize_preview_js' );
