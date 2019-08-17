<?php
/**
 * Provides views for the plugin
*/

class FoundationViews
{
    /**
     * Post object for the current view
     *
     * @var WP_Post
     * @author Chris Ostmo
     */
    protected $mPost;

    /**
     * Class constructor. Setup members.
     * 
     * @author costmo
     */
    public function __construct( $post = null )
    {
        global $post;
        $this->mPost = $post;
    }

    /**
     * Admin input interface
     *
     * @return string
     * @author Chris Ostmo
     */
    public function adminInputView()
    {
        $meta = get_post_meta( $this->mPost->ID, "foundation_input", TRUE );
        $meta = (!$meta) ? array() : $meta;

        // Construct strings that require logic before echoing
        $name = (isset( $meta['foundationName'] )) ? $meta['foundationName'] : "";
        $description = (isset( $meta['foundationDescription'] )) ? $meta['foundationDescription'] : "";

        // We've got everything we need nice and packaged, so echo
        echo <<< EOT
        <div id="feature-admin-container">
            <div class="label">
                <label for="foundation_name">Foundation name</label>
            </div>
            <div class="input">
                <input type="text" id="foundation_name" name="foundation_name" value="{$name}">
            </div>

            <div class="label extra-top-margin">
                <label for="foundation_description">Foundation description</label>
            </div>
            <div class="input">
                <textarea name="foundation_description" id="foundation_description">{$description}</textarea>
            </div>
        </div>
EOT;
    }
}