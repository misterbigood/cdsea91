<?php // phpcs:disable WordPress.Security.NonceVerification.Recommended
/**
 * Add our filters.
 *
 * @package Wsal
 */

use WSAL\Helpers\Classes_Helper;

add_filter( 'wsal_event_objects', 'wsal_bbpress_add_custom_event_objects', 10, 2 );
add_filter( 'wsal_togglealerts_obsolete_events', 'wsal_bbpress_extension_togglealerts_obsolete_events' );
add_filter( 'wsal_ignored_custom_post_types', 'wsal_bbpress_extension_add_custom_ignored_cpt' );

/**
 * Adds new custom event objects for our plugin
 *
 * @method wsal_bbpress_add_custom_event_objects
 * @since  1.0.0
 * @param  array $objects An array of default objects.
 * @return array
 */
function wsal_bbpress_add_custom_event_objects( $objects ) {
	$new_objects = array(
		'bbpress'       => __( 'BBPress', 'wsal-bbpress' ),
		'bbpress-forum' => __( 'BBPress Forum', 'wsal-bbpress' ),
	);

	// combine the two arrays.
	$objects = array_merge( $objects, $new_objects );

	return $objects;
}

/**
 * Add obsolete events to the togglealerts view.
 *
 * @param  array $obsolete_events = An array of currently obsolete events.
 * @return array $obsolete_events - Appended array.
 */
function wsal_bbpress_extension_togglealerts_obsolete_events( $obsolete_events ) {
	$new_events      = array(
		4013,
	);
	$obsolete_events = array_merge( $obsolete_events, $new_events );
	return $obsolete_events;
}

/**
 * Adds new ignored CPT for our plugin
 *
 * @method wsal_woocommerce_extension_add_custom_event_object_text
 * @since  1.0.0
 * @param  array $post_types An array of default post_types.
 * @return array
 */
function wsal_bbpress_extension_add_custom_ignored_cpt( $post_types ) {
	$new_post_types = array(
		'forum',
		'topic',
		'reply',
	);

	// combine the two arrays.
	$post_types = array_merge( $post_types, $new_post_types );
	return $post_types;
}

add_action(
	'wsal_sensors_manager_add',
	/**
	* Adds sensors classes to the Class Helper
	*
	* @return void
	*
	* @since latest
	*/
	function () {
		require_once __DIR__ . '/../wp-security-audit-log/sensors/class-bbpress-sensor.php';
		require_once __DIR__ . '/../wp-security-audit-log/sensors/class-bbpress-user-sensor.php';
		require_once __DIR__ . '/../wp-security-audit-log/sensors/class-bbpress-system-sensor.php';

		Classes_Helper::add_to_class_map(
			array(
				'WSAL\\Plugin_Sensors\\BBPress_Sensor' => __DIR__ . '/../wp-security-audit-log/sensors/class-wpforms-sensor.php',
				'WSAL\\Plugin_Sensors\\BBPress_User_Sensor' => __DIR__ . '/../wp-security-audit-log/sensors/class-wpforms-sensor.php',
				'WSAL\\Plugin_Sensors\\BBPress_System_Sensor' => __DIR__ . '/../wp-security-audit-log/sensors/class-wpforms-sensor.php',
			)
		);
	}
);

