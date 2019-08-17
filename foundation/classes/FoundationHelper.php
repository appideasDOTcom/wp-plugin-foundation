<?php
/**
 * Core wordpress functionality helper functions.
 * 
 * @author costmo
 */
class FoundationHelper
{
	/**
	 * Install the needed schema and data on plugin activation
	 *
	 * @return void
	 */
    public static function wpActivate()
	{

    } // wpActivate
    
    /**
     * Actions to perform when the init hook fires
     *
     * @return void
     */
    public static function wpInit()
    {
		Foundation::registerPostTypes();
	}

	/**
	 * Actions to perform on plugin initialization (every page load in Wordpress)
	 *
	 * @return void
	 */
	public static function wpBootstrap()
	{
		// Save custom fields for the plugin's post type
		add_action( 'save_post', array( 'Foundation', 'saveCustomFields' ) );

		// Define AJAX actions

		// Create the custom columns needed in the admin list menu
		add_filter( 'manage_foundation_posts_columns', array( 'FoundationHelper', 'adminColumns' ) );
		add_action( 'manage_foundation_posts_custom_column', array( 'FoundationHelper', 'adminColumn'), 10, 2 );
		
		// Enqueue scripts for admin. This plugin doesn't do anything for the user on the front-end
		// Load CSS
		add_action( 'admin_enqueue_scripts', array( 'FoundationHelper', 'wpLoadCss' ) );

		// // Load javascript
		add_action( 'admin_enqueue_scripts', array( 'FoundationHelper', 'wpLoadJavascript' ) );
	}

	/**
	 * Load plugin CSS file(s)
	 *
	 * @return void
	 */
	public static function wpLoadCss()
	{
        $cssPluginUrl = FOUNDATION_PLUGIN_URL . "css/foundation-admin.css";
        $pluginData = get_plugin_data( FOUNDATION_PLUGIN_DIR . "foundation.php" );
        
        wp_register_style( 'foundation_css-admin', $cssPluginUrl, false, $pluginData['Version'], 'all' );
        wp_enqueue_style( 'foundation_css-admin' );
	}

	/**
	 * Load plugin javascript file(s)
	 *
	 * @return void
	 */
	public static function wpLoadJavascript()
	{
		$jsUrl = FOUNDATION_PLUGIN_URL . "js/foundation.js";
        $pluginData = get_plugin_data( FOUNDATION_PLUGIN_DIR . "foundation.php" );

		wp_register_script( 'foundation_js', $jsUrl, array( 'jquery' ), $pluginData['Version'], 'all' );
		wp_enqueue_script( 'foundation_js' );

		// Reveal some variables that PHP knows to javascript
		$jsData = array(
			'url' => FOUNDATION_PLUGIN_URL,
			'path' => FOUNDATION_PLUGIN_DIR,
			'slug' => "foundation"
		);
		wp_localize_script( 'foundations_js', 'foundation', $jsData );
	}

	/**
	 * Create the Wordpress admin menu items
	 *
	 * @return void
	 */
	public static function adminMenu()
	{
        // For now, we're hijacking the menu of the custom post type
	}

	/**
	 * Configure the columns to display in the admin list
	 *
	 * @return array
	 */
	public static function adminColumns( $columns )
	{
		$output = array();
		foreach( $columns as $key => $value )
		{
			// Move the date column to the end after adding our custom columns
			if( "date" != $key )
			{
				$output[$key] = $value;
			}
		}
		$output['foundation-name'] = __( 'Name' );
		$output['foundation-description'] = __( 'Description' );
		$output['date'] = __( $columns['date'] );		

		return $output;
	}

	/**
	 * Configure a specific columns to display in theadmin list
	 *
	 * @return void
	 */
	public static function adminColumn( $column, $postId )
	{
		$meta = get_post_meta( $postId, 'foundation_input', true );

		switch( $column )
		{
			case 'foundation-name':
				echo ucwords( $meta['foundationName'] );
				break;
			case 'foundation-description':
				echo  $meta['foundationDescription'];
				break;
		}

		// return $columns;
	}

	
}
