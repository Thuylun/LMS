<?php

/*
Plugin Name: Catch Themes Demo Import
Plugin URI: https://wordpress.org/plugins/catch-themes-demo-import/
Description: Catch Themes Demo Import is a simple and easy-to-use demo importer WordPress plugin that allows you to import the theme demo data (design and content placement) you desire in just a single click.
Version: 1.4.9
Author: Catch Plugins
Author URI: http://www.catchplugins.com
License: GPL3
License URI: http://www.gnu.org/licenses/gpl.html
Text Domain: catch-themes-demo-import
*/

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Main plugin class with initialization tasks.
 */
class CatchThemesDemoImportPlugin {
	/**
	 * Constructor for this class.
	 */
	public function __construct() {
		/**
		 * Display admin error message if PHP version is older than 5.3.2.
		 * Otherwise execute the main plugin class.
		 */
		if ( version_compare( phpversion(), '5.3.2', '<' ) ) {
			add_action( 'admin_notices', array( $this, 'old_php_admin_error_notice' ) );
		} else {
			// Set plugin constants.
			$this->set_plugin_constants();

			// Composer autoloader.
			require_once CTDI_PATH . 'vendor/autoload.php';

			// Instantiate the main plugin class *Singleton*.
			$pt_one_click_demo_import = CTDI\CatchThemesDemoImport::get_instance();

			// Register WP CLI commands
			if ( defined( 'WP_CLI' ) && WP_CLI ) {
				WP_CLI::add_command( 'ctdi list', array( 'CTDI\WPCLICommands', 'list_predefined' ) );
				WP_CLI::add_command( 'ctdi import', array( 'CTDI\WPCLICommands', 'import' ) );
			}

			if ( isset( $_GET['page'] ) && ( 'tgmpa-install-plugins' === $_GET['page'] ) ) {
				// Don't redirect when activated via TGM
			} else {
				// Redirect to settings page after plugin activation.
				add_action( 'activated_plugin', array( $this, 'ctdi_redirect_to_plugin_setting' ) );
			}
		}
	}


	/**
	 * Display an admin error notice when PHP is older the version 5.3.2.
	 * Hook it to the 'admin_notices' action.
	 */
	public function old_php_admin_error_notice() {
		$message = sprintf( esc_html__( 'The %2$sCatch Themes Demo Import%3$s plugin requires %2$sPHP 5.3.2+%3$s to run properly. Please contact your hosting company and ask them to update the PHP version of your site to at least PHP 5.3.2.%4$s Your current version of PHP: %2$s%1$s%3$s', 'catch-themes-demo-import' ), phpversion(), '<strong>', '</strong>', '<br>' );

		printf( '<div class="notice notice-error"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}


	/**
	 * Set plugin constants.
	 *
	 * Path/URL to root of this plugin, with trailing slash and plugin version.
	 */
	private function set_plugin_constants() {
		// Path/URL to root of this plugin, with trailing slash.
		if ( ! defined( 'CTDI_PATH' ) ) {
			define( 'CTDI_PATH', plugin_dir_path( __FILE__ ) );
		}
		if ( ! defined( 'CTDI_URL' ) ) {
			define( 'CTDI_URL', plugin_dir_url( __FILE__ ) );
		}

		// Action hook to set the plugin version constant.
		add_action( 'admin_init', array( $this, 'set_plugin_version_constant' ) );
	}


	/**
	 * Set plugin version constant -> CTDI_VERSION.
	 */
	public function set_plugin_version_constant() {
		if ( ! defined( 'CTDI_VERSION' ) ) {
			$plugin_data = get_plugin_data( __FILE__ );
			define( 'CTDI_VERSION', $plugin_data['Version'] );
		}
	}

	// Redirect to settings page after plugin activation.
	function ctdi_redirect_to_plugin_setting( $plugin ) {
		if ( $plugin == plugin_basename( __FILE__ ) ) {
			exit(
				wp_redirect(
					add_query_arg(
						array(
							'page' => 'catch-themes-demo-import',
						),
						admin_url( 'themes.php' )
					)
				)
			);
		}
	}
}

// Instantiate the plugin class.
$ctdi_plugin = new CatchThemesDemoImportPlugin();

/* CTP tabs removal options */
require plugin_dir_path( __FILE__ ) . '/inc/ctp-tabs-removal.php';

 $ctp_options = ctp_get_options();
if ( 1 == $ctp_options['theme_plugin_tabs'] ) {
	/* Adds Catch Themes tab in Add theme page and Themes by Catch Themes in Customizer's change theme option. */
	if ( ! class_exists( 'CatchThemesThemePlugin' ) && ! function_exists( 'add_our_plugins_tab' ) ) {
		require plugin_dir_path( __FILE__ ) . '/inc/CatchThemesThemePlugin.php';
	}
}

/* Catch Theme Demo Importer */
require plugin_dir_path( __FILE__ ) . '/inc/demo-importer.php';
