<?php
/**
 * @package Example-Plugin
 * @version 0.1
 */
/*
Plugin Name: Example-Plugin
Plugin URI: http://wordpress.org/plugins/example/
Description: Example wordpress plugin boilerplate using react.
Authors: Joe Schmo
Version: 1.6
Author URI: https://sisumedia.com/
*/

/**
 * @package WPEXP
 *
 * Main application class for the plugin. Responsible for bootstrapping
 * any hooks and instantiating all service classes.
 */
class Example {

  /**
   * Object instance.
   *
   * @var self
   */
  public static $instance;

  /**
   * Language text domain.
   *
   * @var string
   */
  public static $text_domain = 'example';

  /**
   * Current version.
   *
   * @var string
   */
  public $version = '0.1';
    const PLG_CLS_PRFX = 'WPEXP_';

  /**
   * Admin object.
   * @var WPEXP_Admin
   *
   * Logger object.
   * @var Logger
   *
   * current wp action.
   * @var action
   */
  public $admin;
  // public $logger;
  public $action = 'nope';

  /**
   * Standard singleton pattern.
   * WARNING! To ensure the system always works as expected, AVOID using this method.
   * Instead, make use of the plugin instance provided by 'wsal_init' action.
   * @return WP_Example Returns the current plugin instance.
   */
  public static function GetInstance()
  {
    static $instance = null;
    if (!$instance) {
      $instance = new self();
    }
    return $instance;
  }

  /**
   * Called at load time, hooks into WP core
   */
  public function __construct() {
    // Define important plugin constants.
    $this->define_constants();

    require_once(__DIR__ . '/setup-hooks.php');
    require_once( 'classes/Autoloader.php' );
    // require_once( 'logger.php' );
    $this->autoloader = new WPEXP_Autoloader( $this );
    $this->autoloader->Register( self::PLG_CLS_PRFX, $this->GetBaseDir() . 'classes' . DIRECTORY_SEPARATOR );

    $this->admin = new WPEXP_Admin( $this );

    add_action( 'init', array( $this, 'Init' ) );
  }

  /**
   * Boot/Loader method
   */
  public function boot() {
      // Load up stuff here if needed
  }

  /**
   * @internal Start to trigger the events after installation.
   */
  public function Init() {
    // Start listening to events
  }

  /**
   * Returns the class name of a particular file that contains the class.
   * @param string $file File name.
   * @return string Class name.
   */
  public function GetClassFileClassName($file)
  {
    return $this->autoloader->GetClassFileClassName($file);
  }

  public function GetBaseUrl()
  {
    return plugins_url('', __FILE__);
  }

  /**
   * @return string Full path to plugin directory WITH final slash.
   */
  public function GetBaseDir()
  {
    return plugin_dir_path(__FILE__);
  }

  /**
   * @return string Plugin directory name.
   */
  public function GetBaseName()
  {
    return plugin_basename(__FILE__);
  }

  public function define_constants() {

    // Plugin version.
    if ( ! defined( 'WPEXP_VERSION' ) ) {
      define( 'WPEXP_VERSION', $this->version );
    }
    // Plugin Name.
    if ( ! defined( 'WPEXP_BASE_NAME' ) ) {
      define( 'WPEXP_BASE_NAME', plugin_basename( __FILE__ ) );
    }
    // Plugin Directory URL.
    if ( ! defined( 'WPEXP_BASE_URL' ) ) {
      define( 'WPEXP_BASE_URL', plugin_dir_url( __FILE__ ) );
    }
    // Plugin Directory Path.
    if ( ! defined( 'WPEXP_BASE_DIR' ) ) {
      define( 'WPEXP_BASE_DIR', plugin_dir_path( __FILE__ ) );
    }
    // TODO: this needs to be abstracted, path to specific
    // Plugin Logging Path.
    // if ( ! defined( 'WPEXP_LOGGER' ) ) {
      // define( 'WPEXP_BASE_DIR', "/wp-content/plugins/wp-example-plugin/example_log.txt" );
    // }
  }

}

add_action('plugins_loaded', array(Example::GetInstance(), 'boot'));

return Example::GetInstance();
