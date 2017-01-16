<?php
/**
Plugin Name: 2J SlideShow
Plugin URI: http://2joomla.net/wordpress
Description: Slider of the images work as fully responsive slideshow, advanced mobile devices support. Slideshow with highly customizable interface 
Version:           1.3.2
Author:            2J Team (c)
Author URI:        http://2joomla.net/wordpress
License: GPLv3 or later
Text Domain:       twoj_slideshow
Domain Path:       /languages
 */

if(!defined('WPINC'))die;
if(!defined("ABSPATH"))exit;

define( 'TWOJ_SLIDESHOW', 1); 
define( 'TWOJ_SLIDESHOW_VERSION', '1.3.2'); 

define( 'TWOJ_SLIDESHOW_PATH', plugin_dir_path( __FILE__ ));


add_action( 'plugins_loaded', 'twoj_slideshow_load_textdomain' );
function twoj_slideshow_load_textdomain() {
  load_plugin_textdomain( 'twoj_slideshow', false, dirname(plugin_basename( __FILE__ )) . '/languages' ); 
}

if( file_exists( WP_PLUGIN_DIR.'/2jslideshowkey/2jslideshowkey.php') ){
	define( 'TWOJ_SLIDESHOW_PRO', 1);
	define( 'TWOJ_SLIDESHOW_KEY_PATH', WP_PLUGIN_DIR.'/2jslideshowkey' );
	require_once TWOJ_SLIDESHOW_KEY_PATH.'/2jslideshowkey.php';
} elseif( file_exists( WP_PLUGIN_DIR.'/2jslideshow/2jslideshowkey.php') ){
	define( 'TWOJ_SLIDESHOW_PRO', 1);
	define( 'TWOJ_SLIDESHOW_KEY_PATH', WP_PLUGIN_DIR.'/2jslideshow' );
	require_once TWOJ_SLIDESHOW_KEY_PATH.'/2jslideshowkey.php';
} else {
	define('TWOJ_SLIDESHOW_PRO', 0);
}


define('TWOJ_SLIDESHOW_MESSAGE', 0);

define('TWOJ_SLIDESHOW_INCLUDES_PATH', 	TWOJ_SLIDESHOW_PATH.'inc/');
define('TWOJ_SLIDESHOW_OPTIONS_PATH', 	TWOJ_SLIDESHOW_INCLUDES_PATH.'options/');
define('TWOJ_SLIDESHOW_FRONTEND_PATH', 	TWOJ_SLIDESHOW_INCLUDES_PATH.'frontend/');
define('TWOJ_SLIDESHOW_ADDONS_PATH', 	TWOJ_SLIDESHOW_INCLUDES_PATH.'addons/');

define('TWOJ_SLIDESHOW_CMB_PATH', TWOJ_SLIDESHOW_PATH.'cmb2/');
define('TWOJ_SLIDESHOW_CMB_FILEDS_PATH', TWOJ_SLIDESHOW_CMB_PATH.'fields/');

define('TWOJ_SLIDESHOW_URL', plugin_dir_url( __FILE__ ));

function activateTwojSlideshow() {
	require_once TWOJ_SLIDESHOW_INCLUDES_PATH.'setup.php';
	TwojSlideshowActivator::activate();
}
register_activation_hook( __FILE__, 'activateTwojSlideshow' );

function deactivateTwojSlideshow() {
	require_once TWOJ_SLIDESHOW_INCLUDES_PATH.'setup.php';
	TwojSlideshowActivator::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivateTwojSlideshow' );

if( file_exists(TWOJ_SLIDESHOW_INCLUDES_PATH.'init.php') )  require_once TWOJ_SLIDESHOW_INCLUDES_PATH.'init.php';