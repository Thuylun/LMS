<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       catchplugins.com
 * @since      1.0.0
 *
 * @package    Catch_Themes_Demo_Import
 * @subpackage Catch_Themes_Demo_Import/admin/partials
 */

?>

<div class="wrap">
    <h1 class="wp-heading-inline"><?php esc_html_e( 'Catch Themes Demo Import', 'catch-themes-demo-import' ); ?></h1>
    <div id="plugin-description">
        <p><?php esc_html_e( 'Catch Themes Demo Import is a simple and easy-to-use demo importer WordPress plugin that allows you to import the theme demo data (design and content placement) you desire in just a single click.', 'catch-themes-demo-import' ); ?></p>
    </div>
    <div class="catchp-content-wrapper">
        <div class="catchp_widget_settings">

            <h2 class="nav-tab-wrapper">
                <a class="nav-tab nav-tab-active" id="dashboard-tab" href="#dashboard"><?php esc_html_e( 'Dashboard', 'catch-themes-demo-import' ); ?></a>
                <a class="nav-tab" id="features-tab" href="#features">Features</a>
            </h2>

            <div id="dashboard" class="wpcatchtab  nosave active">

                <?php require_once plugin_dir_path( dirname( __FILE__ ) ) . '/partials/plugin-page.php'; ?>
                <div id="ctp-switch" class="content-wrapper col-3 catch-themes-demo-import-main">
                        <div class="header">
                            <h2><?php esc_html_e( 'Catch Themes & Catch Plugins Tabs', 'catch-themes-demo-import' ); ?></h2>
                        </div> <!-- .Header -->

                        <div class="content">

                            <p><?php echo esc_html__( 'If you want to turn off Catch Themes & Catch Plugins tabs option in Add Themes and Add Plugins page, please uncheck the following option.', 'catch-themes-demo-import' ); ?>
                            </p>
                            <table>
                                <tr>
                                    <td>
                                        <?php echo esc_html__( 'Turn On Catch Themes & Catch Plugin tabs', 'catch-themes-demo-import' );  ?>
                                    </td>
                                    <td>
                                        <?php $ctp_options = ctp_get_options(); ?>
                                        <div class="module-header <?php echo $ctp_options['theme_plugin_tabs'] ? 'active' : 'inactive'; ?>">
                                            <div class="switch">
                                                <input type="checkbox" id="ctp_options[theme_plugin_tabs]" class="ctp-switch" rel="theme_plugin_tabs" <?php checked( true, $ctp_options['theme_plugin_tabs'] ); ?> >
                                                <label for="ctp_options[theme_plugin_tabs]"></label>
                                            </div>
                                            <div class="loader"></div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                    </div><!-- #ctp-switch -->

            </div><!-- .dashboard -->

            <div id="features" class="wpcatchtab save">
                <div class="content-wrapper col-3">
                    <div class="header">
                        <h3><?php esc_html_e( 'Features', 'catch-themes-demo-import' ); ?></h3>

                    </div><!-- .header -->
                    <div class="content">
                        <ul class="catchp-lists">
                            <li>
                                <strong><?php esc_html_e( 'Supports all themes on WordPress', 'catch-themes-demo-import' ); ?></strong>
                                <p><?php esc_html_e( 'You don’t have to worry if you have a slightly different or complicated theme installed on your website. It supports all the themes on WordPress and makes your website more striking and playful.', 'catch-themes-demo-import' ); ?></p>
                            </li>

                            <li>
                                <strong><?php esc_html_e( 'Lightweight', 'catch-themes-demo-import' ); ?></strong>
                                <p><?php esc_html_e( 'It is extremely lightweight. You do not need to worry about it affecting the space and speed of your website.', 'catch-themes-demo-import' ); ?></p>
                            </li>

                            <li>
                                <strong><?php esc_html_e( 'Responsive Design', 'catch-themes-demo-import' ); ?></strong>
                                <p><?php esc_html_e( 'One of the key features of our plugins is that your website will magically respond and adapt to different screen sizes delivering an optimized design for iPhones, iPads, and other mobile devices. No longer will you need to zoom and scroll around when browsing on your mobile phone.', 'catch-themes-demo-import' ); ?></p>
                            </li>

                            <li>
                                <strong><?php esc_html_e( 'Incredible Support', 'catch-themes-demo-import' ); ?></strong>
                                <p><?php esc_html_e( 'We have a great line of support team and support documentation. You do not need to worry about how to use the plugins we provide, just refer to our Tech Support Forum. Further, if you need to do advanced customization to your website, you can always hire our theme customizer!', 'catch-themes-demo-import' ); ?></p>
                            </li>
                        </ul>
                    </div><!-- .content -->
                </div><!-- content-wrapper -->
            </div> <!-- Featured -->

        </div><!-- .catchp_widget_settings -->


        <?php require_once plugin_dir_path( dirname( __FILE__ ) ) . '/partials/sidebar.php'; ?>
    </div> <!-- .catchp-content-wrapper -->

    <?php require_once plugin_dir_path( dirname( __FILE__ ) ) . '/partials/footer.php'; ?>
</div><!-- .wrap -->
<div id="dialog-confirm" title="Activate required plugin?" style="display: none;">
    <p>
        <span class="dashicons dashicons-info" style="float:left; margin:12px 12px 20px 0;"></span>
        <?php esc_html_e( 'Please install Essential Content Types plugin to fully import the theme demo including Custom Post Types like Featured Content, Portfolio, Testimonials, and Services.', 'catch-themes-demo-import' ); ?>
    </p>
</div>

<div id="dialog-activated" title="ECT Activated" style="display: none;">
    <p>
        <span class="dashicons dashicons-info" style="float:left; margin:12px 12px 20px 0;"></span>
        <?php esc_html_e( 'Required plugin ECT has been activated, now you can import the demo', 'catch-themes-demo-import' ); ?>
    </p>
</div>