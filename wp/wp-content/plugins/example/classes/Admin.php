<?php
/**
 * Admin object manages settings and administration
 * @package Example
 */

/**
 * Class WPEXP_Admin
 */
class WPEXP_Admin {

  /**
   * Application container.
   *
   * @var Example
   */
  public $app;

  /**
   * Instantiates a new Admin object
   *
   * @param WP_Example $app Application container.
   */
  public function __construct( Example $app ) {
    $this->app = $app;
    $this->setup_admin_actions();
    $this->consumer_actions();
  }

  // TODO: allow actions to be hooked
  public function setup_admin_actions(){
    add_action('admin_menu', array($this, 'create_example_options_page'));
    add_action('admin_init', array($this, 'create_example_options'));
  }

  public function consumer_actions(){
      // add option
      add_action('wp_ajax_nopriv_post_new_option', array($this, 'post_new_option'));
      add_action('wp_ajax_post_new_option', array($this, 'post_new_option'));

      // remove option
      add_action('wp_ajax_nopriv_delete_option', array($this, 'delete_option'));
      add_action('wp_ajax_delete_option', array($this, 'delete_option'));

      // get all options
      add_action('wp_ajax_nopriv_get_example_options', array($this, 'get_example_options'));
      add_action('wp_ajax_get_example_options', array($this, 'get_example_options'));

  }

  public function set_defaults_option() {
    if(!is_array(get_option('example'))) {
      $options = array(
        'example' => array(
          'name' => 'example-option',
          'uri' => 'http://example.com/add/your/endpoint/here',
          'properties' => array(
            'name' => 'foobar',
            'value' => 'fooit'
          )
        )
      );
      update_option('example', $options, true);
    }
  }

  public function get_example_options(){
    $options = get_option('example');

    $json = json_encode(
      array(
        'options' => $options
      )
    );

    echo $json;
    die();
  }

  public function post_new_option(){
    $name = $_POST['name'];
    $uri = $_POST['uri'];
    $properties = $_POST['properties'];

    if( $name == '' || $uri == '' ) {
      die(
        json_encode(
          array(
            'success' => false,
            'message' => 'Missing required information.',
            'info' => $_POST
          )
        )
      );
    }

    $options = get_option('example');
    $options[$name] = array(
      'name' => $name,
      'uri' => $uri,
      'properties' => $properties
    );
    update_option('example', $options, true);

    $updated_options = get_option('example');
    $json = json_encode(
      array(
        'options' => $updated_options
      )
    );

    echo $json;
    die();
  }

  public function delete_option(){
    $name = $_POST['name'];

    if( $name == '') {
      die(
        json_encode(
          array(
            'success' => false,
            'message' => 'Missing required information.'
          )
        )
      );
    }

    $options = get_option('example');
    unset($options[$name]);

    update_option('example', $options, true);
    $updated_options = get_option('example');

    $json = json_encode(
      array(
        'apis' => $updated_options
      )
    );

    echo $json;
    die();
  }

  public function create_example_options_page(){
      // Add the menu item and page
      $page_title = 'Example Settings Page';
      $menu_title = 'Example';
      $capability = 'manage_options';
      $slug = 'example';
      $callback = array( $this, 'example_settings_page_content' );
      $icon = 'dashicons-admin-plugins';
      $position = 100;

      // add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
      // add_submenu_page('options-general.php', $page_title, $menu_title, $capability, $slug, $callback);

      add_options_page($page_title, $menu_title, $capability, $slug, $callback);
  }

  public function example_settings_page_content(){

    settings_fields( 'example' );
    do_settings_sections( 'example' );
    ?>
     <div class="wrap">
        <h2>Example</h2>
        <form method="post" action="options.php">
          <div id="example-root"></div>
        </form>
        </div>
    <?php
  }

  // this should trigger on add
  public function create_example_options(){
      register_setting(
          'example',
          'example'
      );
      $this->set_defaults_option();
  }

}
