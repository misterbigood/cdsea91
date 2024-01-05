<?php
/**
 * Plugin Name: WP Activity Log for bbPress
 * Plugin URI: https://wpactivitylog.com/
 * Description: An extension to the WP Activity Log Plugin to track events within the bbPress plugin.
 * Text Domain: wsal-bbpress
 * Domain Path: /languages
 * Author: WP White Security
 * Author URI: https://www.wpwhitesecurity.com/
 * Version: 1.0.6
 * License: GPL2
 * Network: true
 *
 * @package Wsal
 * @subpackage Wsal Custom Events Loader
 */

use WSAL\Helpers\Classes_Helper;

/*
	Copyright(c) 2023  WP White Security  (email : info@wpwhitesecurity.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
	REQUIRED. Here we include and fire up the main core class. This will be needed regardless so be sure to leave line 37-39 in tact.
*/
require_once plugin_dir_path( __FILE__ ) . 'core/class-extension-core.php';
$wsal_extension = new \WPWhiteSecurity\ActivityLog\Extensions\Common\Core( __FILE__, 'wsal-bbpress' );

// Include extension specific functions.
require_once plugin_dir_path( __FILE__ ) . 'includes/wsal-functions.php';

add_action(
	'wsal_custom_alerts_register',
	/**
	* Adds sensors classes to the Class Helper
	*
	* @return void
	*
	* @since latest
	*/
	function () {
		require_once __DIR__ . '/wp-security-audit-log/class-bbpress-custom-alerts.php';

		Classes_Helper::add_to_class_map(
			array(
				'WSAL\\Custom_Alerts\\bbPress_Custom_Alerts' => __DIR__ . '/wp-security-audit-log/class-bbpress-custom-alerts.php',
			)
		);
	}
);
