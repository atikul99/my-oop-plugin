<?php

/*
 * Plugin Name:       My OOP Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Atikul Islam
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-oop-plugin/
 * Text Domain:       my-oop-plugin
 * Domain Path:       /languages
 */

define( 'MY_OOP_PLUGIN_VERSION', '1.0.0' );

define( 'MY_OOP_PLUGIN_URL', plugin_dir_url(__FILE__) );

/**
 * Activation hook
 *
 * @author Atikul Islam
 * @version 1.0.0
 */

function my_oop_plugin_activate() {

	require_once plugin_dir_path( __FILE__ ) . 'inc/my-activation-class.php';
	Activate::activate();

}
register_activation_hook( __FILE__, 'my_oop_plugin_activate');

/**
 * Deactivation hook
 *
 * @author Atikul Islam
 * @version 1.0.0
 */

function my_oop_plugin_deactivate() {
	
	require_once plugin_dir_path( __FILE__ ) . 'inc/my-deactivation-class.php';
	Deactivate::deactivate();

}
register_deactivation_hook( __FILE__, 'my_oop_plugin_deactivate' );

/**
 * Initialize main class
 *
 * @author Atikul Islam
 * @version 1.0.0
 */

require plugin_dir_path( __FILE__ ) . 'inc/my-oop-plugin-class.php';

$plugin = new myOPPClass();

