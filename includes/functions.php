<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get elementor instance
 *
 * @return \Elementor\Plugin
 */
function addonse_elementor() {
    return \Elementor\Plugin::instance();
}