<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function um_bbpress_restrict_redirect() {
	$forum_id = bbp_get_forum_id();
	if ( UM()->access()->is_restricted( $forum_id ) ) {
		wp_safe_redirect( get_permalink( $forum_id ) );
	} else {
		$topic_id = bbp_get_topic_id();
		if ( UM()->access()->is_restricted( $topic_id ) ) {
			wp_safe_redirect( get_permalink( $topic_id ) );
		}
	}
}
add_action( 'bbp_template_before_single_topic', 'um_bbpress_restrict_redirect' );
add_action( 'bbp_template_before_single_reply', 'um_bbpress_restrict_redirect' );
