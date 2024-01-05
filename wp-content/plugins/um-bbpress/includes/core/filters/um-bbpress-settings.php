<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add new activity action
 *
 * @param $actions
 *
 * @return mixed
 */
function um_bbpress_social_activity_action( $actions ) {
	$actions['new-topic'] = __( 'New forum topic', 'um-bbpress' );
	return $actions;
}
add_filter( 'um_activity_global_actions', 'um_bbpress_social_activity_action', 10, 1 );

/**
 * @param $settings
 * @param $key
 *
 * @return mixed
 */
function um_bbpress_mycred_settings_extend( $settings, $key ) {
	$settings['extensions']['sections'][ $key ]['fields'] = array_merge(
		$settings['extensions']['sections'][ $key ]['fields'],
		array(
			array(
				'id'    => 'mycred_hide_role',
				'type'  => 'checkbox',
				'label' => __( 'Hide bbPress Role?', 'um-bbpress' ),
			),
			array(
				'id'    => 'mycred_show_bb_rank',
				'type'  => 'checkbox',
				'label' => __( 'Show user rank in bbPress replies', 'um-bbpress' ),
			),
			array(
				'id'    => 'mycred_show_bb_points',
				'type'  => 'checkbox',
				'label' => __( 'Show user balance in bbPress replies', 'um-bbpress' ),
			),
			array(
				'id'    => 'mycred_show_bb_progress',
				'type'  => 'checkbox',
				'label' => __( 'Show user progress in bbPress replies', 'um-bbpress' ),
			),
		)
	);

	return $settings;
}
add_filter( 'um_mycred_settings_extend', 'um_bbpress_mycred_settings_extend', 10, 2 );

/**
 * Scan templates from extension
 *
 * @param $scan_files
 *
 * @return array
 */
function um_bbpress_extend_scan_files( $scan_files ) {
	$extension_files['um-bbpress'] = UM()->admin_settings()->scan_template_files( um_bbpress_path . '/templates/' );
	$scan_files                    = array_merge( $scan_files, $extension_files );

	return $scan_files;
}
add_filter( 'um_override_templates_scan_files', 'um_bbpress_extend_scan_files', 10, 1 );

/**
 * Get template paths
 *
 * @param $located
 * @param $file
 *
 * @return array
 */
function um_bbpress_get_path_template( $located, $file ) {
	if ( file_exists( get_stylesheet_directory() . '/ultimate-member/um-bbpress/' . $file ) ) {
		$located = array(
			'theme' => get_stylesheet_directory() . '/ultimate-member/um-bbpress/' . $file,
			'core'  => um_bbpress_path . 'templates/' . $file,
		);
	}
	return $located;
}
add_filter( 'um_override_templates_get_template_path__um-bbpress', 'um_bbpress_get_path_template', 10, 2 );
