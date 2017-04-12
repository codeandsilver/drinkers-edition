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
 * @package           drinkers_edition
 *
 * @wordpress-plugin
 * Plugin Name:       Drinkers Edition
 * Plugin URI:        
 * Description:       Lets users browse deals by day, and then filter these deals based on a time, neighborhood, food. 
 * Version:           1.0.0
 * Author:            Code and Silver
 * Author URI:        http://codeandsilver.com/
 * Text Domain:       drinkers-edition
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_plugin_drinkers_edition() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-drinkers-edition-activator.php';
	Drinkers_Edition_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_plugin_drinkers_edition() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-drinkers-edition-deactivator.php';
	Drinkers_Edition_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plugin_drinkers_edition' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_drinkers_edition' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-drinkers-edition.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_drinkers_edition() {

	$plugin = new Drinkers_Edition();
	$plugin->run();

}
run_plugin_drinkers_edition();
