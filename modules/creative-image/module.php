<?php
namespace Addonse\Modules\CreativeImage;
use Addonse\Base\Addonse_Module_Base;
use Addonse;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Addonse_Module_Base{

	public function get_widgets() {
		return [
			'Creative_Image',
		];
	}

	public function get_name() {
		return 'creative-image';
    }
    
}