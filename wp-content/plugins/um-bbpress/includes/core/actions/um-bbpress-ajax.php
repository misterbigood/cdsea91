<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load user's topics.
 *
 * @param array $args
 */
function um_bbpress_load_topics( $args ) {
	$array          = explode( ',', $args );
	$post_type      = sanitize_key( $array[0] );
	$posts_per_page = absint( $array[1] );
	$offset         = absint( $array[2] );
	$author         = absint( $array[3] );

	$offset_n      = $posts_per_page + $offset;
	$modified_args = "$post_type,$posts_per_page,$offset_n,$author";

	$loop = UM()->query()->make( "post_type=$post_type&posts_per_page=$posts_per_page&offset=$offset&author=$author" );

	$t_args = compact( 'loop', 'modified_args' );
	UM()->get_template( 'topics-single.php', um_bbpress_plugin, $t_args, true );
}
add_action( 'um_ajax_load_posts__um_bbpress_load_topics', 'um_bbpress_load_topics' );

/**
 * Load user's replies.
 *
 * @param array $args
 */
function um_bbpress_load_replies( $args ) {
	$array          = explode( ',', $args );
	$post_type      = sanitize_key( $array[0] );
	$posts_per_page = absint( $array[1] );
	$offset         = absint( $array[2] );
	$author         = absint( $array[3] );

	$offset_n      = $posts_per_page + $offset;
	$modified_args = "$post_type,$posts_per_page,$offset_n,$author";

	$loop = UM()->query()->make( "post_type=$post_type&posts_per_page=$posts_per_page&offset=$offset&author=$author" );

	$t_args = compact( 'loop', 'modified_args' );
	UM()->get_template( 'replies-single.php', um_bbpress_plugin, $t_args, true );
}
add_action( 'um_ajax_load_posts__um_bbpress_load_replies', 'um_bbpress_load_replies' );

function um_bbpress_remove_user_favorite() {
	UM()->check_ajax_nonce();

	// phpcs:disable WordPress.Security.NonceVerification -- already verified here
	if ( ! array_key_exists( 'topic', $_POST ) || ! is_numeric( $_POST['topic'] ) ) {
		wp_send_json_error( __( 'Invalid topic', 'um-bbpress' ) );
	}
	$topic_id  = absint( $_POST['topic'] );
	$topic_obj = get_post( $topic_id );
	if ( empty( $topic_obj ) ) {
		wp_send_json_error( __( 'Invalid topic', 'um-bbpress' ) );
	}

	if ( ! array_key_exists( 'user_id', $_POST ) || ! is_numeric( $_POST['user_id'] ) ) {
		wp_send_json_error( __( 'Invalid user', 'um-bbpress' ) );
	}
	$user_id  = absint( $_POST['user_id'] );
	$user_obj = get_userdata( $user_id );
	if ( empty( $user_obj ) ) {
		wp_send_json_error( __( 'Invalid user', 'um-bbpress' ) );
	}
	// phpcs:enable WordPress.Security.NonceVerification

	$result = bbp_remove_user_favorite( $user_id, $topic_id );
	if ( ! $result ) {
		wp_send_json_error( __( 'Invalid un-favorite data', 'um-bbpress' ) );
	}

	wp_send_json_success( 'success' );
}
add_action( 'wp_ajax_um_bbpress_remove_topic_favorite', 'um_bbpress_remove_user_favorite' );


function um_bbpress_remove_user_subscription() {
	UM()->check_ajax_nonce();

	// phpcs:disable WordPress.Security.NonceVerification -- already verified here
	if ( ! array_key_exists( 'argument', $_POST ) || ! is_numeric( $_POST['argument'] ) ) {
		wp_send_json_error( __( 'Invalid argument', 'um-bbpress' ) );
	}
	$post_id  = absint( $_POST['argument'] );
	$post_obj = get_post( $post_id );
	if ( empty( $post_obj ) ) {
		wp_send_json_error( __( 'Invalid argument', 'um-bbpress' ) );
	}

	if ( ! array_key_exists( 'user_id', $_POST ) || ! is_numeric( $_POST['user_id'] ) ) {
		wp_send_json_error( __( 'Invalid user', 'um-bbpress' ) );
	}
	$user_id  = absint( $_POST['user_id'] );
	$user_obj = get_userdata( $user_id );
	if ( empty( $user_obj ) ) {
		wp_send_json_error( __( 'Invalid user', 'um-bbpress' ) );
	}
	// phpcs:enable WordPress.Security.NonceVerification

	$result = bbp_remove_user_subscription( $user_id, $post_id );
	if ( ! $result ) {
		wp_send_json_error( __( 'Invalid unsubscribe data', 'um-bbpress' ) );
	}

	wp_send_json_success( 'success' );
}
add_action( 'wp_ajax_um_bbpress_remove_subscription', 'um_bbpress_remove_user_subscription' );
