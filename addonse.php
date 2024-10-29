<?php
/**
 * Plugin Name: Addonse
 * Description: Creative image widget for Elementor, your favourite WordPress page builder.
 * Plugin URI: https://www.addonse.com
 * Author: Addonse.com
 * Version: 1.0
 * Author URI: https://www.addonse.com
 *
 * Text Domain: addonse
 */

defined( 'ABSPATH' ) || die();

define( 'ADDONSE_VERSION', '1.0' );
define( 'ADDONSE__FILE__', __FILE__ );
define( 'ADDONSE_DIR_PATH', plugin_dir_path( ADDONSE__FILE__ ) );
define( 'ADDONSE_DIR_URL', plugin_dir_url( ADDONSE__FILE__ ) );
define( 'ADDONSE_MODULES_PATH', ADDONSE_DIR_PATH . 'modules' );
define( 'ADDONSE_INC_PATH', ADDONSE_DIR_PATH . 'includes' );
define( 'ADDONSE_ASSETS', trailingslashit( ADDONSE_DIR_URL . 'assets' ) );
if (!defined('ADDONSE_SLUG')) { define( 'ADDONSE_SLUG', 'addonse' ); }
if (!defined('ADDONSE_TITLE')) { define( 'ADDONSE_TITLE', 'Addonse widgets for elementor' ); }

require(dirname(__FILE__).'/includes/functions.php');

function addonse_load_plugin() {
    load_plugin_textdomain( 'addonse', false, basename( dirname( __FILE__ ) ) . '/languages' );

	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'addonse_fail_load' );
		return;
	}
    require( ADDONSE_DIR_PATH . 'loader.php' );
    require( ADDONSE_DIR_PATH . '/includes/admin-notice.php' );
}
add_action( 'plugins_loaded', 'addonse_load_plugin', 9 );

function addonse_fail_load() {
	$screen = get_current_screen();
	if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
		return;
	}

	$plugin = 'elementor/elementor.php';

	if ( _is_elementor_installed() ) {
		if ( ! current_user_can( 'activate_plugins' ) ) { return; }
		$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
		$admin_message = '<p>' . esc_html__( 'Ops! Addonse not working because you need to activate the Elementor plugin first.', 'addonse' ) . '</p>';
		$admin_message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Activate Elementor Now', 'addonse' ) ) . '</p>';
	} else {
		if ( ! current_user_can( 'install_plugins' ) ) { return; }
		$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
		$admin_message = '<p>' . esc_html__( 'Ops! Addonse not working because you need to install the Elementor plugin', 'addonse' ) . '</p>';
		$admin_message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install Elementor Now', 'addonse' ) ) . '</p>';
	}

	echo '<div class="error">' . $admin_message . '</div>';
}

if ( ! function_exists( '_is_elementor_installed' ) ) {

    function _is_elementor_installed() {
        $file_path = 'elementor/elementor.php';
        $installed_plugins = get_plugins();

        return isset( $installed_plugins[ $file_path ] );
    }
}