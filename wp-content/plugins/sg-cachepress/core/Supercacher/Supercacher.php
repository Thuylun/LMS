<?php
namespace SiteGround_Optimizer\Supercacher;

use SiteGround_Optimizer\Front_End_Optimization\Front_End_Optimization;
use SiteGround_Optimizer\DNS\Cloudflare;
/**
 * SG CachePress main plugin class
 */
class Supercacher {

	/**
	 * Child classes that have to be initialized.
	 *
	 * @var array
	 *
	 * @since 5.0.0
	 */
	public static $children = array(
		'themes',
		'plugins',
		'terms',
		'comments',
		// 'postmeta',
	);

	/**
	 * Hooks which to be called with the purge_everything function.
	 *
	 * @var array
	 *
	 * @since 5.8.3
	 */
	public $purge_hooks = array(
		'save_post',
		'pll_save_post',
		'wp_trash_post',
		'automatic_updates_complete',
		'_core_updated_successfully',
		'update_option_permalink_structure',
		'update_option_tag_base',
		'update_option_category_base',
		'wp_update_nav_menu',
		'update_option_siteground_optimizer_enable_cache',
		'update_option_siteground_optimizer_autoflush_cache',
		'update_option_siteground_optimizer_enable_memcached',
		'edd_login_form_logged_in',
	);

	/**
	 * The singleton instance.
	 *
	 * @since 5.0.0
	 *
	 * @var \Supercacher The singleton instance.
	 */
	private static $instance;

	/**
	 * Create a {@link Supercacher} instance.
	 *
	 * @since 5.0.0
	 */
	public function __construct() {
		self::$instance = $this;

		// Run the supercachers if the autoflush is enabled.
		if ( 1 === (int) get_option( 'siteground_optimizer_autoflush_cache', 0 ) ) {
			$this->run();
		}
	}

	/**
	 * Run the hooks when we have to purge everything.
	 *
	 * @since  5.0.0
	 */
	public function run() {
		foreach ( $this->purge_hooks as $hook ) {
			add_action( $hook, array( $this, 'purge_everything' ) );
		}
		add_action( 'wp_ajax_widgets-order', array( $this, 'purge_everything' ), 1 );
		add_action( 'wp_ajax_save-widget', array( $this, 'purge_everything' ), 1 );
		add_action( 'woocommerce_create_refund', array( $this, 'purge_everything' ), 1 );
		add_action( 'wp_ajax_delete-selected', array( $this, 'purge_everything' ), 1 );
		add_action( 'wp_ajax_edit-theme-plugin-file', array( $this, 'purge_everything' ), 1 );
		add_action( 'update_option_siteground_optimizer_combine_css', array( $this, 'delete_assets' ), 10, 0 );
		add_action( 'pll_save_post', array( $this, 'flush_memcache' ) );

		// Delete assets (minified js and css files) every 30 days.
		add_action( 'siteground_delete_assets', array( $this, 'delete_assets' ) );
		add_action( 'siteground_delete_assets', array( $this, 'purge_cache' ), 11 );
		add_filter( 'cron_schedules', array( $this, 'add_siteground_cron_schedule' ) );

		// Schedule a cron job that will delete all assets (minified js and css files) every 30 days.
		if ( ! wp_next_scheduled( 'siteground_delete_assets' ) ) {
			wp_schedule_event( time(), 'siteground_every_two_days', 'siteground_delete_assets' );
		}

		$this->purge_on_other_events();
		$this->purge_on_options_save();

		$this->init_cachers();
	}

	/**
	 * Create a new supercacher of type $type
	 *
	 * @since 5.0.0
	 *
	 * @param string $type The type of the supercacher.
	 *
	 * @throws \Exception  Exception if the type is not supported.
	 */
	public static function factory( $type ) {
		$type = str_replace( ' ', '_', ucwords( str_replace( '_', ' ', $type ) ) );

		$class = __NAMESPACE__ . '\\Supercacher_' . $type;

		if ( ! class_exists( $class ) ) {
			throw new \Exception( 'Unknown supercacher type "' . $type . '".' );
		}

		$cacher = new $class();

		$cacher->run();
	}

	/**
	 * Get the singleton instance.
	 *
	 * @since 5.0.0
	 *
	 * @return \Supercacher The singleton instance.
	 */
	public static function get_instance() {
		return self::$instance;
	}

	/**
	 * Init supercacher children.
	 *
	 * @since  5.0.0
	 */
	public static function init_cachers() {
		foreach ( self::$children as $child ) {
			self::factory( $child );
		}
	}

	/**
	 * Purge the dynamic cache.
	 *
	 * @since  5.0.0
	 *
	 * @return bool True on success, false on failure.
	 */
	public static function purge_cache() {
		return Supercacher::get_instance()->purge_everything();
	}

	/**
	 * Purge everything from cache.
	 *
	 * @since  5.0.0
	 *
	 * @return bool True on success, false on failure.
	 */
	public function purge_everything() {
		return $this->purge_cache_request( get_home_url( null, '/' ) );
	}

	/**
	 * Purge index.php from cache.
	 *
	 * @since  5.0.0
	 *
	 * @return bool True on success, false on failure.
	 */
	public function purge_index_cache() {
		return $this->purge_cache_request( get_home_url( null, '/' ), false );
	}

	/**
	 * Purge rest api cache.
	 *
	 * @since  5.7.18
	 *
	 * @return bool True on success, false on failure.
	 */
	public function purge_rest_cache() {
		return $this->purge_cache_request( get_rest_url() );
	}

	/**
	 * Purge the post cache and all child paths.
	 *
	 * @since  5.0.0
	 *
	 * @param  int $post_id The post id.
	 *
	 * @return bool True on success, false on failure.
	 */
	public function purge_post_cache( $post_id ) {
		// Purge the rest api cache.
		$this->purge_rest_cache();

		// Purge the post cache.
		return $this->purge_cache_request( get_permalink( $post_id ) );
	}

	/**
	 * Perform a delete request.
	 *
	 * @since  5.0.0
	 *
	 * @param  string $url                 The url to purge.
	 * @param  bool   $include_child_paths Whether to purge child paths too.
	 *
	 * @return bool True if the cache is deleted, false otherwise.
	 */
	public static function purge_cache_request( $url, $include_child_paths = true ) {
		// Flush the Cloudflare cache if the optimization is enabled.
		if ( 1 === intval( get_option( 'siteground_optimizer_cloudflare_optimization', 0 ) ) ) {
			Cloudflare::get_instance()->purge_cache();
		}

		// Bail if the url is empty.
		if ( empty( $url ) ) {
			return;
		}

		$hostname   = str_replace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
		$parsed_url = parse_url( $url );
		$main_path  = parse_url( $url, PHP_URL_PATH );

		if ( empty( $main_path ) ) {
			$main_path = '/';
		}

		// Bail if the url has get params, but it matches the home url.
		// We don't want to purge the entire cache.
		if (
			isset( $parsed_url['query'] ) &&
			parse_url( home_url( '/' ), PHP_URL_PATH ) === $main_path
		) {
			return;
		}

		// Change the regex if we have to delete the child paths.
		if ( true === $include_child_paths ) {
			$main_path .= '(.*)';
		}

		// Flush the cache.
		exec(
			sprintf(
				"site-tools-client domain-all update id=%s flush_cache=1 path='%s'",
				$hostname,
				$main_path
			),
			$output,
			$status
		);

		do_action( 'siteground_optimizer_flush_cache', $url );

		if ( 0 === $status ) {
			return true;
		}

		return false;
	}

	/**
	 * Flush Memcache or Memcached.
	 *
	 * @since 5.0.0
	 */
	public static function flush_memcache() {
		return wp_cache_flush();
	}

	/**
	 * Purge the cache when the options are saved.
	 *
	 * @since  5.0.0
	 */
	private function purge_on_options_save() {

		if (
			isset( $_POST['action'] ) && // WPCS: CSRF ok.
			isset( $_POST['option_page'] ) && // WPCS: CSRF ok.
			'update' === $_POST['action'] // WPCS: CSRF ok.
		) {
			$this->purge_everything();
		}
	}

	/**
	 * Purge the cache for other events.
	 *
	 * @since  5.0.0
	 */
	private function purge_on_other_events() {
		if (
			isset( $_POST['save-header-options'] ) || // WPCS: CSRF ok.
			isset( $_POST['removeheader'] ) || // WPCS: CSRF ok.
			isset( $_POST['skip-cropping'] ) || // WPCS: CSRF ok.
			isset( $_POST['remove-background'] ) || // WPCS: CSRF ok.
			isset( $_POST['save-background-options'] ) || // WPCS: CSRF ok.
			( isset( $_POST['submit'] ) && 'Crop and Publish' == $_POST['submit'] ) || // WPCS: CSRF ok.
			( isset( $_POST['submit'] ) && 'Upload' == $_POST['submit'] ) // WPCS: CSRF ok.
		) {
			$this->purge_everything();
		}
	}

	/**
	 * Check if cache header is enabled for url.
	 *
	 * @since  5.0.0
	 *
	 * @param  string $url           The url to test.
	 * @param  bool   $maybe_dynamic Wheather to make additional request to check the cache again.
	 *
	 * @return bool                  True if the cache is enabled, false otherwise.
	 */
	public static function test_cache( $url, $maybe_dynamic = true, $is_cloudflare_check = false ) {
		// Bail if the url is empty.
		if ( empty( $url ) ) {
			return;
		}

		// Add slash at the end of the url.
		$url = trailingslashit( $url );

		// Check if the url is excluded for dynamic checks only.
		if ( false === $is_cloudflare_check ) {
			// Bail if the url is excluded.
			if ( SuperCacher_Helper::is_url_excluded( $url ) ) {
				return false;
			}
		}

		// Make the request.
		$response = wp_remote_get( $url );

		// Check for errors.
		if ( is_wp_error( $response ) ) {
			return false;
		}

		// Get response headers.
		$headers = wp_remote_retrieve_headers( $response );

		if ( empty( $headers ) ) {
			return false;
		}

		$cache_header = false === $is_cloudflare_check ? 'x-proxy-cache' : 'cf-cache-status';

		// Check if the url has a cache header.
		if (
			isset( $headers[ $cache_header ] ) &&
			'HIT' === strtoupper( $headers[ $cache_header ] )
		) {
			return true;
		}

		if ( $maybe_dynamic ) {
			return self::test_cache( $url, false );
		}

		// The header doesn't exists.
		return false;
	}

	/**
	 * Adds custom cron schdule.
	 *
	 * @since 5.1.0
	 *
	 * @param array $schedules An array of non-default cron schedules.
	 */
	public function add_siteground_cron_schedule( $schedules ) {

		if ( ! array_key_exists( 'siteground_every_two_days', $schedules ) ) {
			$schedules['siteground_every_two_days'] = array(
				'interval' => 172800,
				'display' => __( 'Every two days', 'sg-cachepress' ),
			);
		}

		return $schedules;
	}

	/**
	 * Delete plugin assets
	 *
	 * @since  5.1.0
	 *
	 * @param bool|string $dir Directory to clean up.
	 */
	public static function delete_assets( $dir = false ) {
		if ( false === $dir ) {
			$dir = Front_End_Optimization::get_instance()->assets_dir;
		}

		// Scan the assets dir.
		$all_files = scandir( $dir );

		// Get only files and directories.
		$files = array_diff( $all_files, array( '.', '..' ) );

		foreach ( $files as $filename ) {
			// Build the filepath.
			$maybe_file = trailingslashit( $dir ) . $filename;

			// Bail if the file is not a file.
			if ( ! is_file( $maybe_file ) ) {
				self::delete_assets( $maybe_file );
				continue;
			}

			// Delete the file.
			unlink( $maybe_file );
		}
	}
}
