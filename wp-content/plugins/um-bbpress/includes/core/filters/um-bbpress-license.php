<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Extend settings
 *
 * @param array $settings
 *
 * @return array
 */
function um_bbpress_settings( $settings ) {
	$settings['licenses']['fields'][] = array(
		'id'        => 'um_bbpress_license_key',
		'label'     => __( 'bbPress License Key', 'um-bbpress' ),
		'item_name' => 'bbPress',
		'author'    => 'Ultimate Member',
		'version'   => um_bbpress_version,
	);

	return $settings;
}
add_filter( 'um_settings_structure', 'um_bbpress_settings' );
