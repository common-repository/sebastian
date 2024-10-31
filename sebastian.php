<?php

/**
 * @link              https://batuhan.me
 * @since             1.0.0
 * @package           Sebastian
 *
 * @wordpress-plugin
 * Plugin Name:       Sebastian
 * Plugin URI:        https://radix.works/sebastian
 * Description:       Sebastian is a simple Wordpress plugin that allows you to surprise your visitors. Like easter eggs.
 * Version:           1.0.0
 * Author:            Batuhan Kök
 * Author URI:        https://batuhan.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sebastian
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SEBASTIAN_VERSION', '1.0.0' );

function activate_sebastian() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sebastian-activator.php';
	Sebastian_Activator::activate();
}

function deactivate_sebastian() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sebastian-deactivator.php';
	Sebastian_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sebastian' );
register_deactivation_hook( __FILE__, 'deactivate_sebastian' );

require plugin_dir_path( __FILE__ ) . 'includes/class-sebastian.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sebastian() {

	$plugin = new Sebastian();
	$plugin->run();

}
run_sebastian();
