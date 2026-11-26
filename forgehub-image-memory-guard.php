<?php
/**
 * Plugin Name:       ForgeHub Image Memory Guard
 * Plugin URI:        https://wpforgehub.com/product/image-memory-guard/
 * Description:       Proactive memory protection for WordPress media library. Pre-calculates image memory budgets, prevents PHP fatal memory exhaustion, and enables safe auto-scaling.
 * Version:           1.1.8
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            WPForgeHub
 * Author URI:        https://wpforgehub.com
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       forgehub-image-memory-guard
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WPFH_IMG_VERSION', '1.1.8' );
define( 'WPFH_IMG_FILE', __FILE__ );
define( 'WPFH_IMG_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPFH_IMG_URL', plugin_dir_url( __FILE__ ) );

/**
 * Main Plugin Class
 */
final class WPFH_Image_Memory_Guard {

	private static $instance = null;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ), 20 );
	}

	public function init() {
		// Note: load_plugin_textdomain is intentionally omitted as WordPress.org automatically loads translations since WP 4.6.

		require_once WPFH_IMG_PATH . 'includes/class-wpfh-img-guard.php';
		require_once WPFH_IMG_PATH . 'includes/class-wpfh-img-admin.php';

		WPFH_IMG_Guard::get_instance();
		WPFH_IMG_Admin::get_instance();

	}
}

WPFH_Image_Memory_Guard::get_instance();
