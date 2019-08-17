<?php
/**
 * Plugin Name: APPideas WordPress Plugin Foundation
 * Plugin URI: https://github.com/appideasDOTcom/wp-plugin-foundation
 * Description: WordPress plugin foundational code
 * Version: 1.0
 * Author: Chris Ostmo
 * Author URI: https://appideas.com
 */

// Prevent attempts to load the plugin before Wordpress is loaded.
if( defined( 'ABSPATH' ) )
{
    require_once( dirname( __FILE__ ) . "/classes/FoundationHelper.php" );
    require_once( dirname( __FILE__ ) . "/classes/Foundation.php" );
    require_once( dirname( __FILE__ ) . "/classes/FoundationViews.php" );
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    define( 'FOUNDATION_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    define( 'FOUNDATION_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
    define( 'FOUNDATION_PLUGIN_FILE', "foundation.php" );

    // Load the plugin
    register_activation_hook( __FILE__, array( 'FoundationHelper', 'wpActivate' ) );
    add_action( 'init', array( 'FoundationHelper', 'wpInit' ) );
    FoundationHelper::wpBootstrap();
}