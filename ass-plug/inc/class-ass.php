<?php
/**
 * @since:      0.0.1
 *
 */

class ASS {

  protected $loader;
  protected $plugin_name;
  protected $version;

  public function __construct() {
    
    if ( defined( 'ASS_VERSION' ) ) {
      
      $this->version = ASS_VERSION;

    } else {

      $this->version = '1.0.0';

    }

    $this->plugin_name = 'ass-plug';
    $this->load_dependencies();

  }

  private function load_dependencies() {
  
    require_once plugin_dir_path( dirname( __FILE__ ) ) 
      . 'inc/ass-loader.php';
    require_once plugin_dir_path( dirname( __FILE__ ) )
      . 'admin/class-ass-plug-admin.php';
    require_once plugin_dir_path( dirname( __FILE__ ) )
      . 'public/class-ass-plug-public.php';

    $this->loader = new ASS_Loader();

  }

  public function tap() {

    $this->loader->run();

  }

  private function define_admin_hooks() {

    $ass_admin = new ASSPlug_Admin( 
      $this->get_plugin_name(), 
      $this->get_version() 
    );

    $this->loader->add_action( 
      'admin_enqueue_scripts', 
      $ass_admin, 
      'enqueue_styles' 
    );
    $this->loader->add_action(
      'admin_enqueue_scripts',
      $ass_admin,
      'enqueue_scripts'
    );

  }

  private function define_public_hooks() {

    $ass_public = new ASSPlug_Public( 
      $this->get_plugin_name(),
      $this->get_version()
    );

    $this->loader->add_action(
      'wp_enqueue_scripts',
      $ass_public,
      'enqueue_styles'
    );
    $this->loader->add_action(
      'wp_enqueue_scripts',
      $ass_public,
      'enqueue_scripts'
    );

  }

  public function get_plugin_name() {

    return $this->plugin_name;

  }

  public function get_version() {

    return $this->version;

  }

}


?>
