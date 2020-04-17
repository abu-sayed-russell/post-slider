<?php
/**
 * @package  PostSlider
 */
/*
Plugin Name: Post Slider
Plugin URI: https://getwebinc.com
Description: Awesome Post Slider Plugin.
Version: 1.0.0
Author: M A  Monim
Author URI: https://facebook.comwith.rain79
License: GPLv2
Text Domain: post-slider
*/

// If this file is called firectly, abort!!!
if ( ! defined( 'ABSPATH' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}
/**
* Constant
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 06.04.2020
*/
if (!defined("MMWPS_VERSION"))
    define("MMWPS_VERSION", '1.0.0');

if (!defined("MMWPS_WPMIN_VERSION"))
    define("MMWPS_WPMIN_VERSION", '4.9');

if (!defined("MMWPS_PHP_VERSION"))
    define("MMWPS_PHP_VERSION", '5.6.0');

if (!defined("MMWPS_PREFIX"))
    define("MMWPS_PREFIX", 'mmwps_');

if (!defined("MMWPS_POST_SLIDER_PLUGIN"))
    define("MMWPS_POST_SLIDER_PLUGIN", __FILE__);

if (!defined("MMWPS_POST_SLIDER_PLUGIN_BASE"))
    define("MMWPS_POST_SLIDER_PLUGIN_BASE", plugin_basename(MMWPS_POST_SLIDER_PLUGIN));

if (!defined("MMWPS_POST_SLIDER_PLUGIN_DIR_PATH"))
    define("MMWPS_POST_SLIDER_PLUGIN_DIR_PATH", plugin_dir_path(MMWPS_POST_SLIDER_PLUGIN));

if (!defined("MMWPS_POST_SLIDER_PLUGIN_DIR_URL"))
    define("MMWPS_POST_SLIDER_PLUGIN_DIR_URL", plugin_dir_url( MMWPS_POST_SLIDER_PLUGIN ));

/**
* Require once the Composer Autoload
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 06.04.2020
*/
if ( version_compare( PHP_VERSION, MMWPS_PHP_VERSION, '>=' ) ) {
    require_once ( MMWPS_POST_SLIDER_PLUGIN_DIR_PATH . '/vendor/autoload.php' );
}else{
    add_action( 'admin_notices',  'mmwps_version_error_warning');
}

function mmwps_version_error_warning( ) {
        $php_version = phpversion();
         ?>
        <div class="notice notice-warning mmwps-warning">
         <p><?php echo sprintf( __("Your current PHP version is <strong> $php_version </strong>. You need to upgrade your PHP version to <strong>".MMWPS_PHP_VERSION." or later</strong> to run project manager.", "post-slider" ) ); ?></p>
        </div>
    <?php
}

/**
 * The code that runs during plugin activation
 */
if ( version_compare( PHP_VERSION, MMWPS_PHP_VERSION, '>=' ) ) {
    function MMWPS_Activate_post_slider_plugin() {
        MMWPS\Common\MMWPS_ActivatePostSlider::ActivatePostSliderFlush();
    }
    register_activation_hook( __FILE__, 'MMWPS_Activate_post_slider_plugin' );
}

/**
 * The code that runs during plugin deactivation
 */
if ( version_compare( PHP_VERSION, MMWPS_PHP_VERSION, '>=' ) ) {
    function MMWPS_deactivate_post_slider_plugin() {
        MMWPS\Common\MMWPS_DeactivatePostSlider::MMWPS_DeactivatePostSliderFlash();
    }
    register_deactivation_hook( __FILE__, 'MMWPS_deactivate_post_slider_plugin' );
}

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'MMWPS\\MMWPS' ) ) {
    MMWPS\MMWPS::mmwps_registerServices();
}