# WordPress plugin foundational code

When I am writing a new WordPress plugin, I find myself spending several hours repeating the same basic structure to begin each project. Instead of continuing that tradition, I decided to commit a generic skeleton of the code and structure.

This will give you a very basic WordPress plugin that provides a custom post type and an admin form with a couple of inputs. It also performs basic loading of Javascript and CSS and other normal WordPress plugin bootstrap functions.

# Usage

1. Copy the source `foundation` folder into your `wp-content/plugins` directory
1. Rename the `foundation` folder to a name of your choice, appropriate to your plugin.
1. Open `foundation.php` and change the plugin information that appears in the comment at the top to something appropriate for your new plugin (don't change the uncommented code yet - that will come in a bit)
1. Rename the 6 source code files in a manner appropriate to your plugin. For example, if your plugin is called `Apple`:
   1. `foundation.php` becomes `apple.php`
   1. `classes/Foundation.php` becomes `classes/Apple.php`
   1. `classes/FoundationHelper.php` becomes `classes/AppleHelper.php`
   1. `classes/FoundationViews.php` becomes `classes/AppleViews.php`
   1. `css/foundation-admin.css` becomes `css/apple-admin.css`
   1. `js/foundation.js` becomes `js/apple.js`
1. Do a few case sensitive search and replaces against the source code files. Again, using `Apple` as an example:
   1. Replace `Foundation` with `Apple`
   1. Replace `foundation` with `apple`
   1. Replace `FOUNDATION` with `APPLE`
1. (optional) Open `classes/Foundation.php` (or whatever you renamed that file) and modify `registerPostTypes()` so that the labels and description make sense for your new plugin.

That's it.

# License

This may not be useful to anyone but me. Regardless, it is available under the GNU LGPL v3, a copy of which is contained in the LICENSE file.
