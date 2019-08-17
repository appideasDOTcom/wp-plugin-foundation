<?php
/**
 * Functionality of the plugin
 * 
 * @author costmo
 */
class Foundation
{
	/**
     * Define some constants that get reused commonly in WP calls
     */

    /**
     * The screen slug. In WP calls, this is the "screen"
     *
     * @var string
     */
    const SCREEN_SLUG = "foundation";

    /**
     * The screen context
     *
     * @var string
     */
    const SCREEN_CONTEXT = "normal";

    /**
     * The screen priority
     *
     * @var string
     */
    const SCREEN_PRIORITY = "high";

    /**
     * The domain for localization
     * 
     * @var string
     */
	const LOCALE_DOMAIN = "appideas";
	

    /**
     * Register our custom post type(s) and/or toxonomy(ies) with WP
     *
     * @return void
     * @author costmo
     */
    public static function registerPostTypes()
    {
        register_post_type( "Foundation",
        array(

            "label" => "Foundation",
            "description" => "Foundation description",
            "public" => false,
            "has_archive" => false,
            "publicaly_queryable" => false,
            "query_var" => true,
      
            "labels" => array(
              "name"             =>  _x("Foundation", "Post Type General Name"),
              "singular_name"    =>  _x("Foundation",  "Post Type Singular Name"),
              "menu_name"        =>  __("Foundation"),
              "add_new_item"     =>  __("New Foundation"),
              "add_new"          =>  __("New Foundation"),
              "all_items"        =>  __("All Foundations"),
              "view_item"        =>  __("View Foundation"),
              "edit_item"        =>  __("Edit Foundation"),
              "update_item"      =>  __("Update Foundation"),
              "not_found"        =>  __("No Foundation")
            ),
      
            "hierarchical"       =>  false,
            "show_ui"            =>  true,
            "show_in_nav_menus"  =>  false,
            "rewrite"            =>  true,
            "show_in_rest"       =>  false,
            "menu_icon"          =>  "dashicons-nametag",
      
            "supports" => array(
              "title",
              "thumbnail"
            )
      
          )
        );
        add_action( "add_meta_boxes", array( 'Foundation', 'addMetaBoxes' ) );
    }

    /**
     * Define the add/modify screen's meta box input sections
     *
     * @return void
     */
    public static function addMetaBoxes()
    {
        global $post;
        $view = new FoundationViews( $post );

        add_meta_box(
          "foundation_admin_input",
          __( "Foundation Info", self::LOCALE_DOMAIN ),
          array( $view, "adminInputView" ),
          self::SCREEN_SLUG,
          self::SCREEN_CONTEXT,
          self::SCREEN_PRIORITY
      );
    }

    /**
    * Save this plugin's custom fields
    *
    * @return void
    * @author costmo
    */
    public static function saveCustomFields()
    {
        // We don't want to autosave
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        {
            return;
        }

        global $post;

        // Short circuit the method if this isn't a post type that this class controls
        if( !isset( $post ) || !isset( $post->post_type ) || $post->post_type != "foundation" )
        {
            return;
		}

        $saveName = (isset( $_POST['foundation_name'] )) ? $_POST['foundation_name'] : "";
		$saveDescription = (isset( $_POST['foundation_description'] )) ? $_POST['foundation_description'] : "";

        $saveData = array( 
          "foundationName" => $saveName,
		  "foundationDescription" => $saveDescription,
        );

        update_post_meta( $post->ID, 'foundation_input', $saveData );
	}

	
}