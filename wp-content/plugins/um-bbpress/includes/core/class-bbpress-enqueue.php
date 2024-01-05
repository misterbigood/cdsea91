<?php
namespace um_ext\um_bbpress\core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class bbPress_Enqueue
 * @package um_ext\um_bbpress\core
 */
class bbPress_Enqueue {

	/**
	 * bbPress_Enqueue constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( &$this, 'wp_enqueue_scripts' ), 0 );
	}

	/**
	 *
	 */
	public function wp_enqueue_scripts() {
		$suffix = UM()->frontend()->enqueue()::get_suffix();
		wp_register_style( 'um_bbpress', um_bbpress_url . 'assets/css/um-bbpress' . $suffix . '.css', array( 'um_tipsy' ), um_bbpress_version );
		wp_register_script( 'um_bbpress', um_bbpress_url . 'assets/js/um-bbpress' . $suffix . '.js', array( 'jquery', 'um_tipsy' ), um_bbpress_version, true );
	}
}
