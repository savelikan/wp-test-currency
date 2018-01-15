<?php

use Premmerce\NewPlugin\NewPluginPlugin;
use Premmerce\NewPlugin\FileManager;

/**
 * Новий плагін plugin
 *
 *
 * @link              http://premmerce.com
 * @since             1.0.0
 * @package           Premmerce\NewPlugin
 *
 * @wordpress-plugin
 * Plugin Name:       Новий плагін
 * Plugin URI:        http://premmerce.com
 * Description:       Новий плагін
 * Version:           1.0
 * Author:            savelikan
 * Author URI:        http://premmerce.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       premmerce-new
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

call_user_func( function () {

	require_once plugin_dir_path( __FILE__ ) . 'autoload.php';

	$main = new NewPluginPlugin( new FileManager( __FILE__ ) );

	register_activation_hook( __FILE__, [ $main, 'activate' ] );

	register_deactivation_hook( __FILE__, [ $main, 'deactivate' ] );

	register_uninstall_hook( __FILE__, [ NewPluginPlugin::class, 'uninstall' ] );

	$main->run();
} );