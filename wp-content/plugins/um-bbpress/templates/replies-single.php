<?php
/**
 * Template for the UM bbPress "Replies Created" subtab items
 * Used on the "Profile" page, "Forums" tab
 * Called from the um_bbpress_load_replies() function
 * @version 2.1.3
 *
 * This template can be overridden by copying it to yourtheme/ultimate-member/um-bbpress/replies-single.php
 * @var object $loop
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

while ( $loop->have_posts() ) {
	$loop->the_post();
	$reply_id = get_the_ID();
	?>
	<div class="um-item">
		<div class="um-item-link"><a href="<?php bbp_reply_url( $reply_id ); ?>"><?php bbp_reply_title( $reply_id ); ?></a></div>
		<div class="um-item-meta">
			<?php // translators: %s is a topic's replies count. ?>
			<span><?php printf( __( 'This topic has %s more replies', 'um-bbpress' ), bbp_get_topic_reply_count( bbp_get_reply_topic_id( $reply_id ) ) - 1 ); ?></span>
		</div>
	</div>
	<?php
}

if ( isset( $modified_args ) && $loop->have_posts() && ( (int) $loop->query['offset'] + 10 < (int) $loop->found_posts ) ) {
	?>
	<div class="um-load-items">
		<a href="javascript:void(0);" class="um-ajax-paginate um-button" data-hook="um_bbpress_load_replies" data-args="<?php echo esc_attr( $modified_args ); ?>"><?php esc_html_e( 'load more replies', 'um-bbpress' ); ?></a>
	</div>
	<?php
}
