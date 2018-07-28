<?php
/*
Plugin Name:  Another Social Signin Plug(in)
Plugin URI:   https://github.com/boonej/ass_plug
Description:  Yet another social sign-in provider for Wordpress.
Version:      0.0.1
Author:       Jonathan Boone <jeboone@gmail.com>
License:      GPL2
 */

if ( ! defined( 'WPINC' ) ) {
  die;
}

define( 'ASS_VERSION', '0.0.1' );


function insert_assplug() {

  require_once plugin_dir_path( __FILE__ ) . 'inc/'
    . 'class-assplug-inserter.php';
  ASSPlug_Inserter::insert();

}

function remove_assplug() {

  require_once plugin_dir_path( __FILE__ ) . 'inc/'
    . 'class-assplug-remover.php';
  ASSPlug_Remover::remove();

}

require plugin_dir_path( __FILE__ ) . 'inc/class-ass.php';

function tap_ass() {

  $ass = new ASS();
  $ass->tap();

}

register_activation_hook( __FILE__, 'insert_assplug' );
register_deactivation_hook( __FILE__, 'remove_assplug' );


tap_ass();

?>
