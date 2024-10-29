<?php
namespace Addonse;
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! function_exists('is_plugin_active')) { include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); }

final class Manager {

	public function __construct() {
		
		$modules = array_diff(scandir(ADDONSE_DIR_PATH.'modules'), array('..', '.'));
        
		// Fetch all modules data
		foreach ( $modules as $module ) {
			$module_file = ADDONSE_DIR_PATH . 'modules/' . $module . '/module.php';
			if ( is_readable( $module_file ) ) {
				$class_name = str_replace( '-', ' ', $module );
				$class_name = implode(' ', array_map('ucfirst', explode(' ',$class_name)));
				$class_name = str_replace( ' ', '', ucwords( $class_name ) );
				$class_name = __NAMESPACE__ . '\\Modules\\' . $class_name . '\Module';
				$class_name::instance();
			}
		}
	}

}