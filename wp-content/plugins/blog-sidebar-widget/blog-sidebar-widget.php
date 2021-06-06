<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              
 * @since             1.0.0
 * @package           Blog_Sidebar_Widget
 *
 * @wordpress-plugin
 * Plugin Name:       Blog Sidebar Widget 
 * Plugin URI:        https://wordpress.org/plugins/blog-sidebar-widget/
 * Description:       Blog Sidebar Widget provides you necessary widgets for better and effective blogging.
 * Version:           1.0.1
 * Author:            avidthemes
 * Author URI:        https://profiles.wordpress.org/avidthemes/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       blog-sidebar-widget
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'BSW_PLUGIN_VERSION', '1.0.1' );
define( 'BSW_BASE_PATH', dirname( __FILE__ ) );
define( 'BSW_FILE_PATH', __FILE__ );
define( 'BSW_FILE_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
add_image_size( 'post-slider-thumb-size', 330, 190, true ); 

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-blog-sidebar-widget-activator.php
 */
function activate_blog_sidebar_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-blog-sidebar-widget-activator.php';
	Blog_Sidebar_Widget_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-blog-sidebar-widget-deactivator.php
 */
function deactivate_blog_sidebar_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-blog-sidebar-widget-deactivator.php';
	Blog_Sidebar_Widget_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_blog_sidebar_widget' );
register_deactivation_hook( __FILE__, 'deactivate_blog_sidebar_widget' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-blog-sidebar-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_blog_sidebar_widget() {

	$plugin = new Blog_Sidebar_Widget();
	$plugin->run();

}
run_blog_sidebar_widget();
