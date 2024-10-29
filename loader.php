<?php
namespace Addonse;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

class Addonse_Loader
{
  private static $_instance = null;
  private $_modules_manager;
  private $classes_aliases = [
    'ElementPack\Modules\PanelPostsControl\Module' => 'Addonse\Modules\QueryControl\Module',
    'ElementPack\Modules\PanelPostsControl\Controls\Group_Control_Posts' => 'Addonse\Modules\QueryControl\Controls\Group_Control_Posts',
    'ElementPack\Modules\PanelPostsControl\Controls\Query' => 'Addonse\Modules\QueryControl\Controls\Query',
  ]; 
  public function get_theme() {
    return wp_get_theme();
  } 
  public function __clone() {
    _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheating huh?', 'addonse' ), '1.0' );
  } 
  public function __wakeup() {
    _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheating huh?', 'addonse' ), '1.0' );
  }
  public static function elementor() {
    return \Elementor\Plugin::$instance;
  } 
  public static function instance() {
      if ( is_null( self::$_instance ) ) {
          self::$_instance = new self();
      }
      return self::$_instance;
  }
  private function includes(){
      include_once( ADDONSE_DIR_PATH . 'includes/modules-manager.php' );
  }
  private function __construct() {
      spl_autoload_register([ $this, 'autoload' ]);
      $this->includes();
      $this->setup_hooks(); 
  }

  public function autoload( $class ) {
    if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
      return;
    }

    $has_class_alias = isset( $this->classes_aliases[ $class ] );
    if ( $has_class_alias ) {
      $class_alias_name = $this->classes_aliases[ $class ];
      $class_to_load = $class_alias_name;
    } else {
      $class_to_load = $class;
    }

    if ( ! class_exists( $class_to_load ) ) {
      $filename = strtolower(
        preg_replace(
          [ '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
          [ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
          $class_to_load
        )
      );
      $filename = ADDONSE_DIR_PATH . $filename . '.php';

      if ( is_readable( $filename ) ) {
        include( $filename );
      }
    }

    if ( $has_class_alias ) {
      class_alias( $class_alias_name, $class );
    }
  }
    
  private function setup_hooks() {
    add_action( 'elementor/init', [ $this, 'addonse_init' ] ); 
    add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'enqueue_editor_styles' ] ); 
  }

	public function enqueue_editor_styles() {
		$direction_suffix = is_rtl() ? '.rtl' : '';
    wp_enqueue_style('addonse-icon-font', ADDONSE_DIR_URL . 'assets/fonts/addonse-icon-style' . $direction_suffix . '.css', '', ADDONSE_VERSION );
  } 
  
  public function addonse_init(){
      $this->_modules_manager = new Manager();
      $elementsManager = addonse_elementor()->elements_manager;
      $elementsManager->add_category(
          ADDONSE_SLUG,
          array(
            'title' => ADDONSE_TITLE,
            'icon'  => 'fa fa-smile-o',
          )
        );
      do_action( 'addonse/init' );
  }
}
if ( ! defined( 'ADDONSE_TESTS' ) ) {
	Addonse_Loader::instance();
}
function addonse_config() {
	return Addonse_Loader::instance();
}